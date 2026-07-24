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


// Monthly Bookings Chart

    public function monthlyBookings()
    {
        $sql = "SELECT
                    MONTH(order_date) AS month,
                    COUNT(*) AS total
                FROM orders
                WHERE YEAR(order_date) = YEAR(CURDATE())
                GROUP BY MONTH(order_date)
                ORDER BY MONTH(order_date)";

        $result = $this->conn
            ->query($sql)
            ->fetchAll(PDO::FETCH_ASSOC);

        $months = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];

        $data = array_fill(0, 12, 0);

        foreach($result as $row)
        {
            $data[$row['month'] - 1] = (int)$row['total'];
        }

        return [

            'labels' => $months,

            'data' => $data

        ];
    }

    // Order Status Chart

    public function orderStatusChart()
    {
        return [

            'Pending' => $this->pendingBookings(),

            'Ready' => $this->readyBookings(),

            'Delivered' => $this->deliveredBookings()

        ];
    }

}