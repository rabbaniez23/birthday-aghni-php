<section class="cake-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="cake-container text-center">
                    <h2 class="mb-4">Make a Wish! 🕯️</h2>
                    <div class="birthday-cake">
                        <div class="cake-emoji">🎂</div>
                        <div class="candles">
                            <span class="candle" id="candle1">🕯️</span>
                            <span class="candle" id="candle2">🕯️</span>
                            <span class="candle" id="candle3">🕯️</span>
                            <span class="candle" id="candle4">🕯️</span>
                            <span class="candle" id="candle5">🕯️</span>
                        </div>
                    </div>

                    <div class="cake-elements mt-4">
                        <div class="cake-element d-inline-block mx-3">
                            <div class="element-icon fs-3">🎈</div>
                            <p>Balloons</p>
                        </div>
                        <div class="cake-element d-inline-block mx-3">
                            <div class="element-icon fs-3">🎁</div>
                            <p>Gifts</p>
                        </div>
                        <div class="cake-element d-inline-block mx-3">
                            <div class="element-icon fs-3">✨</div>
                            <p>Magic</p>
                        </div>
                    </div>

                    <!-- Pesan setelah semua lilin mati -->
                    <div id="wish-message" class="text-center mt-4 fw-bold text-success fs-4" style="display: none;">
                        🎉 Yeay! Semua lilin sudah ditiup!
                        Semoga semua harapan Aghni terkabul! 💖
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Confetti Library -->
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>

<!-- Sound -->
<audio id="cheerSound" src="assets/sfx/cheer.mp3" preload="auto"></audio>

<!-- Interactivity Script -->
<script>
let blownCandles = 0;
const totalCandles = 5;

for (let i = 1; i <= totalCandles; i++) {
    const candle = document.getElementById(`candle${i}`);
    candle.addEventListener('click', () => {
        if (!candle.classList.contains('blown')) {
            candle.textContent = '🕳️'; // simbol lilin mati
            candle.classList.add('blown');
            blownCandles++;

            if (blownCandles === totalCandles) {
                document.getElementById("wish-message").style.display = "block";
                playConfetti();
                playCheerSound();
            }
        }
    });
}

function playConfetti() {
    confetti({
        particleCount: 200,
        spread: 120,
        origin: {
            y: 0.6
        }
    });
}

function playCheerSound() {
    const audio = document.getElementById("cheerSound");
    audio.play();
}
</script>