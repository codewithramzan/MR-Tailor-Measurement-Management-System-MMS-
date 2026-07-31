<?php

class StitchingOption extends Model
{
    protected $table = "stitching_options";

    public function getAll()
    {
        $sql = "

        SELECT *

        FROM stitching_options

        ORDER BY
        garment_type, 
        category, 
        print_order,
        id

        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getGrouped($garmentType)
    {
        $sql = "

        SELECT *

        FROM stitching_options

        WHERE

            garment_type = ?

        AND

            status='Active'

        ORDER BY
            garment_type,
            category,
            print_order, 
            id

        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([$garmentType]);

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $grouped=[];

        foreach($rows as $row){

           $category = trim($row["category"]);

            if ($category === "") {
                $category = "General";
            }

            $grouped[$category][] = $row;

        }

        return $grouped;
    }

 
}