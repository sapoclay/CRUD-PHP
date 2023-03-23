<?php

require_once "connection.php";

try {
    
    $pdo = connection();

    $sql = "SELECT * FROM users"; // Buscamos todos los usuarios de la base de datos
    $stmt = $pdo->query($sql);

    // Obtenemos los resultados de la consulta
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Cerramos la conexión
    $pdo = null;
    
} catch (PDOException $e) {
    
    // Manejo de errores
    echo "Error: " . $e->getMessage();
    die();
    
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./CSS/style.css" rel="stylesheet">
    <link rel="icon" type="image/jpg" href="./Img/favicon.ico" />
    <title>CRUD PHP y MySQL</title>
</head>

<body>
    <div class="wrapper">
        <header>
            <div class="titulo">C.R.U.D. RESPONSIVE <br/> CON PHP (PDO), MySQL, <br/> ETC ...</div>
            <p>
                <button id="open-modal" class="metro-button">+ Añadir usuario</button>
            </p>
        </header>
        <main>
            <br />
            <div class="users-table">
                <h2>Usuarios registrados</h2>
                <table>
                    <thead>
                        <!-- Cabeceras de la tabla de resultados -->
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Email</th>
                            <th colspan="2">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $row) : ?>
                            <tr>
                                <td data-column='Id'><?= $row['id'] ?></td>
                                <td data-column='Nombre'><?= $row['name'] ?></td>
                                <td data-column='Apellido'><?= $row['lastname'] ?></td>
                                <td data-column='Nombre Usuario'><?= $row['username'] ?></td>
                                <td data-column='Contraseña'><?= $row['password'] ?></td>
                                <td data-column='Email'><?= $row['email'] ?></td>
                                <td data-column='Opción #1'><a href="update.php?id=<?= $row['id'] ?>" class="users-table--edit">Editar</a></td>
                                <td data-column='Opción #2'><a href="#" onclick="confirmDelete(<?= $row['id'] ?>)" class="users-table--delete">Eliminar</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
        <footer>
            <script>
                // Función para eliminar el usuario
                function confirmDelete(userId) {
                    if (confirm("¿Está seguro de que desea eliminar este usuario?")) {
                        window.location.href = "delete_user.php?id=" + userId;
                    }
                }

                // Obtener el botón para abrir la ventana modal
                var btn = document.getElementById("open-modal");

                // Obtener la ventana modal
                var modal = document.createElement("div");
                modal.className = "modal";

                // Agregar el contenido del formulario en la ventana modal
                modal.innerHTML = `
                                <div class="users-form">
                                    <h1 class="titulo">Crear usuario</h1>
                                    <form action="insert_user.php" method="POST">
                                    <input type="text" name="name" placeholder="Nombre">
                                    <input type="text" name="lastname" placeholder="Apellidos">
                                    <input type="text" name="username" placeholder="Username">
                                    <input type="password" name="password" placeholder="Password">
                                    <input type="email" name="email" placeholder="Email">
                                    <input type="submit" value="Añadir">
                                    </form>
                                </div>
                                `;

                // Obtener el botón para cerrar la ventana modal
                var closeButton = document.createElement("button");
                closeButton.className = "close-button";
                closeButton.textContent = "X Cerrar ventana";
                modal.appendChild(closeButton);

                // Agregar la ventana modal al documento
                document.body.appendChild(modal);

                // Agregar un manejador de eventos para abrir la ventana modal
                btn.onclick = function() {
                    modal.style.display = "block";
                }

                // Agregar un manejador de eventos para cerrar la ventana modal
                closeButton.onclick = function() {
                    modal.style.display = "none";
                }
            </script>
            <span><a href="https://entreunosyceros.net/about" title="about entreunosyceros" target="_blank">entreunosyceros.net</span>
        </footer>
    </div>
</body>

</html>
