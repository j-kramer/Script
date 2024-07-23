<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Boodschappenlijst</title>
</head>

<body>
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
                    <td class="productName"><?php echo $name ?></td>
                    <td><?php printf("%.2f", $price); ?></td>
                    <td><?php echo $amount ?></td>
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
</body>

</html>