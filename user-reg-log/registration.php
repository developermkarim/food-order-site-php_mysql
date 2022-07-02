<!DOCTYPE html>
<!-- Created By CodingLab - www.codinglabweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
   <!---- <title> Login Form | CodingLab </title>--->
    <link rel="stylesheet" href="sign-up.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
   <link rel="stylesheet" href="user-reg-log.css">
   </head>
<body>
  
  <div class="main_div">
    <div class="title">Sign Up Form</div>
    <div class="social_icons">
      <a href="#"><i class="fab fa-facebook-f"></i> <span>Facebook</span></a>
      <a href="#"><i class="fab fa-twitter"></i><span>Twitter</span></a>
    </div>
    <form action="validate-captcha.php" method="post">
      <div class="input_box">
        <input type="text" placeholder="User Name" name="userName" required>
        <div class="icon"><i class="fas fa-user"></i></div>
      </div>
      <div class="input_box">
        <input type="email" placeholder="Email or Phone" name="email" required>
        <div class="icon"><i class="fas fa-user"></i></div>
      </div>
      <div class="input_box">
        <input type="password" placeholder="Password" name="password" required>
        <div class="icon"><i class="fas fa-lock"></i></div>
      </div>
      <div class="g-recaptcha" data-sitekey="6LeZDjsgAAAAANrZSoxDJ3n4xRjlNiBTM3iT30AY"></div>
      <div class="option_div">
        <div class="check_box">
          <input type="checkbox">
          <span>Remember me</span>
        </div>
        <div class="forget_div">
          <a href="#">Forgot password?</a>
        </div>
      </div>

      <div class="input_box button">
        <input type="submit" value="Sign Up" name="sign-btn">
      </div>
      <div class="sign_up">
        already have an Account? <a href="login.php">Log In</a>
      </div>
    </form>
  </div>
  
</body>
</html>
