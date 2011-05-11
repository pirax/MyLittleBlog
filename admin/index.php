<?php
ob_start ();
if (!ini_get ('session.auto_start')) {
    session_start ();
}

define ('ROOT', dirname (dirname (__FILE__)));

define ('DB_PATH', ROOT . '/db/');

require ROOT . '/lib/utils.php';

?><html>
    <head>
        <title>MyLittleBlog</title>
    </head>
    <body>
        <ul>
            <li><a href="/admin/?action=add">dodaj wpis</a></li>
        </ul>
        <div id="main">

<?php

if (isset ($_SESSION['msg'])) {
    echo '<div>'. $_SESSION['msg'] ."</div>\n";
    unset ($_SESSION['msg']);
}

if (isset ($_GET['action']) && in_array ($_GET['action'], array ('add', 'edit', 'del', ))) {
    require_once 'action_'. $_GET['action'] .'.php';
}
else {
    require_once 'action_list.php';
}

ob_flush ();

?>

        </div>
    </body>
</html>
