<?php

require_once "Database.php";

class Model extends Database
{
    public function generateNumber($column, $prefix)
  {
      $stmt = $this->conn->query("
          SELECT $column
          FROM orders
          ORDER BY id DESC
          LIMIT 1
      ");

      $last = $stmt->fetchColumn();

      if (!$last) {
          return $prefix . "-0001";
      }

      $number = (int) preg_replace('/\D/', '', $last);

      return $prefix . "-" . str_pad($number + 1, 4, "0", STR_PAD_LEFT);
  }
}