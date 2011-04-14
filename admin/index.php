<html>
    <head>
        <title>MyLittleBlog</title>
    </head>
    <body>
        <ul>
            <li><a href="/admin/?action=add">dodaj wpis</a></li>
        </ul>
        <div id="main">

<?php

function action_add () {
    echo 'add';
}

function action_edit () {
}

function action_del () {
}

if (isset ($_GET['action']) && in_array ($_GET['action'], array ('add', 'edit', 'del', ))) {
    call_user_func ('action_'. $_GET['action']);
}

?>

        </div>
    </body>
</html>
