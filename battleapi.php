<?php
    try {
        $db = new PDO('mysql:host=203.33.121.41;dbname=battle', 'battles_stats', '');
    } catch(PDOException $e) {
        echo 'Something went wrong! '.$e->getMessage();
        die();
    }
 
    $username = $_REQUEST['name'];
 
    $user = $db->query('SELECT `name` FROM `UserInfo` WHERE `name` = \''.$username.'\';')->fetchAll();
    $kills = $db->query('SELECT COUNT(*) FROM `stats` WHERE `killer` = \''.$username.'\';')->fetchAll();
    $deaths = $db->query('SELECT COUNT(*) FROM `stats` WHERE `killed` = \''.$username.'\';')->fetchAll();
    $ffawins = $db->query('SELECT COUNT(*) FROM `FFAWins` WHERE `winner` = \''.$username.'\';')->fetchAll();
    $infectionwins = $db->query('SELECT COUNT(*) FROM `InfectionWins` WHERE `winner` = \''.$username.'\';')->fetchAll();
    $gamesplayed = $db->query('SELECT COUNT(*) FROM `GamesPlayed` WHERE `name` = \''.$username.'\';')->fetchAll();

    if (isset($user[0])) {
        echo json_encode(array(
            'error' => false, 
            'stats' => array(
                'username' => $user[0]['name'],
                'kills' => $kills[0]['COUNT(*)'], 
                'deaths' => $deaths[0]['COUNT(*)'], 
                'ffa_wins' => $ffawins[0]['COUNT(*)'], 
                'infection_wins' => $infectionwins[0]['COUNT(*)'],
                'games_played' => $gamesplayed[0]['COUNT(*)']
            )
        ));
    } else {
        echo json_encode(array(
            'error' => true
        ));
    }
?>