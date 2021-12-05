<?php
session_start();
if(isset($_POST['nama'])){

    $_SESSION['nama'] = $_POST['nama'];
} if(isset($_SESSION['nama'])){
    
} else {
    $_SESSION['nama'] = 'Anonymous';
}

?>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css" />
    <title>Website SD</title>
</head>

<body class="bg-home">
    <div class="body">
        <div class="card-container">
            <a class="card-item" href="./category/ki_kd_tujuan/ki_kd_tujuan.php">
                <div class="card-image">
                    <img src="./assets/icons/kurikulum.png" class="card-icon" />
                </div>
                <div class="card-title">
                        <p>KI, KD <br/> TUJUAN</p>
                </div>
            </a>
            <a class="card-item" href="./category/petunjuk/petunjuk.php">
                <div class="card-image">
                    <img src="./assets/icons/search.png" class="card-icon" />
                </div>
                <div class="card-title">
                        <p>PETUNJUK</p>
                </div>
            </a>
            <a class="card-item" href="./category/tema1pb1/materi.php">
                <div class="card-image">
                    <img src="./assets/icons/buku.png" class="card-icon" />
                </div>
                <div class="card-title">
                        <p>TEMA 1 <br/> PB 1</p>
                </div>
            </a>
            <a class="card-item" href="./category/forum/forum.php">
                <div class="card-image">
                    <img src="./assets/icons/diskusi.png" class="card-icon" />
                </div>
                <div class="card-title">
                        <p>Forum <br/> DISKUSI</p>
                </div>
            </a>
            <a class="card-item" href="./category/soal/soal.php">
                <div class="card-image">
                    <img src="./assets/icons/latihan.png" class="card-icon" />
                </div>
                <div class="card-title">
                        <p>Latihan <br/> Soal</p>
                </div>
            </a>
            <a class="card-item" href="./category/games/games.html">
                <div class="card-image">
                    <img src="./assets/icons/games.png" class="card-icon" />
                </div>
                <div class="card-title">
                        <p>Games</p>
                </div>
            </a>
            <a class="card-item" href="index.php">
                <div class="card-image">
                    <img src="./assets/icons/logout.png" class="card-icon" />
                </div>
                <div class="card-title">
                        <p>Keluar</p>
                </div>
            </a>
        </div>
    </div>
</body>

</html>