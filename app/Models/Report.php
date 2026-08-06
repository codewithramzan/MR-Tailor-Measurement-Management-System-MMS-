<?php

class Report extends Model
{
    /*
    |--------------------------------------------------------------------------
    | Dashboard Summary
    |--------------------------------------------------------------------------
    */

    public function getDashboardSummary()
    {
        return [

            'totalCustomers' => $this->scalar("
                SELECT COUNT(*)
                FROM customers
            "),

            'totalOrders' => $this->scalar("
                SELECT COUNT(*)
                FROM orders
            "),

            'pendingOrders' => $this->scalar("
                SELECT COUNT(*)
                FROM orders
                WHERE status='Pending'
            "),

            'readyOrders' => $this->scalar("
                SELECT COUNT(*)
                FROM orders
                WHERE status='Ready'
            "),

            'deliveredOrders' => $this->scalar("
                SELECT COUNT(*)
                FROM orders
                WHERE status='Delivered'
            "),

            'todayIncome' => $this->scalar("
                SELECT IFNULL(SUM(advance),0)
                FROM orders
                WHERE order_date = CURDATE()
            "),

            'monthlyIncome' => $this->scalar("
                SELECT IFNULL(SUM(advance),0)
                FROM orders
                WHERE MONTH(order_date)=MONTH(CURDATE())
                AND YEAR(order_date)=YEAR(CURDATE())
            "),

            'totalBalance' => $this->scalar("
                SELECT IFNULL(SUM(balance),0)
                FROM orders
                WHERE balance > 0
            ")

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Daily Report
    |--------------------------------------------------------------------------
    */

    public function daily($date)
    {
        $sql = "

            SELECT

                o.*,

                c.full_name,

                c.phone,
                gt.name AS garment_name

            FROM orders o

            INNER JOIN customers c
                    ON c.id=o.customer_id
            INNER JOIN garment_types gt
                ON gt.id = o.garment_type_id
            WHERE DATE(o.order_date)=?

            ORDER BY o.id DESC

        ";

        return $this->query($sql, [$date]);
    }

    /*
    |--------------------------------------------------------------------------
    | Monthly Report
    |--------------------------------------------------------------------------
    */

    public function monthly($month, $year)
    {
        $sql = "

            SELECT

                o.*,

                c.full_name,

                c.phone
                gt.name AS garment_name

            FROM orders o

            INNER JOIN customers c
                    ON c.id=o.customer_id
                    
            INNER JOIN garment_types gt
            ON gt.id = o.garment_type_id
            
            WHERE MONTH(o.order_date)=?

            AND YEAR(o.order_date)=?

            ORDER BY o.order_date DESC

        ";

        return $this->query($sql, [$month, $year]);
    }

    /*
    |--------------------------------------------------------------------------
    | Customer Report
    |--------------------------------------------------------------------------
    */

    public function customers()
    {
        $sql = "

            SELECT

                c.id,

                c.full_name,

                c.phone,

                c.village,

                COUNT(o.id) total_orders,

                IFNULL(SUM(o.total_amount),0) total_amount,

                IFNULL(SUM(o.advance),0) advance,

                IFNULL(SUM(o.balance),0) balance

            FROM customers c

            LEFT JOIN orders o
                   ON o.customer_id=c.id

            GROUP BY c.id

            ORDER BY c.full_name ASC

        ";

        return $this->query($sql);
    }

    /*
    |--------------------------------------------------------------------------
    | Income Report
    |--------------------------------------------------------------------------
    */

    public function income($from, $to)
    {
        $sql = "

            SELECT

                o.*,

                c.full_name
                gt.name AS garment_name

            FROM orders o

            INNER JOIN customers c
                    ON c.id=o.customer_id
            INNER JOIN garment_types gt
               ON gt.id = o.garment_type_id

            WHERE DATE(o.order_date)
                  BETWEEN ? AND ?

            ORDER BY o.order_date DESC

        ";

        return $this->query($sql, [$from, $to]);
    }

    /*
    |--------------------------------------------------------------------------
    | Pending Orders
    |--------------------------------------------------------------------------
    */

    public function pending()
    {
        return $this->status("Pending");
    }

    /*
    |--------------------------------------------------------------------------
    | Ready Orders
    |--------------------------------------------------------------------------
    */

    public function ready()
    {
        return $this->status("Ready");
    }

    /*
    |--------------------------------------------------------------------------
    | Delivered Orders
    |--------------------------------------------------------------------------
    */

    public function delivered()
    {
        return $this->status("Delivered");
    }

    /*
    |--------------------------------------------------------------------------
    | Invoice Report
    |--------------------------------------------------------------------------
    */

    public function invoices()
    {
        $sql = "

            SELECT

                o.*,

                c.full_name,

                c.phone

            FROM orders o

            INNER JOIN customers c
                    ON c.id=o.customer_id

            ORDER BY o.id DESC

        ";

        return $this->query($sql);
    }

    /*
    |--------------------------------------------------------------------------
    | Private Helpers
    |--------------------------------------------------------------------------
    */

    private function status($status)
    {
        $sql = "

            SELECT

                o.*,

                c.full_name,

                c.phone

            FROM orders o

            INNER JOIN customers c
                    ON c.id=o.customer_id

            WHERE o.status=?

            ORDER BY o.delivery_date ASC

        ";

        return $this->query($sql, [$status]);
    }

    /*
    |--------------------------------------------------------------------------
    | Execute SELECT
    |--------------------------------------------------------------------------
    */

    private function query($sql, $params = [])
    {
        $stmt = $this->conn->prepare($sql);

        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /*
    |--------------------------------------------------------------------------
    | Execute COUNT / SUM
    |--------------------------------------------------------------------------
    */

    private function scalar($sql, $params = [])
    {
        $stmt = $this->conn->prepare($sql);

        $stmt->execute($params);

        return $stmt->fetchColumn();
    }

}