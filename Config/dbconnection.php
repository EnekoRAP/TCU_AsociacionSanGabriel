<?php
require_once "global.php";

class dbconnection {
    private $conn;

    public function abrirConexion() {
        $connectionString = [
            "UID" => DB_USER_SQLSRV,
            "PWD" => DB_PASSWORD_SQLSRV,
            "Database" => DB_NAME_SQLSRV
        ];

        $this->conn = sqlsrv_connect(DB_SERVER_SQLSRV, $connectionString);

        if ($this->conn === false) {
            die("Error de conexión: " . print_r(sqlsrv_errors(), true));
        }

        return $this->conn;
    }

    public function cerrarConexion() {
        if ($this->conn) {
            sqlsrv_close($this->conn);
        }
    }
}
?>
