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
        <div>
            <p>Información de cuenta:
                <?php echo $_SESSION["perfil"] ?>
        </div>
        <h2>Listado de contactos</h2>
        <table border="1">
            <caption>Contactos</caption>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data["contacto"] as $contacto): ?>
                    <tr>
                        <td>
                            <?php echo $contacto["nombre"] ?>
                        </td>
                        <td>
                            <?php echo $contacto["telefono"] ?>
                        </td>
                        <td>
                            <?php echo $contacto["email"] ?>
                        </td>
                        <?php
                            if ($_SESSION["perfil"] == "usuario") {
                                echo "<td colspan='3'><a href='http://localhost/contactos/editar/"
                                    . $contacto["id"] . "'>📝</a></td>";
                                echo "<td colspan='3'><a href='http://localhost/contactos/borrar/"
                                    . $contacto["id"] . "'>🗑️</a></td>";
                            }
                        ?>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </main>
    <footer>
        <p>Agenda - 2024</p>
    </footer>
</body>

</html>
