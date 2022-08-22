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
        <label for="dndcharacterName">Name:</label><input type="text" name="dndcharacterName" size="20" /><br />
        <label for="dndcharacterRace">Race:</label><input type="text" name="dndcharacterRace" size="20" /><br />
        <label for="dndcharacterClass">Class:</label><input type="text" name="dndcharacterClass" size="20" /><br />
        <label for="dndcharacterLevel">Level:</label><input type="text" name="dndcharacterLevel" size="20" /><br />
        <label for="dndcharacterMaxHealth">MaxHealth:</label><input type="text" name="dndcharacterMaxHealth" size="20" /><br />
        <label for="dndcharacterStrength">Strength:</label><input type="text" name="dndcharacterStrength" size="20" /><br />
        <label for="dndcharacterDexterity">Dexterity:</label><input type="text" name="dndcharacterDexterity" size="20" /><br />
        <label for="dndcharacterConstitution">Constitution:</label><input type="text" name="dndcharacterConstitution" size="20" /><br />
        <label for="dndcharacterIntelligence">Intelligence:</label><input type="text" name="dndcharacterIntelligence" size="20" /><br />
        <label for="dndcharacterWisdom">Wisdom:</label><input type="text" name="dndcharacterWisdom" size="20" /><br />
        <label for="dndcharacterChrisma">Chrisma:</label><input type="text" name="dndcharacterChrisma" size="20" /><br />
        <label for="dndcharacterAdditionalDetails">AdditionalDetails:</label><input type="text" name="dndcharacterAdditionalDetails" size="20" /><br />

    </fieldset>
    <input class="btn" type="submit" name="DndCharSubmit" value="Add D&D Character" />
</form>

<?php
include_once "./Wrappers/footer.php";
?>