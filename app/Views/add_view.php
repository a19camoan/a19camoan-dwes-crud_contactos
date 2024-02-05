<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>
    <link rel="icon" type="image/x-icon" href="https://cdn-icons-png.flaticon.com/512/784/784856.png">
    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <header>
        <h1>Contactos</h1>
        <nav>
            <ul>
                <a href="http://localhost">
                    <li>Home</li>
                </a>
            </ul>
        </nav>
    </header>
    <main>
        <aside>
            <?php
                if ($data["perfil"] == "invitado") {
                    include_once "include/login_view.php";
                } else {
                    echo "<p>Bienvenido " . $_SESSION["usuario"]["usuario"] . "</p>";
                    echo "<a href='http://localhost/logout'>Cerrar sesión</a>";
                }
            ?>
        <div>
            <p>Información de cuenta:
                <?php echo $data["perfil"] ?>
        </div>
        <h2>Crear contacto</h2>
        <form action="" method="post">
            <div>
                <label for="nombre">Nombre: </label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <div>
                <label for="telefono">Teléfono: </label>
                <input type="tel" id="telefono" name="telefono" required>
            </div>
            <div>
                <label for="email">Email: </label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <input name="add" type="submit" value="Guardar">
            </div>
        </form>
    </main>
    <footer>
        <p>Agenda - 2024</p>
    </footer>
</body>

</html>
