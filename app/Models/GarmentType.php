<?php

class GarmentType extends Model
{
    protected $table = "garment_types";

    public function getActive()
    {
        $stmt = $this->conn->query("
            SELECT
                id,
                name,
                urdu_name
            FROM garment_types
            WHERE status='Active'
            ORDER BY print_order,id
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $stmt = $this->conn->prepare("
            SELECT *
            FROM garment_types
            WHERE id=?
            LIMIT 1
        ");

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}