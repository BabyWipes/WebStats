<?php

$link = mysql_connect ("host", "user", "password")
                   or die('Could not connect: ' . mysql_error());
				   
				   mysql_select_db ("database", $link) or die('could not select database'); 
				   
				   $username = $_GET["name"];
				   
				    $fullname = "SELECT name FROM `oresomebattles` WHERE name='$username'";
					 $fullname_result = mysql_query($fullname)or die('query failed'. mysql_error());
				   $realname = mysql_fetch_assoc($fullname_result);
                    $final_fullname = $realname['name'];
                    
		if (mysql_num_rows($fullname_result) === 0) { ?>


    <html>
    
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
				<strong><span style="font-size:24px;"><span style="font-family: arial, helvetica, sans-serif;">Sorry, that user wasn't found in the database! Please search for an existing user below:</span></span></strong></p>
			<p style="text-align: center;">&nbsp;
				</p>
			<p style="text-align: center;">
				<span style="font-family:arial,helvetica,sans-serif;"><strong><span style="font-size: 20px;">Username: </span></strong></span><input name="name" type="text" /><span style="font-size:28px;"> </span><input type="submit" /></p>
			<p style="text-align: center;">&nbsp;
				</p>
    
    </div>
    
    
    </html>

				 <? 
				 die();
				 } else { 
				   
				   $kills = "SELECT kills FROM `oresomebattles` WHERE name='$final_fullname'";
				   $deaths = "SELECT deaths FROM `oresomebattles` WHERE name='$final_fullname'";
				   $ffawins = "SELECT ffawins FROM `oresomebattles` WHERE name='$final_fullname'";
			
	$kills_result = mysql_query($kills)or die('query failed'. mysql_error());			   
 $deaths_result = mysql_query($deaths)or die('query failed'. mysql_error());		   
 $ffawins_result = mysql_query($ffawins)or die('query failed'. mysql_error());
 
$row = mysql_fetch_assoc($kills_result);
$final_kills = $row['kills'];

$row = mysql_fetch_assoc($deaths_result);
$final_deaths = $row['deaths'];

$row = mysql_fetch_assoc($ffawins_result);
$final_ffawins = $row['ffawins'];

mysql_close ($link);

  }
				
	
?>

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
<em><strong><span style="font-family: arial, helvetica, sans-serif; font-size: 72px; text-align: center;"> <?php echo $final_fullname ?> </span></span></strong></em></p>
<p style="text-align: center;">

<img src="https://minotar.net/avatar/<?php echo $final_fullname?>/200">

<p style="text-align: center;">
<strong><span style="font-size:36px;"><span style="font-family: arial, helvetica, sans-serif;"> Kills: </span></span></strong><span style="font-size:36px;"><span style="font-family: arial, helvetica, sans-serif;"> <?php echo $final_kills ?> </span></span></p>

<p style="text-align: center;">
<strong><span style="font-size:36px;"><span style="font-family: arial, helvetica, sans-serif;">Deaths: </span></span></strong> <span style="font-size:36px;"><span style="font-family: arial, helvetica, sans-serif;"> <?php echo $final_deaths ?> </span></span></p>

<p style="text-align: center;">
<strong><span style="font-size:36px;"><span style="font-family: arial, helvetica, sans-serif;">Kill / Death ratio: </span></span></strong>  <span style="font-size:36px;"><span style="font-family: arial, helvetica, sans-serif;"><?php 

if ($final_kills / $final_deaths === 0 OR $final_kills / $final_deaths < 0 AND $final_deaths === 0) {
	echo $final_kills;

	
} else {

$kdr = $final_kills / $final_deaths;
$formatted_kdr = round($kdr,2);

echo $formatted_kdr;
}
				?> 

</span></span></p>


<p style="text-align: center;">
<strong><span style="font-size:36px;"><span style="font-family: arial, helvetica, sans-serif;">Free for alls won: </span></span></strong> <span style="font-size:36px;"><span style="font-family: arial, helvetica, sans-serif;"> <?php echo $final_ffawins ?> </span></span></p>


<form>
<p style="text-align: center;">
 <input type=button value="Refresh" onClick="window.location.reload()"></form>

<form action="statistics.php" method="get">
			
				</p>
			<p style="text-align: center;">
				<span style="font-family:arial,helvetica,sans-serif;"><strong><em><span style="font-size: 24px;">Search another user: </span></em></strong></span><input name="name" type="text" /><span style="font-size:28px;"> </span><input type="submit" /></p>
				  </div>
				
				</html>
