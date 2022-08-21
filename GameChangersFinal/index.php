<?php
session_start();

$pageName = "Home";

if (!isset($_SESSION["characters"])) $_SESSION["characters"] = [

];

if (!isset($_SESSION["dndCharacters"])) $_SESSION["dndCharacters"] = [

];

include_once "./Wrappers/header.php";
include_once "./Wrappers/menu.php";

//function DeleteGame(int $index)
//{
//    // Get GameId For Use With UserGameTable and GameTable
//    $gId = $_SESSION["games"][$index][4];

//    // Delete From GameTable
//    $sql = "DELETE FROM UserGameTable WHERE GameId = $gId";
//    mysqli_query($_SESSION["link"], $sql);

//    // Delete From UserGameTable
//    $sql2 = "DELETE FROM GameTable WHERE GameId = $gId";
//    mysqli_query($_SESSION["link"], $sql2);

//    SetGamesByUser($_SESSION["id"]);
//}

//if (isset($_POST['DeleteGame']))
//{
//    DeleteGame($_POST['DeleteGame']);
//}

//if (isset($_POST['EditGame']))
//{
//    $_SESSION['EditIds'] = [
//        $_POST['EditGame'],
//        $_SESSION["games"][$_POST['EditGame']][4]
//    ];
//    header("location: EditGame.php");
//}

//print_r($_SESSION["games"]);
?>

<h1>
    <?php echo $pageName; ?>
</h1>

<p>
    Welcome to Game Changers Character Creator! Game Changers Character Creator is a website for you to create characters for any purpose, such as for a book or other story. You may also create a D&D character, for any edition!
</p>

<?php

if (isset($_SESSION['loggedin']) && isset($_SESSION["characters"]) && count($_SESSION["characters"]) > 0)
{
    echo "
    <table>
        <tr>
            <th>
                Name
            </th>
            <th>
                Release Date
            </th>
            <th>
                Genre
            </th>
            <th>
                Rating
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

if (isset($_SESSION['loggedin']) && isset($_SESSION["dndCharacters"]) && count($_SESSION["dndCharacters"]) > 0)
{
    echo "
    <table>
        <tr>
            <th>
                Name
            </th>
            <th>
                Release Date
            </th>
            <th>
                Genre
            </th>
            <th>
                Rating
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
