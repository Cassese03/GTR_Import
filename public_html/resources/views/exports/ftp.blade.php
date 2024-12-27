<table>
    <thead>
    <tr>
        <th style="font-weight: bold;border:1px solid white;" colspan="1">Codice Articolo</th>
        <th style="font-weight: bold;border:1px solid white;" colspan="1">Giacenza</th>
        <th style="font-weight: bold;border:1px solid white;" colspan="1">Disponibile</th>
        <th style="font-weight: bold;border:1px solid white;" colspan="1">Immediato</th>
        <th style="font-weight: bold;border:1px solid white;" colspan="1">Descrizione</th>
        <th style="font-weight: bold;border:1px solid white;" colspan="1">Prezzo</th>
        <th style="font-weight: bold;border:1px solid white;" colspan="1">Barcode</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($righe as $r) { ?>
    <tr>
        <td colspan="1" style="border:1px solid white;"><?php echo $r['0']; ?></td>
        <td colspan="1" style="border:1px solid white;"><?php echo $r['1']; ?></td>
        <td colspan="1" style="border:1px solid white;"><?php echo $r['2']; ?></td>
        <td colspan="1" style="border:1px solid white;"><?php echo $r['3']; ?></td>
        <td colspan="1" style="border:1px solid white;"><?php echo $r['4']; ?></td>
        <td colspan="1" style="border:1px solid white;"><?php echo $r['5']; ?></td>
        <td colspan="1" style="border:1px solid white;"><?php echo $r['6']; ?></td>
    </tr>
    <?php } ?>

    </tbody>
</table>