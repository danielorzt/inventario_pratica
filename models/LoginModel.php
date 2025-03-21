<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once "Conexion.php";

class LoginModel
{
    public static function mdlLogin($email, $password)
    {
        try {
            $conexion = Conexion::conectar();
            $stmt = $conexion->prepare("SELECT * FROM Usuario WHERE email = :email");
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->execute();

            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($resultado && password_verify($password, $resultado['password'])) {
                // Guardar datos en sesión
                $_SESSION['id_usuario'] = $resultado['id_usuario'];
                $_SESSION['nombre'] = $resultado['nombre'];
                $_SESSION['apellido'] = $resultado['apellido'];

                // Redirigir a dashboard.php
                header("Location: ../views/dashboard.php");
                exit();
            } else {
                return array(
                    "codigo" => "401",
                    "mensaje" => "Usuario no existe o contraseña incorrecta, por favor verifique los datos introducidos"
                );
            }
        } catch (Exception $e) {
            return array(
                "codigo" => "500",
                "mensaje" => "Error en la conexión: " . $e->getMessage()
            );
        }
    }
}
