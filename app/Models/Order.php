<?php

class Order extends Model
{
    public function create($data)
    {
        // Default values
        $data['advance'] = !empty($data['advance']) ? $data['advance'] : 0;
        $data['discount'] = !empty($data['discount']) ? $data['discount'] : 0;

        $data['balance'] = $data['total_amount']
                            - $data['advance']
                            - $data['discount'];

        $data['status'] = !empty($data['status'])
                            ? $data['status']
                            : "Pending";

        $data['notes'] = !empty($data['notes'])
                            ? trim($data['notes'])
                            : "";

        $stmt = $this->conn->prepare("
            INSERT INTO orders(
                customer_id,
                garment_type_id,
                quantity,
                booking_no,
                invoice_no,
                order_date,
                delivery_date,
                total_amount,
                advance,
                discount,
                balance,
                status,
                notes
            )
            VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)
        ");
        $this->conn->beginTransaction();
        $data['invoice_no'] = $this->generateNumber('invoice_no', 'INV');
        try { 
            $stmt->execute([
                $data['customer_id'],
                $data['garment_type_id'],
                $data['quantity'],
                $data['booking_no'],
                $data['invoice_no'],
                $data['order_date'],
                $data['delivery_date'],
                $data['total_amount'],
                $data['advance'],
                $data['discount'],
                $data['balance'],
                $data['status'],
                $data['notes']
            ]);

            $orderId = $this->conn->lastInsertId();
            $this->conn->commit();

            return $orderId;
        } catch (Exception $e){

            $this->conn->rollBack();
            throw $e;
        }


    }
        public function getAll()
        {
            $stmt = $this->conn->prepare("
                SELECT
                    orders.*,
                    customers.full_name,
                    customers.phone,
                    garment_types.name AS garment_name,
                    garment_types.urdu_name
                FROM orders
                INNER JOIN customers
                    ON customers.id = orders.customer_id
                    INNER JOIN garment_types
                    ON garment_types.id = orders.garment_type_id
                ORDER BY 
                orders.id DESC
            ");
           $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        

    public function find($id)
        {
            $stmt = $this->conn->prepare("
                SELECT

                orders.*,
                customers.full_name,
                customers.phone,
                garment_types.name AS garment_name,
                garment_types.urdu_name
                FROM orders
                INNER JOIN customers
                ON customers.id=orders.customer_id
                INNER JOIN garment_types
                ON garment_types.id=orders.garment_type_id
                WHERE orders.id = ?
                LIMIT 1
            ");

            $stmt->execute([$id]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }



        public function findWithMeasurements($id)
        {
            $stmt = $this->conn->prepare("
                SELECT
                    orders.*,
                    customers.full_name,
                    customers.father_name,
                    customers.phone,
                    customers.mohalla,
                    customers.village,
                    garment_types.name AS garment_name,
                    garment_types.urdu_name
                FROM orders
                INNER JOIN customers
                    ON customers.id = orders.customer_id
                INNER JOIN garment_types
                ON garment_types.id = orders.garment_type_id
                WHERE orders.id = ?
                LIMIT 1
            ");

            $stmt->execute([$id]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }


        public function update($id, $data)
        {

            $advance = $data['advance'] ?? 0;
            $discount = $data['discount'] ?? 0;

            $balance =
                $data['total_amount']
                - $advance
                - $discount;
            $stmt = $this->conn->prepare("
                UPDATE orders
                SET

                garment_type_id=?,
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
        $this->conn->beginTransaction();
        try{
             $stmt->execute([

                $data['garment_type_id'],
                $data['quantity'],
                $data['delivery_date'],
                $data['total_amount'],
                $advance,
                $discount,
                $balance,
                $data['status'],
                $data['notes'],
                $id

            ]);

        $this->conn->commit();
        return true;

        } catch(Exception $e) {
            $this->conn->rollBack();
            throw $e;
        }
           
        }

        public function delete($id)
        {
            $stmt = $this->conn->prepare("
                DELETE FROM orders
                WHERE id=?
            ");

            return $stmt->execute([$id]);
        }

        public function getByStatus($status)
        {
            $sql = "SELECT
                        orders.*,
                        customers.full_name,
                        garment_types.name AS garment_name,
                        garment_types.urdu_name
                    FROM orders
                    INNER JOIN customers
                        ON customers.id = orders.customer_id
                        INNER JOIN garment_types
                        ON garment_types.id=orders.garment_type_id
                    WHERE orders.status = ?
                    ORDER BY orders.id DESC";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([$status]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
}