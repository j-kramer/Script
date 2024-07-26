<?php include "views/partials/header.php"; ?>
<table id="boodschappenlijst">
    <thead>
        <tr>
            <th scope="col">Product</th>
            <th scope="col">Prijs</th>
            <th scope="col">Aantal</th>
            <th scope="col">Subtotaal</th>
        </tr>
    </thead>
    <tbody><?php
            foreach ($groceries as [$name, $amount, $price]) { ?>
            <tr>
                <td class="productName"><?= $name ?></td>
                <td><?php printf("%.2f", $price); ?></td>
                <td><?= $amount ?></td>
                <td><?php printf("%.2f", $price * $amount) ?></td>
            </tr>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <th scope="row" colspan="3">Totaal</th>
            <td id="totalCost"><?php printf("%.2f", $totalprice); ?></td>
        </tr>
    </tfoot>
</table>
<?php include "views/partials/footer.php"; ?>