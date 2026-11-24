<?php
/*
    ACTIVITAT 6 · Modularitzar el codi
    config.php: els valors que es fan servir a més d'un lloc.

    APARTAT 2 · config.php
    - Aquí hi va tot el que surt a més d'un lloc i que algun dia pot canviar.
    - Si demà canviés i l'hagués de tocar més d'una vegada, va aquí.
    - Aquest fitxer NO escriu res a la pantalla: ni un echo ni un espai abans del <?php.
*/

// faig servir const i no variables: una constant no es pot canviar un cop creada,
// aixi ningu pot canviar el nom de la botiga a mitja pagina.
// per fer-les servir s'escriuen sense dolar i sense cometes: echo BOTIGA_NOM;

// dades de la botiga (surten al title, al header i al footer de totes les pagines)
const BOTIGA_NOM    = 'BitBazar';
const BOTIGA_LEMA   = 'Material informàtic al millor preu';
const BOTIGA_CORREU = 'info@bitbazar.cat';

// regles de validacio. les faig servir al missatge d'error i a l'etiqueta del formulari,
// aixi els dos llocs sempre diuen el mateix numero
const MIN_USUARI = 4;
const MIN_CLAU   = 6;

// rutes dels fitxers
const FULL_ESTILS   = 'estils.css';
const PAG_FORMULARI = 'registre.php';

/*
    ACTIVITAT 8 · El login

    APARTAT 2 · Els usuaris
    - Una contrasenya no es desa mai tal com l'escriu l'usuari. Es desa el seu hash,
      un text del qual no es pot tornar enrere.
    - Els hash els he fet amb un fitxer de prova, hash.php, amb password_hash().
      Cada vegada que el recarregava sortia un hash diferent i tots valien, perquè
      password_hash() hi afegeix un tros aleatori. Per això dos hash no es poden
      comparar entre ells: la comprovació es fa amb password_verify().
    - Quan he tingut els hash he esborrat hash.php, no va a l'entrega.
*/

// la llista d'usuaris. la clau de fora es el nom d'usuari que s'escriu al formulari,
// i a dins cada usuari es un array amb dues claus: 'nom' i 'hash'.
// el hash s'ha d'enganxar sencer (60 caracters), si en falta un no s'entra mai
const USUARIS = [
    'xinkai' => [
        'nom'  => 'Xinkai Zheng',
        'hash' => '$2y$10$BIIvYDrCOZ6VtlRcsIdHiuZqpvFVi7Nr6MiUaodqk8oSLpAJ5stfq',
    ],
    'aina' => [
        'nom'  => 'Aina Puig',
        'hash' => '$2y$10$QQTlDFyRTE/wdC7t/ZlN2e5ve/2f6/MXIxM2mpAcbC8eBM34.uaPi',
    ],
];

// no tanco el php al final a posta: si despres del tancament quedes un salt de linia
// o un espai s'escriuria a la pantalla i trencaria les pagines que inclouen aquest fitxer.
// (compte: l'etiqueta de tancar el php no es pot escriure ni dins d'un comentari amb //,
// perque el php la llegeix igual i tanca)
