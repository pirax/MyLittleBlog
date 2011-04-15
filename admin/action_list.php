<table width="100%">
<thead>
    <tr>
        <td></td>
        <td></td>
        <td></td>
    </tr>
</thead>
<tbody>
<?php

$entries = entry_list (null, 'date_add');
$i = 0;

foreach ($entries as $entry) {
    printf ("
    <tr>
        <td>%d</td>
        <td>%s</td>
        <td>%s</td>
        <td><a href='/?action=entry_edit&slug=%s'>edytuj</a></td>
    </tr>",

        ++$i,
        $entry['subject'],
        strftime ('%Y-%m-%d %H:%M:%S', $entry['date_add']),
        $entry['slug']
    );
}

?>
</tbody>
</table>
