 <div class="login" id="login_box">
        <div class="login_left">
            <img src="./images/login_icon.png" >
        </div>

        <div class="login_right">

            <div class="form_title">
                <h3>Member Login</h3>
                <div class="cross" id="cross" onclick="crossSign()">
                    <img src="./images/cross_icon.png">
                </div>
            </div>
                
            <div>
                    <p>Akaza - a better place to watch anime online for free!</p>
                </div>

            

            <form action="" method="post" class="form_login">
                <div class="email">
                    <input type="text" placeholder="Username" name="username" required>
                    <div class="email_icon">
                        <img src="./images/email_icon.png" >
                    </div>
                </div>

                <div class="password">
                    <input type="password" placeholder="Password" name="password" required>
                    <div class="pass_icon"><img src="./images/password_icon.png" ></div>
                </div>

                <button class="login_btn" type="submit" name="submit" value="login" onclick="loggin()">
                    <span>Login</span>
                </button>

                <div class="account">
                    <p>Don't have an account?</p>
                    <p id="reg" class="reg" onclick="openRegister()">Register</p>
                </div>
            </form>

           
         </div> 

</div>