<?php
session_start();
$nama = $_SESSION['nama'];
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


$data = http_request('https://dev-sekolahdasar.herokuapp.com/api/v1/user/forum/get');
// if ($data == 0) {
//   header("Refresh:0; url=forum.php");
// }
?>
<html>

<head>
  <title>Forum Diskusi</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../assets/css/style.css" />
  <link rel="stylesheet" href="../../assets/css/style-modal.css" />
  <title>Forum</title>
</head>

<body class="bg-pendidikan">
  <div class="container-forum">
    <h1>Selamat Datang <?php echo $nama ?> di Forum Diskusi</h1>

    <button class="btn btn-direct" id="myBtn">Tambah Diskusi</button>
    <?php

    // $date = date_create('now', timezone_open('Asia/Jakarta'));
    // $fmt = $date->format('Y-m-d\TH:i:s.u\Z');
    // echo "Timezone : " . $fmt . "<br><br>";
    foreach ($data as $data) {
      $date = date('d F Y', strtotime($data['date']));
    ?>
      <div class="forum-card-container">
        <div class="forum-card-item">
          <h2><?php echo $data['title'] ?></h2> <small><?php echo $date ?></small><br />
          <small>Forum ini dibuat oleh <?php echo $data['created_by'] ?></small>
          <div style="padding: 10px;padding-left:0;margin-top:15px">
            <a href="./detail_forum.php?id_forum=<?php echo $data['_id'] ?>" class="btn btn-direct">Baca yuk</a>
          </div>
        </div>
      </div>
    <?php

    }
    ?>

    <!-- MODAL -->

    <!-- The Modal -->
    <div id="myModal" class="modal">

      <!-- Modal content -->
      <div class="modal-header">

      </div>
      <div class="modal-content">
        <div class="header">
          <span class="close">&times;</span>
        </div>
        <div class="body" style="padding:50px 0px">
          <h2 style="text-align:center;">
            Tambah Diskusi
          </h2>
          <form method="POST" action="tambah_diskusi.php">
            <input type="hidden" name="nama" value="<?= $nama ?>" />
            <div>
              <label>Judul Diskusi</label><br />
              <input type="text" class="input" style="margin:10px;width:95%" id="" name="title"/>
            </div>
            <div>
              <label>Apa yang mau di diskusikan ?</label><br />
              <textarea rows="5" class="input" style="margin:10px;width:95%" name="content"></textarea>
            </div>
            <div style="text-align:right;margin:10px;width:95%">
              <button class="btn btn-direct" type="submit">Tambah Diskusi</button>
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>

  </div>
  <button class="btn btn-direct" style="position: absolute;top:30;left:25" onclick="window.location='../../home.php'">
    < Kembali ke Menu Utama</button>
      <script>
        const modal = document.getElementById("myModal");

        const btn = document.getElementById("myBtn");

        var span = document.getElementsByClassName("close")[0];


        btn.onclick = () => {
          modal.style.display = "block"
        }

        span.onclick = () => {
          modal.style.display = "none"
        }

        window.onclick = function(event) {

          if (event.target == modal) {
            modal.style.display = "none";
          }


        }
      </script>
</body>

</html>