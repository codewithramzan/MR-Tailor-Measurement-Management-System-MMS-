<?php

class Measurement extends Model
{
    protected $table = "measurements";

    // Get measurement fields by garment category
   public function getTypes($garmentType)
    {
        // Map garment types to measurement categories
        $categoryMap = [

            "Shalwar Kameez" => ["Shirt", "Trouser"],

            "Shirt"          => ["Shirt"],

            "Trouser"        => ["Trouser"],

            "Pant"           => ["Trouser"],

        ];

        // Default: use garment type itself
        $categories = $categoryMap[$garmentType] ?? [$garmentType];

        $placeholders = implode(',', array_fill(0, count($categories), '?'));

        $sql = "
            SELECT *
            FROM measurement_types
            WHERE category IN ($placeholders)
            ORDER BY print_order ASC, id ASC
        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute($categories);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Save measurements
    public function save($orderId, $measurements)
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
                measurement_types.name,
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
        $delete=$this->conn->prepare(

            "DELETE FROM measurements

            WHERE order_id=?"

        );

        $delete->execute([$orderId]);

        $insert=$this->conn->prepare(

            "INSERT INTO measurements

            (order_id,

            measurement_type_id,

            measurement_value)

            VALUES(?,?,?)"

        );

        foreach($measurements as $type=>$value){

            $insert->execute([

                $orderId,

                $type,

                $value

            ]);

        }
    }


    public function getSlip($orderId)
    {
        $sql = "
        SELECT

        o.id,
        o.booking_no,
        o.order_date,
        o.delivery_date,
        o.garment_type,
        o.total_amount,
        o.advance,
        o.discount,
        o.balance,

        c.full_name,
        c.phone,
        c.village,

        mt.name,
        mt.urdu_name,
        mt.print_order,

        m.measurement_value

        FROM orders o

        INNER JOIN customers c
        ON c.id=o.customer_id

        LEFT JOIN measurements m
        ON o.id=m.order_id

        LEFT JOIN measurement_types mt
        ON mt.id=m.measurement_type_id

        WHERE o.id=?

        ORDER BY mt.print_order ASC
        ";

        $stmt=$this->conn->prepare($sql);

        $stmt->execute([$orderId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOptions($orderId)
    {
        $sql="

        SELECT

        s.urdu_name

        FROM order_stitching_options o

        INNER JOIN stitching_options s

        ON s.id=o.option_id

        WHERE o.order_id=?

        ";

        $stmt=$this->conn->prepare($sql);

        $stmt->execute([$orderId]);

        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function saveOptions($orderId,$options)
    {
        $delete=$this->conn->prepare(

            "DELETE FROM order_stitching_options
            WHERE order_id=?"

        );

        $delete->execute([$orderId]);

        if(empty($options))
        {
            return;
        }

        $insert=$this->conn->prepare(

            "INSERT INTO order_stitching_options
            (order_id,option_id)

            VALUES(?,?)"

        );

        foreach($options as $id)
        {
            $insert->execute([

                $orderId,

                $id

            ]);
        }
    }


    public function getSelectedOptions($orderId)
    {
        $stmt=$this->conn->prepare(

            "SELECT option_id

            FROM order_stitching_options

            WHERE order_id=?"

        );

        $stmt->execute([$orderId]);

        return $stmt->fetchAll(

            PDO::FETCH_COLUMN

        );
    }
}