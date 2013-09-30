<?php
    try {
        $db = new PDO('mysql:host=203.33.121.41;dbname=battle', 'battle_stats', '');
    } catch (PDOException $e) {
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

    $total_server_kills = $db->query('SELECT COUNT(*) FROM `stats` WHERE `pvp` = \'true\';')->fetchAll();
    $total_server_deaths = $db->query('SELECT COUNT(*) FROM `stats`;')->fetchAll();

    $server_stats = array('kills' => $total_server_kills[0]['COUNT(*)'], 'deaths' => $total_server_deaths[0]['COUNT(*)']);

    if (isset($user[0])) {
        echo json_encode(array(
            'user_exists' => true, 
            'stats' => array(
                'username' => $user[0]['name'],
                'kills' => $kills[0]['COUNT(*)'], 
                'deaths' => $deaths[0]['COUNT(*)'], 
                'ffa_wins' => $ffawins[0]['COUNT(*)'], 
                'infection_wins' => $infectionwins[0]['COUNT(*)'],
                'games_played' => $gamesplayed[0]['COUNT(*)'],
                'gamemode_stats' => array(
                    'TDM' => array(
                        'kills' => $db->query('SELECT COUNT(*) FROM `stats` WHERE `gamemode` = \'TDM\' AND `killer` = \''.$username.'\';')->fetchAll()[0]['COUNT(*)'],
                        'deaths' => $db->query('SELECT COUNT(*) FROM `stats` WHERE `gamemode` = \'TDM\' AND `killed` = \''.$username.'\';')->fetchAll()[0]['COUNT(*)']
                        ),
                    'FFA' => array(
                        'kills' => $db->query('SELECT COUNT(*) FROM `stats` WHERE `gamemode` = \'FFA\' AND `killer` = \''.$username.'\';')->fetchAll()[0]['COUNT(*)'],
                        'deaths' => $db->query('SELECT COUNT(*) FROM `stats` WHERE `gamemode` = \'FFA\' AND `killed` = \''.$username.'\';')->fetchAll()[0]['COUNT(*)']
                        ),
                    'INFECTION' => array(
                        'kills' => $db->query('SELECT COUNT(*) FROM `stats` WHERE `gamemode` = \'INFECTION\' AND `killer` = \''.$username.'\';')->fetchAll()[0]['COUNT(*)'],
                        'deaths' => $db->query('SELECT COUNT(*) FROM `stats` WHERE `gamemode` = \'INFECTION\' AND `killed` = \''.$username.'\';')->fetchAll()[0]['COUNT(*)']
                        ),
                    'CTF' => array(
                        'kills' => $db->query('SELECT COUNT(*) FROM `stats` WHERE `gamemode` = \'CTF\' AND `killer` = \''.$username.'\';')->fetchAll()[0]['COUNT(*)'],
                        'deaths' => $db->query('SELECT COUNT(*) FROM `stats` WHERE `gamemode` = \'CTF\' AND `killed` = \''.$username.'\';')->fetchAll()[0]['COUNT(*)']
                        ),
                    'KOTH' => array(
                        'kills' => $db->query('SELECT COUNT(*) FROM `stats` WHERE `gamemode` = \'KOTH\' AND `killer` = \''.$username.'\';')->fetchAll()[0]['COUNT(*)'],
                        'deaths' => $db->query('SELECT COUNT(*) FROM `stats` WHERE `gamemode` = \'KOTH\' AND `killed` = \''.$username.'\';')->fetchAll()[0]['COUNT(*)']
                        ),
                    'LMS' => array(
                        'kills' => $db->query('SELECT COUNT(*) FROM `stats` WHERE `gamemode` = \'LMS\' AND `killer` = \''.$username.'\';')->fetchAll()[0]['COUNT(*)'],
                        'deaths' => $db->query('SELECT COUNT(*) FROM `stats` WHERE `gamemode` = \'LMS\' AND `killed` = \''.$username.'\';')->fetchAll()[0]['COUNT(*)']
                        ),
                    'CP' => array(
                        'kills' => $db->query('SELECT COUNT(*) FROM `stats` WHERE `gamemode` = \'CP\' AND `killer` = \''.$username.'\';')->fetchAll()[0]['COUNT(*)'],
                        'deaths' => $db->query('SELECT COUNT(*) FROM `stats` WHERE `gamemode` = \'CP\' AND `killed` = \''.$username.'\';')->fetchAll()[0]['COUNT(*)']
                        )
                    )
            ),
            'total_server_stats' => $server_stats
        ), JSON_PRETTY_PRINT);
    } else {
        echo json_encode(array(
            'user_exists' => false,
            'total_server_stats' => $server_stats
        ), JSON_PRETTY_PRINT);
    }
?>