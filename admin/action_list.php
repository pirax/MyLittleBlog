<table width="100%">
<thead>
    <tr>
        <td>LP</td>
        <td>Tytuł</td>
        <td>Data utworzenia</td>
        <td>Edytuj</td>
    </tr>
</thead>
<tbody>
<?php

$entries = entry_list (null, 'date_add');
$i = 0;

if (is_array ($entries) && count ($entries)) {
    foreach ($entries as $entry) {
        printf ("
        <tr>
            <td>%d</td>
            <td>%s</td>
            <td>%s</td>
            <td><a href='/admin/?action=edit&slug=%s'>edytuj</a></td>
        </tr>",

            ++$i,
            $entry['subject'],
            strftime ('%Y-%m-%d %H:%M:%S', $entry['date_add']),
            $entry['slug']
        );
    }
}
else {
    echo '<tr><td colspan="4">Brak wpisów</td></tr>';
}

?>
</tbody>
</table>
