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


<!-- -- About ------------------------------- -->

<section class="page" id="about">

  <!-- Split Hero: text + balanced image panel -->
  <div class="about-hero">

    <div class="about-hero-text fade-in">
      <p class="section-label">Our Mission</p>
      <h2 class="section-title">Why This <em>Exists</em></h2>
      <div class="gold-line"></div>
      <p class="section-desc">
        Students often graduate into uncertainty. The Alumni Success Directory changes that &mdash; by creating a simple, honest space where seniors share exactly where they landed and what they wish they'd known.
      </p>
      <a href="../Contact_Us Page/contact_us.php" class="btn-outline-about">Meet the Team</a>
    </div>

    <div class="about-hero-image fade-in" style="animation-delay:0.15s">
      <img src="Images/alumni_photo.png" alt="Graduation Celebration">
    </div>

  </div>

  <!-- Feature Grid: equal-height balanced cards -->
  <div class="section-wrap">

    <div class="feature-grid">

      <div class="feature-card fade-in" style="animation-delay:0.2s">
        <div class="feature-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4"><path d="M21 12c0 4.418-4.03 8-9 8-1.06 0-2.076-.163-3.017-.463L3 21l1.395-4.185C3.512 15.36 3 13.73 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
        </div>
        <h3>Real Alumni Stories</h3>
        <p>Discover authentic career journeys and success stories from graduates.</p>
      </div>

      <div class="feature-card fade-in" style="animation-delay:0.25s">
        <div class="feature-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4"><circle cx="10.5" cy="10.5" r="6.5"/><line x1="15.5" y1="15.5" x2="21" y2="21"/></svg>
        </div>
        <h3>Easy Alumni Search</h3>
        <p>Find alumni by industry, company, graduation year, or area of expertise.</p>
      </div>

      <div class="feature-card fade-in" style="animation-delay:0.3s">
        <div class="feature-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4"><circle cx="12" cy="12" r="9"/><polygon points="14.5,9.5 16,16 9.5,14.5 8,8"/></svg>
        </div>
        <h3>Career Guidance</h3>
        <p>Gain practical advice, insights, and lessons learned from experienced professionals.</p>
      </div>

      <div class="feature-card fade-in" style="animation-delay:0.35s">
        <div class="feature-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4"><path d="M12 3l7 3v6c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V6l7-3z"/></svg>
        </div>
        <h3>Secure &amp; Reliable Platform</h3>
        <p>A safe and organized system for managing alumni information and connections.</p>
      </div>

      <div class="feature-card fade-in" style="animation-delay:0.4s">
        <div class="feature-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4"><polygon points="12,2 14.9,9 22,9.3 16.5,14 18.2,21 12,17.2 5.8,21 7.5,14 2,9.3 9.1,9"/></svg>
        </div>
        <h3>Inspiration for Success</h3>
        <p>Learn from those who have already walked the path and achieved their goals.</p>
      </div>

    </div>

  </div>

  <!-- Closing CTA band -->
  <div class="about-cta fade-in" style="animation-delay:0.45s">
    <div class="gold-line"></div>
    <h3>Ready to find where you belong?</h3>
    <p>Explore stories from seniors who've walked the path before you.</p>
  </div>

</section>


<!-- -- Footer ------------------------------- -->
  
<?php
include "../Header_Footer/Footer.php";
?>

<script src="script.js"></script>

</body>
</html>