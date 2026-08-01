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
        garment_type_id, 
        category, 
        print_order,
        id

        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getGrouped($garmentTypeId)
    {
        $sql = "

        SELECT *

        FROM stitching_options

        WHERE

            garment_type_id = ?

        AND

            status='Active'

        ORDER BY
            category,
            print_order, 
            id

        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([$garmentTypeId]);

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