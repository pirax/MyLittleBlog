<?php

$subject = '';
$content = '';

if (isset ($_POST['subject'])) {
    $subject = $_POST['subject'];
}

if (isset ($_POST['content'])) {
    $content = $_POST['content'];
}

if (isset ($_POST['save'])) {
    if (strlen ($subject) < 3) {
        $errors[] = 'Temat nie może być krótszy niż 3 znaki';
    }
    if (strlen ($content) < 10) {
        $errors[] = 'Treść nie może być krótsza niż 10 znaków';
    }

    if (!count ($errors)) {
        $_SESSION['msg'] = 'Post zapisany poprawnie';
        header ('Location: /admin/');
        exit;
    }
}

?><form method="post">
<ul>
<?php
foreach ($errors as $error) {
    echo "<li>$error</li>\n";
}
?>
</ul>
<div>
<label for="subject"><input type="text" name="subject" id="subject" value="<?php echo $subject; ?>" /></label>
<label for="content"><textarea name="content" id="content"><?php echo $content; ?></textarea></label>
<input type="submit" name="save" value="Zapisz" />
</div>
</form>
