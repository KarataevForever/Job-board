<?php

$title = $_GET['title'];
$name = $_POST['name'] ?? "Unknown";
$email = $_POST['email'] ?? "Email";
$portfolio = $_POST['portfolio'];
$letter = $_POST['coverletter'];

mail("job@jobboard.com", "{$title}", "Заявка принята");
header('Location: /');