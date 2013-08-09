<?php

$link = mysql_connect ("203.33.121.41", "battles_stats", "")
    or die('Could not connect: ' . mysql_error());

mysql_select_db ("battle", $link) or die('could not select database');

$query_kills = "SELECT COUNT(*) FROM stats WHERE pvp='true'";
$kills = mysql_fetch_assoc(mysql_query($query_kills, $link))['COUNT(*)'];

$query_deaths = "SELECT COUNT(*) FROM stats";
$deaths = mysql_fetch_assoc(mysql_query($query_deaths, $link))['COUNT(*)'];

mysql_close($link);
?>

<html>
<head>
    <title>OresomeCraft Battles online stats</title>
</head>
<style type="text/css">
    .boxdiv {
        margin: 5px;
        padding: 5px;
        width: 60%;
        position: fixed;
        left: 20%;
        border: 2px solid #4D686F;
        background-color: #E6E6E6;
        border-radius: 8px;
    }
    .statsbox {
        margin: 5px;
        padding: 5px;
        width: 45%;
        position: fixed;
        border: 2px solid #4D686F;
        border-radius: 8px;
    }
</style>
<body>

<form action="statistics.php" method="get">
    <p style="text-align: center;">
        <strong><span style="font-size:48px;"><span style="font-family: arial, helvetica, sans-serif;">OresomeCraft Battles Statistics</span></span></strong></p>
    <p style="text-align: center;">&nbsp;
    </p>
    <div class="boxdiv">
        <p style="text-align: center;">
            <strong><span style="font-size:32px;"><span style="font-family: arial, helvetica, sans-serif;">Search statistics for a user:</span></span></strong></p>
        <p style="text-align: center;">&nbsp;
            <span style="font-family:arial,helvetica,sans-serif;"><strong><span style="font-size: 20px;">Username: </span></strong></span><input name="name" type="text" /><span style="font-size:28px;"> </span><input type="submit" />
        </p>
    </div>
</form>

<br><br><br><br><br><br><br><br>

<div class="statsbox" style="right: 2%; background-color: #0000FF;">
    <p style="text-align: center;">
        <strong><span style="font-size:30px;"><span style="font-family: arial, helvetica, sans-serif;">Total Server Deaths:</span></span></strong></p>
    <p style="text-align: center;">&nbsp;
        <span style="font-family:arial,helvetica,sans-serif;"><strong><span style="font-size: 26px;"><?php echo $deaths ?></span></strong></span></p>

</div>

<div class="statsbox" style="left: 2%; background-color: #FF0000;">
    <p style="text-align: center;">
        <strong><span style="font-size:30px;"><span style="font-family: arial, helvetica, sans-serif;">Total Server Kills:</span></span></strong></p>
    <p style="text-align: center;">&nbsp;
        <span style="font-family:arial,helvetica,sans-serif;"><strong><span style="font-size: 26px;"><?php echo $kills ?></span></strong></span></p>

</div>

</body>
</html>