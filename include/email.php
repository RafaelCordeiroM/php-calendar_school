<?php include "db.php" ?>
<?php
require "../vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
?>
<?php

//////////////// mail config /////////////////////
$mail = new PHPMailer();
//Server settings
$mail->isSMTP();
$mail->SMTPDebug  = 1;
$mail->Host       = Config::SMTP_HOST;
$mail->Port       = Config::SMTP_PORT;
$mail->SMTPAuth   = true;
$mail->Username   = Config::SMTP_USER;
$mail->Password   = Config::SMTP_PASSWORD;
$mail->SMTPSecure = 'tls';
$mail->isHTML(true);
$mail->CharSet    = 'UTF-8';
$mail->setFrom('rafaelYMG0@gmail.com', "Rafael Cordeiro Martins");
/////////////////////////////////////////////

////////////////////////////////////// event //////////////////////
if (isset($_GET["id"]) && isset($_GET["participants"])) {
    $string =  $_GET['participants'];
    $string = trim(preg_replace('!\s+!', ' ', $string));
    $array_of_participants = explode(" ", $string);
    $id = $_GET["id"];


    if (isset($_GET["route"]) && $_GET["route"] == "event") {


        $query = "SELECT * from agenda WHERE agenda_id = '{$id}'";
        $query = mysqli_query($connection, $query);
        $array_event = mysqli_fetch_assoc($query);

        $date = date_create($array_event["agenda_date"]);
        $date = date_format($date, "d-m-Y");
        $hour = date_create($array_event["agenda_hour"]);
        $hour = date_format($hour, "H:i");

        $mail->Subject    = $array_event["agenda_title"];
        $mail->Body       = "data:" . $date . " as " . $hour . " horas" . "\n" . $array_event["agenda_description"];

        for ($i = 0; $i < count($array_of_participants); $i++) {
            $participants = $array_of_participants[$i];
            $query = "SELECT user_email from users WHERE user_class = '{$participants}'";
            $array = mysqli_query($connection, $query);

            if (mysqli_num_rows($array) > 0) {
                while ($row = mysqli_fetch_assoc($array)) {
                    $email = $row["user_email"];
                    $mail->addAddress($email);
                }
            }
        }
    }
}

////////////////////////////////////// notifications //////////////////////
if (isset($_GET["route"]) && $_GET["route"] == "notification") {
    $id = $_GET["id"];
    $query = "SELECT * from notifications WHERE not_id = '{$id}'";
    $query = mysqli_query($connection, $query);
    $array_not = mysqli_fetch_assoc($query);

    $query = "SELECT user_email from users";
    $query = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($query)) {
        $mail->addAddress($row["user_email"]);
    }
    $mail->Subject    = $array_not["not_title"];
    $mail->Body       = $array_not["not_description"];
    
}


if ($mail->send()) {
    header("location:../admin.php");
} 
else {
    die("<script>alert('Ocorreu um error')</script>");
    }

?>