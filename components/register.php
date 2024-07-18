    
        <div class="register_login" id="register_box">

             <div class="left_register">
                <img src="./images/icon-register.png" >
             </div>

             <div class="right_register">

                <div class="register_title">
                    
                    <h3>Register</h3>
                    <div class="tik" id="tik" onclick="crossSign()">
                        <img src="./images/cross_icon.png">
                    </div>

                </div>
                    
                <div><p>When becoming members of the site, you could use the full range of functions.</p>
                </div>

                <form action="" method="post" class="form_register">

                    <div class="user_register">
                        <input type="text" placeholder="Username" name="username" required>
                        <div><img src="./images/user_icon.png" ></div>
                    </div>

                    <div class="email_register">
                        <input type="email" placeholder="Your Email" name="email" required>
                        <div> <img src="./images/email_icon.png" ></div>
                    </div>

                    <div class="password_register">
                        <input type="password" placeholder="Your Password" name="password" required>
                        <div><img src="./images/password_icon.png" ></div>
                    </div>

                    <div class="check_register">
                        <input type="password" placeholder="Repeat Your Password" name="confirm_password" required>
                        <div><img src="./images/password_icon.png" ></div>
                    </div>

                    <button class="btn_register" type="submit" name="submit" value="register">
                        <span>Register</span>
                    </button>

                    <div class="sig">
                        <p>Have an account?</p>
                        <p class="sip" id="sip" onclick="openSignUp()">Sign-In</a>
                    </div>
                </div>

            </form>
        </div>
    
