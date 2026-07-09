<?php include 'save.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Success Directory</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Cormorant+Garamond:ital,wght@0,400;0,500;1,400&family=Lato:wght@400;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
</head>

<body>

<!-- -- Header ------------------------------- -->

<?php
include "../Header_Footer/Header.php";
?>

<!-- --------------------------------------------------------------------------------------------------------------------- -->   

<!-- Submit form --------------------------------------------------------------------------------------------------------- -->   

<section class="page" id="submit">
  <div class="submit-shell">

    <!-- Left: sticky intro + process steps ------------------------------- -->
    <div class="submit-intro fade-in">
      <span class="submit-section-label">Share Your Journey</span>
      <h2 class="submit-title">Join the <em>Directory</em></h2>
      <div class="submit-gold-line"></div>
      <p class="submit-desc">Your story could be the reason a junior chooses the right path. Share where you landed and the lessons you carry with you &mdash; it only takes a few minutes.</p>

      <ul class="process-steps">
        <li>
          <span class="step-num">01</span>
          <div class="step-text">
            <strong>Fill your details</strong>
            <span>Tell us about your journey since graduating.</span>
          </div>
        </li>
        <li>
          <span class="step-num">02</span>
          <div class="step-text">
            <strong>Upload verification</strong>
            <span>Attach a document that confirms your alumni status.</span>
          </div>
        </li>
        <li>
          <span class="step-num">03</span>
          <div class="step-text">
            <strong>Get approved</strong>
            <span>An admin reviews your profile before it goes live.</span>
          </div>
        </li>
      </ul>
    </div>

    <!-- Right: form card --------------------------------------------------- -->
    <div class="submit-form-card fade-in" style="animation-delay:0.15s">

      <?php if ($formError): ?>
        <p class="form-error"><?php echo htmlspecialchars($formError); ?></p>
      <?php endif; ?>

      <form method="POST" action="submit.php" enctype="multipart/form-data" id="profileForm">

        <p class="form-section-title">Personal Details</p>

        <div class="form-group">
          <label class="form-label">Full Name *</label>
          <input class="form-input" name="name" id="f-name" type="text" placeholder="e.g. Nimal Perera" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>" required>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Graduation Year *</label>
            <input class="form-input" name="year" id="f-year" type="number" placeholder="e.g. 2022" min="2000" max="2030" value="<?php echo htmlspecialchars($_POST['year'] ?? ''); ?>" required>
          </div>
          <div class="form-group">
            <label class="form-label">Student ID</label>
            <input class="form-input" name="student_id" id="f-id" type="text" placeholder="e.g. PS/2020/001" value="<?php echo htmlspecialchars($_POST['student_id'] ?? ''); ?>">
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">Current Company / Organisation *</label>
          <input class="form-input" name="company" id="f-company" type="text" placeholder="e.g. Dialog Axiata" value="<?php echo htmlspecialchars($_POST['company'] ?? ''); ?>" required>
        </div>

        <div class="form-group">
          <label class="form-label">Job Title / Role *</label>
          <input class="form-input" name="role" id="f-role" type="text" placeholder="e.g. Software Engineer" value="<?php echo htmlspecialchars($_POST['role'] ?? ''); ?>" required>
        </div>

        <div class="form-divider"></div>

        <p class="form-section-title">Account</p>

        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Username *</label>
            <input class="form-input" name="username" id="f-username" type="text" placeholder="e.g. nimal_p" value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>" required>
          </div>
          <div class="form-group">
            <label class="form-label">Password *</label>
            <input class="form-input" name="password" id="f-password" type="password" placeholder="Enter password" required>
          </div>
        </div>

        <div class="form-divider"></div>

        <p class="form-section-title">Documents</p>

        <div class="form-group">
          <label class="form-label">Profile Photo</label>
          <input class="form-input file-input" name="image" id="f-image" type="file" accept=".jpg,.jpeg,.png">
          <small class="upload-note">Upload JPG, JPEG or PNG image</small>
        </div>

        <div class="form-group">
          <label class="form-label">Proof of Validation (Ex:- Degree Certificate) *</label>
          <input class="form-input file-input" name="pdf" id="f-pdf" type="file" accept=".pdf">
          <small class="upload-note">Upload PDF file only</small>
        </div>

        <button class="form-submit-btn" type="submit" name="profile_submit">Submit My Profile →</button>

      </form>

      <div class="success-msg<?php echo $formSuccess ? ' show' : ''; ?>" id="successMsg">
        <h3>You're All Set!</h3>
        <p>Submission successful and pending admin review.</p>
      </div>

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