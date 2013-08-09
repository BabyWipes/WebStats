<?php

$link = mysql_connect("203.33.121.41", "battles_stats", "");

mysql_select_db("battle", $link) or die('could not select database');

$username = $_GET["name"];
$fullname = "SELECT name FROM `UserInfo` WHERE name='$username'";
$fullname_result = mysql_query($fullname)or die('query failed' . mysql_error());
$realname = mysql_fetch_assoc($fullname_result);
$final_fullname = $realname['name'];

if (mysql_num_rows($fullname_result) === 0) {
    printNoUser();
    die();
}

// Queries
$query_kills = "SELECT COUNT(*) FROM stats WHERE killer='$final_fullname'";
$query_deaths = "SELECT COUNT(*) FROM stats WHERE killed='$final_fullname'";
$query_ffa_wins = "SELECT COUNT(*) FROM `FFAWins` WHERE winner='$final_fullname'";
$query_infection_wins = "SELECT COUNT(*) FROM `InfectionWins` WHERE winner='$final_fullname'";
$query_games_played = "SELECT COUNT(*) FROM `GamesPlayed` WHERE name='$final_fullname'";

$kills = mysql_fetch_assoc(mysql_query($query_kills, $link))['COUNT(*)'];
$deaths = mysql_fetch_assoc(mysql_query($query_deaths, $link))['COUNT(*)'];
$ffa_wins = mysql_fetch_assoc(mysql_query($query_ffa_wins, $link))['COUNT(*)'];
$infection_wins = mysql_fetch_assoc(mysql_query($query_infection_wins, $link))['COUNT(*)'];
$games_played = mysql_fetch_assoc(mysql_query($query_games_played, $link))['COUNT(*)'];

printPage($final_fullname, $kills, $deaths, $ffa_wins, $infection_wins, $games_played);
mysql_close($link);

function calculateKD($kills, $deaths)
{
    if ($kills / $deaths === 0 OR $kills / $deaths < 0 AND $deaths === 0) {
        return $kills;

    } else {

        $kdr = $kills / $deaths;
        $formatted_kdr = round($kdr, 2);

        return $formatted_kdr;
    }
}

function printPage($name, $kills, $deaths, $ffa_wins, $infection_wins, $games_played)
{
    echo '
    <html>
    <style type="text/css">

    .boxdiv {
        margin: 5px;
        padding: 5px;
        width: 65%;
        position: fixed;
        left: 15%;
        border: 2px solid #4D686F;
        background-color: #E6E6E6;
        border-radius: 8px;
    }
</style>

<div class="boxdiv">
    <p style="text-align: center;">
        <em><strong><span
                    style="font-family: arial, helvetica, sans-serif; font-size: 72px; text-align: center;"> ' . $name . ' </span></span>
            </strong></em></p>

    <p style="text-align: center;">

        <img src="https://minotar.net/avatar/' . $name . '/200">

    <p style="text-align: center;">
        <strong><span style="font-size:28px;"><span
                    style="font-family: arial, helvetica, sans-serif;"> Kills: </span></span></strong><span
            style="font-size:28px;"><span
                style="font-family: arial, helvetica, sans-serif;">' . $kills . '</span></span></p>

    <p style="text-align: center;">
        <strong><span style="font-size:28px;"><span
                    style="font-family: arial, helvetica, sans-serif;">Deaths: </span></span></strong> <span
            style="font-size:28px;"><span
                style="font-family: arial, helvetica, sans-serif;">' . $deaths . '</span></span></p>

    <p style="text-align: center;">
        <strong><span style="font-size:28px;"><span style="font-family: arial, helvetica, sans-serif;">Kill / Death ratio: </span></span></strong>  <span
            style="font-size:28px;"><span style="font-family: arial, helvetica, sans-serif;">'. calculateKD($kills, $deaths) .'</span></span></p>

    <p style="text-align: center;">
        <strong><span style="font-size:28px;"><span style="font-family: arial, helvetica, sans-serif;">Free for alls won: </span></span></strong>
        <span style="font-size:28px;"><span
                style="font-family: arial, helvetica, sans-serif;"> ' . $ffa_wins . ' </span></span></p>

     <p style="text-align: center;">
        <strong><span style="font-size:28px;"><span style="font-family: arial, helvetica, sans-serif;">Infection games won: </span></span></strong>
        <span style="font-size:28px;"><span
                style="font-family: arial, helvetica, sans-serif;"> ' . $infection_wins . ' </span></span></p>

     <p style="text-align: center;">
        <strong><span style="font-size:28px;"><span style="font-family: arial, helvetica, sans-serif;">Games played: </span></span></strong>
        <span style="font-size:28px;"><span
                style="font-family: arial, helvetica, sans-serif;"> ' . $games_played . ' </span></span></p>

    <form>
        <p style="text-align: center;">
            <input type=button value="Refresh" onClick="window.location.reload()"></form>

    <form action="statistics.php" method="get">

        <p style="text-align: center;">
            <span style="font-family:arial,helvetica,sans-serif;"><strong><em><span style="font-size: 24px;">Search another user: </span></em></strong></span><input
                name="name" type="text"/><span style="font-size:28px;"> </span><input type="submit"/></p>
    </form>

</html>

';

}

function printNoUser()
{
    echo '
    <style type="text/css">

    .boxdiv {
        margin: 5px;
        padding: 5px;
        width: 45%;
        position: fixed;
        left: 25%;
        border: 2px solid #4D686F;
        background-color: #E6E6E6;
        border-radius: 8px;
    }
    </style>

        <br>
    <div class="boxdiv">
        <form action="statistics.php" method="get">
            <p style="text-align: center;">
                <strong><span style="font-size:24px;"><span style="font-family: arial, helvetica, san-serif;">Sorry, that user wasn\'t found in the database! Please search for an existing user below:</span></span></strong></p>
            <p style="text-align: center;">&nbsp;
            </p>
            <p style="text-align: center;">
                <span style="font-family:arial,helvetica,sans-serif;"><strong><span style="font-size: 20px;">Username: </span></strong></span><input name="name" type="text"/><span style="font-size:28px;"> </span><input type="submit" /></p>
            <p style="text - align: center;">&nbsp;
            </p>

    </div>

    </html>
    ';
}

?>
