<?php

class Setting extends Model
{
    public function getSettings()
    {
        $stmt = $this->conn->prepare("SELECT * FROM settings LIMIT 1");

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateSettings($data)
    {
        $sql = "UPDATE settings SET

                shop_name = ?,
                owner_name = ?,
                phone = ?,
                email = ?,
                website = ?,
                address = ?,
                currency = ?,
                timezone = ?,
                invoice_footer = ?,
                logo = ?

                WHERE id = 1";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([

            $data['shop_name'],
            $data['owner_name'],
            $data['phone'],
            $data['email'],
            $data['website'],
            $data['address'],
            $data['currency'],
            $data['timezone'],
            $data['invoice_footer'],
            $data['logo']

        ]);
    }
        /*--------------------------------------------------
    | Get All Garments
    --------------------------------------------------*/

    public function getGarments()
    {
        $stmt = $this->conn->prepare("
            SELECT DISTINCT garment_type
            FROM measurement_types
            WHERE status='Active'
            ORDER BY garment_type ASC
        ");

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /*--------------------------------------------------
    | Get All Measurement Types
    --------------------------------------------------*/

    public function getMeasurementTypes()
    {
        $stmt = $this->conn->prepare("
            SELECT *
            FROM measurement_types
            ORDER BY
                garment_type,
                section,
                display_order,
                option_name
        ");

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    /*--------------------------------------------------
    | Find Measurement Type
    --------------------------------------------------*/

    public function getMeasurementTypeById($id)
    {
        $stmt = $this->conn->prepare("
            SELECT *
            FROM measurement_types
            WHERE id=?
        ");

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    /*--------------------------------------------------
    | Add Measurement Type
    --------------------------------------------------*/

    public function addMeasurementType($data)
    {
        $stmt = $this->conn->prepare("
            INSERT INTO measurement_types
            (
                garment_type,
                section,
                option_name,
                urdu_name,
                placeholder,
                display_order,
                status
            )
            VALUES
            (
                ?,?,?,?,?,?,?
            )
        ");

        return $stmt->execute([

            $data["garment_type"],

            $data["section"],

            $data["option_name"],

            $data["urdu_name"],

            $data["placeholder"],

            $data["display_order"],

            $data["status"]

        ]);
    }
    /*--------------------------------------------------
| Update Measurement Type
--------------------------------------------------*/

    public function updateMeasurementType($id,$data)
    {
        $stmt = $this->conn->prepare("
            UPDATE measurement_types
            SET

            garment_type=?,

            section=?,

            option_name=?,

            urdu_name=?,

            placeholder=?,

            display_order=?,

            status=?

            WHERE id=?
        ");

        return $stmt->execute([

            $data["garment_type"],

            $data["section"],

            $data["option_name"],

            $data["urdu_name"],

            $data["placeholder"],

            $data["display_order"],

            $data["status"],

            $id

        ]);
    }
    /*--------------------------------------------------
    | Soft Delete Measurement Type
    --------------------------------------------------*/

        public function deleteMeasurementType($id)
        {
            $stmt = $this->conn->prepare("
                UPDATE measurement_types
                SET status='Inactive'
                WHERE id=?
            ");

            return $stmt->execute([$id]);
        }
}