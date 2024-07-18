<section class="navbar">
        <div class="nav_left">
            <div class="menu" onclick="openBar()">
            <img src="./images/menu.png" >
            </div>

            <div class="logo">
               <a href="index.php"><img src="./images/logo.jpg" ></a>
                <a href="index.php">Akaza</a>
            </div>

            <form action="genre.php" method="post">
                <div class="search">
                    <input type="text" name="search_query" placeholder="Enter anime name">
                    <div class="search_icon_box"><img src="./images/search.png"></div>
                </div>
            </form>


        </div>

        <div class="nav_r">
        <?php if ($user) { ?>
        <div class="nav_right"><?php echo "<p>".$user."</p>"; ?> </div>
             <div class="log">  <a href="logout.php" class="logout" onclick="loggout()"><img src="./images/logoutIcon.png"></a></div>
        </div>


    <?php } else { ?>
        <div class="nav_right" onclick="openSignIn()"  >Sign in</div>
    <?php } ?>


    </section>