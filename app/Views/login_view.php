<?php
    use App\Models\Usuarios;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nombre = $_POST["nombre"];
        $password = $_POST["password"];
        $password = password_hash($password, PASSWORD_DEFAULT);

        echo $password;
    }
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="icon" type="image/x-icon" href="https://cdn-icons-png.flaticon.com/512/784/784856.png">
    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <header>
        <h1>Registro</h1>
        <nav>
            <ul>
                <a href="http://localhost">
                    <li>Home</li>
                </a>
            </ul>
        </nav>
    </header>
    <main>
        <form method="post" action="">
            <div>
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <div>
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div>
                <input type="submit" value="Registrarse">
            </div>
        </form>
    </main>
    <footer>
        <p>Agenda - 2024</p>
    </footer>
</body>
