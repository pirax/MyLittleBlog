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

$entries = entry_list ();
$i = 0;

foreach ($entries as $entry) {
    printf ("
    <tr>
        <td>%d</td>
        <td>%s</td>
        <td><a href='/?action=entry_edit&slug=%s'>edytuj</a></td>
    </tr>",

        ++$i,
        $entry['subject'],
        $entry['slug']
    );
}

?>
</tbody>
</table>
