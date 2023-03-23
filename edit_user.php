<?php
require("connection.php");

try {
    
    $con = connection();

    $id = $_POST["id"];
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = $_POST["email"];

    // Comprobamos si $email tiene un formato de email válido
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        
        throw new Exception('La dirección de correo electrónico no es válida');
        
    }

    $sql = "UPDATE users SET name=?, lastname=?, username=?, password=?, email=? WHERE id=?";
    $query = $con->prepare($sql);
    $values = array($name, $lastname, $username, $password, $email, $id);

    if ($query->execute($values)) {
        
        Header("Location: index.php");
        
    } else {
        
        echo "ERROR AL EDITAR EL USUARIO";
        
    }
    
} catch (PDOException $e) {
    
    echo "SE HA PRODUCIDO UN ERROR AL EDITAR EL USUARIO";
    die();
    
} catch (Exception $e) {
    
    echo "Error: " . $e->getMessage();
    die();
    
} finally {
    
    $con = null; // Cerrar la conexión
    
}
