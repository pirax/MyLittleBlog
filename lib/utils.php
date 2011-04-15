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
    $path  = DB_PATH . '/' . $fname .'.txt';
    return file_put_contents ($path, $subject ."\n". $content);
}

function entry_edit ($entry, $subject, $content) {
    if (!file_put_contents ($entry, $subject ."\n". $content)) {
        return false;
    }

    $fname = fname_encode ($subject);
    $path  = DB_PATH . '/' . $fname .'.txt';
    return rename ($entry, $path);
}

function entry_read ($entry) {
    $data = file_get_contents ($entry);
    list ($subject, $content) = explode ("\n", $data, 2);
    return array ('subject' => $subject, 'content', $content);
}

function entry_del ($entry) {
    return unlink ($entry);
}

function entries_sorter ($field) {
    return create_function ('$a, $b', "
        if (\$a['$field'] == \$b['$field']) {
            return 0;
        }
        return \$a['$field'] < \$b['$field'] ? 1 : -1;
    ");
}

function entry_list ($mask=null, $sort_by='slug') {
    $list = glob (DB_PATH. (!is_null ($mask) ? "/$mask.txt" : '/*.txt'), GLOB_MARK);
    $ret = array ();
    foreach ($list as $entry_path) {
        $entry = entry_read ($entry_path);
        $ret[] = array (
            'subject'   => $entry['subject'],
            'path'      => $entry_path,
            'slug'      => substr (basename ($entry_path), 0, -4),
            'date_add'  => filectime ($entry_path),
            'date_mod'  => filemtime ($entry_path),
        );
    }

    $reverse = 0;
    if (strpos ($sort_by, '!') === 0) {
        $reverse = 1;
        $sort_by = substr ($sort_by, 1);
    }

    if ($sort_by != 'slug') {
        uasort ($ret, entries_sorter ($sort_by));
    }

    if ($reverse) {
        $ret  =array_reverse ($ret);
    }

    return $ret;
}

