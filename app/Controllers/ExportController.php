<?php

use Dompdf\Dompdf;
use Dompdf\Options;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportController extends Controller
{
    private Report $reportModel;

    public function __construct()
    {
        $this->reportModel = new Report();
    }

    /*
    |--------------------------------------------------------------------------
    | Main Entry Point
    |--------------------------------------------------------------------------
    |
    | Example:
    |
    | index.php?page=export&type=daily&format=pdf
    |
    | index.php?page=export&type=monthly&format=excel
    |
    */

    public function export()
    {
        $type = strtolower($_GET['type'] ?? '');
        $format = strtolower($_GET['format'] ?? '');

        if (!in_array($format, ['pdf', 'excel'])) {

            die('Invalid export format.');

        }

        $data = $this->getReportData($type);

        if ($format === 'pdf') {

            $this->exportPdf($type, $data);

            return;

        }

        $this->exportExcel($type, $data);
    }

    /*
    |--------------------------------------------------------------------------
    | Load Report Data
    |--------------------------------------------------------------------------
    */

    private function getReportData(string $type): array
    {
        switch ($type) {

            case 'daily':

                return $this->reportModel->daily(
                    $_GET['date'] ?? date('Y-m-d')
                );

            case 'monthly':

                return $this->reportModel->monthly(
                    $_GET['month'] ?? date('m'),
                    $_GET['year'] ?? date('Y')
                );

            case 'customers':

                return $this->reportModel->customers();

            case 'income':

                return $this->reportModel->income(
                    $_GET['from'] ?? date('Y-m-01'),
                    $_GET['to'] ?? date('Y-m-d')
                );

            case 'pending':

                return $this->reportModel->pending();

            case 'ready':

                return $this->reportModel->ready();

            case 'delivered':

                return $this->reportModel->delivered();

            case 'invoice':

                return $this->reportModel->invoices(
                    $_GET['from'] ?? '',
                    $_GET['to'] ?? '',
                    $_GET['status'] ?? '' );

            default:

                die("Invalid report type.");
        }
    }

    /*
    |--------------------------------------------------------------------------
    | PDF Export
    |--------------------------------------------------------------------------
    */

    private function exportPdf(string $title, array $data): void
    {
        $html = $this->buildPdfHtml($title, $data);

        $options = new Options();

        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);

        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'landscape');

        $dompdf->render();

        $dompdf->stream(

            $title . "_" . date('Ymd_His') . ".pdf",

            [
                "Attachment" => true
            ]

        );
    }

    /*
    |/*
  |--------------------------------------------------------------------------
  | Export Excel
  |--------------------------------------------------------------------------
  */

  private function exportExcel(string $title, array $data): void
  {
      $spreadsheet = new Spreadsheet();

      $sheet = $spreadsheet->getActiveSheet();

      $sheet->setTitle(ucfirst($title));

      /*
      |--------------------------------------------------------------------------
      | Report Title
      |--------------------------------------------------------------------------
      */

      $sheet->mergeCells('A1:H1');

      $sheet->setCellValue('A1', 'MR Tailor Management System');

      $sheet->mergeCells('A2:H2');

      $sheet->setCellValue('A2', strtoupper($title) . ' REPORT');

      $sheet->mergeCells('A3:H3');

      $sheet->setCellValue(
          'A3',
          'Generated: ' . date('d M Y h:i A')
      );

      /*
      |--------------------------------------------------------------------------
      | Styles
      |--------------------------------------------------------------------------
      */

      $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(18);

      $sheet->getStyle('A2')->getFont()->setBold(true)->setSize(14);

      $sheet->getStyle('A3')->getFont()->setItalic(true);

      if (empty($data)) {

          $sheet->setCellValue('A5', 'No records found.');

      } else {

          /*
          |--------------------------------------------------------------------------
          | Header Row
          |--------------------------------------------------------------------------
          */

          $headers = array_keys($data[0]);

          $column = 'A';

          foreach ($headers as $header) {

              $sheet->setCellValue(

                  $column . '5',

                  ucwords(str_replace('_', ' ', $header))

              );

              $column++;
          }

          /*
          |--------------------------------------------------------------------------
          | Header Style
          |--------------------------------------------------------------------------
          */

          $lastColumn = chr(ord('A') + count($headers) - 1);

          $sheet->getStyle("A5:{$lastColumn}5")
                ->getFont()
                ->setBold(true);

          /*
          |--------------------------------------------------------------------------
          | Data Rows
          |--------------------------------------------------------------------------
          */

          $rowNumber = 6;

          foreach ($data as $row) {

              $column = 'A';

              foreach ($headers as $header) {

                  $sheet->setCellValue(

                      $column . $rowNumber,

                      $row[$header]

                  );

                  $column++;
              }

              $rowNumber++;
          }

          /*
          |--------------------------------------------------------------------------
          | Auto Size Columns
          |--------------------------------------------------------------------------
          */

          foreach (range('A', $lastColumn) as $col) {

              $sheet->getColumnDimension($col)
                    ->setAutoSize(true);

          }

          /*
          |--------------------------------------------------------------------------
          | Freeze Header
          |--------------------------------------------------------------------------
          */

          $sheet->freezePane('A6');

          /*
          |--------------------------------------------------------------------------
          | Auto Filter
          |--------------------------------------------------------------------------
          */

          $sheet->setAutoFilter(
              "A5:{$lastColumn}" . ($rowNumber - 1)
          );
      }

      /*
      |--------------------------------------------------------------------------
      | Download
      |--------------------------------------------------------------------------
      */

      header(
          'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
      );

      header(
          'Content-Disposition: attachment; filename="' .
          strtolower($title) .
          '_' .
          date('Ymd_His') .
          '.xlsx"'
      );

      header('Cache-Control: max-age=0');

      $writer = new Xlsx($spreadsheet);

      $writer->save('php://output');

      exit;
  }
  

//  HTML Builder
    private function buildPdfHtml(string $title, array $data): string
    {
        ob_start();

        include dirname(__DIR__) . '/Views/exports/pdf.php';

        return ob_get_clean();
    }
}