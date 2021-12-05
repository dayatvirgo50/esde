<?php

$title = $_POST['title'];
$nama = $_POST['nama'];
$content = $_POST['content'];

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"https://dev-sekolahdasar.herokuapp.com/api/v1/user/forum/add");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
            "title=$title&created_by=$nama&content=$content");

// In real life you should use something like:
// curl_setopt($ch, CURLOPT_POSTFIELDS, 
//          http_build_query(array('postvar1' => 'value1')));

// Receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec($ch);

curl_close ($ch);

header('location:forum.php');

?>