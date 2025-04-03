<?php

include($_SERVER['DOCUMENT_ROOT'] . '/project/vendor/config.php');

$sql = "SELECT `id`, `email`, `password`,`UserName` FROM `registration` WHERE `email` = 'ly453145@gmail.com'";
$query = mysqli_query($conn, $sql);
$DataROW = mysqli_fetch_assoc($query);

echo '<pre>';
print_r($DataROW);
echo '</pre>';

$password = md5(12345678);



echo '<br>' . $DataROW['password'];
echo '<br>' . $password;