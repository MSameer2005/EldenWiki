<?php
session_start();
$isLogged = isset($_SESSION['isLogged']) && $_SESSION['isLogged'] === true;
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="../img/EldenRing-Simbolo.png" rel="icon" type="image/png">
    <title>Elden Wiki</title>
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>
<div class="myVideo">
    <video autoplay class="myVideo" loop muted>
        <source src="../img/EldenRing.mp4" type="video/mp4">
    </video>
</div>

<header class="sfondo">
    <a href="Home.php"><h1>Elden Wiki</h1></a>
    <div class="menu">
        <ul>
            <li><a href="Home.php">Home</a></li>
            <?php if ($isLogged): ?>
                <li><a href="Lore.php">Lore</a></li>
                <li><a href="Walkthrough.php">Walkthrough</a></li>
                <div class="dropdown">
                    <li class="dropbtn">Equipment</li>
                    <div class="dropdown-content">
                        <a href="Armi.php">Weapons</a>
                        <a href="Armature.php">Armor</a>
                        <a href="Incantesimi.php">Incantations</a>
                        <a href="Stregonerie.php">Sorcery</a>
                        <a href="CeneriDiGuerra.php">Ashes of War</a>
                    </div>
                </div>
                <li><a href="EffettiStato.php">Status Effects</a></li>
            <?php endif; ?>
            <li><a href="Contacts.php">Contact Us</a></li>
        </ul>
    </div>
    <div class="header-buttons">
        <?php if ($isLogged): ?>
            <img src="<?php echo "../" . $_SESSION['profilePicture']; ?>" alt="Profilo" width="60px"
                 style="border-radius: 50%"
                 onclick="window.location.href='Profilo.php'">
        <?php else: ?>
            <button class="sign-up" onclick="window.location.href='SignUp.php'">Sign Up</button>
            <button class="log-in" onclick="window.location.href='LogIn.php'">Log in</button>
        <?php endif; ?>
    </div>
</header>

