<?php
session_start();

$pageName = "Add D&D Character";

include_once "./Wrappers/header.php";
include_once "./Wrappers/menu.php";
?>

<h1>
    <?php echo $pageName; ?>
</h1>

<form method="post" action="">
    <fieldset>
        <!--<label for="gameName">Game Name:</label><input type="text" name="gameName" size="20" /><br />
        <label for="releaseDate">Release Date:</label><input type="text" name="releaseDate" size="20" /><br />
        <label for="genre">Genre:</label><input type="text" name="genre" size="20" /><br />
        <label for="rating">Rating:</label><input type="text" name="rating" size="20" /><br />-->
    </fieldset>
    <input class="btn" type="submit" name="DndCharSubmit" value="Add D&D Character" />
</form>

<?php
include_once "./Wrappers/footer.php";
?>