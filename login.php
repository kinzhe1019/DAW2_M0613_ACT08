<?php
// session_start() a la PRIMERA linia, abans fins i tot dels require.
// si la poso despres del require de header.php surt l'avis de headers already sent
session_start();
/*
    ACTIVITAT 8 · El login
    login.php: el formulari d'entrada i la comprovació.

    APARTAT 3 · El formulari i la comprovació
    - El formulari s'envia a si mateix: l'action apunta a login.php.
    - Si arriba per POST, comprovo l'usuari i la contrasenya amb comprovaCredencials().
    - Si són correctes, demano un número de sessió nou, deso a la sessió qui és i a
      quina hora ha entrat, i l'envio a privat.php.
    - Si no, surt un sol missatge d'error a posta. No dic si el que falla és l'usuari
      o la contrasenya, perquè si no qualsevol podria anar provant noms fins a saber
      quins existeixen.

    AMPLIACIÓ · Comptar els intents fallits
    - Cada vegada que falla sumo 1 a $_SESSION['intents'], igual que el comptador de
      visites de l'Activitat 7. Quan entra bé l'esborro amb unset().
    - Quan arriba a MAX_INTENTS (3, a config.php) ja no comprova la contrasenya.
    - És un bloqueig senzill: com que va a la sessió, si es tanca el navegador (o
      s'esborra la cookie) torna a començar de zero.
*/

// la configuracio (la llista d'usuaris) i les funcions, sempre amb require_once
require_once 'config.php';
require_once 'funcions.php';

// aqui van els errors. si al final es buit es que no n'hi ha cap
$errors = [];

// la primera vegada que s'obre la pagina es GET i nomes s'ensenya el formulari.
// quan s'envia el formulari arriba per POST i llavors comprovo
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // ampliacio: si ja ha fallat massa vegades, no el deixo ni provar.
    // el ?? posa 0 si encara no ha fallat mai i 'intents' no existeix
    if (($_SESSION['intents'] ?? 0) >= MAX_INTENTS) {
        $errors[] = 'Has fallat ' . MAX_INTENTS . ' vegades. Tanca el navegador i torna-ho a provar.';
    } else {

        // camp() fa el trim($_POST[...] ?? ''). la contrasenya la recullo sense trim,
        // perque els espais tambe poden formar part de la contrasenya
        $usuari = camp('usuari');
        $clau   = $_POST['clau'] ?? '';

        // torna les dades de l'usuari si es correcte, o null si no ho es
        $dades = comprovaCredencials($usuari, $clau);

        if ($dades === null) {
            $errors[] = 'Usuari o contrasenya incorrectes.';

            // ampliacio: un intent fallit mes
            $_SESSION['intents'] = ($_SESSION['intents'] ?? 0) + 1;
        } else {
            // numero de sessio nou: si algu havia aconseguit el d'abans, ja no li serveix
            session_regenerate_id(true);

            // ampliacio: ha entrat be, aixi que esborro el comptador d'intents
            unset($_SESSION['intents']);

            // deso a la sessio qui es i a quina hora ha entrat
            $_SESSION['usuari']  = $usuari;
            $_SESSION['nom']     = $dades['nom'];
            $_SESSION['entrada'] = date('H:i:s');

            // l'envio a la pagina privada. exit perque header() nomes envia la capcalera,
            // no para la pagina
            header('Location: privat.php');
            exit;
        }
    }
}

// el titol ABANS del require del header, si no el header no el veu
$titolPagina = 'Iniciar sessió';
require 'header.php';
?>

        <h2>Entra al teu compte</h2>

        <!-- la llista d'errors, igual que a l'activitat 3. nomes surt si n'hi ha algun -->
        <?php if (count($errors) > 0): ?>
            <div class="errors">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- l'action apunta a la mateixa pagina, aixi les dades tornen a login.php -->
        <form action="login.php" method="post">
            <label for="usuari">Nom d'usuari</label>
            <input type="text" id="usuari" name="usuari">

            <!-- type password perque no es vegi el que s'escriu -->
            <label for="clau">Contrasenya</label>
            <input type="password" id="clau" name="clau">

            <button type="submit">Entrar</button>
        </form>

<?php
// el peu tanca el main, el body i el html que ha obert el header
require 'footer.php';