<main class="sfondo">
    <section class="hero">
        <h2 class="titolo">Welcome to the world of Elden Ring</h2>
        <p class="benvenuto">Welcome, Tarnished. The fate of the world rests within thy hands.<br>Dare to traverse the
            boundaries of the Lands Between and forge thy path amidst shadows and legends.</p>
    </section>

    <section class="caratteristiche">
        <h2 class="titolo">Features</h2>
        <div class="cards">
            <div class="card">
                <h4>An Open Realm of Boundless Vastness</h4>
                <p>
                    Explore an immense world rich with secrets, where every corner harbors new challenges, mysteries, or
                    opportunities. Journey through desolate lands, ancient ruins, and majestic castles, and uncover a
                    narrative that unfolds through thy exploration.
                </p>
            </div>
            <div class="card">
                <h4>Freedom of Play</h4>
                <p>
                    Elden Ring offers thee total freedom in the choices of thy gameplay. Choose thy style of combat,
                    customize thy character, and face the world as thou desirest, whether thou engagest in close combat
                    or wieldest potent sorceries.
                </p>
            </div>
            <div class="card">
                <h4>A Deep and Mysterious Saga</h4>
                <p>
                    Forged by the legendary Hidetaka Miyazaki and in collaboration with George R. R. Martin, the saga of
                    Elden Ring is rich with mystery and mythos. Each step draws thee nearer to unveiling the truth
                    behind the Lands Between and the power of the Elden Ring.
                </p>
            </div>
            <div class="card">
                <h4>The Complexity of Combat</h4>
                <p>
                    The battles within Elden Ring are trials without equal. Confront ferocious foes and mighty lords,
                    each bearing their own unique art of combat. Strategy and patience are the keys to triumph.
                </p>
            </div>
            <div class="card">
                <h4>The System of Progression and Personalization</h4>
                <p>
                    Elden Ring offers a vast progression system for thy character. Enhance skills, equipment, and
                    acquire new techniques. Every choice influences thy style of play and the manner in which thou
                    confrontest challenges.
                </p>
            </div>
            <div class="card">
                <h4>An Atmosphere of Unparalleled Immersion</h4>
                <p>
                    Every corner of the Lands Between is imbued with a dark and captivating beauty. The breathtaking
                    visuals, surreal settings, and evocative melodies weave an immersive experience that enthralls thee
                    from the first battle to the last.
                </p>
            </div>
            <div class="card">
                <h4>Multiplayer and Co-op</h4>
                <p>
                    Engage with thy companions or confront other Tarnished in PvP encounters. A unique system of
                    cooperation permits thee to explore the world alongside others, facing common trials and enriching
                    thy journey.
                </p>
            </div>
        </div>
    </section>

    <section class="gallery">
        <h2 class="titolo">The Gallery</h2>
        <div class="slideshow-container">
            <div class="mySlides fade">
                <div class="numbertext">1 / 36</div>
                <img alt="Slide 1" class="slide" src="../img/gallery/Slide-1.png">
            </div>
            <div class="mySlides fade">
                <div class="numbertext">2 / 36</div>
                <img alt="Slide 2" class="slide" src="../img/gallery/Slide-2.png">
            </div>
            <div class="mySlides fade">
                <div class="numbertext">3 / 36</div>
                <img alt="Slide 3" class="slide" src="../img/gallery/Slide-3.png">
            </div>
            <div class="mySlides fade">
                <div class="numbertext">4 / 36</div>
                <img alt="Slide 4" class="slide" src="../img/gallery/Slide-4.png">
            </div>
            <div class="mySlides fade">
                <div class="numbertext">5 / 36</div>
                <img alt="Slide 5" class="slide" src="../img/gallery/Slide-5.png">
            </div>
            <div class="mySlides fade">
                <div class="numbertext">6 / 36</div>
                <img alt="Slide 6" class="slide" src="../img/gallery/Slide-6.png">
            </div>
            <div class="mySlides fade">
                <div class="numbertext">7 / 36</div>
                <img alt="Slide 7" class="slide" src="../img/gallery/Slide-7.png">
            </div>
            <div class="mySlides fade">
                <div class="numbertext">8 / 36</div>
                <img alt="Slide 8" class="slide" src="../img/gallery/Slide-8.png">
            </div>
            <div class="mySlides fade">
                <div class="numbertext">9 / 36</div>
                <img alt="Slide 9" class="slide" src="../img/gallery/Slide-9.png">
            </div>
            <div class="mySlides fade">
                <div class="numbertext">10 / 36</div>
                <img alt="Slide 10" class="slide" src="../img/gallery/Slide-10.png">
            </div>
            <div class="mySlides fade">
                <div class="numbertext">11 / 36</div>
                <img alt="Slide 11" class="slide" src="../img/gallery/Slide-11.png">
            </div>
            <div class="mySlides fade">
                <div class="numbertext">12 / 36</div>
                <img alt="Slide 12" class="slide" src="../img/gallery/Slide-12.png">
            </div>
            <div class="mySlides fade">
                <div class="numbertext">13 / 36</div>
                <img alt="Slide 13" class="slide" src="../img/gallery/Slide-13.png">
            </div>
            <div class="mySlides fade">
                <div class="numbertext">14 / 36</div>
                <img alt="Slide 14" class="slide" src="../img/gallery/Slide-14.png">
            </div>
            <div class="mySlides fade">
                <div class="numbertext">15 / 36</div>
                <img alt="Slide 15" class="slide" src="../img/gallery/Slide-15.png">
            </div>
            <div class="mySlides fade">
                <div class="numbertext">16 / 36</div>
                <img alt="Slide 16" class="slide" src="../img/gallery/Slide-16.png">
            </div>
            <div class="mySlides fade">
                <div class="numbertext">17 / 36</div>
                <img alt="Slide 17" class="slide" src="../img/gallery/Slide-17.png">
            </div>
            <div class="mySlides fade">
                <div class="numbertext">18 / 36</div>
                <img alt="Slide 18" class="slide" src="../img/gallery/Slide-18.png">
            </div>
            <div class="mySlides fade">
                <div class="numbertext">19 / 36</div>
                <img alt="Slide 19" class="slide" src="../img/gallery/Slide-19.png">
            </div>
            <div class="mySlides fade">
                <div class="numbertext">20 / 36</div>
                <img alt="Slide 20" class="slide" src="../img/gallery/Slide-20.png">
            </div>
            <div class="mySlides fade">
                <div class="numbertext">21 / 36</div>
                <img alt="Slide 21" class="slide" src="../img/gallery/Slide-21.png">
            </div>
            <div class="mySlides fade">
                <div class="numbertext">22 / 36</div>
                <img alt="Slide 22" class="slide" src="../img/gallery/Slide-22.png">
            </div>
            <div class="mySlides fade">
                <div class="numbertext">23 / 36</div>
                <img alt="Slide 23" class="slide" src="../img/gallery/Slide-23.png">
            </div>
            <div class="mySlides fade">
                <div class="numbertext">24 / 36</div>
                <img alt="Slide 24" class="slide" src="../img/gallery/Slide-24.png">
            </div>
            <div class="mySlides fade">
                <div class="numbertext">25 / 36</div>
                <img alt="Slide 25" class="slide" src="../img/gallery/Slide-25.png">
            </div>
            <div class="mySlides fade">
                <div class="numbertext">26 / 36</div>
                <img alt="Slide 26" class="slide" src="../img/gallery/Slide-26.png">
            </div>
            <div class="mySlides fade">
                <div class="numbertext">27 / 36</div>
                <img alt="Slide 27" class="slide" src="../img/gallery/Slide-27.png">
            </div>
            <div class="mySlides fade">
                <div class="numbertext">28 / 36</div>
                <img alt="Slide 28" class="slide" src="../img/gallery/Slide-28.png">
            </div>
            <div class="mySlides fade">
                <div class="numbertext">29 / 36</div>
                <img alt="Slide 29" class="slide" src="../img/gallery/Slide-29.png">
            </div>
            <div class="mySlides fade">
                <div class="numbertext">30 / 36</div>
                <img alt="Slide 30" class="slide" src="../img/gallery/Slide-30.png">
            </div>
            <div class="mySlides fade">
                <div class="numbertext">31 / 36</div>
                <img alt="Slide 31" class="slide" src="../img/gallery/Slide-31.png">
            </div>
            <div class="mySlides fade">
                <div class="numbertext">32 / 36</div>
                <img alt="Slide 32" class="slide" src="../img/gallery/Slide-32.png">
            </div>
            <div class="mySlides fade">
                <div class="numbertext">33 / 36</div>
                <img alt="Slide 33" class="slide" src="../img/gallery/Slide-33.png">
            </div>
            <div class="mySlides fade">
                <div class="numbertext">34 / 36</div>
                <img alt="Slide 34" class="slide" src="../img/gallery/Slide-34.png">
            </div>
            <div class="mySlides fade">
                <div class="numbertext">35 / 36</div>
                <img alt="Slide 35" class="slide" src="../img/gallery/Slide-35.png">
            </div>
            <div class="mySlides fade">
                <div class="numbertext">36 / 36</div>
                <img alt="Slide 36" class="slide" src="../img/gallery/Slide-36.png">
            </div>

            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
    </section>

    <script>
        let slides = document.querySelectorAll('.mySlides');
        let currentSlideIndex = 0;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.style.display = i === index ? 'block' : 'none';
            });
        }

        function nextSlide() {
            currentSlideIndex = (currentSlideIndex + 1) % slides.length;
            showSlide(currentSlideIndex);
        }

        function plusSlides(n) {
            currentSlideIndex = (currentSlideIndex + n + slides.length) % slides.length;
            showSlide(currentSlideIndex);
        }

        function currentSlide(n) {
            currentSlideIndex = n - 1;
            showSlide(currentSlideIndex);
        }

        showSlide(currentSlideIndex);
        setInterval(nextSlide, 3000);
    </script>

</main>

<footer class="sfondo">
    <p>&copy; 2022 Elden Ring. All rights reserved.</p>
</footer>

</body>

</html>