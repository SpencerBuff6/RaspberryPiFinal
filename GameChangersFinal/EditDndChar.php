<?php
session_start();

$pageName = "Edit D&D Character";

include_once "./Wrappers/header.php";
include_once "./Wrappers/menu.php";

// If all fields are set to something
if(isset($_POST['dndcharacterName']) &&
   isset($_POST['dndcharacterRace']) &&
   isset($_POST['dndcharacterClass']) &&
   isset($_POST['dndcharacterLevel']) &&
   isset($_POST['dndcharacterMaxHealth']) &&
   isset($_POST['dndcharacterStrength']) &&
   isset($_POST['dndcharacterDexterity']) &&
   isset($_POST['dndcharacterConstitution']) &&
   isset($_POST['dndcharacterIntelligence']) &&
   isset($_POST['dndcharacterWisdom']) &&
   isset($_POST['dndcharacterCharisma']) &&
   isset($_POST['dndcharacterAdditionalDetails']))
{
    // Remove spaces from beginning and end of each field, store in variable
    $tempName = trim($_POST['dndcharacterName']);
    $tempRace = trim($_POST['dndcharacterRace']);
    $tempClass = trim($_POST['dndcharacterClass']);
    $tempLevel = trim($_POST['dndcharacterLevel']);
    $tempMaxHealth = intval(trim($_POST['dndcharacterMaxHealth'])); // Cast string to int
    $tempStr = trim($_POST['dndcharacterStrength']);
    $tempDex = trim($_POST['dndcharacterDexterity']);
    $tempCon = trim($_POST['dndcharacterConstitution']);
    $tempInt = trim($_POST['dndcharacterIntelligence']);
    $tempWis = trim($_POST['dndcharacterWisdom']);
    $tempCha = trim($_POST['dndcharacterCharisma']);
    $tempDetails = trim($_POST['dndcharacterAdditionalDetails']);

    // Get dndCharacterId from session
    $tempCharId = $_SESSION['EditIds'][1];

    // Query to update all fields in dndCharacterTable according to dndCharacterId
    $sql = "UPDATE dndCharacterTable SET Name = '$tempName', Race = '$tempRace', Class = '$tempClass', Level = '$tempLevel', MaxHealth = $tempMaxHealth, Strength = '$tempStr', Dexterity = '$tempDex', Constitution = '$tempCon', Intelligence = '$tempInt', Wisdom = '$tempWis', Charisma = '$tempCha', AdditionalDetails = '$tempDetails' WHERE dndCharacterId = $tempCharId";

    // Perform query
    mysqli_query($_SESSION["link"], $sql);

    // Grab User's dndCharacters, to replace local, outdated version of this dndCharacter
    SetDndCharsByUser($_SESSION["id"]);

    // Closes db connection
    mysqli_close($_SESSION["link"]);

    // Redirect to home page
    header("location: index.php");
}
?>

<h1>
    <?php echo $pageName; ?>
</h1>

<form method="post" action="">
    <fieldset>
        <label for="dndcharacterName">Name:</label><input type="text" name="dndcharacterName" value="<?php echo $_SESSION['dndCharacters'][$_SESSION['EditIds'][0]][0] ?>" size="20" /><br />
        <label for="dndcharacterRace">Race:</label><input type="text" name="dndcharacterRace" value="<?php echo $_SESSION['dndCharacters'][$_SESSION['EditIds'][0]][1] ?>" size="20" /><br />
        <label for="dndcharacterClass">Class:</label><input type="text" name="dndcharacterClass" value="<?php echo $_SESSION['dndCharacters'][$_SESSION['EditIds'][0]][2] ?>" size="20" /><br />
        <label for="dndcharacterLevel">Level:</label><input type="text" name="dndcharacterLevel" value="<?php echo $_SESSION['dndCharacters'][$_SESSION['EditIds'][0]][3] ?>" size="20" /><br />
        <label for="dndcharacterMaxHealth">MaxHealth:</label><input type="text" name="dndcharacterMaxHealth" value="<?php echo $_SESSION['dndCharacters'][$_SESSION['EditIds'][0]][4] ?>" size="20" /><br />
        <label for="dndcharacterStrength">Strength:</label><input type="text" name="dndcharacterStrength" value="<?php echo $_SESSION['dndCharacters'][$_SESSION['EditIds'][0]][5] ?>" size="20" /><br />
        <label for="dndcharacterDexterity">Dexterity:</label><input type="text" name="dndcharacterDexterity" value="<?php echo $_SESSION['dndCharacters'][$_SESSION['EditIds'][0]][6] ?>" size="20" /><br />
        <label for="dndcharacterConstitution">Constitution:</label><input type="text" name="dndcharacterConstitution" value="<?php echo $_SESSION['dndCharacters'][$_SESSION['EditIds'][0]][7] ?>" size="20" /><br />
        <label for="dndcharacterIntelligence">Intelligence:</label><input type="text" name="dndcharacterIntelligence" value="<?php echo $_SESSION['dndCharacters'][$_SESSION['EditIds'][0]][8] ?>" size="20" /><br />
        <label for="dndcharacterWisdom">Wisdom:</label><input type="text" name="dndcharacterWisdom" value="<?php echo $_SESSION['dndCharacters'][$_SESSION['EditIds'][0]][9] ?>" size="20" /><br />
        <label for="dndcharacterCharisma">Chrisma:</label><input type="text" name="dndcharacterCharisma" value="<?php echo $_SESSION['dndCharacters'][$_SESSION['EditIds'][0]][10] ?>" size="20" /><br />
        <label for="dndcharacterAdditionalDetails">Additional Details:</label><input type="text" name="dndcharacterAdditionalDetails" value="<?php echo $_SESSION['dndCharacters'][$_SESSION['EditIds'][0]][11] ?>" size="20" /><br />
    </fieldset>
    <input class="btn" type="submit" name="DndCharSubmit" value="Edit D&D Character" />
</form>

<?php
include_once "./Wrappers/footer.php";
?>
