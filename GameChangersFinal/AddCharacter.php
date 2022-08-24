<?php
session_start();

$pageName = "Add Character";

include_once "./Wrappers/header.php";
include_once "./Wrappers/menu.php";

// If all fields set to something
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
    // Remove spaces from beginning and end
    $tempName = trim($_POST['characterName']);
    $tempGender = trim($_POST['characterGender']);
    $tempHeight = trim($_POST['characterHeight']);
    $tempWeight = trim($_POST['characterWeight']);
    $tempAge = intval(trim($_POST['characterAge'])); // Cast string to int
    $tempHair = trim($_POST['characterHair']);
    $tempEyes = trim($_POST['characterEyes']);
    $tempRace = trim($_POST['characterRace']);
    $tempDetails = trim($_POST['characterDetails']);

    // Query to add Character to CharacterTable with above values
    $sql = "INSERT INTO CharacterTable (Name, Gender, Height, Weight, Age, Hair, EyeColor, Race, AdditionalDetails) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    if($stmt = mysqli_prepare($_SESSION["link"], $sql))
    {
        mysqli_stmt_bind_param($stmt, "ssssissss", $tempName, $tempGender, $tempHeight, $tempWeight, $tempAge, $tempHair, $tempEyes, $tempRace, $tempDetails);

        // If query executes proper
        if(mysqli_stmt_execute($stmt))
        {
            // Get UserId and CharacterId
            $tempUserId = $_SESSION["id"];
            $tempCharacterId = null;

            // Get CharacterId from newly added character
            $sql2 = "SELECT CharacterId FROM CharacterTable WHERE Name = ? AND Gender = ? AND Height = ? AND Weight = ? AND Age = ? AND Hair = ? AND EyeColor = ? AND Race = ? AND AdditionalDetails = ? LIMIT 1";
            if($stmt = mysqli_prepare($_SESSION["link"], $sql2))
            {
                mysqli_stmt_bind_param($stmt, 'ssssissss', $tempName, $tempGender, $tempHeight, $tempWeight, $tempAge, $tempHair, $tempEyes, $tempRace, $tempDetails);

                // If query 2 executes proper
                if(mysqli_stmt_execute($stmt))
                {
                    mysqli_stmt_store_result($stmt);

                    // If exactly 1 character returned
                    if(mysqli_stmt_num_rows($stmt) == 1)
                    {
                        // Store CharacterId of Newly Added Character
                        mysqli_stmt_bind_result($stmt, $tempCharacterId);

                        if(mysqli_stmt_fetch($stmt))
                        {
                            // Add UserId and CharacterId to UserCharacterTable (connect Character data to User data)
                            $sql3 = "INSERT INTO UserCharacterTable (UserId, CharacterId) VALUES (?, ?)";
                            if($stmt = mysqli_prepare($_SESSION["link"], $sql3))
                            {
                                mysqli_stmt_bind_param($stmt, "ii", $tempUserId, $tempCharacterId);

                                // If query 3 executes proper
                                if(mysqli_stmt_execute($stmt))
                                {
                                    // Grab User's Characters, since CharacterTable updated
                                    SetCharsByUser($_SESSION["id"]);
                                }
                            }

                            // Redirect to home page
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

            // Redirect to home page
            header("location: index.php");
        }
        else
        {
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Closes prepared statement
        mysqli_stmt_close($stmt);
    }

    // Close db connection
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
        <label for="characterHeight">Height (in meters):</label><input type="text" name="characterHeight" size="20" /><br />
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
