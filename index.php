<?php
// ================= TESTIMONIALS DATA =================
$testimonials = [
  [
    "name" => "Naledi M.",
    "role" => "Project Coordinator",
    "company" => "BrightPath",
    "message" => "Reliable, fast, and communicative. Our site went from idea to clean launch without the usual chaos.",
    "rating" => 5,
    "date" => "2026-02-10"
  ],
  [
    "name" => "Thabo K.",
    "role" => "Small Business Owner",
    "company" => "Kasi Mart",
    "message" => "The attention to detail was top-tier.",
    "rating" => 5,
    "date" => "2026-01-28"
  ],
  [
    "name" => "Ayesha D.",
    "role" => "Operations Lead",
    "company" => "Northwind Ops",
    "message" => "Great structure and a professional finish.",
    "rating" => 4,
    "date" => "2026-01-12"
  ]
];

function renderStars($rating){
    $out="";
    for($i=1;$i<=5;$i++){
        $out .= ($i <= $rating) ? "★" : "☆";
    }
    return $out;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>MAKE EDUCATION FASHIONABLE</title>

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:Arial;}
body{background:#f4f6f9;color:#333;line-height:1.6;}

/* ================= HEADER ================= */
header{
background:linear-gradient(90deg,#000,#3b3b98);
color:white;padding:15px 0;position:sticky;top:0;z-index:1000;
}

.container{width:90%;margin:auto;}

.nav-bar{
display:flex;justify-content:space-between;align-items:center;
}

/* LOGO LEFT */
.logo-area{
display:flex;align-items:center;gap:12px;
}

.logo-area img{
width:45px;
height:45px;
object-fit:contain;
}

/* TITLE */
.logo-text{
font-size:22px;
font-weight:bold;
color:#ffd32a; /* GOLD */
}

/* NAV */
nav ul{list-style:none;display:flex;}
nav ul li{margin-left:20px;}
nav ul li a{
color:white;text-decoration:none;font-weight:bold;
}
nav ul li a:hover{color:#ffd32a;}

/* ================= SECTIONS ================= */
section{padding:60px 0;}
h2{text-align:center;margin-bottom:25px;color:#3b3b98;}

/* GRID */
.grid{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
gap:20px;
}

.card{
background:white;padding:20px;border-radius:10px;
box-shadow:0 4px 10px rgba(0,0,0,0.1);
transition:0.3s;
}

.card:hover{
transform:translateY(-5px);
}

/* ================= SERVICES BG ================= */
#services{
background:
linear-gradient(rgba(0,0,0,0.75),rgba(0,0,0,0.75)),
url("images/services-bg.jpg") center/cover no-repeat;
color:white;
}

#services h2{color:#ffd32a;}
#services .card{
background:rgba(255,255,255,0.95);
color:#333;
}

/* ================= CONTACT ================= */
#contact{
background:
linear-gradient(rgba(255,255,255,0.9),rgba(255,255,255,0.9)),
url("images/contact-bg.jpg") center/cover no-repeat;
text-align:center;
}

#contact h2{
color:#3b3b98;
}

#contact a{
color:#c9a227; /* GOLD */
font-weight:bold;
text-decoration:none;
}

/* ================= HOME ================= */
#home{
text-align:center;
background:#222;
color:white;
padding:100px 20px;
position:relative;
overflow:hidden;
}

#home h1{
font-size:42px;
line-height:1.3;
position:relative;
display:inline-block;
}

/* ANIMATION */
.slide-left{
position:relative;
animation: slideLeft 2s ease forwards;
}

.slide-right{
position:relative;
animation: slideRight 2s ease forwards;
}

@keyframes slideLeft {
0% { left:-100%; opacity:0;}
100% { left:0; opacity:1;}
}

@keyframes slideRight {
0% { right:-100%; opacity:0;}
100% { right:0; opacity:1;}
}

/* ================= FOOTER ================= */
footer{
background:#000;color:white;text-align:center;
padding:25px;margin-top:40px;
}

