<?php
//Appelez les fichiers responsables de la partie d'affichage de plugin dans la page administrative
$path = ABSPATH . 'wp-content/plugins/pluignInformationMeteo/admin_html/';
require_once($path . 'adminHtmlBulletinmeteo.php');
$path1 = ABSPATH . 'wp-content/plugins/pluignInformationMeteo/admin_html/';
require_once($path1 . 'adminHtmlInstallations.php');
$path2 = ABSPATH . 'wp-content/plugins/pluignInformationMeteo/admin_html/';
require_once($path2 . 'adminHtmlWebcam.php');
