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
        <label for="dndcharacterName">dndName:</label><input type="text" name="dndcharacterName" size="20" /><br />
        <label for="dndcharacterRace">dndRace:</label><input type="text" name="dndcharacterRace" size="20" /><br />
        <label for="dndcharacterClass">dndClass:</label><input type="text" name="dndcharacterClass" size="20" /><br />
        <label for="dndcharacterLevel">dndLevel:</label><input type="text" name="dndcharacterLevel" size="20" /><br />
        <label for="dndcharacterMaxHealth">dndMaxHealth:</label><input type="text" name="dndcharacterMaxHealth" size="20" /><br />
        <label for="dndcharacterStrength">dndStrength:</label><input type="text" name="dndcharacterStrength" size="20" /><br />
        <label for="dndcharacterDexterity">dndDexterity:</label><input type="text" name="dndcharacterDexterity" size="20" /><br />
        <label for="dndcharacterConstitution">dndConstitution:</label><input type="text" name="dndcharacterConstitution" size="20" /><br />
        <label for="dndcharacterIntelligence">dndIntelligence:</label><input type="text" name="dndcharacterIntelligence" size="20" /><br />
        <label for="dndcharacterWisdom">dndWisdom:</label><input type="text" name="dndcharacterWisdom" size="20" /><br />
        <label for="dndcharacterChrisma">dndChrisma:</label><input type="text" name="dndcharacterChrisma" size="20" /><br />
        <label for="dndcharacterAdditionalDetails">dndAdditionalDetails:</label><input type="text" name="dndcharacterAdditionalDetails" size="20" /><br />

    </fieldset>
    <input class="btn" type="submit" name="DndCharSubmit" value="Add D&D Character" />
</form>

<?php
include_once "./Wrappers/footer.php";
?>