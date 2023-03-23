<?php
require("connection.php");

try {
    
    $pdo = connection();

    $id = $_GET['id'];
    
    // Preparamos la sentencia, buscando el usuario por su ID, recibida por GET
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id=:id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    // Almacenamos los resultados de la consulta en $row, para mostrarlos en el formulario
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    
    // manejo de excepción
    echo "Error: " . $e->getMessage();
    die();
    
} finally {
    
    // cerrar la conexión
    $pdo = null;
    
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="./CSS/style.css" rel="stylesheet">
    <link rel="icon" type="image/jpg" href="./Img/favicon.ico" />
    <title>Editar usuario</title>
</head>

<body>
    <div class="wrapper">
        <header>
            <div class="titulo">EDICIÓN DE USUARIO</div>
        </header>
        <main>
            <div class="users-form">
                <!-- Fomulario para la edición de usuarios -->
                <form action="edit_user.php" method="POST">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <input type="text" name="name" placeholder="Nombre" value="<?= $row['name'] ?>">
                    <input type="text" name="lastname" placeholder="Apellidos" value="<?= $row['lastname'] ?>">
                    <input type="text" name="username" placeholder="Username" value="<?= $row['username'] ?>">
                    <input type="text" name="password" placeholder="Password" value="<?= $row['password'] ?>">
                    <input type="text" name="email" placeholder="Email" value="<?= $row['email'] ?>">
                    <input type="submit" value="Actualizar">
                </form>
                <p><button class="back-btn" onclick="window.history.back()">Volver</button></p>
            </div>
        </main>
        <footer>
            <span><a href="https://entreunosyceros.net/about" title="about entreunosyceros" target="_blank">entreunosyceros.net</span>
        </footer>
    </div>
</body>

</html>
