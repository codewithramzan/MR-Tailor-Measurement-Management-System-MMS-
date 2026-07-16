<?php

class Order extends Database
{
   public function create($data)
        {
            $stmt = $this->conn->prepare("
                INSERT INTO orders(
                    customer_id,
                    garment_type,
                    quantity,
                    booking_no,
                    order_date,
                    delivery_date,
                    total_amount,
                    advance,
                    discount,
                    balance,
                    status,
                    notes
                )
                VALUES(?,?,?,?,?,?,?,?,?,?,?,?)
            ");

            $stmt->execute([
                $data['customer_id'],
                $data['garment_type'],
                $data['quantity'],
                $data['booking_no'],
                $data['order_date'],
                $data['delivery_date'],
                $data['total_amount'],
                $data['advance'],
                $data['discount'],
                $data['balance'],
                $data['status'],
                $data['notes']
            ]);

            return $this->conn->lastInsertId();
    }

        public function getAll()
        {
            $stmt = $this->conn->query("
                SELECT
                    orders.*,
                    customers.full_name,
                    customers.phone
                FROM orders
                JOIN customers
                    ON customers.id = orders.customer_id
                ORDER BY orders.id DESC
            ");

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        

    public function find($id)
        {
            $stmt = $this->conn->prepare("
                SELECT
                    orders.*,
                    customers.full_name,
                    customers.phone
                FROM orders
                JOIN customers
                    ON customers.id = orders.customer_id
                WHERE orders.id = ?
            ");

            $stmt->execute([$id]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }



        public function findWithMeasurements($id)
        {
            $stmt = $this->conn->prepare("
                SELECT
                    orders.*,
                    customers.booking_no,
                    customers.full_name,
                    customers.father_name,
                    customers.phone,
                    customers.mohalla,
                    customers.village
                FROM orders
                JOIN customers
                    ON customers.id = orders.customer_id
                WHERE orders.id = ?
            ");

            $stmt->execute([$id]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }


        public function update($id, $data)
        {
            $stmt = $this->conn->prepare("
                UPDATE orders
                SET

                garment_type=?,
                quantity=?,
                delivery_date=?,
                total_amount=?,
                advance=?,
                discount=?,
                balance=?,
                status=?,
                notes=?,
                updated_at=NOW()

                WHERE id=?
            ");

            return $stmt->execute([

                $data['garment_type'],
                $data['quantity'],
                $data['delivery_date'],
                $data['total_amount'],
                $data['advance'],
                $data['discount'],
                $data['balance'],
                $data['status'],
                $data['notes'],
                $id

            ]);
        }

        public function delete($id)
        {
            $stmt = $this->conn->prepare("
                DELETE FROM orders
                WHERE id=?
            ");

            return $stmt->execute([$id]);
        }
}