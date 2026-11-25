<?php
// per poder tancar la sessio primer l'he d'obrir, per aixo session_start() va primer
session_start();
/*
    ACTIVITAT 8 · El login
    sortir.php: tanca la sessió i torna al login.

    APARTAT 5 · Sortir
    Tancar una sessió són tres passos, no un:
    1. Buidar les dades de $_SESSION.
    2. Esborrar la cookie PHPSESSID del navegador.
    3. Destruir la sessió al servidor (el fitxer sess_).
    El pas 2 és el que s'oblida tothom: sense ell tot sembla que funciona, però el
    navegador es queda guardant un número que ja no serveix per res. Amb F12 >
    Application > Cookies es veu que després de sortir la PHPSESSID d'abans ja no hi és.
*/

require_once 'config.php';

// 1. buidem les dades
$_SESSION = [];

// 2. esborrem la cookie del navegador.
// per esborrar una cookie es torna a enviar buida i amb una data del passat
// (time() - 42000), aixi el navegador la dona per caducada i la llença.
// el path, el domain, etc han de ser els mateixos que quan es va crear,
// per aixo els agafo de session_get_cookie_params()
if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params['path'], $params['domain'],
        $params['secure'], $params['httponly']);
}

// 3. destruim la sessio al servidor
session_destroy();

// i tornem al login. exit perque no s'executi res mes
header('Location: login.php');
exit;
