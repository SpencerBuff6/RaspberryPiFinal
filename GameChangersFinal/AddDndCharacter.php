<?php
session_start();

$pageName = "Add D&D Character";

include_once "./Wrappers/header.php";
include_once "./Wrappers/menu.php";

// If all fields set to something
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
    // Remove spaces from beginning and end
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

    // Query to add dndCharacter to dndCharacterTable with above values
    $sql = "INSERT INTO dndCharacterTable (Name, Race, Class, Level, MaxHealth, Strength, Dexterity, Constitution, Intelligence, Wisdom, Charisma, AdditionalDetails) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    if($stmt = mysqli_prepare($_SESSION["link"], $sql))
    {
        mysqli_stmt_bind_param($stmt, "ssssisssssss", $tempName, $tempRace, $tempClass, $tempLevel, $tempMaxHealth, $tempStr, $tempDex, $tempCon, $tempInt, $tempWis, $tempCha, $tempDetails);

        // If query executes proper
        if(mysqli_stmt_execute($stmt))
        {
            // Get UserId and dndCharacterId
            $tempUserId = $_SESSION["id"];
            $tempCharacterId = null;

            // Get dndCharacterId from newly added dndCharacter
            $sql2 = "SELECT dndCharacterId FROM dndCharacterTable WHERE Name = ? AND Race = ? AND Class = ? AND Level = ? AND MaxHealth = ? AND Strength = ? AND Dexterity = ? AND Constitution = ? AND Intelligence = ? AND Wisdom = ? AND Charisma = ? AND AdditionalDetails = ? LIMIT 1";
            if($stmt = mysqli_prepare($_SESSION["link"], $sql2))
            {
                mysqli_stmt_bind_param($stmt, 'ssssisssssss', $tempName, $tempRace, $tempClass, $tempLevel, $tempMaxHealth, $tempStr, $tempDex, $tempCon, $tempInt, $tempWis, $tempCha, $tempDetails);

                // If query 2 executes proper
                if(mysqli_stmt_execute($stmt))
                {
                    mysqli_stmt_store_result($stmt);

                    // If exactly 1 character returned
                    if(mysqli_stmt_num_rows($stmt) == 1)
                    {
                        // Store DndCharacterId of Newly Added D&D Character
                        mysqli_stmt_bind_result($stmt, $tempCharacterId);

                        if(mysqli_stmt_fetch($stmt))
                        {
                            // Add UserId and dndCharacterId to UserDndCharacterTable (connect dndCharacter data to User data)
                            $sql3 = "INSERT INTO UserDndCharacterTable (UserId, dndCharacterId) VALUES (?, ?)";
                            if($stmt = mysqli_prepare($_SESSION["link"], $sql3))
                            {
                                mysqli_stmt_bind_param($stmt, "ii", $tempUserId, $tempCharacterId);

                                // If query 3 executes proper
                                if(mysqli_stmt_execute($stmt))
                                {
                                    // Grab User's dndCharacters, since dndCharacterTable updated
                                    SetDndCharsByUser($_SESSION["id"]);
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
        <label for="dndcharacterName">Name:</label><input type="text" name="dndcharacterName" size="20" /><br />
        <label for="dndcharacterRace">Race:</label><input type="text" name="dndcharacterRace" size="20" /><br />
        <label for="dndcharacterClass">Class:</label><input type="text" name="dndcharacterClass" size="20" /><br />
        <label for="dndcharacterLevel">Level:</label><input type="text" name="dndcharacterLevel" size="20" /><br />
        <label for="dndcharacterMaxHealth">Max Health:</label><input type="text" name="dndcharacterMaxHealth" size="20" /><br />
        <label for="dndcharacterStrength">Strength:</label><input type="text" name="dndcharacterStrength" size="20" /><br />
        <label for="dndcharacterDexterity">Dexterity:</label><input type="text" name="dndcharacterDexterity" size="20" /><br />
        <label for="dndcharacterConstitution">Constitution:</label><input type="text" name="dndcharacterConstitution" size="20" /><br />
        <label for="dndcharacterIntelligence">Intelligence:</label><input type="text" name="dndcharacterIntelligence" size="20" /><br />
        <label for="dndcharacterWisdom">Wisdom:</label><input type="text" name="dndcharacterWisdom" size="20" /><br />
        <label for="dndcharacterCharisma">Charisma:</label><input type="text" name="dndcharacterCharisma" size="20" /><br />
        <label for="dndcharacterAdditionalDetails">Additional Details:</label><input type="text" name="dndcharacterAdditionalDetails" size="20" value=" " /><br />

    </fieldset>
    <input class="btn" type="submit" name="DndCharSubmit" value="Add D&D Character" />
</form>

<?php
include_once "./Wrappers/footer.php";
?>