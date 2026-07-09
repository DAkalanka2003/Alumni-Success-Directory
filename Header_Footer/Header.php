<?php
    // Determine the current page filename so the matching nav link
    // can be marked active automatically, on every page, without
    // having to hand-edit a class on each Header.php include.
    $current_page = basename($_SERVER['PHP_SELF']);

    function nav_active($files, $current) {
        $files = is_array($files) ? $files : [$files];
        return in_array($current, $files, true) ? ' active' : '';
    }
?>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Lato:wght@400;700;900&display=swap" rel="stylesheet">
<style>
/* ==========================================================================
   Alumni Success Directory — Header & Footer
   Palette: near-black ground, warm gold accent, cream text — a quiet,
   certificate-and-seal register rather than a generic dark/gold gradient.
   ========================================================================== */

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

:root {
  --gold: #C9A84C;
  --gold-light: #E8C97A;
  --gold-dim: #8A7238;
  --gold-muted: #D4B896;
  --black: #0D0D0D;
  --near-black: #1A1209;
  --charcoal: #100C07;
  --warm-gray: #6B5E4A;
  --cream: #FAF6EE;

  --line: rgba(201, 168, 76, .16);
  --line-strong: rgba(201, 168, 76, .38);
  --glass: rgba(13, 13, 13, .72);
  --shadow-soft: 0 18px 40px rgba(0, 0, 0, .35);
  --shadow-strong: 0 24px 60px rgba(0, 0, 0, .5);
  --ease: cubic-bezier(.22, 1, .36, 1);
  --nav-h: 70px;
  --nav-h-scrolled: 58px;
}

html {
  scroll-behavior: smooth;
}

body {
  font-family: 'Lato', sans-serif;
  background-color: var(--near-black);
  color: var(--cream);
}

::selection {
  background: var(--gold);
  color: var(--black);
}

/* Slim gold scrollbar — WebKit + Firefox */
::-webkit-scrollbar { width: 10px; }
::-webkit-scrollbar-track { background: var(--black); }
::-webkit-scrollbar-thumb { background: var(--gold-dim); border-radius: 10px; border: 2px solid var(--black); }
* { scrollbar-width: thin; scrollbar-color: var(--gold-dim) var(--black); }

a:focus-visible,
button:focus-visible {
  outline: 1.5px solid var(--gold-light);
  outline-offset: 3px;
  border-radius: 2px;
}

/* --------------------------------------------------------------------------
   Signature motif — a hairline "certificate rule" with a centered diamond.
   Reused as the header's bottom edge and the footer's top edge, so the two
   ends of the page are visually bound together.
   -------------------------------------------------------------------------- */
.gold-rule {
  position: relative;
  height: 1px;
  background: linear-gradient(90deg, transparent, var(--line-strong) 18%, var(--gold) 50%, var(--line-strong) 82%, transparent);
}

.gold-rule::after {
  content: '';
  position: absolute;
  top: 50%;
  left: 50%;
  width: 6px;
  height: 6px;
  background: var(--gold);
  transform: translate(-50%, -50%) rotate(45deg);
  box-shadow: 0 0 10px rgba(201, 168, 76, .55);
}

/* ==========================================================================
   Header / Navigation
   ========================================================================== */

.site-header {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 300;
  background: rgba(13, 13, 13, .55);
  backdrop-filter: blur(6px);
  -webkit-backdrop-filter: blur(6px);
  border-bottom: 1px solid transparent;
  transition: background .4s var(--ease), backdrop-filter .4s var(--ease), box-shadow .4s var(--ease);
}

.site-header::after {
  content: '';
  position: absolute;
  left: 0;
  right: 0;
  bottom: -1px;
  height: 1px;
  background: linear-gradient(90deg, transparent, var(--line-strong) 18%, var(--gold) 50%, var(--line-strong) 82%, transparent);
  opacity: .7;
}

.site-header.scrolled {
  background: var(--glass);
  backdrop-filter: blur(16px);
  -webkit-backdrop-filter: blur(16px);
  box-shadow: var(--shadow-soft);
}

.site-header.scrolled .nav {
  height: var(--nav-h-scrolled);
}

.nav {
  height: var(--nav-h);
  max-width: 1400px;
  margin: 0 auto;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 40px;
  transition: height .35s var(--ease);
}

/* -- Brand -- */
.nav-brand {
  display: flex;
  align-items: center;
  gap: 12px;
  text-decoration: none;
}

