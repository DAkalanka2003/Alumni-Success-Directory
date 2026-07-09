<?php include 'auth.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Success Directory</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Lato:wght@400;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
</head>

<body>

<!-- -- Header ------------------------------- -->

<?php
include "../Header_Footer/Header.php";
?>

<!-- --------------------------------------------------------------------------------------------------------------------- -->   

<!-- Log In form----------------------------------------------------------------------------------------------------------- -->   

<section class="page" id="submit">

  <div class="submit-inner">

    <div class="login-card">

      <div class="login-card-header">
        <p class="section-label">Welcome Back</p>
        <h1 class="login-title">Sign In to Your Account</h1>
      </div>

      <form method="POST" action="login.php" id="loginForm">

        <div class="form-group">
          <label class="form-label" for="su-username">Username *</label>
          <input class="form-input" name="username" id="su-username" type="text" placeholder="e.g. nimal_perera" required>
        </div>

        <div class="form-group">
          <label class="form-label" for="su-password">Password *</label>
          <input class="form-input" name="password" id="su-password" type="password" placeholder="Enter your password" required>
        </div>

        <?php if ($loginError): ?>
          <p class="form-error"><?php echo htmlspecialchars($loginError); ?></p>
        <?php endif; ?>

        <button class="form-submit-btn" type="submit" name="login_submit">Login →</button>

      </form>

      <p class="login-footnote">Don't have an account? <a href="../Submit Page/submit.php">Sign Up</a></p>

    </div>

  </div>
</section>
<!-- --------------------------------------------------------------------------------------------------------------------- -->   


<!-- -- Footer ------------------------------- -->
  
<?php
include "../Header_Footer/Footer.php";
?>

<script src="script.js"></script>
</body>
</html>