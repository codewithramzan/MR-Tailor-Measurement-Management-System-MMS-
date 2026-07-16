<?php

class Dashboard extends Model
{

    public function totalCustomers()
    {
        return $this->conn
            ->query("SELECT COUNT(*) FROM customers")
            ->fetchColumn();
    }

    public function totalBookings()
    {
        return $this->conn
            ->query("SELECT COUNT(*) FROM orders")
            ->fetchColumn();
    }

    public function pendingBookings()
    {
        return $this->conn
            ->query("SELECT COUNT(*) FROM orders WHERE status='Pending'")
            ->fetchColumn();
    }

    public function readyBookings()
    {
        return $this->conn
            ->query("SELECT COUNT(*) FROM orders WHERE status='Ready'")
            ->fetchColumn();
    }

    public function deliveredBookings()
    {
        return $this->conn
            ->query("SELECT COUNT(*) FROM orders WHERE status='Delivered'")
            ->fetchColumn();
    }

    public function totalIncome()
    {
        return $this->conn
            ->query("SELECT SUM(total_amount) FROM orders")
            ->fetchColumn();
    }

    public function recentBookings()
    {
        $sql="SELECT
                orders.*,
                customers.full_name,
                customers.phone
              FROM orders

              INNER JOIN customers

              ON customers.id=orders.customer_id

              ORDER BY orders.id DESC

              LIMIT 10";

        return $this->conn
                ->query($sql)
                ->fetchAll(PDO::FETCH_ASSOC);

    }

}