<?php

class Measurement extends Model
{
    protected $table = "measurements";

    // Get measurement fields by garment type
    public function getTypes($garmentTypeId)
    {
        $stmt = $this->conn->prepare("
            SELECT *
            FROM measurement_types
            WHERE garment_type_id = ?
            AND status = 'Active'
            ORDER BY section, print_order, id
        ");

        $stmt->execute([$garmentTypeId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
        // Save measurements
    public
     function save($orderId, $measurements)
    {
        // Remove old measurements
        $delete = $this->conn->prepare("
            DELETE FROM measurements
            WHERE order_id = ?
        ");

        $delete->execute([$orderId]);

        if (empty($measurements)) {
            return true;
        }

        $stmt = $this->conn->prepare("
            INSERT INTO measurements
            (
                order_id,
                measurement_type_id,
                measurement_value
            )
            VALUES (?, ?, ?)
        ");

        foreach ($measurements as $typeId => $value) {

            $value = trim($value);

            if ($value === '') {
                continue;
            }

            $stmt->execute([
                $orderId,
                $typeId,
                $value
            ]);
        }

        return true;
    }

    // Get existing measurements (for edit page later)
    public function getByOrder($orderId)
    {
        $stmt = $this->conn->prepare("
            SELECT
                measurement_types.option_name,
                measurements.measurement_value
            FROM measurements
            JOIN measurement_types
                ON measurement_types.id = measurements.measurement_type_id
            WHERE measurements.order_id = ?
            ORDER BY measurement_types.id
        ");

        $stmt->execute([$orderId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

   public function getMeasurements($orderId)
    {
        $sql="

        SELECT

        measurement_type_id,

        measurement_value

        FROM measurements

        WHERE order_id=?

        ";

        $stmt=$this->conn->prepare($sql);

        $stmt->execute([$orderId]);

        $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);

        $data=[];

        foreach($rows as $row){

            $data[$row['measurement_type_id']]

                =$row['measurement_value'];

        }

        return $data;
    }

    public function updateMeasurements($orderId,$measurements)
    {
        return $this->save($orderId,$measurements);
    }

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

            ORDER BY

                s.category ASC,
                s.print_order ASC,
                s.id ASC

        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([$orderId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
 public function getSlip($orderId)
{
    $sql = "

        SELECT

            /* ==========================
               ORDER
            ========================== */

            o.id,
            o.booking_no,
            o.order_date,
            o.delivery_date,
            o.status,

            o.total_amount,
            o.advance,
            o.discount,
            o.balance,

            /* ==========================
               CUSTOMER
            ========================== */

            c.full_name,
            c.father_name,
            c.phone,
            c.village,
            c.mohalla,

            /* ==========================
               GARMENT
            ========================== */

            gt.id AS garment_type_id,
            gt.name AS garment_name,
            gt.urdu_name AS garment_urdu_name,

            /* ==========================
               MEASUREMENT TYPE
            ========================== */

            mt.id AS measurement_type_id,
            mt.option_name,
            mt.urdu_name AS measurement_urdu_name,
            mt.section,
            mt.section_urdu,
            mt.print_order,

            /* ==========================
               SAVED MEASUREMENT
            ========================== */

            m.measurement_value

        FROM orders o

        INNER JOIN customers c
            ON c.id = o.customer_id

        INNER JOIN garment_types gt
            ON gt.id = o.garment_type_id

        /*
        IMPORTANT:
        Only measurement records actually
        saved for this order are returned.
        */

        INNER JOIN measurements m
            ON m.order_id = o.id

        INNER JOIN measurement_types mt
            ON mt.id = m.measurement_type_id

        WHERE o.id = ?

        ORDER BY

            mt.section ASC,
            mt.print_order ASC,
            mt.id ASC

    ";

    $stmt = $this->conn->prepare($sql);

    $stmt->execute([$orderId]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function saveOptions($orderId, $options)
{
    $delete = $this->conn->prepare("
        DELETE FROM order_stitching_options
        WHERE order_id = ?
    ");

    $delete->execute([$orderId]);

    if (empty($options)) {
        return true;
    }

    $insert = $this->conn->prepare("
        INSERT INTO order_stitching_options
        (
            order_id,
            option_id
        )
        VALUES (?, ?)
    ");

    foreach ($options as $id) {

        $insert->execute([
            $orderId,
            $id
        ]);
    }

    return true;
}


public function getSelectedOptionIds($orderId)
{
    $stmt = $this->conn->prepare("
        SELECT option_id
        FROM order_stitching_options
        WHERE order_id = ?
    ");

    $stmt->execute([$orderId]);

    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

}