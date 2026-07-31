<?php

class Invoice extends Model
{
    /**
     * -------------------------------------------------------
     * Get All Invoices
     * -------------------------------------------------------
     */
    public function getAll()
    {
        $sql = "

            SELECT

                o.id,
                o.booking_no,
                o.invoice_no,
                o.order_date,
                o.delivery_date,
                o.garment_type_id,
                o.total_amount,
                o.advance,
                o.discount,
                o.balance,
                o.status,

                c.full_name,
                c.phone

            FROM orders o

            INNER JOIN customers c
                ON c.id = o.customer_id

            ORDER BY o.id DESC

        ";
          $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * -------------------------------------------------------
     * Find Invoice by Order ID
     * -------------------------------------------------------
     */
    public function find($orderId)
    {
        $sql = "

            SELECT

                o.*,

                c.full_name,
                c.phone,
                c.father_name,
                c.village,
                c.mohalla

            FROM orders o

            INNER JOIN customers c
                ON c.id = o.customer_id

            WHERE o.id = ?

            LIMIT 1

        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([$orderId]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * -------------------------------------------------------
     * Generate Invoice Number
     * -------------------------------------------------------
     */
        // public function generateInvoiceNumber()
        // {
        //     $stmt = $this->conn->query("
        //         SELECT invoice_no
        //         FROM orders
        //         WHERE invoice_no IS NOT NULL
        //         ORDER BY id DESC
        //         LIMIT 1
        //     ");

        //     $last = $stmt->fetch(PDO::FETCH_ASSOC);

        //     if (!$last || empty($last['invoice_no'])) {
        //         return "INV-0001";
        //     }

        //     $number = (int) preg_replace('/\D/', '', $last['invoice_no']);

        //     $number++;

        //     return "INV-" . str_pad($number, 4, "0", STR_PAD_LEFT);
        // }

    /**
     * -------------------------------------------------------
     * Save Invoice Number
     * -------------------------------------------------------
     */
    public function saveInvoiceNumber($orderId, $invoiceNo)
    {
        $sql = "
            UPDATE orders
            SET invoice_no = ?
            WHERE id = ?
        ";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $invoiceNo,
            $orderId
        ]);
    }

    /**
     * -------------------------------------------------------
     * Measurements
     * -------------------------------------------------------
     */
  public function getMeasurements($orderId)
  {
      $sql = "
          SELECT
              mt.option_name,
              mt.urdu_name,
              mt.section,
              mt.garment_type_id,
              mt.print_order,
              m.measurement_value

          FROM measurements m

          INNER JOIN measurement_types mt
              ON mt.id = m.measurement_type_id

          WHERE m.order_id = ?

          ORDER BY
              mt.garment_type_id,
              mt.section,
              mt.print_order,
              mt.id
      ";

      $stmt = $this->conn->prepare($sql);

      $stmt->execute([$orderId]);

      return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
    /**
     * -------------------------------------------------------
     * Stitching Options
     * -------------------------------------------------------
     */
    public function getOptions($orderId)
    {
        $sql = "

            SELECT

                s.category,
                s.option_name,
                s.urdu_name

            FROM order_stitching_options oso

            INNER JOIN stitching_options s
                ON s.id = oso.option_id

            WHERE oso.order_id = ?

            ORDER BY
                s.category,
                s.print_order,
                s.id

        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$orderId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * -------------------------------------------------------
     * Print Invoice Data
     * -------------------------------------------------------
     */
    public function getPrintData($orderId)
    {
        return [
            'invoice' => $this->find($orderId),
            'measurements' => $this->getMeasurements($orderId),
            'options' => $this->getOptions($orderId)
        ];
    }
}