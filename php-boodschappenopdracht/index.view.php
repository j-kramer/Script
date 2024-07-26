<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>PHP Boodschappenlijst</title>
</head>

<body>
    <div class="wrapper">
        <header>
            <h1>PHP Boodschappenlijst</h1>
            <nav>
                <ul>
                    <li><a href="" class="current">home</a></li>
                    <li><a href="">create</a></li>
                </ul>
            </nav>
        </header>
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
    </div>
</body>

</html>