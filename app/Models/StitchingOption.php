<?php

class StitchingOption extends Model
{
    protected $table = "stitching_options";

    public function getAll()
    {
        $sql = "

        SELECT *

        FROM stitching_options

        ORDER BY category, print_order

        ";

        $stmt = $this->conn->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getGrouped()
    {
        $rows = $this->getAll();

        $data = [];

        foreach($rows as $row){

            $data[$row['category']][] = $row;

        }

        return $data;
    }
}