footer a{color:#ffd32a;text-decoration:none;margin:0 10px;}
</style>
</head>

<body>

<!-- ================= HEADER ================= -->
<header>
<div class="container nav-bar">

<!-- LOGO + TITLE -->
<div class="logo-area">
<img src="images/logo.jpeg" alt="MEF Logo">
<div class="logo-text">MAKE EDUCATION FASHIONABLE</div>
</div>

<!-- NAV -->
<nav>
<ul>
<li><a href="#home">Home</a></li>
<li><a href="#services">Services</a></li>
<li><a href="#about">About</a></li>
<li><a href="#testimonials">Testimonials</a></li>
<li><a href="#contact">Contact</a></li>
</ul>
</nav>

</div>
</header>

<!-- ================= HOME ================= -->
<section id="home">
<h1>
<span class="slide-left" style="color:#ffd32a;">Empowering Minds</span>
<span class="slide-right" style="color:white;"> · Making Education Fashionable</span>
</h1>
</section>

<!-- ================= SERVICES ================= -->
<section id="services">
<div class="container">

<h2>MEF Services & Awards</h2>

<div class="grid">

<div class="card">
<h3>MEF Nominations</h3>
<p>Share your story and book a ticket to attend the MEF Awards & Convocation.</p>
<a href="https://www.quicket.co.za/events/346942-make-education-fashionable-convocation-2025/#/" target="_blank">
Book Ticket
</a>
</div>

<div class="card">
<h3>African Development Research Award</h3>
<p>Recognizes research contributing to African development.</p>
</div>

<div class="card">
<h3>AI Champion Award</h3>
<p>Honors leaders in AI innovation and advocacy.</p>
</div>

<div class="card">
<h3>Mamokgethi Phakeng Prize</h3>
<p>Honors a trailblazing woman breaking barriers.</p>
</div>

<div class="card">
<h3>Young Entrepreneur Award</h3>
<p>Celebrates youth building enterprises.</p>
</div>

<div class="card">
<h3>Youth in Agriculture Award</h3>
<p>Recognizes graduates transforming agriculture.</p>
</div>

</div>
</div>
</section>

<!-- ================= ABOUT ================= -->
<section id="about">
<div class="container">

<h2>About MEF</h2>

<p style="text-align:center;max-width:900px;margin:auto;">
MEF (Make Education Fashionable) is a social campaign founded by
<strong style="color:#c9a227;">Dr. Mamokgethi Phakeng</strong>.
Launched in 2015, it inspires people through real stories of graduates
who succeeded despite challenges.
</p>

</div>
</section>

<!-- ================= TESTIMONIALS ================= -->
<section id="testimonials">
<div class="container">

<h2>Testimonials</h2>

<div class="grid">
<?php foreach($testimonials as $t): ?>
<div class="card">
<div style="color:#c9a227;font-size:18px;">
<?php echo renderStars($t["rating"]); ?>
</div>
<p>“<?php echo $t["message"]; ?>”</p>
<strong><?php echo $t["name"]; ?></strong>
</div>
<?php endforeach; ?>
</div>

</div>
</section>

<!-- ================= CONTACT ================= -->
<section id="contact">
<div class="container">

<h2>Contact & Social Links</h2>

<p>
<a href="https://www.facebook.com/kgethi.phakeng/directory_links" target="_blank">
Facebook
</a> |
<a href="mailto:kgethi@perspicuty.africa">
Email
</a> |
<a href="https://www.quicket.co.za/events/346942-make-education-fashionable-convocation-2025/#/" target="_blank">
Quicket
</a>
</p>

<!-- LINKEDIN CARD -->
<div style="margin-top:30px;">
<a href="https://linkedin.com/in/mamokgethiphakeng" target="_blank"
   style="
   display:inline-block;
   background:#0077b5;
   color:white;
   padding:18px 28px;
   border-radius:12px;
   text-decoration:none;
   box-shadow:0 4px 10px rgba(0,0,0,0.2);
   ">
<h3 style="margin-bottom:5px;">LinkedIn</h3>
<p style="margin:0;">Mamokgethi Phakeng</p>
</a>
</div>

<!-- CONTACT IMAGE -->
<img src="images/2ndLogo.jpeg"
     alt="Contact MEF"
     style="width:220px;margin-top:20px;border-radius:12px;">

</div>
</section>

<!-- ================= FOOTER ================= -->
<footer>
<p>
&copy; <?php echo date("Y"); ?> MAKE EDUCATION FASHIONABLE.
All Rights Reserved.
</p>
</footer>

</body>
</html>
