<?php require "views/partials/header.php"; ?>
<form action="/create" method="post">
    <fieldset>
        <legend>Add groceries</legend>
        <label for="name">Product Name:</label>
        <input type="text" name="name" required="required" placeholder="Cheese" value="<?=$formdata["name"]?>" <?php if (!$formdata["validName"]) {?> class="invalid"/>
        <p>Invalid name</p>
        <?php } else echo "/>";?>
        <label for="amount">Amount:</label>
        <input type="number" name="amount" required="required" placeholder="1" value="<?=$formdata["amount"]?>" <?php if (!$formdata["validAmount"]) {?> class="invalid"/>
        <p>Invalid amount</p>
        <?php } else echo "/>";?>
        <label for="price">Price:</label>
        <input type="number" name="price" step="0.01" min="0" required="required" placeholder="4.95" value="<?=$formdata["price"]?>" <?php if (!$formdata["validPrice"]) {?> class="invalid"/>
        <p>Invalid price</p>
        <?php } else echo "/>";?>
        <div class="submit"><input type="submit" value="Add" /></div>
    </fieldset>
</form>
<?php require "views/partials/footer.php"; ?>