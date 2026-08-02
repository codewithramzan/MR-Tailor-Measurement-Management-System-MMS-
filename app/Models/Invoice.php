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
                gt.name AS garment_name,
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
            INNER JOIN garment_types gt
                ON gt.id = o.garment_type_id;
            

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
                c.mohalla,

                gt.name AS garment_name

            FROM orders o

            INNER JOIN customers c
                ON c.id = o.customer_id
            INNER JOIN garment_types gt
                ON gt.id = o.garment_type_id

            WHERE o.id = ?

            LIMIT 1

        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([$orderId]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

     /* -------------------------------------------------------
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
              gt.name AS garment_name,
              mt.print_order,
              m.measurement_value

          FROM measurements m

          INNER JOIN measurement_types mt
              ON mt.id = m.measurement_type_id
          INNER JOIN garment_types gt
              ON gt.id = mt.garment_type_id

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
                s.id,
                s.option_name,
                s.urdu_name,
                s.category,
                s.selection_type,
                s.print_order

            FROM order_stitching_options os

            INNER JOIN stitching_options s
                ON s.id = os.option_id

            INNER JOIN orders o
                ON o.id = os.order_id

            WHERE
                os.order_id = ?
                AND s.garment_type_id = o.garment_type_id
                AND s.status = 1

            ORDER BY
                s.category ASC,
                s.print_order ASC,
                s.id ASC

        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$orderId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}