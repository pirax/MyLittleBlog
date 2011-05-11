<?php

if (!isset ($_GET['slug'])) {
    $_SESSION['msg'] = 'Brak identyfikatora wpisu';
    header ('Location: /admin/');
    exit;
}

$path = slug_to_path ($_GET['slug']);
if (!file_exists ($path)) {
    $_SESSION['msg'] = 'Nie znaleziono wpisu o identyfikatorze "'. html ($_GET['slug']) .'"';
    header ('Location: /admin/');
    exit;
}

@unlink ($path);
$_SESSION['msg'] = 'Wpis o identyfikatorze "'. html ($_GET['slug']) .'" został usunięty';

header ('Location: /admin/');
exit;

