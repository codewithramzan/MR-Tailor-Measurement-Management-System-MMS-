<?php

class BackupController extends Controller
{
    /**
     * Show Backup & Restore Page
     */
    public function index()
    {
        $this->view('backup/backup');
    }
    public function restorePage()
  {
      $this->view('backup/restore');
  }
    /**
     * Backup Database
     */
        
    public function backup()
    {
      $database = new Database();

      $db = $database->getConnection();

        try {

            // Get database name
            $database = $db->query("SELECT DATABASE()")->fetchColumn();

            if (!$database) {
                throw new Exception("Database not selected.");
            }

            $sql = "";

            $sql .= "-- ==========================================\n";
            $sql .= "-- MR Tailor Database Backup\n";
            $sql .= "-- Database : {$database}\n";
            $sql .= "-- Generated: " . date("Y-m-d H:i:s") . "\n";
            $sql .= "-- ==========================================\n\n";

            // Get all tables
            $tables = [];

            $stmt = $db->query("SHOW TABLES");

            while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
                $tables[] = $row[0];
            }

            foreach ($tables as $table) {

                /*
                ---------------------------------------
                DROP TABLE
                ---------------------------------------
                */

                $sql .= "DROP TABLE IF EXISTS `$table`;\n";

                /*
                ---------------------------------------
                CREATE TABLE
                ---------------------------------------
                */

                $create = $db
                    ->query("SHOW CREATE TABLE `$table`")
                    ->fetch(PDO::FETCH_ASSOC);

                $sql .= $create['Create Table'] . ";\n\n";

                /*
                ---------------------------------------
                INSERT DATA
                ---------------------------------------
                */

                $rows = $db->query("SELECT * FROM `$table`");

                while ($record = $rows->fetch(PDO::FETCH_ASSOC)) {

                    $values = [];

                    foreach ($record as $value) {

                        if ($value === null) {

                            $values[] = "NULL";

                        } else {

                            $values[] = $db->quote($value);

                        }
                    }

                    $sql .= "INSERT INTO `$table` VALUES (" .
                            implode(",", $values) .
                            ");\n";
                }

                $sql .= "\n\n";
            }

            /*
            ---------------------------------------
            Download
            ---------------------------------------
            */

            $filename = sprintf(
                "%s_%s.sql",
                $database,
                date("Ymd_His")
            );

            header("Content-Type: application/sql");
            header("Content-Disposition: attachment; filename=\"$filename\"");
            header("Content-Length: " . strlen($sql));

            echo $sql;

            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => 'Backup complete successfully.'
            ];

        } catch (Exception $e) {

            $_SESSION['flash'] = [
                'type' => 'danger',
                'message' => 'Backup failed: ' . $e->getMessage()
            ];

            header("Location: index.php?page=backup");
            exit;
        }
    }

    /**
     * Restore Database
     */
    public function restore()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

            header("Location: index.php?page=backup");
            exit;
        }

        if (
            !isset($_FILES['backup_file']) ||
            $_FILES['backup_file']['error'] !== UPLOAD_ERR_OK
        ) {

            $_SESSION['flash'] = [
                'type' => 'danger',
                'message' => 'Please select a valid SQL backup file.'
            ];

            header("Location: index.php?page=backup");
            exit;
        }

        $extension = strtolower(
            pathinfo($_FILES['backup_file']['name'], PATHINFO_EXTENSION)
        );

        if ($extension !== 'sql') {

            $_SESSION['flash'] = [
                'type' => 'danger',
                'message' => 'Only SQL files are allowed.'
            ];

            header("Location: index.php?page=backup");
            exit;
        }

        $sql = file_get_contents($_FILES['backup_file']['tmp_name']);

        if (!$sql) {

            $_SESSION['flash'] = [
                'type' => 'danger',
                'message' => 'Unable to read backup file.'
            ];

            header("Location: index.php?page=backup");
            exit;
        }

        try {

           $database = new Database();

          $db = $database->getConnection();

            /*
            |--------------------------------------------------------------------------
            | Disable FK Checks
            |--------------------------------------------------------------------------
            */

            $db->exec("SET FOREIGN_KEY_CHECKS=0");

            /*
            |--------------------------------------------------------------------------
            | Execute SQL
            |--------------------------------------------------------------------------
            */

            $queries = explode(";\n", $sql);

            foreach ($queries as $query) {

                $query = trim($query);

                if ($query === '') {
                    continue;
                }

                $db->exec($query);
            }

            /*
            |--------------------------------------------------------------------------
            | Enable FK Checks
            |--------------------------------------------------------------------------
            */

            $db->exec("SET FOREIGN_KEY_CHECKS=1");

            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => 'Database restored successfully.'
            ];

        } catch (PDOException $e) {

            $db->exec("SET FOREIGN_KEY_CHECKS=1");

            $_SESSION['flash'] = [
                'type' => 'danger',
                'message' => 'Restore failed: ' . $e->getMessage()
            ];
        }

        header("Location: index.php?page=backup");
        exit;
    }
}