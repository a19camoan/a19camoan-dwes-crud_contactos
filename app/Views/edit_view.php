<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>
    <link rel="icon" type="image/x-icon" href="https://cdn-icons-png.flaticon.com/512/784/784856.png">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <header>
        <h1>Contactos</h1>
        <nav>
            <ul>
                <a href="http://localhost">
                    <li>Home</li>
                    <?php
                        if ($data["perfil"] == "usuario") {
                            echo "<a href='http://localhost/logout'><li>Cerrar sesión</li></a>";
                        }
                    ?>
                </a>
            </ul>
        </nav>
        <form action="http://localhost/search" method="get">
            <input type="text" name="q" id="nombre" placeholder="Buscar contacto">
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
        <div>
            <p>Información de cuenta:
                <?php echo $data["perfil"] ?>
        </div>
        <h2>Editar contacto</h2>
        <form action="" method="post">
            <div>
                <label for="nombre">Nombre: </label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $data["nombre"] ?>" required>
            </div>
            <div>
                <label for="telefono">Teléfono: </label>
                <input type="tel" id="telefono" name="telefono" value="<?php echo $data["telefono"] ?>" required>
            </div>
            <div>
                <label for="email">Email: </label>
                <input type="email" id="email" name="email" value="<?php echo $data["email"] ?>" required>
            </div>
            <div>
                <input name="edit" type="submit" value="Editar">
            </div>
        </form>
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
