<?php
session_start();

$pageName = "Home";

// Prevents null errors when trying to access property of null
if (!isset($_SESSION["characters"])) $_SESSION["characters"] = [

];

// Prevents null errors when trying to access property of null
if (!isset($_SESSION["dndCharacters"])) $_SESSION["dndCharacters"] = [

];

// Sets character and dndCharacter arrays if logged in
if (isset($_SESSION["id"]))
{
    SetCharsByUser($_SESSION["id"]);
    SetDndCharsByUser($_SESSION["id"]);
}

include_once "./Wrappers/header.php";
include_once "./Wrappers/menu.php";

// Deletes Character and UserCharacter from database, resets 'local' character array
function DeleteChar(int $index)
{
    // Get CharacterId For Use With UserCharacterTable and CharacterTable
    $gId = $_SESSION["characters"][$index][9];

    // Delete From UserCharacterTable
    $sql = "DELETE FROM UserCharacterTable WHERE CharacterId = $gId";
    mysqli_query($_SESSION["link"], $sql);

    // Delete From CharacterTable
    $sql2 = "DELETE FROM CharacterTable WHERE CharacterId = $gId";
    mysqli_query($_SESSION["link"], $sql2);

    // Grab User's Characters
    SetCharsByUser($_SESSION["id"]);
}

// Deletes dndCharacter and UserDndCharacter from database, resets 'local' dndCharacter array
function DeleteDndChar(int $index)
{
    // Get DndCharacterId For Use With UserDndCharacterTable and DndCharacterTable
    $gId = $_SESSION["dndCharacters"][$index][12];

    // Delete From UserDndCharacterTable
    $sql = "DELETE FROM UserDndCharacterTable WHERE dndCharacterId = $gId";
    mysqli_query($_SESSION["link"], $sql);

    // Delete From DndCharacterTable
    $sql2 = "DELETE FROM dndCharacterTable WHERE dndCharacterId = $gId";
    mysqli_query($_SESSION["link"], $sql2);

    // Grab User's D&D Characters
    SetDndCharsByUser($_SESSION["id"]);
}

// If DeleteChar button clicked
if (isset($_POST['DeleteChar']))
{
    // Deletes from CharacterTable and UserCharacterTable according to CharId
    DeleteChar($_POST['DeleteChar']);
}

// If EditChar button clicked
if (isset($_POST['EditChar']))
{
    // Stores index in 'local' character array, and id for CharacterTable
    $_SESSION['EditIds'] = [
        $_POST['EditChar'],
        $_SESSION["characters"][$_POST['EditChar']][9]
    ];
    header("location: EditChar.php");
}

// If DeleteDndChar button clicked
if (isset($_POST['DeleteDndChar']))
{
    // Deletes from dndCharacterTable and UserDndCharacterTable according to DndCharId
    DeleteDndChar($_POST['DeleteDndChar']);
}

// If EditDndChar button clicked
if (isset($_POST['EditDndChar']))
{
    // Stores index in 'local' dndCharacter array, and id for dndCharacterTable
    $_SESSION['EditIds'] = [
        $_POST['EditDndChar'],
        $_SESSION["dndCharacters"][$_POST['EditDndChar']][12]
    ];
    header("location: EditDndChar.php");
}

//print_r($_SESSION["games"]);
?>

<h1>
    <?php echo $pageName; ?>
</h1>

<p>
    Welcome to Game Changers Character Creator! Game Changers Character Creator is a website for you to create characters for any purpose, such as for a book or other story. You may also create a D&D character, for any edition!
</p>

<?php
// If logged in and 'local' character array is not empty
if (isset($_SESSION['loggedin']) && isset($_SESSION["characters"]) && count($_SESSION["characters"]) > 0)
{
    echo "
    <table>
        <tr>
            <th>
                Name
            </th>
            <th>
                Gender
            </th>
            <th>
                Height
            </th>
            <th>
                Weight
            </th>
            <th>
                Age
            </th>
            <th>
                Hair
            </th>
            <th>
                Eye Color
            </th>
            <th>
                Race
            </th>
            <th>
                Additional Details
            </th>
            <th>
                Delete?
            </th>
            <th>
                Edit?
            </th>
        </tr>";
    for($i = 0; $i < count($_SESSION["characters"]); $i++)
    {
        $g = $_SESSION["characters"][$i];
        echo "
        <tr>
            <td>
                $g[0]
            </td>
            <td>
                $g[1]
            </td>
            <td>
                $g[2]
            </td>
            <td>
                $g[3]
            </td>
            <td>
                $g[4]
            </td>
            <td>
                $g[5]
            </td>
            <td>
                $g[6]
            </td>
            <td>
                $g[7]
            </td>
            <td>
                $g[8]
            </td>
            <td>
                <form method='post'>
                    <input class='btn delete' type='submit' name='DeleteChar' value='$i'/>
                </form>
            </td>
            <td>
                <form method='post'>
                    <input class='btn delete' type='submit' name='EditChar' value='$i'/>
                </form>
            </td>
        </tr>";
    }
    echo "</table>";
}

echo "<br />";
echo "<br />";
echo "<br />";
// If logged in and 'local' dndCharacter array is not empty
if (isset($_SESSION['loggedin']) && isset($_SESSION["dndCharacters"]) && count($_SESSION["dndCharacters"]) > 0)
{
    echo "
    <table>
        <tr>
            <th>
                Name
            </th>
            <th>
                Race
            </th>
            <th>
                Class
            </th>
            <th>
                Level
            </th>
            <th>
                Max Health
            </th>
            <th>
                Strength
            </th>
            <th>
                Dexterity
            </th>
            <th>
                Constitution
            </th>
            <th>
                Intelligence
            </th>
            <th>
                Wisdom
            </th>
            <th>
                Charisma
            </th>
            <th>
                Additional Details
            </th>
            <th>
                Delete?
            </th>
            <th>
                Edit?
            </th>
        </tr>";
    for($i = 0; $i < count($_SESSION["dndCharacters"]); $i++)
    {
        $g = $_SESSION["dndCharacters"][$i];
        echo "
        <tr>
            <td>
                $g[0]
            </td>
            <td>
                $g[1]
            </td>
            <td>
                $g[2]
            </td>
            <td>
                $g[3]
            </td>
            <td>
                $g[4]
            </td>
            <td>
                $g[5]
            </td>
            <td>
                $g[6]
            </td>
            <td>
                $g[7]
            </td>
            <td>
                $g[8]
            </td>
            <td>
                $g[9]
            </td>
            <td>
                $g[10]
            </td>
            <td>
                $g[11]
            </td>
            <td>
                <form method='post'>
                    <input class='btn delete' type='submit' name='DeleteDndChar' value='$i'/>
                </form>
            </td>
            <td>
                <form method='post'>
                    <input class='btn delete' type='submit' name='EditDndChar' value='$i'/>
                </form>
            </td>
        </tr>";
    }
    echo "</table>";
}

?>

<?php
include_once "./Wrappers/footer.php";
?>
