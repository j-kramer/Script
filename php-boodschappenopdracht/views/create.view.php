<?php require "views/partials/header.php"; ?>
<form action="/create" method="post">
    <fieldset>
        <legend>Add groceries</legend>
        <label for="name">Product Name:</label>
        <input type="text" name="name" required="required" placeholder="Cheese" /></label>
        <br />
        <label for="amount">Amount:</label>
        <input type="number" name="amount" required="required" placeholder="1" />
        <br />
        <label for="price">Price:</label>
        <input type="number" name="price" step="0.01" min="0" required="required" placeholder="4.95" />
        <br />
        <div class="submit"><input type="submit" value="Add" /></div>
    </fieldset>
</form>
<?php require "views/partials/footer.php"; ?>