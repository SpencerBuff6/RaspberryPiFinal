
<!DOCTYPE html>
<html lang="en">

<?php 

session_start();
require "config.php"; 

$WebsiteName = "Game Changers Character Creator" . " - " . $pageName;
if(!isset($_SESSION['style']))
{
    $_SESSION['style'] = "../Styles/style1.css";
}
if(isset($_POST['styleChoice'])){
	switch ($_POST['styleChoice'])
    {
        case "Style 1":
            $_SESSION['style'] = "../Styles/style1.css";
            break;
        case "Style 2":
            $_SESSION['style'] = "../Styles/style2.css";
            break;
        case "Style 3":
            $_SESSION['style'] = "../Styles/style3.css";
            break;
    	default:
            $_SESSION['style'] = "../Styles/style1.css";
            break;
    } 
}

$Header = "Game Changers Character Creator";

$Style = $_SESSION['style'];

function SetCharsByUser($uId)
{
    /*
    UserTable UserCharacterTable CharacterTable
    UserTable.UserId -> UserCharacterTable.CharacterId    ->  CharacterTable.*

    Get All Character Info From CharacterTable By Filtering UserCharacterTable On UserId
     */
    $sql4 = "SELECT c.Name, c.Gender, c.Height, c.Weight, c.Age, c.Hair, c.EyeColor, c.Race, c.AdditionalDetails, c.CharacterId
                                               FROM UserCharacterTable as uc
                                               LEFT JOIN UserTable as u
                                               ON uc.UserId = u.UserId
                                               LEFT JOIN CharacterTable as c
                                               ON c.CharacterId = uc.CharacterId
                                               WHERE ug.UserId = $uId";
    if($res = mysqli_query($_SESSION["link"], $sql4))
    {
        $results = array();
        while ($games = mysqli_fetch_assoc($res))
        {
            $results[] = $games;
        }

        $_SESSION["characters"] = $results;

        for ($i = 0; $i < count($_SESSION['characters']); $i++)
        {
            $_SESSION["characters"][$i] = array_combine(range(0, count($_SESSION["characters"][$i])-1),
                                               array_values($_SESSION["characters"][$i])
                                               );
        }
    }
}

function SetDndCharsByUser($uId)
{
    /*
    UserTable UserDndCharacterTable DndCharacterTable
    UserTable.UserId -> UserDndCharacterTable.DndCharacterId    ->  DndCharacterTable.*

    Get All D&D Character Info From DndCharacterTable By Filtering UserDndCharacterTable On UserId
     */
    $sql4 = "SELECT c.Name, c.Race, c.Class, c.Level, c.MaxHealth, c.Strength, c.Dexterity, c.Constitution, c.Intelligence, c.Wisdom, c.Charisma, c.AdditionalDetails, c.DndCharacterId
                                               FROM UserDndCharacterTable as uc
                                               LEFT JOIN UserTable as u
                                               ON uc.UserId = u.UserId
                                               LEFT JOIN DndCharacterTable as c
                                               ON c.DndCharacterId = uc.DndCharacterId
                                               WHERE ug.UserId = $uId";
    if($res = mysqli_query($_SESSION["link"], $sql4))
    {
        $results = array();
        while ($games = mysqli_fetch_assoc($res))
        {
            $results[] = $games;
        }

        $_SESSION["dndCharacters"] = $results;

        for ($i = 0; $i < count($_SESSION['dndCharacters']); $i++)
        {
            $_SESSION["dndCharacters"][$i] = array_combine(range(0, count($_SESSION["dndCharacters"][$i])-1),
                                               array_values($_SESSION["dndCharacters"][$i])
                                               );
        }
    }
}

?>
<head>
  <meta content="text/html; charset=ISO-8859-1"  http-equiv="content-type">
  <title name="siteTitle"><?php echo $WebsiteName; ?></title>
  <link rel="stylesheet" href="<?php echo $Style; ?>" />
</head>
<body>

<h1><?php echo $Header ?></h1>

<form method="post" action="">
    <input class="btn" type="submit" name="styleChoice" value="Style 1" /> &nbsp; &nbsp;
    <input class="btn" type="submit" name="styleChoice" value="Style 2" /> &nbsp; &nbsp;
    <input class="btn" type="submit" name="styleChoice" value="Style 3" />
</form>

<br />
