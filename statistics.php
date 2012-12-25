
<?php

$link = mysql_connect ("Host", "User", "Password")
                   or die('Could not connect: ' . mysql_error());
				   
				   mysql_select_db ("oresomec_battle", $link) or die('could not select database'); 
				   
				   $username = $_GET["name"];
				   
				   $kills = "SELECT kills FROM `oresomebattles` WHERE name='$username'";
				   $deaths = "SELECT deaths FROM `oresomebattles` WHERE name='$username'";
				
	
	$kills_result = mysql_query($kills)or die('query failed'. mysql_error());			   
 $deaths_result = mysql_query($deaths)or die('query failed'. mysql_error());
 
$row = mysql_fetch_assoc($kills_result);
$final_kills = $row['kills'];

$row = mysql_fetch_assoc($deaths_result);
$final_deaths = $row['deaths'];

///$kd = final_kills /final_deaths;

mysql_close ($link);


 
?>

<html>

<p style="text-align: center;">
<em><strong><span style="font-family: arial, helvetica, sans-serif; font-size: 72px; text-align: center;"> <?php echo $username ?> </span></span></strong></em></p>
<p style="text-align: center;">
<img src="https://minotar.net/avatar/<?php echo $username?>/200">

<p style="text-align: center;">
<strong><span style="font-size:36px;"><span style="font-family: arial, helvetica, sans-serif;"> Kills: </span></span></strong><span style="font-size:36px;"><span style="font-family: arial, helvetica, sans-serif;"> <?php echo $final_kills ?> </span></span></p>

<p style="text-align: center;">
<strong><span style="font-size:36px;"><span style="font-family: arial, helvetica, sans-serif;">Deaths: </span></span></strong> <span style="font-size:36px;"><span style="font-family: arial, helvetica, sans-serif;"> <?php echo $final_deaths ?> </span></span></p>

<p style="text-align: center;">
<strong><span style="font-size:36px;"><span style="font-family: arial, helvetica, sans-serif;">Kill / Death ratio: </span></span></strong>  <span style="font-size:36px;"><span style="font-family: arial, helvetica, sans-serif;"><?php echo $final_kills / $final_deaths?> </span></span></p>
<br>
<br>
<br>
<p style="text-align: center;">
	<span style="font-size:48px;"><a href="http://oresomecraft.com/stats.php"><span style="font-family: arial, helvetica, sans-serif;">Home</span></a></span></p>

</html>
