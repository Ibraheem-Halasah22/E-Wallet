<?php
session_start();

?>
<!doctype html>
<html lang="en">
<head>

    <title>testing new things</title>
    <link rel="stylesheet" href="CSS/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">


</head>
<body>
<div id="soso" class="iconpen">
    <img src="imgaes/pen.png">
    <h1>Penguin</h1>
</div>
<div class="icon" id="menu"><i class="fas fa-bars" id="toggler"></i></div>
<header id="main">
    <nav id="navbar">
        <ul id="links">
            <li><a class="hello2" href="#">home</a></li>
            <li><a class="hello2" href="#about">about</a></li>

            <li><a class="hello2" href="#contact">contact us</a></li>
        </ul>
    </nav>
    <div class="mainpage">
        <h1>WELCOME TO PENGUIN</h1>
        <p>penguin is an E-wallet system that is secure and easy to use ,keep your money safe and sound,
            pay all your bills from your house <br>and now you can use penguin prime to shop online for watches to never run late</p>
        <div>
            <?php

            $v = isset($_SESSION['logInId'])?"Let's go!":"Sign In";
            $inOut = '<form action="firstredir.php" method="post"><button class="mySbutton" onclick="e_wallet_main()"><span></span>' .$v.'</button></form>';
            echo $inOut;

            ?>
        </div>


    </div>
    <div class="soso2">
        <div class="about-section" id ="about">
            <h1>ABOUT PENGIN</h1>
            <h4>How We Got Here</h4>
            <span>Since our first day in business, pengin has been offering our customers the best selection of products
            atunbeatable prices. Our online store has become synonymous with quality and we ensure a continuous variety
            of fantastic merchandise along with unique limited edition and seasonal items that fit any budget. Check it
            out and start shopping today!</span>
        </div>

        <h2 style="text-align:center" id="contact">Our Team</h2>
        <div class="row">
            <div class="column">
                <div class="card">
                    <img src="imgaes/mohamad.jpg" alt="mo" style="width:50%;">
                    <div class="container">
                        <h2>mohamad jondi</h2>
                        <p class="title">front-end designer</p>
                        <p>a great programmer who think he can change the world </p>
                        <p>mohamadw22@hotmail.com</p>
                        <p><a href="https://www.facebook.com/mohamadwaljondi/" target="_blank"><button class="button" onclick="e_wallet_main">Contact</button></a></p>
                    </div>
                </div>
            </div>

            <div class="column">
                <div class="card">
                    <img src="imgaes/ibrahem.jpg" alt="ibrahem" style="width:50% ; ">
                    <div class="container">
                        <h2>ibrahem halse</h2>
                        <p class="title">back-end developer </p>
                        <p>a person with great knowledge and great ambitions </p>

                        <p><a href="https://www.facebook.com/ibraheemm.halasah" target="_blank"><button class="button" onclick="watch_store_main">Contact</button></a></p>
                    </div>
                </div>
            </div>


        </div>
    </div>



    <div class="box"></div>
    <div class="box"></div>
    <div class="box"></div>
    <div class="box"></div>
    <div class="box"></div>
    <div class="box"></div>
    <div class="box"></div>
    <div class="box"></div>
    <div class="box"></div>
    <script src="javascript/main.js" ></script>
</header>


</body>
</html>