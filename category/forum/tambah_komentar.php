<?php

$id_forum = $_POST['id_forum'];
$nama = $_POST['nama'];
$comment = $_POST['comment'];

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"https://dev-sekolahdasar.herokuapp.com/api/v1/user/forum/comment/$id_forum");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
            "name=$nama&comment=$comment");

// In real life you should use something like:
// curl_setopt($ch, CURLOPT_POSTFIELDS, 
//          http_build_query(array('postvar1' => 'value1')));

// Receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec($ch);

curl_close ($ch);

header("location:detail_forum.php?id_forum=$id_forum");

?>