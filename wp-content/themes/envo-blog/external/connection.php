<?php

$host = 'localhost';
$db   = 'awesome_external';
$user = 'root';
$pass = 'root';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];


$tries = 20;
while($tries)
{
    try
    {
        $pdo = new PDO($dsn, $user, $pass, $options);
        break;
    }
    catch (\PDOException $e)
    {
        sleep(1);
        $tries--;
    }
}
if(!$tries)
{
    $_SESSION['recursion'] = true;

    $_SESSION['FAILS']['message'] = 'At this moment the server refuses to respond; perhaps it is busy doing something else. But be perseverant and try again later!';
    wp_redirect(get_site_url() . '/fail/');
    die();
}


function db_query($query, $args, $error_message = "Something didn't go as smoothly as supposed to!", $attempts=5)
{

    if (( $attempts <= 0 ))
        return false;

    global $pdo;

    // Query nu are cum sa fie rau. Singura exceptie este conexiunea
    while( $attempts )
    {
        try
        {
            $stmt = $pdo->prepare($query);
            $stmt->execute($args);
            return $stmt;
        }
        catch(\PDOException $e)
        {
            $attempts--;
            sleep(1);
        }
    }
    if(!$attempts)
    {
        $_SESSION['FAILS']['message'] = $error_message;
        $_SESSION['FAILS']['exception'] = $e->getMessage();
        wp_redirect(get_site_url() . '/fail/');
        return null;
    }
}


function db_transaction($queries, $args, $error_message = "Oh boy! there we go again..", $attempts=8)
{
    if (( $attempts <= 0 ) || !is_array($queries))
        return false;

    global $pdo;

    while( $attempts )
    {
        try
        {
            $pdo->beginTransaction();

            for($i = 0; $i < sizeof($queries); $i++)
            {
                $stmt = $pdo->prepare($queries[$i]);
                $stmt->execute($args[$i]);
            }

            $pdo->commit();
            return true;
        }
        catch(\PDOException $e)
        {
            $attempts--;
            $pdo->rollBack();
            sleep(1);
        }
    }
    if(!$attempts)
    {
        $_SESSION['FAILS']['message'] = $error_message;
        $_SESSION['FAILS']['exception'] = $e->getMessage();
        wp_redirect(get_site_url() . '/fail/');
        return null;
    }
}