.logo_1 {
  height: 44px;
  display: block;
  transition: filter .3s var(--ease);
}

.nav-brand:hover .logo_1 {
  filter: drop-shadow(0 0 6px rgba(201, 168, 76, .45));
}

.nav-logo {
  font-family: 'Playfair Display', serif;
  font-size: 1.15rem;
  color: var(--gold);
  letter-spacing: .06em;
  font-weight: 600;
  transition: color .3s var(--ease);
  white-space: nowrap;
}

.nav-brand:hover .nav-logo {
  color: var(--gold-light);
}

/* -- Links -- */
.nav-links {
  display: flex;
  align-items: center;
  gap: 4px;
  list-style: none;
}

.nav-link {
  position: relative;
  display: block;
  padding: 10px 14px;
  margin: 0 2px;
  font-size: .72rem;
  font-weight: 700;
  letter-spacing: .12em;
  text-transform: uppercase;
  color: var(--gold-muted);
  text-decoration: none;
  transition: color .3s var(--ease);
}

.nav-link::after {
  content: '';
  position: absolute;
  left: 50%;
  right: 50%;
  bottom: 4px;
  height: 1px;
  background: linear-gradient(90deg, var(--gold-light), var(--gold));
  transition: left .35s var(--ease), right .35s var(--ease);
}

.nav-link:hover,
.nav-link.active {
  color: var(--gold-light);
}

.nav-link:hover::after,
.nav-link.active::after {
  left: 14px;
  right: 14px;
}

.nav-link.active::before {
  content: '';
  position: absolute;
  top: 3px;
  left: 50%;
  width: 3px;
  height: 3px;
  background: var(--gold);
  transform: translateX(-50%) rotate(45deg);
}

/* -- Mobile toggle button (hidden on desktop) -- */
.nav-toggle {
  display: none;
  position: relative;
  width: 34px;
  height: 34px;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 6px;
  background: none;
  border: 0;
  cursor: pointer;
  z-index: 260;
}

.nav-toggle span {
  display: block;
  width: 20px;
  height: 1.5px;
  background: var(--gold);
  transition: transform .35s var(--ease), opacity .25s var(--ease);
}

.nav-toggle.open span:nth-child(1) { transform: translateY(7.5px) rotate(45deg); }
.nav-toggle.open span:nth-child(2) { opacity: 0; }
.nav-toggle.open span:nth-child(3) { transform: translateY(-7.5px) rotate(-45deg); }

/* -- Mobile drawer + scrim -- */
.nav-scrim {
  position: fixed;
  inset: 0;
  background: rgba(8, 8, 6, .6);
  backdrop-filter: blur(2px);
  opacity: 0;
  visibility: hidden;
  transition: opacity .35s var(--ease), visibility .35s var(--ease);
  z-index: 210;
}

.nav-scrim.open {
  opacity: 1;
  visibility: visible;
}

/* ==========================================================================
   Footer
   ========================================================================== */

.site-footer {
  background: var(--charcoal);
  position: relative;
  padding-top: 1px;
}

.footer-rule {
  max-width: 1400px;
  margin: 0 auto;
}

.footer-inner {
  max-width: 1400px;
  margin: 0 auto;
  padding: 56px 40px 32px;
  display: grid;
  grid-template-columns: 1.4fr 1fr 1fr;
  gap: 48px;
}

.footer-brand .footer-logo {
  font-family: 'Playfair Display', serif;
  font-size: 1.3rem;
  color: var(--gold);
  margin-bottom: 14px;
  letter-spacing: .04em;
}

.footer-tagline {
  font-size: .85rem;
  line-height: 1.7;
  color: var(--warm-gray);
  max-width: 34ch;
}

.footer-heading {
  font-family: 'Lato', sans-serif;
  font-size: .68rem;
  font-weight: 900;
  letter-spacing: .16em;
  text-transform: uppercase;
  color: var(--gold-muted);
  margin-bottom: 18px;
}

.footer-links {
  list-style: none;
  display: flex;
  flex-direction: column;
  gap: 11px;
}

.footer-links a {
  font-size: .85rem;
  color: var(--cream);
  opacity: .75;
  text-decoration: none;
  transition: opacity .3s var(--ease), color .3s var(--ease), padding-left .3s var(--ease);
}

