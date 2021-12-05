<?php
session_start();
$nama = $_SESSION["nama"];
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


$data = http_request('https://dev-sekolahdasar.herokuapp.com/api/v1/user/soal/get');
if ($data == 0) {
  header("Refresh:0; url=soal.php");
}

// foreach($data as $soal){
//   echo $soal['soal'] . '<br/>';
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../assets/css/style.css" />
  <link rel="stylesheet" href="../../assets/css/style-modal.css" />
  <title>Soal Latihan</title>
</head>

<body id="soal" class="bg-pendidikan" style="padding:0px 20px;">
  <button style="position: absolute;top:5%;left:25" class="btn btn-direct" onclick="window.location='../../home.php'">
    Kembali Ke Menu Utama
  </button>
  <div class="container">
    <h2 class="title">Soal Latihan</h2>
    <?php
    if (isset($_POST)) {
      $countPost = count($_POST);
    } else {
      $countPost = 0;
    }
    ?>
    <small class="small">Silahkan Jawab Semua Pertanyaan di bawah ini</small>
    <form method="POST" action="soal.php">
      <ol>
        <?php
        $no = 1;
        $jawab_benar = 0;
        if ($data != 0) {

          foreach ($data as $soal) {



            $color_a = "black";
            $color_b = "black";
            $color_c = "black";
            $color_d = "black";
            // CeK Jika Jawaban Sama dengan Jawaban Yang Benar
            if ($countPost > 0 &&  $_POST['jawaban' . $no] == $soal['jawab_benar']) {
              $jawab_benar++;
              $color_a = 'lightgreen';
              $color_b = 'lightgreen';
              $color_c = 'lightgreen';
              $color_d = 'lightgreen';
            }

            // Cek Jika Jawaban Tidak sama dengan Jawaban Yang Benar
            if ($countPost > 0 &&  $_POST['jawaban' . $no] != $soal['jawab_benar']) {
              $color_a = "red";
            }


            // Cek Jika Pilihan A tidak sama Dengan Jawaban
            if ($countPost > 0 && $soal['jawab_a'] != $_POST['jawaban' . $no]) {
              $color_a = "black";
            }

            // Cek Jika Pilihan A sama dengan Jawaban Yang Benar
            if ($countPost > 0 &&  $soal['jawab_a'] == $soal['jawab_benar']) {
              $color_a = 'lightgreen';
            }




            if ($countPost > 0 && $_POST['jawaban' . $no] != $soal['jawab_benar']) {
              $color_b = "red";
            }
            if ($countPost > 0 && $soal['jawab_b'] != $_POST['jawaban' . $no]) {
              $color_b = "black";
            }
            if ($countPost > 0 &&  $soal['jawab_b'] == $soal['jawab_benar']) {
              $color_b = 'lightgreen';
            }



            if ($countPost > 0 && $_POST['jawaban' . $no] != $soal['jawab_benar']) {
              $color_c = "red";
            }
            if ($countPost > 0 && $soal['jawab_c'] != $_POST['jawaban' . $no]) {
              $color_c = "black";
            }
            if ($countPost > 0 &&  $soal['jawab_c'] == $soal['jawab_benar']) {
              $color_c = 'lightgreen';
            }


            if ($countPost > 0 &&  $_POST['jawaban' . $no] != $soal['jawab_benar']) {
              $color_d = "red";
            }
            if ($countPost > 0 && $soal['jawab_d'] != $_POST['jawaban' . $no]) {
              $color_d = "black";
            }
            if ($countPost > 0 &&  $soal['jawab_d'] == $soal['jawab_benar']) {
              $color_d = 'lightgreen';
            }


        ?>
            <div class="soal-content">
              <p class="pertanyaan">
                <li><?php echo $soal['soal'] ?></li>
              </p>
              <div class="options">
                <div class="options-jawab" style="color : <?= $color_a ?>">
                  <input type="radio" name="jawaban<?= $no ?>" id="jawab_a_<?= $no; ?>" value="<?= $soal['jawab_a'] ?>" <?php if ($countPost > 0 && $_POST['jawaban' . $no] == $soal['jawab_a']) echo "checked" ?> <?php if ($countPost > 0) echo " disabled" ?> required>
                  <label for="jawab_a_<?= $no; ?>"><span>a.</span> <?= $soal['jawab_a'] ?></label>
                </div>
                <div class="options-jawab" style="color : <?= $color_b ?>">
                  <input type="radio" name="jawaban<?= $no ?>" id="jawab_b_<?= $no; ?>" value="<?= $soal['jawab_b'] ?>" <?php if ($countPost > 0 && $_POST['jawaban' . $no] == $soal['jawab_b']) echo "checked" ?> <?php if ($countPost > 0) echo " disabled" ?> required>
                  <label for="jawab_b_<?= $no; ?>"><span>b.</span> <?= $soal['jawab_b'] ?></label>
                </div>
                <div class="options-jawab" style="color :<?= $color_c ?> ">
                  <input type="radio" name="jawaban<?= $no ?>" id="jawab_c_<?= $no; ?>" value="<?= $soal['jawab_c'] ?>" <?php if ($countPost > 0 && $_POST['jawaban' . $no] == $soal['jawab_c']) echo "checked" ?> <?php if ($countPost > 0) echo " disabled" ?> required>
                  <label for="jawab_c_<?= $no; ?>"><span>c.</span> <?= $soal['jawab_c'] ?></label>
                </div>
                <div class="options-jawab" style="color : <?= $color_d ?> ">
                  <input type="radio" name="jawaban<?= $no ?>" id="jawab_d_<?= $no; ?>" value="<?= $soal['jawab_d'] ?>" <?php if ($countPost > 0 && $_POST['jawaban' . $no] == $soal['jawab_d']) echo "checked" ?> <?php if ($countPost > 0) echo " disabled" ?> required>
                  <label for="jawab_d_<?= $no; ?>"><span>d.</span> <?= $soal['jawab_d'] ?></label>
                </div>
              </div>
            </div>
        <?php
            $no++;

            $total_nilai = $jawab_benar / 15 * 100; // Hitung Nilai
            $total_nilai = round($total_nilai); //  Bulatkan Nilai
          }
        }
        ?>
      </ol>
      <?php if ($countPost == 0) {
      ?>
        <!-- BUTTON SUBMIT -->

        <div class="container-button">

          <button id="myBtn" class="btn btn-direct" style="width:50%;">
            Submit
          </button>
        </div>
      <?php
      }
      ?>
    </form>

  </div>

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
          Selamat <?= $nama ?>
        </h2>
        <div style="display:flex;justify-content:center;align-items:center;margin:5% 0px;">
          <img src="../../assets/icons/medal.png" alt="score">
        </div>

        <div class="score-modal" style="display:flex;justify-content:center;align-items:center;flex-direction:column;">
          <h2>Score Kamu Adalah : <?= $total_nilai ?></h2>
          <button class="btn btn-direct" id="cek_jawaban" style="margin-top:3%;"">
            Cek Jawaban
          </button>
          <button class=" btn btn-direct" style="margin-top:3%;" onclick="window.location='../../home.php'">
            Kembali Ke Halaman utama
          </button>
        </div>
      </div>
    </div>

  </div>

  <script>
    const modal = document.getElementById("myModal");

    const btn = document.getElementById("myBtn");
    const cek_jawaban = document.getElementById("cek_jawaban");

    var span = document.getElementsByClassName("close")[0];
    <?php
    if ($countPost > 0) {
    ?>modal
    document.onload = modal.style.display = "block"
    <?php
    }


    ?>

    // btn.onclick = () => {
    //   modal.style.display = "block"
    // }

    span.onclick = () => {
      modal.style.display = "none"
    }
    cek_jawaban.onclick = () => {
      modal.style.display = "none"
    }

    window.onclick = () => {
      if (event.target == modal) {

        modal.style.display = "none"
      }
    }
  </script>
</body>

</html>