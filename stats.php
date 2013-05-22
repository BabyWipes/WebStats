<?php

$link = mysql_connect ("203.33.121.41", "battles_stats", "")
    or die('Could not connect: ' . mysql_error());

mysql_select_db ("battle", $link) or die('could not select database');

$totaldeaths = "SELECT SUM(deaths) as req_value FROM oresomebattles";
$totaldeaths_results = mysql_query($totaldeaths)or die('query failed'. mysql_error());

$row = mysql_fetch_assoc($totaldeaths_results);
$final_deaths = $row['req_value'];

$totalkills = "SELECT SUM(kills) as req_value FROM oresomebattles";
$totalkills_results = mysql_query($totalkills)or die('query failed'. mysql_error());

$row1 = mysql_fetch_assoc($totalkills_results);
$final_kills = $row1['req_value'];
mysql_close ($link);

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
    .tdeathsdiv {
        margin: 5px;
        padding: 5px;
        width: 45%;
        position: fixed;
        right: 2%;
        border: 2px solid #4D686F;
        background-color: #0000FF;
        border-radius: 8px;
    }
    .tkillsdiv {
        margin: 5px;
        padding: 5px;
        width: 45%;
        position: fixed;
        left: 2%;
        border: 2px solid #4D686F;
        background-color: #FF0000;
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
<div class="tdeathsdiv">
    <p style="text-align: center;">
        <strong><span style="font-size:30px;"><span style="font-family: arial, helvetica, sans-serif;">Total Server Deaths:</span></span></strong></p>
    <p style="text-align: center;">&nbsp;
        <span style="font-family:arial,helvetica,sans-serif;"><strong><span style="font-size: 26px;"><?php echo $final_deaths ?></span></strong></span></p>

</div>

<div class="tkillsdiv">
    <p style="text-align: center;">
        <strong><span style="font-size:30px;"><span style="font-family: arial, helvetica, sans-serif;">Total Server Kills:</span></span></strong></p>
    <p style="text-align: center;">&nbsp;
        <span style="font-family:arial,helvetica,sans-serif;"><strong><span style="font-size: 26px;"><?php echo $final_kills ?></span></strong></span></p>

</div>

</body>
</html>