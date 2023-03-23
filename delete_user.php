<?php
require("connection.php");
// Validamos y sanitizamos el valor de ID
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    // manejo del error
    echo "SE HA PRODUCIDO UN ERROR EN EL ID DEL USUARIO QUE SE QUIERE BORRAR";
    die();
}

try {
    $con = connection();

    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $con->prepare($sql);
    // Nos aseguramos de que $id es un entero
    $stmt->bindParam(1, $id, PDO::PARAM_INT);

    $stmt->execute();

    Header("Location: index.php");
} catch (PDOException $e) {
    echo "SE HA PRODUCIDO UN ERROR AL ELIMINAR EL USUARIO";
    die();
} finally {
    $con = null; // Cerrar la conexión
}
