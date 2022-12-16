<?php

$title = $_POST['title'];
$name = $_POST['name'] ?? "Unknown";
$email = $_POST['email'] ?? "Email";
$portfolio = $_POST['portfolio'];
$letter = $_POST['coverletter'];
var_dump($title);
mail("job@jobboard.com", "{$title}", "{$name}\n{$email}\n{$portfolio}\n{$letter}");
header('Location: /');