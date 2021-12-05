<?php
session_start();

date_default_timezone_set('Asia/Jakarta');
$nama = $_SESSION['nama'];
$id_forum = $_GET['id_forum'];
function http_request($url)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_CUSTOMREQUEST => "GET",
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    // Decode the response from the API

    $decoded_response_object = json_decode($response, TRUE);
    if ($decoded_response_object['success']) {
        return $decoded_response_object['success'];
    } else {
        return 0;
    }
}


$data = http_request('https://dev-sekolahdasar.herokuapp.com/api/v1/user/forum/get/' . $id_forum);
$data_komen = http_request('https://dev-sekolahdasar.herokuapp.com/api/v1/user/forum/comment/' . $id_forum);
if ($data == 0) {
    header("Refresh:0; url=forum.php");
}
if ($data_komen == 0) {
    header("Refresh:0; url=forum.php");
}
// $data = $data[0];

$date = date('d F Y', strtotime($data['date']));

$data_komen = $data_komen['list_comment'];

?>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css" />
    <title><?= $data['title'] ?></title>
</head>

<body class="bg-pendidikan">
    <div class="detail-forum-card-container">
        <div class="forum-card-item">
            <div class="header-detail-forum">
                <div class="header-detail-forum-item">
                    <img src='../../assets/img/star.png' style="width: 50px;border-radius:120px;border:1px solid #000" />
                </div>
                <div class="header-detail-forum-item">
                    <div style="flex-direction:row">
                        <h3><?= $data['created_by'] ?></h3><small style="font-size: x-smaller;"><?= $date ?></small>
                    </div>
                    <p>Forum Diskusi</p>
                </div>
                <div style="width:70%;word-wrap:break-word">

                    <h1><?= $data['title'] ?></h1>
                </div>
            </div>
            <div class="content-detail-forum">
                <p>
                    <?= $data['content'] ?>
                </p>
            </div>
        </div>
    </div>

    <!-- List Komentar -->
    <?php

    foreach ($data_komen as $komen) {
    ?>
        <div class="detail-forum-card-container">
            <div class="forum-card-item">
                <div class="header-detail-forum">
                    <div class="header-detail-forum-item">
                        <img src='../../assets/img/star.png' style="width: 50px;border-radius:120px;border:1px solid #000" />
                    </div>
                    <div class="header-detail-forum-item">
                        <div style="flex-direction:row">
                            <h3><?= $komen['name'] ?></h3><small style="font-size: x-smaller;"><?= $komen['date'] ?></small>
                        </div>
                        <p>Balas Forum Diskusi</p>
                    </div>
                </div>
                <div class="content-detail-forum">
                    <p>
                        <?= $komen['comment'] ?>
                    </p>
                </div>
            </div>
        </div>
    <?php
    }
    ?>

    <div class="detail-forum-card-container">
        <div class="forum-card-item">
            <form method="POST" action="tambah_komentar.php">
                <input type="hidden" name="id_forum" value="<?= $id_forum ?>"/>
                <input type="hidden" name="nama" value="<?= $nama ?>"/>
                <div class="header-detail-forum">
                    <div class="header-detail-forum-item">
                        <img src='../../assets/img/star.png' style="width: 50px;border-radius:120px;border:1px solid #000" />
                    </div>
                    <div class="header-detail-forum-item">
                        <div style="flex-direction:row">
                            <h3>Kamu Login Sebagai <?= $nama ?></h3>
                        </div>
                        <p>Balas Forum Diskusi</p>
                    </div>
                </div>
                <div class="content-detail-forum">
                    <textarea placeholder="Apa tanggapan kamu ??" rows="5" style="width: 100%;" class="input" name="comment"></textarea>
                    <button class="btn btn-direct" style="align-self:flex-end;margin: 15px 5px" type="submit">Kirim Tanggapan</button>
                </div>
            </form>
        </div>
    </div>
    <button class="btn btn-direct" style="position: absolute;top:30;left:25" onclick="window.location='./forum.php'">
        < Kembali ke Forum</button>



</body>

</html>