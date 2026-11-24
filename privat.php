<?php
// session_start() a la primera linia. sense aixo $_SESSION esta buit i em faria fora sempre
session_start();
/*
    ACTIVITAT 8 · El login
    privat.php: la pàgina a la qual només s'hi arriba havent entrat.

    APARTAT 4 · La pàgina privada
    - Les primeres línies són el "porter": si a la sessió no hi ha cap usuari,
      cap a login.php. És el patró que aniria a totes les pàgines privades.
    - El exit després del header() no és opcional. header() només envia una capçalera
      al navegador, no para res. Sense el exit PHP continuaria i enviaria la pàgina
      sencera: el navegador no l'ensenyaria, però les dades privades hi arribarien igual.
    - Ho he provat: he entrat, he anat a privat.php, i després en una finestra
      d'incògnit he obert privat.php directament. M'ha fet fora cap al login.
    - A sota hi ha una taula amb tot el que hi ha dins de la sessió.
*/

require_once 'config.php';
require_once 'funcions.php';

// el porter: si no ha iniciat sessio no existeix $_SESSION['usuari'] i l'envio al login
if (!isset($_SESSION['usuari'])) {
    header('Location: login.php');
    exit;
}

// el titol ABANS del require del header
$titolPagina = 'La teva àrea privada';
require 'header.php';
?>

        <!-- htmlspecialchars per si el nom porta algun caracter especial -->
        <h2>Hola, <?= htmlspecialchars($_SESSION['nom']) ?></h2>

        <!-- l'hora la va desar login.php quan va entrar -->
        <p>Has entrat a les
           <strong><?= $_SESSION['entrada'] ?></strong>.</p>

        <!-- la taula es fa sola amb un foreach, una fila per cada dada de la sessio,
             com la del resum de l'activitat 3 -->
        <h3>Què hi ha dins de la sessió</h3>
        <table>
            <?php foreach ($_SESSION as $clau => $valor): ?>
                <tr>
                    <th><?= htmlspecialchars($clau) ?></th>
                    <td><?= htmlspecialchars($valor) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <!-- sortir.php tanca la sessio -->
        <a class="tornar" href="sortir.php">Tancar la sessió</a>

<?php
// el peu tanca el main, el body i el html que ha obert el header
require 'footer.php';
