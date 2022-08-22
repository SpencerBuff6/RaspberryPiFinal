<?php
session_start();

$pageName = "Edit Character";

include_once "./Wrappers/header.php";
include_once "./Wrappers/menu.php";

?>

<h1>
    <?php echo $pageName; ?>
</h1>

<form method="post" action="">
    <fieldset>
        <!--<label for="gameName">Game Name:</label><input type="text" name="gameName" value="<?php echo $_SESSION['games'][$_SESSION['EditIds'][0]][0] ?>" size="20" /><br />
        <label for="releaseDate">Release Date:</label><input type="text" name="releaseDate" value="<?php echo $_SESSION['games'][$_SESSION['EditIds'][0]][1] ?>" size="20" /><br />
        <label for="genre">Genre:</label><input type="text" name="genre" value="<?php echo $_SESSION['games'][$_SESSION['EditIds'][0]][2] ?>" size="20" /><br />
        <label for="rating">Rating:</label><input type="text" name="rating" value="<?php echo $_SESSION['games'][$_SESSION['EditIds'][0]][3] ?>" size="20" /><br />-->
    </fieldset>
    <input class="btn" type="submit" name="CharSubmit" value="Edit Character" />
</form>

<?php
include_once "./Wrappers/footer.php";
?>
