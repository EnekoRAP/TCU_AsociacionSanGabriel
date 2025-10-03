<?php
require_once __DIR__ . '/../Config/dbconnection.php';

class Usuario {

    public static function login($correo, $password) {
        $cn = abrirConexion();
        if (!$cn || $cn->connect_error) {
            return false;
        }

        $query = "SELECT id_usuario, identificacion, nombre, apellidos, correo, contrasenna, id_rol, estado
                  FROM tbl_usuarios
                  WHERE correo = ?";
        $stmt = $cn->prepare($query);
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param("s", $correo);
        if (!$stmt->execute()) {
            return false;
        }

        $rs = $stmt->get_result();
        if ($rs->num_rows === 1) {
            $u = $rs->fetch_assoc();

            if (trim($password) === trim($u['contrasenna']) && (int)$u['estado'] === 1) {
                if (session_status() !== PHP_SESSION_ACTIVE) session_start();
                session_regenerate_id(true);

                $_SESSION['usuarioID'] = (int)$u['id_usuario'];
                $_SESSION['identificacion'] = $u['identificacion'];
                $_SESSION['nombre'] = $u['nombre'];
                $_SESSION['apellidos'] = $u['apellidos'];
                $_SESSION['correo'] = $u['correo'];
                $_SESSION['id_rol'] = (int)$u['id_rol'];

                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
}

?>
