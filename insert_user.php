<?php
require("connection.php");

try {
    
    $pdo = connection();
    
    // Limpiamos las cosas que llegan por $_POST
    $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Comprobamos si $email tiene un formato de email válido
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        
        throw new Exception('La dirección de correo electrónico no es válida');
        
    }

    // Preparamos al sentencia
    $stmt = $pdo->prepare("INSERT INTO users (name, lastname, username, password, email) VALUES (?, ?, ?, ?, ?)");
    $stmt->bindParam(1, $name);
    $stmt->bindParam(2, $lastname);
    $stmt->bindParam(3, $username);
    $stmt->bindParam(4, $password);
    $stmt->bindParam(5, $email);
    // Ejecutamos la sentencia con sus correspondientes valores
    $stmt->execute();

    header("Location: index.php");
} catch (PDOException $e) {
    
    echo "Error: " . $e->getMessage();
    die();
    
} catch (Exception $e) {
    
    echo "Error: " . $e->getMessage();
    die();
    
} finally {
    
    $pdo = null;
    
}
?>
