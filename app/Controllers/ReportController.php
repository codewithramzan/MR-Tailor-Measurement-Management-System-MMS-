<?php

class ReportController extends Controller
{
    private $reportModel;

    public function __construct()
    {
        $this->reportModel = new Report();
    }

    /*
    |--------------------------------------------------------------------------
    | Report Dashboard
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $summary = $this->reportModel->getDashboardSummary();

        $this->view(
            'reports/dashboard',
            compact('summary')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Daily Report
    |--------------------------------------------------------------------------
    */

    public function daily()
    {
        $date = $_GET['date'] ?? date('Y-m-d');

        $reports = $this->reportModel->daily($date);

        $this->view(
            'reports/daily',
            compact(
                'reports',
                'date'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Monthly Report
    |--------------------------------------------------------------------------
    */

    public function monthly()
    {
        $month = (int)($_GET['month'] ?? date('m'));
        $year  = (int)($_GET['year'] ?? date('Y'));

        $reports = $this->reportModel->monthly(
            $month,
            $year
        );

        $this->view(
            'reports/monthly',
            compact(
                'reports',
                'month',
                'year'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Customer Report
    |--------------------------------------------------------------------------
    */

    public function customers()
    {
        $reports = $this->reportModel->customers();

        $this->view(
            'reports/customers',
            compact('reports')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Income Report
    |--------------------------------------------------------------------------
    */

    public function income()
    {
        $from = $_GET['from'] ?? date('Y-m-01');
        $to   = $_GET['to'] ?? date('Y-m-t');

        $reports = $this->reportModel->income(
            $from,
            $to
        );

        $this->view(
            'reports/income',
            compact(
                'reports',
                'from',
                'to'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Pending Orders
    |--------------------------------------------------------------------------
    */

    public function pending()
    {
        $reports = $this->reportModel->pending();

        $this->view(
            'reports/pending',
            compact('reports')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Ready Orders
    |--------------------------------------------------------------------------
    */

    public function ready()
    {
        $reports = $this->reportModel->ready();

        $this->view(
            'reports/ready',
            compact('reports')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Delivered Orders
    |--------------------------------------------------------------------------
    */

    public function delivered()
    {
        $reports = $this->reportModel->delivered();

        $this->view(
            'reports/delivered',
            compact('reports')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Invoice Report
    |--------------------------------------------------------------------------
    */

    public function invoices()
    {
        $reports = $this->reportModel->invoices();

        $this->view(
            'reports/invoices',
            compact('reports')
        );
    }

    public function getStatusColor($status) {
        
        $badge = "secondary";

        switch($status){

            case "Pending":
                $badge = "warning";
                break;

            case "Ready":
                $badge = "primary";
                break;

            case "Delivered":
                $badge = "success";
                break;

        }

          return $badge;           
    }
}