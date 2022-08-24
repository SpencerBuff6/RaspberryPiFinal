<?php
session_start();

$pageName = "Edit Character";

include_once "./Wrappers/header.php";
include_once "./Wrappers/menu.php";

// If all fields are set to something
if(isset($_POST['characterName']) &&
   isset($_POST['characterGender']) &&
   isset($_POST['characterHeight']) &&
   isset($_POST['characterWeight']) &&
   isset($_POST['characterAge']) &&
   isset($_POST['characterHair']) &&
   isset($_POST['characterEyes']) &&
   isset($_POST['characterRace']) &&
   isset($_POST['characterDetails']))
{
    // Remove spaces from beginning and end of each field, store in variable
    $tempName = trim($_POST['characterName']);
    $tempGender = trim($_POST['characterGender']);
    $tempHeight = trim($_POST['characterHeight']);
    $tempWeight = trim($_POST['characterWeight']);
    $tempAge = intval(trim($_POST['characterAge'])); // Cast string to int
    $tempHair = trim($_POST['characterHair']);
    $tempEyes = trim($_POST['characterEyes']);
    $tempRace = trim($_POST['characterRace']);
    $tempDetails = trim($_POST['characterDetails']);

    // Get CharacterId from session
    $tempCharId = $_SESSION['EditIds'][1];

    // Query to update all fields in CharacterTable according to CharacterId
    $sql = "UPDATE CharacterTable SET Name = '$tempName', Gender = '$tempGender', Height = '$tempHeight', Weight = '$tempWeight', Age = $tempAge, Hair = '$tempHair', EyeColor = '$tempEyes', Race = '$tempRace', AdditionalDetails = '$tempDetails' WHERE CharacterId = $tempCharId";

    // Perform query
    mysqli_query($_SESSION["link"], $sql);

    // Grab User's Characters, to replace local, outdated version of this character
    SetCharsByUser($_SESSION["id"]);

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
        <label for="characterName">Name:</label><input type="text" name="characterName" value="<?php echo $_SESSION['characters'][$_SESSION['EditIds'][0]][0] ?>" size="20" /><br />
        <label for="characterGender">Gender:</label><input type="text" name="characterGender" value="<?php echo $_SESSION['characters'][$_SESSION['EditIds'][0]][1] ?>" size="20" /><br />
        <label for="characterHeight">Height (in meters):</label><input type="text" name="characterHeight" value="<?php echo $_SESSION['characters'][$_SESSION['EditIds'][0]][2] ?>" size="20" /><br />
        <label for="characterWeight">Weight:</label><input type="text" name="characterWeight" value="<?php echo $_SESSION['characters'][$_SESSION['EditIds'][0]][3] ?>" size="20" /><br />
        <label for="characterAge">Age:</label><input type="text" name="characterAge" value="<?php echo $_SESSION['characters'][$_SESSION['EditIds'][0]][4] ?>" size="20" /><br />
        <label for="characterHair">Hair Details:</label><input type="text" name="characterHair" value="<?php echo $_SESSION['characters'][$_SESSION['EditIds'][0]][5] ?>" size="20" /><br />
        <label for="characterEyes">Eye Color:</label><input type="text" name="characterEyes" value="<?php echo $_SESSION['characters'][$_SESSION['EditIds'][0]][6] ?>" size="20" /><br />
        <label for="characterRace">Race:</label><input type="text" name="characterRace" value="<?php echo $_SESSION['characters'][$_SESSION['EditIds'][0]][7] ?>" size="20" /><br />
        <label for="characterDetails">Additional Details:</label><input type="text" name="characterDetails" value="<?php echo $_SESSION['characters'][$_SESSION['EditIds'][0]][8] ?>" size="20" /><br />
    </fieldset>
    <input class="btn" type="submit" name="CharSubmit" value="Edit Character" />
</form>

<?php
include_once "./Wrappers/footer.php";
?>
