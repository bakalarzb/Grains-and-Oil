<?php

require_once '../db_config.php'; // Include the database connection

if (!function_exists('addSubscriber')) {
    function addSubscriber($email) {

        $pdo = Database::getConnection();

        try{

            // Check if email exists already
            $stmt = $pdo -> prepare('SELECT * FROM subscribers WHERE subscriber_email = ?');
            $stmt -> execute([ $email ]);
            if ($stmt -> fetch(PDO::FETCH_ASSOC)) {
                return('Already subscribed!');
            }

            // Insert email into database
            $stmt = $pdo -> prepare('INSERT INTO subscribers (subscriber_email) VALUES (?)');
            $stmt -> execute([ $email]);

            return 'Subscribed!';

        }catch (Exception $e) {
            return 'Subscription failed!';
        }

    }

}

?>