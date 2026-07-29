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
}