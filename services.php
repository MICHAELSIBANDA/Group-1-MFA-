<?php
// Optional PHP logic area (for later use)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MEF Services · Awards & Tickets</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial, sans-serif;
            background: #f4f7fb;
            color: #1a2b3c;
            line-height: 1.5;
            padding: 2rem 1.5rem;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .main-wrapper {
            max-width: 1300px;
            width: 100%;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #0b2a4a;
            text-align: center;
            margin-bottom: 0.5rem;
            letter-spacing: -0.02em;
        }

        .subhead {
            text-align: center;
            color: #2c5f2d;
            font-weight: 500;
            margin-bottom: 3rem;
            border-bottom: 2px dashed #b0c9b0;
            padding-bottom: 1rem;
        }

        .section {
            margin-bottom: 4rem;
        }

        .section-title {
            font-size: 2rem;
            font-weight: 600;
            color: #1b4d3e;
            margin-bottom: 1.8rem;
            padding-left: 0.5rem;
            border-left: 8px solid #2a7f62;
            letter-spacing: -0.01em;
        }

        .cards-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 2rem;
        }

        .service-box {
            flex: 0 1 320px;            
            background: #ffffff;
            border-radius: 28px;
            padding: 2rem 1.5rem 1.8rem 1.5rem;
            box-shadow: 0 15px 30px -12px rgba(0, 40, 40, 0.2);
            transition: transform 0.25s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            border: 1px solid rgba(210, 225, 240, 0.6);
            backdrop-filter: blur(2px);
        }

        .service-box:hover {
            transform: translateY(-8px);
            box-shadow: 0 28px 40px -12px #0b2f4e33;
            border-color: #bcd9e2;
        }

        .service-box h3 {
            font-size: 1.5rem;
            font-weight: 650;
            color: #0b3b3c;
            margin-bottom: 1rem;
            line-height: 1.3;
        }

        .service-box p {
            color: #1f3a4c;
            font-size: 1rem;
            margin-bottom: 1.8rem;
            flex: 1;                  
        }

        .ticket-btn {
            display: inline-block;
            background: #0a3147;
            color: white;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            padding: 0.8rem 1.8rem;
            border-radius: 50px;
            text-align: center;
            transition: background 0.2s, transform 0.1s;
            box-shadow: 0 6px 12px rgba(9, 60, 80, 0.15);
            border: 1px solid #154c5e;
            letter-spacing: 0.3px;
            align-self: center;
            margin-top: 0.3rem;
            width: fit-content;
        }

        .ticket-btn:hover {
            background: #134b6b;
            transform: scale(1.02);
            box-shadow: 0 10px 20px rgba(5, 40, 60, 0.25);
            border-color: #2d7a9c;
        }

        .ticket-btn:active {
            transform: scale(0.98);
        }

        .nomination-highlight {
            background: linear-gradient(145deg, #ffffff, #f9fcff);
        }

        @media (max-width: 700px) {
            body { padding: 1.5rem 1rem; }
            h1 { font-size: 2.2rem; }
            .section-title { font-size: 1.8rem; }
            .service-box { flex: 0 1 100%; max-width: 420px; }
        }

        .footnote {
            margin-top: 3rem;
            text-align: center;
            font-size: 0.9rem;
            color: #3f627c;
            border-top: 1px solid #cbdae6;
            padding-top: 2rem;
        }
    </style>
</head>
<body>
<div class="main-wrapper">

    
    <h1> MEF Services </h1>
    <div class="subhead">celebrate · nominate · attend</div>

    
    <section class="section">
        <h2 class="section-title">MEF Nominations</h2>
        <div class="cards-container">
            <div class="service-box nomination-highlight">
                <p>
                    <strong style="font-size:1.2rem; color:#0a405a;">Share your story</strong><br><br>
                    An individual or participant writes their story and books a ticket 
                    to make reservations for the MEF Awards & Convocation.
                </p>
\                <a href="https://www.quicket.co.za/events/346942-make-education-fashionable-convocation-2025/#/" 
                   class="ticket-btn" 
                   target="_blank" 
                   rel="noopener noreferrer">
                    Book ticket
                </a>
            </div>
        </div>
    </section>

    <section class="section">
        <h2 class="section-title"> The Awards Categories</h2>
        <div class="cards-container">
            <div class="service-box">
                <h3>1. African Development Research Award</h3>
                <p>Recognizes research that contributes to African development in health, education, environment, governance, or technology.</p>
                <a href="https://www.quicket.co.za/events/346942-make-education-fashionable-convocation-2025/#/" 
                   class="ticket-btn" 
                   target="_blank" 
                   rel="noopener noreferrer">
                   Book ticket
                </a>
            </div>
            <div class="service-box">
                <h3>2. AI Champion Award</h3>
                <p>Recognizes individuals leading in AI innovation, adoption, and advocacy.</p>
                <a href="https://www.quicket.co.za/events/346942-make-education-fashionable-convocation-2025/#/" 
                   class="ticket-btn" 
                   target="_blank" 
                   rel="noopener noreferrer">
                 Book ticket
                </a>
            </div>
            <div class="service-box">
                <h3>3. Mamokgethi Phakeng Prize</h3>
                <p>Honors a trailblazing woman who breaks barriers and embodies courage in pursuit of excellence.</p>
                <a href="https://www.quicket.co.za/events/346942-make-education-fashionable-convocation-2025/#/" 
                   class="ticket-btn" 
                   target="_blank" 
                   rel="noopener noreferrer">
                    Book ticket
                </a>
            </div>
            <div class="service-box">
                <h3>4. Young Entrepreneur Award</h3>
                <p>Celebrates individuals building enterprises that create employment, drive transformation, and inspire others.</p>
                <a href="https://www.quicket.co.za/events/346942-make-education-fashionable-convocation-2025/#/" 
                   class="ticket-btn" 
                   target="_blank" 
                   rel="noopener noreferrer">
                    Book ticket
                </a>
            </div>
            <div class="service-box">
                <h3>5. Youth in Agriculture Award</h3>
                <p>Honors graduates transforming farming into a sustainable and aspirational field.</p>
                <a href="https://www.quicket.co.za/events/346942-make-education-fashionable-convocation-2025/#/" 
                   class="ticket-btn" 
                   target="_blank" 
                   rel="noopener noreferrer">
                    Book ticket
                </a>
            </div>
        </div>
    </section>

    

</div>

<?php

?>
</body>
</html>