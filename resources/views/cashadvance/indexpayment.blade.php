
<!DOCTYPE html>
<html>
<head>
    <title>Pament Request</title>
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
        }

        .container {
            margin: 100px auto;
            max-width: 400px;
        }

        h1 {
            font-size: 36px;
        }

        p {
            font-size: 18px;
        }

        .countdown {
            font-size: 24px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Coming Soon</h1>
        <p>We're working on something awesome and exciting!</p>
        <div class="countdown" id="countdown">
            <span id="days">00</span> days
            <span id="hours">00</span> hours
            <span id="minutes">00</span> minutes
            <span id="seconds">00</span> seconds
        </div>
    </div>

    <script>
        // Tanggal target (ganti sesuai kebutuhan)
        var targetDate = new Date("2024-01-01 00:00:00").getTime();

        // Fungsi untuk memperbarui hitungan mundur
        var x = setInterval(function() {
            var now = new Date().getTime();
            var distance = targetDate - now;

            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Tampilkan hitungan mundur di elemen dengan ID yang sesuai
            document.getElementById("days").innerHTML = formatTime(days);
            document.getElementById("hours").innerHTML = formatTime(hours);
            document.getElementById("minutes").innerHTML = formatTime(minutes);
            document.getElementById("seconds").innerHTML = formatTime(seconds);

            // Jika waktu target sudah tercapai, hentikan hitungan mundur
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("countdown").innerHTML = "EXPIRED";
            }
        }, 1000);

        // Fungsi untuk menambahkan "0" di depan angka tunggal
        function formatTime(time) {
            return (time < 10) ? "0" + time : time;
        }
    </script>
</body>
</html>





