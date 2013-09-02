<?php
$username = $_REQUEST["name"];
$decode = json_decode(file_get_contents('http://oresomecraft.net/battleapi.php?name=' . $username), true);

if ($decode['user_exists'] == false) {
    printNoUser();
} else {
    printPage($decode['stats']['username'], $decode['stats']['kills'], $decode['stats']['deaths'],
        $decode['stats']['ffa_wins'], $decode['stats']['infection_wins'], $decode['stats']['games_played']);
}

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
    <title>OresomeCraft Battles stats</title>
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
    <title>User not found!</title>
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
