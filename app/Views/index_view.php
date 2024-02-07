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
                <li>
                    <a href="<?php echo "http://" . $_SERVER["HTTP_HOST"] ?>">Home</a>
                </li>
                <?php
                    if ($data["perfil"] == "usuario") {
                        echo "<li><a href='http://localhost/logout'>Cerrar sesión</a></li>";
                    }
                ?>
            </ul>
        </nav>
        <form action="http://localhost/search" method="get">
            <input type="text" name="q" id="nombre" placeholder="Buscar contacto" minlength="3" required>
            <input type="submit" value="Buscar">
        </form>
    </header>
    <main>
        <aside>
            <?php
                if ($data["perfil"] == "invitado") {
                    include_once "include/login_view.php";
                } else {
                    echo "<p>Bienvenido " . $_SESSION["usuario"]["usuario"] . "</p>";
                }
            ?>
        </aside>
            <h2>Listado de contactos</h2>
            <table border="1">
                <caption>Contactos</caption>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <?php
                            if ($data["perfil"] == "usuario") {
                                echo "<th colspan='3'>Acciones</th>";
                            }
                        ?>
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
                                if ($data["perfil"] == "usuario") {
                                    echo "<td colspan='3'><a href='http://localhost/edit/"
                                        . $contacto["id"] . "'>📝 </a>";
                                    echo "<a href='http://localhost/del/"
                                        . $contacto["id"] . "'> 🗑️</a></td>";
                                }
                            ?>
                        </tr>
                    <?php endforeach ?>
                    <?php if ($data["perfil"] == "usuario"): ?>
                        <tr>
                            <td class="add" colspan="4">
                                <a href="http://localhost/add" >Agregar contacto</a>
                            </td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
    </main>
    <footer>
        <div class="rss">
            <a href="https://github.com/a19camoan/a19camoan-dwes-crud_contactos" target="_blank">
                <img src="https://png2.cleanpng.com/sh/258b7a4277582c50c48f22f8b10d4b63/L0KzQYm3U8I3N5dofZH0aYP2gLBuTfdqfJl6ep9sb33zhcXskr1qa5Dzi591b3fyPbjwlPh2al46edQDYUO2SITpU8hnOl84SqkDNEm4SYK8UsIxPGo9TKo7NEK5PsH1h5==/kisspng-github-computer-icons-logo-github-5ab8a3383b38f2.3278495915220498482426.png"
                alt="Github">
            </a>
        </div>
        <p>Agenda - 2024</p>
    </footer>
</body>

</html>
