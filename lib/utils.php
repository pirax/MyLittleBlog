<?php

function slug ($string) {
    $string = strtr ($string, "ążśźęćńłóĄŻŚŹĘĆŃŁÓ \t\r\n", 'azszecnloAZSZECNLO____');
    $string = preg_replace ('/_{1,}/', '_', $string);
    $string = preg_replace ('/[^a-zA-Z0-9_,.-]/', '', $string);
    return $string;
}

function fname_encode ($subject) {
    return slug ($subject);
}

function entry_add ($subject, $content) {
    $fname = fname_encode ($subject);
    $path  = DB_PATH . '/' . $fname;
    return file_put_contents ($path, $subject ."\n". $content);
}

function entry_edit ($entry, $subject, $content) {
    if (!file_put_contents ($entry, $subject ."\n". $content)) {
        return false;
    }

    $fname = fname_encode ($subject);
    $path  = DB_PATH . '/' . $fname;
    return rename ($entry, $path);
}

function entry_read ($entry) {
    $data = file_get_contents ($entry);
    list ($subject, $content) = explode ($data, 2);
    return array ('subject' => $subject, 'content', $content);
}

function entry_del ($entry) {
    return unlink ($entry);
}

