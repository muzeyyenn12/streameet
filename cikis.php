<?php

include 'header.php';
include 'helper.php';
include 'config.php';
include 'sessionManager.php';

$sessionManager = new sessionManager();
if ($sessionManager->kontrol()) {
    sessionManager::sessionSil();
    helper::yonlendir(url: "http://localhost:63342/config.php/bootstrap.html?_ijt=chi578c4sr931qgv715gvqkbo&_ij_reload=RELOAD_ON_SAVE");

}
else
{
    helper::yonlendir(url: "http://localhost:63342/config.php/profil.html?_ijt=chi578c4sr931qgv715gvqkbo&_ij_reload=RELOAD_ON_SAVE");
}