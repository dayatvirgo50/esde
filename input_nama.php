<html>

<head>
    <title>Website SD</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css" />
</head>

<body class="bg-home">
    <div class="body">
        <div class="loader-content">
            <div class="plane" id="plane">
                <img src="./assets/icons/plane.png" style="width: 300px;height:auto" />
            </div>
            <div>
                <h2>
                    Nama Kamu Adalah <span id="nama_text"></span>
                </h2>
                <form action="./home.php" method="POST">
                    <input type="text" class="input_nama" id="nama" name="nama" onkeyup="changeName(this)" /> <span id="btn"></span>
                </form>

            </div>
        </div>
    </div>
    <script>
        function changeName(e) {
            document.getElementById('nama_text').innerText = e.value
            console.log(e.value)
            if (e.value) {
                document.getElementById('btn').innerHTML = "<button type='submit' class='btn btn-direct'>Menu Utama</button>"
            } else {
                document.getElementById('btn').innerHTML = ""
            }
        }


        // Munculkan Animasi Dalam 3 Detik
        setTimeout(function() {
            var plane = document.getElementById('plane');
            plane.classList.add('plane-animated');
        }, 3000)
    </script>
</body>

</html>