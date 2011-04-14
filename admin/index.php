<?php

ob_start ();

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

ob_flush ();

?>

        </div>
    </body>
</html>
