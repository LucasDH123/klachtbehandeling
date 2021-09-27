<?php
use PHPMailer\PHPMailer\PHPMailer;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
?>
<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        form {
            text-align: center;
            align-content: center;
        }


    </style>
    <title>klachten form</title>
</head>
<body>
<form action="" method="post">
    <label for="naam">Naam:</label>
    <input type="text" id="naam" name="naam" placeholder="vul je naam in"><br>
    <label for="email">Email</label>
    <input type="email" id="email" name="email" placeholder="vul je email in"><br>
    <label for="onderwerp">Onderwerp</label>
    <input type="text" id="onderwerp" name="onderwerp" placeholder="onderwerp"><br>
    <p>Je klacht</p>
    <textarea name="klacht" id="klacht" rows="4"></textarea><br>
    <input type="submit" value="submit">


</form>
</body>
</html>
<?php
require '../vendor/autoload.php';
if (isset($_POST['email'])) {

    $email = $_POST['email'];
    $naam = $_POST['naam'];
    $onderwerp = $_POST['onderwerp'];
    $klacht = $_POST['klacht'];

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.mailtrap.io';
    $mail->Subject = $onderwerp;
    $mail->SMTPAuth = true;
    $mail->Port = 2525;
    $mail->Username = 'aae80984fe9b5f';
    $mail->Password = '00e8685ea1b58e';
    $mail->isHTML(true);
    $mail->body = $klacht ;
    $mail->AltBody = "Dit is de standaard body.";
    $mail->From = "Lucasdh2003@gmail.com";
    $mail->FromName = "LDH-support";
    try {
        $mail->addReplyTo("Lucasdh2003@gmail.com");
    } catch (\PHPMailer\PHPMailer\Exception $e) {

    }
    $mail->msgHTML($klacht);
    $mail->addAddress($email);
    $mail->AddCC("40188047@roctilburg.nl");
    if (!$mail->send()) {
        echo "mailer Error: " . $mail->ErrorInfo;
    } else {
        echo "Mail is gestuurd!";
    }
}

$mail->isHTML(true);
$mail->subject = $onderwerp;

// create a log channel
$log = new Logger('name');
$log->pushHandler(new StreamHandler('path/to/your.log', Logger::WARNING));

// add records to the log
$log->warning($naam. " ". $klacht);
// echo "message has been sent";

    ?>