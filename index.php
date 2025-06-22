<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎂 Happy Birthday Aghni! 🎉</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <!-- Confetti Container -->
    <div id="confetti-container"></div>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-10">
                    <div class="hero-content">
                        <div class="floating-elements">
                            <div class="balloon balloon-1">🎈</div>
                            <div class="balloon balloon-2">🎈</div>
                            <div class="balloon balloon-3">🎈</div>
                            <div class="sparkle sparkle-1">✨</div>
                            <div class="sparkle sparkle-2">⭐</div>
                            <div class="sparkle sparkle-3">💫</div>
                        </div>

                        <h1 class="hero-title">
                            <span class="cake-icon">🎂</span>
                            Aghni Habibah Putriana
                            <span class="cake-icon">🎂</span>
                        </h1>

                        <div id="birthday-messages" class="birthday-message">
                            <p class="message active">🎉 Selamat ulang tahun, Aghni Habibah Putriana!🎉</p>
                            <p class="message">✨ Di tahun ini, semoga semua harapanmu dikabulkan.✨</p>
                            <p class="message">🎂 aku harap kamu bisa jadi lebih baik 🎂</p>
                            </p>
                        </div>
                        <div id="typewriter" class="text-center mt-4 fs-5 fw-bold text-primary"></div>

                        <!-- Countdown Timer -->
                        <div class="countdown-container">
                            <h3 class="countdown-title">hitung mundur ke ulang taun selanjutnya hehe</h3>
                            <div id="countdown" class="countdown-timer">
                                <div class="time-unit">
                                    <span id="days">000</span>
                                    <label>Days</label>
                                </div>
                                <div class="time-unit">
                                    <span id="hours">00</span>
                                    <label>Hours</label>
                                </div>
                                <div class="time-unit">
                                    <span id="minutes">00</span>
                                    <label>Minutes</label>
                                </div>
                                <div class="time-unit">
                                    <span id="seconds">00</span>
                                    <label>Seconds</label>
                                </div>
                                <h3 class="countdown-title">aku buat ini biar tahun depan gk lupa hehe</h3>
                            </div>
                        </div>

                        <div class="hero-icons">
                            <i class="fas fa-birthday-cake bounce"></i>
                            <i class="fas fa-heart pulse"></i>
                            <i class="fas fa-gift bounce"></i>
                            <i class="fas fa-star spin"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Birthday Cards Section -->
    <section class="cards-section py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="birthday-card">
                        <div class="card-icon">🎂</div>
                        <h3>Ucapan manis😜</h3>
                        <p>HBD Aghniii 🎂✨ makin tua makin kece dong! Semoga rezeki lancar, vibes positif terus, dan
                            🧃🥳 Nikmatin hari ini kayak nikmatin es kopi di tanggal
                            tua—penuh perjuangan tapi tetep happy! 😆💖</p>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="birthday-card">
                        <div class="card-icon">🌟</div>
                        <h3>Bersinar Terus, Kak!</h3>
                        <p>Aghni tuh kayak lampu LED 100 watt—selalu terangin suasana! ✨ Di hari spesial ini, semoga
                            kamu tetap bersinar kayak bintang (tapi jangan panas kayak matahari ya 😆). Terus jadi
                            inspirasi, tapi jangan lupa recharge juga~ 🔋💖</p>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="birthday-card">
                        <div class="card-icon">💝</div>
                        <h3>Hari Spesial Aghni! 🎉</h3>
                        <p>Hari ini waktunya kamu jadi pusat semesta—kayak notif masuk pas lagi nungguin chat crush 😍📱
                            Semoga tahun baru ini bawa tawa gak ada habisnya, vibes healing tiap hari, dan semua
                            cita-cita tercapai 😝✨ Happy B'day, Aghni!</p>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Interactive Cake Section -->
    <!-- <section class="cake-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="cake-container">
                        <h2 class="text-center mb-4">Make a Wish! 🕯️</h2>
                        <div class="birthday-cake">
                            <div class="cake-emoji">🎂</div>
                            <div class="candles">
                                <span class="candle">🕯️</span>
                                <span class="candle">🕯️</span>
                                <span class="candle">🕯️</span>
                                <span class="candle">🕯️</span>
                                <span class="candle">🕯️</span>
                            </div>
                        </div>
                        <div class="cake-elements">
                            <div class="cake-element">
                                <div class="element-icon">🎈</div>
                                <p>Balloons</p>
                            </div>
                            <div class="cake-element">
                                <div class="element-icon">🎁</div>
                                <p>Gifts</p>
                            </div>
                            <div class="cake-element">
                                <div class="element-icon">✨</div>
                                <p>Magic</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <?php include 'includes/cake-section.php'; ?>


    <!-- Music Player -->
    <div class="music-player">
        <button id="musicToggle" class="btn btn-primary">
            <i class="fas fa-play" id="playIcon"></i>
        </button>
        <span class="music-label">Birthday Melody</span>
        <audio id="backgroundMusic" loop>
            <source src="assets/music/lagu.mp3" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>
    </div>

    <?php include 'includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>
    <script>
    // Confetti saat load
    window.onload = () => {
        confetti({
            particleCount: 200,
            spread: 120,
            origin: {
                y: 0.6
            }
        });
    };
    </script>

    <script>
    const words = ["Maaf ya baru bisa ngasih kado sekarang soalnya kmrn bnyk banget tugas yang harus dikerjain"];
    let i = 0,
        j = 0,
        current = '',
        isDeleting = false;

    function type() {
        current = words[i];
        document.getElementById("typewriter").innerText = current.substring(0, j);

        if (!isDeleting && j < current.length) {
            j++;
        } else if (isDeleting && j > 0) {
            j--;
        } else {
            isDeleting = !isDeleting;
            if (!isDeleting) i = (i + 1) % words.length;
        }
        setTimeout(type, isDeleting ? 50 : 120);
    }
    type();
    </script>



</body>

</html>