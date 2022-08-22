<?php
session_start();

$pageName = "Add Character";

include_once "./Wrappers/header.php";
include_once "./Wrappers/menu.php";

// If Adding Character Proper
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
    $tempName = trim($_POST['characterName']);
    $tempGender = trim($_POST['characterGender']);
    $tempHeight = trim($_POST['characterHeight']);
    $tempWeight = trim($_POST['characterWeight']);
    $tempAge = intval(trim($_POST['characterAge']));
    $tempHair = trim($_POST['characterHair']);
    $tempEyes = trim($_POST['characterEyes']);
    $tempRace = trim($_POST['characterRace']);
    $tempDetails = trim($_POST['characterDetails']);

    $sql = "INSERT INTO CharacterTable (Name, Gender, Height, Weight, Age, Hair, Eyes, Race, AdditionalDetails) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    if($stmt = mysqli_prepare($_SESSION["link"], $sql))
    {
        mysqli_stmt_bind_param($stmt, "ssssissss", $tempName, $tempGender, $tempHeight, $tempWeight, $tempAge, $tempHair, $tempEyes, $tempRace, $tempDetails);

        // If Game Added Proper
        if(mysqli_stmt_execute($stmt))
        {
            // Get UserId and CharacterId
            $tempUserId = $_SESSION["id"];
            $tempCharacterId = null;

            $sql2 = "SELECT CharacterId FROM CharacterTable WHERE Name = ? AND Gender = ? AND Height = ? AND Weight = ? AND Age = ? AND Hair = ? AND Eyes = ? AND Race = ? AND AdditionalDetails = ? LIMIT 1";
            if($stmt = mysqli_prepare($_SESSION["link"], $sql2))
            {
                mysqli_stmt_bind_param($stmt, 'ssssissss', $tempName, $tempGender, $tempHeight, $tempWeight, $tempAge, $tempHair, $tempEyes, $tempRace, $tempDetails);

                if(mysqli_stmt_execute($stmt))
                {
                    mysqli_stmt_store_result($stmt);

                    if(mysqli_stmt_num_rows($stmt) == 1)
                    {
                        // Store CharacterId of Newly Added Character
                        mysqli_stmt_bind_result($stmt, $tempCharacterId);

                        if(mysqli_stmt_fetch($stmt))
                        {
                            $sql3 = "INSERT INTO UserCharacterTable (UserId, CharacterId) VALUES (?, ?)";
                            if($stmt = mysqli_prepare($_SESSION["link"], $sql3))
                            {
                                mysqli_stmt_bind_param($stmt, "ii", $tempUserId, $tempCharacterId);

                                // If UserCharacterTable Inserted Into
                                if(mysqli_stmt_execute($stmt))
                                {
                                    SetCharsByUser($_SESSION["id"]);
                                }
                            }

                            header("location: index.php");
                        }
                    }
                    else
                    {
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                }
                else
                {
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }

            header("location: index.php");
        }
        else
        {
            echo "Oops! Something went wrong. Please try again later.";
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($_SESSION["link"]);
}
?>

<h1>
    <?php echo $pageName; ?>
</h1>

<form method="post" action="">
    <fieldset>
        <label for="characterName">Name:</label><input type="text" name="characterName" size="20" /><br />
        <label for="characterGender">Gender:</label><input type="text" name="characterGender" size="20" /><br />
        <label for="characterHeight">Height:</label><input type="text" name="characterHeight" size="20" /><br />
        <label for="characterWeight">Weight:</label><input type="text" name="characterWeight" size="20" /><br />
        <label for="characterAge">Age:</label><input type="text" name="characterAge" size="20" /><br />
        <label for="characterHair">Hair Details:</label><input type="text" name="characterHair" size="20" /><br />
        <label for="characterEye">Eye Color</label><input type="text" name="characterEyes" size="20" /><br />
        <label for="characterRace">Race:</label><input type="text" name="characterRace" size="20" /><br />
        <label for="characterDetails">Additional Details:</label><input type="text" name="characterDetails" size="20" value=" " /><br />
    </fieldset>
    <input class="btn" type="submit" name="CharSubmit" value="Add Character" />
</form>

<?php
include_once "./Wrappers/footer.php";
?>
