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
                    <li><a href="">home</a></li>
                    <li><a href="" class="current">create</a></li>
                </ul>
            </nav>
        </header>
        <form action="create.php" method="post">
            <fieldset>
                <legend>Add groceries</legend>
                <label for="name">Product Name:</label>
                <input type="text" name="name" required="required" placeholder="Cheese" /></label>
                <br />
                <label for="amount">Amount:</label>
                <input type="number" name="amount" required="required" placeholder="1"/>
                <br />
                <label for="price">Price:</label> 
                <input type="number" name="price" required="required" placeholder="4.95"/>
                <br />
                <div class="submit"><input type="submit" value="Add" /></div>
            </fieldset>
        </form>
    </div>
</body>

</html>