.footer-links a:hover {
  opacity: 1;
  color: var(--gold-light);
  padding-left: 4px;
}

.footer-social {
  display: flex;
  gap: 12px;
}

.footer-social-link {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 38px;
  height: 38px;
  border: 1px solid var(--line-strong);
  border-radius: 50%;
  color: var(--gold-muted);
  transition: color .3s var(--ease), border-color .3s var(--ease), transform .3s var(--ease), box-shadow .3s var(--ease);
}

.footer-social-link svg {
  width: 16px;
  height: 16px;
}

.footer-social-link:hover {
  color: var(--gold-light);
  border-color: var(--gold);
  transform: translateY(-3px);
  box-shadow: 0 8px 20px rgba(201, 168, 76, .2);
}

.footer-bottom {
  text-align: center;
  padding: 0 40px 40px;
}

.footer-gold-line {
  width: 40px;
  height: 1px;
  background: var(--gold);
  margin: 0 auto 16px;
  opacity: .4;
}

.footer-text {
  font-size: .7rem;
  color: var(--warm-gray);
  letter-spacing: .05em;
  line-height: 1.5;
}

/* ==========================================================================
   Responsive
   ========================================================================== */

@media (max-width: 1080px) {
  .footer-inner {
    grid-template-columns: 1.2fr 1fr 1fr;
    gap: 32px;
  }
}

@media (max-width: 860px) {
  .nav {
    padding: 0 22px;
  }

  .nav-toggle {
    display: flex;
  }

  .nav-links {
    position: fixed;
    top: 0;
    right: 0;
    height: 100dvh;
    width: min(78vw, 320px);
    background: var(--near-black);
    border-left: 1px solid var(--line-strong);
    box-shadow: var(--shadow-strong);
    flex-direction: column;
    align-items: flex-start;
    justify-content: flex-start;
    gap: 2px;
    padding: 110px 30px 40px;
    transform: translateX(100%);
    transition: transform .45s var(--ease);
    z-index: 250;
    overflow-y: auto;
  }

  .nav-links.open {
    transform: none;
  }

  .nav-link {
    width: 100%;
    padding: 13px 4px;
    font-size: .78rem;
    border-bottom: 1px solid var(--line);
  }

  .nav-link::after {
    display: none;
  }

  .nav-link.active {
    color: var(--gold);
  }

  .nav-link.active::before {
    left: 0;
    top: 50%;
    transform: translateY(-50%) rotate(45deg);
  }

  .footer-inner {
    grid-template-columns: 1fr;
    gap: 36px;
    padding: 48px 26px 28px;
    text-align: left;
  }

  .footer-tagline {
    max-width: 100%;
  }
}

@media (max-width: 480px) {
  .nav-logo {
    font-size: 1rem;
  }

  .logo_1 {
    height: 36px;
  }
}

@media (prefers-reduced-motion: reduce) {
  * {
    animation: none !important;
    transition: none !important;
    scroll-behavior: auto !important;
  }
}
</style>

<header class="site-header" id="siteHeader">
    <nav class="nav">
        <a href="../Home Page/Home.php" class="nav-brand" aria-label="Alumni Success Directory — Home">
            <img class="logo_1" src="../Logo.png" alt="Alumni Success Directory Logo">
            <span class="nav-logo">Alumni Success Directory</span>
        </a>

        <ul class="nav-links" id="navLinks">
            <li><a href="../Home Page/Home.php" class="nav-link<?php echo nav_active('Home.php', $current_page); ?>">Home</a></li>
            <li><a href="../Directory/directory.php" class="nav-link<?php echo nav_active('directory.php', $current_page); ?>">Directory</a></li>
            <li><a href="../About Page/about.php" class="nav-link<?php echo nav_active('about.php', $current_page); ?>">About</a></li>
            <li><a href="../Login Page/login.php" class="nav-link<?php echo nav_active(['login.php', 'submit.php'], $current_page); ?>">Submit</a></li>
            <li><a href="../Contact_Us Page/contact_us.php" class="nav-link<?php echo nav_active('contact_us.php', $current_page); ?>">Contact Us</a></li>
        </ul>

        <button type="button" class="nav-toggle" id="navToggle" aria-label="Toggle navigation menu" aria-expanded="false" aria-controls="navLinks">
            <span></span><span></span><span></span>
        </button>
    </nav>
</header>
<div class="nav-scrim" id="navScrim"></div>