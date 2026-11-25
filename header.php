<?php
/*
    ACTIVITAT 6 · Modularitzar el codi
    header.php: el disseny de dalt de qualsevol pàgina.

    APARTAT 4 · header.php
    - Tot el que hi ha des del <!DOCTYPE> fins a l'obertura del <main>.
    - Fa servir $titolPagina, que l'ha de posar la pàgina ABANS del require.
    - Obre etiquetes que no tanca (<html>, <body> i <main>). No és un error:
      les tanca footer.php.

    ACTIVITAT 8 · El login
    APARTAT 6 · La capçalera que et saluda
    - Dins del <header> hi ha el salut amb el nom i l'enllaç de sortir si has entrat,
      o l'enllaç d'iniciar sessió si no. Com que està al header, surt a totes les pàgines
      sense haver-ho de copiar a cada fitxer.
    - Ho miro amb isset($_SESSION['usuari']) directament i no amb una funció de
      funcions.php, perquè registre.php no inclou funcions.php i petaria.
    - Les pàgines que no fan session_start() (registre.php, processa.php i gracies.php)
      no tenen $_SESSION. isset() no dona cap avís, només torna false, i per això
      allà sempre surt "Iniciar sessió".
*/

// el fitxer inclos s'executa dins de la pagina que l'inclou, per aixo veu $titolPagina.
// si una pagina s'oblida del titol, poso 'Inici' i aixi no surt cap avis
if (!isset($titolPagina)) {
    $titolPagina = 'Inici';
}
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="utf-8">
    <!-- el titol de la pagina i despres el nom de la botiga, que surt de config.php -->
    <title><?= htmlspecialchars($titolPagina) ?> · <?= BOTIGA_NOM ?></title>
    <link rel="stylesheet" href="<?= FULL_ESTILS ?>">
</head>
<body>
    <header>
        <h1><?= BOTIGA_NOM ?></h1>
        <p><?= BOTIGA_LEMA ?></p>

        <!-- si hi ha usuari a la sessio el saludo, si no surt l'enllac per entrar -->
        <p class="usuari">
        <?php if (isset($_SESSION['usuari'])): ?>
            Hola, <strong><?= htmlspecialchars($_SESSION['nom']) ?></strong>
            &middot; <a href="sortir.php">Sortir</a>
        <?php else: ?>
            <a href="login.php">Iniciar sessió</a>
        <?php endif; ?>
        </p>
    </header>
    <main>
