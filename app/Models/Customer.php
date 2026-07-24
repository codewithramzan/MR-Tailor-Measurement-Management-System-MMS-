<?php

class Customer extends Model
{
    public function create($data)
  {
      $sql = "INSERT INTO customers
              (booking_no, full_name, father_name, phone, mohalla, village)
              VALUES (?, ?, ?, ?, ?, ?)";

      $stmt = $this->conn->prepare($sql);

      $stmt->execute([
          $data['booking_no'],
          $data['full_name'],
          $data['father_name'],
          $data['phone'],
          $data['mohalla'],
          $data['village']
      ]);
    

      return $this->conn->lastInsertId();
  }

    public function getAll()
    {
        $stmt = $this->conn->query("SELECT * FROM customers ORDER BY id DESC");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function generateBookingNo()
    {
        $query = $this->conn->query("SELECT MAX(id) as last_id FROM customers");

        $row = $query->fetch(PDO::FETCH_ASSOC);

        $next = ($row['last_id'] ?? 0) + 1;

        return "BK-" . str_pad($next, 4, "0", STR_PAD_LEFT);
    }


    public function find($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM customers WHERE id=?");

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function search($keyword)
    {
        $stmt = $this->conn->prepare("
            SELECT *
            FROM customers
            WHERE full_name LIKE ?
            OR father_name LIKE ?
            OR phone LIKE ?
            OR mohalla LIKE ?
            OR village LIKE ?
        ");

        $search = "%".$keyword."%";

        $stmt->execute([
            $search,
            $search,
            $search,
            $search,
            $search
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id,$data)
        {
            $sql="UPDATE customers SET

                full_name=?,
                father_name=?,
                phone=?,
                mohalla=?,
                village=?

                WHERE id=?";

            $stmt=$this->conn->prepare($sql);

            return $stmt->execute([

                $data['full_name'],
                $data['father_name'],
                $data['phone'],
                $data['mohalla'],
                $data['village'],
                $id

            ]);
        }
        public function delete($id)
            {
                $stmt=$this->conn->prepare(
                    "DELETE FROM customers WHERE id=?"
                );

                return $stmt->execute([$id]);
            }
        public function getProfile($id)
            {
                $sql = "SELECT *
                        FROM customers
                        WHERE id=?";

                $stmt = $this->conn->prepare($sql);

                $stmt->execute([$id]);

                return $stmt->fetch(PDO::FETCH_ASSOC);
            }
            public function getOrders($customerId)
            {
                $sql = "SELECT *
                        FROM orders
                        WHERE customer_id=?
                        ORDER BY id DESC";

                $stmt = $this->conn->prepare($sql);

                $stmt->execute([$customerId]);

                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            public function getSummary($customerId)
            {
                $sql = "SELECT

                        COUNT(*) AS total_orders,

                        SUM(total_amount) AS total_amount,

                        SUM(advance) AS total_advance,

                        SUM(balance) AS total_balance

                    FROM orders

                    WHERE customer_id=?";

                $stmt = $this->conn->prepare($sql);

                $stmt->execute([$customerId]);

                return $stmt->fetch(PDO::FETCH_ASSOC);
            }
}