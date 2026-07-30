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
  /*--------------------------------------------------
    | Duplicate check
    --------------------------------------------------*/
        public function measurementExists($garment, $section, $option)
        {
            $stmt = $this->conn->prepare("
                SELECT id
                FROM measurement_types
                WHERE garment_type = ?
                AND section = ?
                AND option_name = ?
                LIMIT 1
            ");

            $stmt->execute([
                $garment,
                $section,
                $option
            ]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        /*--------------------------------------------------
        | Get All Stitching Options
        --------------------------------------------------*/

        public function getStitchingOptions()
        {
            $stmt = $this->conn->prepare("
                SELECT *
                FROM stitching_options
                ORDER BY
                    category,
                    print_order,
                    option_name
            ");

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        //1	French Collar	فرنچ کالر	Collar	Radio*--------------------------------------------------
         //Get Categories
        /*--------------------------------------------------*/

        public function getStitchingCategories()
        {
            $stmt = $this->conn->prepare("
                SELECT DISTINCT category
                FROM stitching_options
                ORDER BY category
            ");

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        /*--------------------------------------------------
        | Find Stitching Option
        --------------------------------------------------*/

        public function getStitchingOptionById($id)
        {
            $stmt = $this->conn->prepare("
                SELECT *
                FROM stitching_options
                WHERE id=?
            ");

            $stmt->execute([$id]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        /*--------------------------------------------------
        | Duplicate Check
        --------------------------------------------------*/

       public function stitchingOptionExists($option,$category)
        {
            $stmt = $this->conn->prepare("
                SELECT id
                FROM stitching_options
                WHERE LOWER(option_name)=LOWER(?)
                AND LOWER(category)=LOWER(?)
                LIMIT 1
            ");

            $stmt->execute([
                trim($option),
                trim($category)
            ]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        /*--------------------------------------------------
        | Add Stitching Option
        --------------------------------------------------*/

        public function addStitchingOption($data)
        {
            $stmt = $this->conn->prepare("
                INSERT INTO stitching_options
                (
                    option_name,
                    urdu_name,
                    category,
                    print_order,
                    selection_type,
                    status
                )
                VALUES
                (
                    ?,?,?,?,?,?
                )
            ");

            return $stmt->execute([

                $data["option_name"],

                $data["urdu_name"],

                $data["category"],

                $data["print_order"],

                $data["selection_type"],
                $data["status"]

            ]);
        }

        /*--------------------------------------------------
        | Update Stitching Option
        --------------------------------------------------*/

        public function updateStitchingOption($id,$data)
        {
            $stmt = $this->conn->prepare("
                UPDATE stitching_options
                SET

                    option_name=?,

                    urdu_name=?,

                    category=?,

                    print_order=?,

                    selection_type=?,
                    status=?

                WHERE id=?
            ");

            return $stmt->execute([

                $data["option_name"],

                $data["urdu_name"],

                $data["category"],

                $data["print_order"],

                $data["selection_type"],

                $data["status"],

                $id

            ]);
        }

        /*--------------------------------------------------
        | Toggle Stitching Option
        --------------------------------------------------*/

        public function toggleStitchingOptionStatus($id)
        {
            $stmt = $this->conn->prepare("
                UPDATE stitching_options
                SET status =
                    CASE
                        WHEN status='Active'
                        THEN 'Inactive'
                        ELSE 'Active'
                    END
                WHERE id=?
            ");

            return $stmt->execute([$id]);
        }

        public function stitchingOptionExistsExcept($id, $option, $category)
        {
            $stmt = $this->conn->prepare("
                SELECT id
                FROM stitching_options
                WHERE LOWER(option_name) = LOWER(?)
                AND LOWER(category) = LOWER(?)
                AND id <> ?
                LIMIT 1
            ");

            $stmt->execute([
                trim($option),
                trim($category),
                $id
            ]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
}