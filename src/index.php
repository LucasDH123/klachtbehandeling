<?php
use PHPMailer\PHPMailer\PHPMailer;
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
    $mail->From = "Lucasdh2003@gmail.com";
    $mail->FromName = "LDH-support";
    $mail->msgHTML($klacht);
    $mail->addAddress($email);
    $mail->AddCC("40188047@roctilburg.nl");
    if (!$mail->send()) {
        echo "mailer Error: " . $mail->ErrorInfo;
    } else {
        echo "Mail is gestuurd!";
    }
}

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('info.log');
$log->pushHandler(new StreamHandler('C:\Users\lucas\Documents\GitHub\klachtbehandeling', Logger::WARNING));

// add records to the log
$log->warning('Foo');
$log->error('Bar');



?>