<?php
/** @global string Шлях до корня сервера */
define("ROOT", dirname(__FILE__));
/** @global string Шлях до файлів конфігурації */
define("CONFIG", ROOT.'/config/');
/** @global string Шлях до корня додатку для html */
define("APPURL", '/app');
/** @global string Шлях до корня додатку */
define("APP", ROOT.'/app');
/** @global string Шлях до файлів(бд) додатку для html */
define("APPDATAURL", '/app/data');
/** @global string Шлях до файлів(бд) додатку */
define("APPDATA", APP.'/data');
/** @global string Шлях до html шаблону додатку */
define("TEMPLATE", ROOT.'/app/template');
/** @global string Шлях до хедера шаблону додатку */
define("HEADER", TEMPLATE.'/layouts/header.php');
/** @global string Шлях до футера шаблону додатку */
define("FOOTER", TEMPLATE.'/layouts/footer.php');
