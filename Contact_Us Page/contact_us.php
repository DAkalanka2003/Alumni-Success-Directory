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

<main class="contact-page" id="team">

    <div class="page-intro">
        <p class="section-label">The Builders</p>
        <h2 class="section-title">Meet <em>Our Team</em></h2>
        <div class="gold-line"></div>
        <p class="section-desc">Five students from the Department of Statistics &amp; Computer Science, working together to connect generations.</p>
    </div>

    <div class="directory-split">

        <!-- Team Directory ------------------------------------------------- -->
        <div class="team-directory">

            <div class="team-row fade-in" style="animation-delay:0.05s">
                <span class="team-index">01</span>
                <div class="team-avatar"><img src="Images/dinujaya.png" alt="dinujaya"></div>
                <div class="team-meta">
                    <div class="team-name">K. Dinujaya Akalanka</div>
                    <div class="team-role">Project Leader</div>
                </div>
            </div>

            <div class="team-row fade-in" style="animation-delay:0.1s">
                <span class="team-index">02</span>
                <div class="team-avatar"><img src="Images/upeksha.png" alt="upeksha"></div>
                <div class="team-meta">
                    <div class="team-name">Upeksha Mataraarachchi</div>
                    <div class="team-role">Team Member</div>
                </div>
            </div>

            <div class="team-row fade-in" style="animation-delay:0.15s">
                <span class="team-index">03</span>
                <div class="team-avatar"><img src="Images/avishka.jpeg" alt="avishka"></div>
                <div class="team-meta">
                    <div class="team-name">W.A.A.D. Rajapaksha</div>
                    <div class="team-role">Team Member</div>
                </div>
            </div>

            <div class="team-row fade-in" style="animation-delay:0.2s">
                <span class="team-index">04</span>
                <div class="team-avatar"><img src="Images/ishan.jpeg" alt="ishan"></div>
                <div class="team-meta">
                    <div class="team-name">A.H.I. Lakshitha</div>
                    <div class="team-role">Team Member</div>
                </div>
            </div>

            <div class="team-row fade-in" style="animation-delay:0.25s">
                <span class="team-index">05</span>
                <div class="team-avatar"><img src="Images/gimni.png" alt="gimni"></div>
                <div class="team-meta">
                    <div class="team-name">M.G.S. Thilakasiri</div>
                    <div class="team-role">Team Member</div>
                </div>
            </div>

        </div>

        <!-- Contact Card ------------------------------------------------- -->
        <aside class="contact-card fade-in" style="animation-delay:0.3s">
            <div class="contact-card-inner">

                <p class="contact-eyebrow">Get In Touch</p>
                <h1 class="contact-heading">Contact Us</h1>
                <p class="contact-sub">Any questions or remarks? Just write us a message!</p>

                <div class="contact-divider"></div>

                <div class="contact-row">
                    <div class="contact-icon"><img src="Images/whatsapp.webp" alt="Whatsapp"></div>
                    <div class="contact-detail">
                        <h4>WhatsApp</h4>
                        <p>+94 70455432</p>
                        <p>+94 75689876</p>
                    </div>
                </div>

                <div class="contact-row">
                    <div class="contact-icon"><img src="Images/location.png" alt="location"></div>
                    <div class="contact-detail">
                        <h4>Our Office</h4>
                        <p>University of Kelaniya</p>
                        <p>No. 218, Kandy Road, Dalugama, Kelaniya 11600, Sri Lanka.</p>
                    </div>
                </div>

            </div>
        </aside>

    </div>

</main>

<!-- -- Footer ------------------------------- -->
  
<?php
include "../Header_Footer/Footer.php";
?>

<script src="script.js"></script>

</body>
</html>