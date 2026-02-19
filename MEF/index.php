<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MEF · Make Education Fashionable</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        :root {
            --primary-dark: #0a192f;
            --primary-navy: #112240;
            --primary-light: #1a2f4f;
            
            --accent-gold: #ffd700;
            --accent-gold-light: #ffed4e;
            --accent-gold-dark: #e6c200;
            
            --accent-teal: #2dd4bf;
            --accent-teal-light: #5eead4;
            --accent-teal-dark: #14b8a6;
            
            --accent-purple: #a78bfa;
            --accent-purple-light: #c4b5fd;
            --accent-purple-dark: #8b5cf6;
            
            --accent-coral: #fb7185;
            --accent-coral-light: #fda4af;
            --accent-coral-dark: #f43f5e;
            
            --text-light: #f0f4fa;
            --text-muted: #94a3b8;
            --text-dark: #1e293b;
            
            --shadow-sm: 0 4px 6px rgba(0,0,0,0.1);
            --shadow-md: 0 10px 25px rgba(0,0,0,0.15);
            --shadow-lg: 0 20px 40px rgba(0,0,0,0.2);
            --shadow-xl: 0 30px 60px rgba(0,0,0,0.25);
            
            --radius-sm: 8px;
            --radius-md: 16px;
            --radius-lg: 24px;
            --radius-xl: 32px;
            --radius-full: 9999px;

            --transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, Roboto, sans-serif;
            color: var(--text-light);
            line-height: 1.7;
            background: var(--primary-dark);
        }

        a { color: inherit; text-decoration: none; }

        /* FIXED NAVBAR */
        .fixed-nav {
            position: fixed;
            top: 0; left: 0;
            width: 100%;
            background: rgba(10, 25, 47, 0.92);
            backdrop-filter: blur(12px);
            border-bottom: 2px solid var(--accent-gold);
            padding: 1rem 3.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            z-index: 1000;
            transition: var(--transition);
        }

        .fixed-nav.scrolled {
            padding: 0.8rem 3.5rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.4);
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: 1.4rem;
        }

        /* logo is now clickable */
        .logo-link {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .logo {
            width: 58px;
            height: 58px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--accent-gold);
            box-shadow: 0 0 25px rgba(255,215,0,0.35);
            transition: var(--transition);
        }

        .logo:hover {
            transform: scale(1.12) rotate(8deg);
            box-shadow: 0 0 40px rgba(255,215,0,0.6);
        }

        .brand-text .brand {
            font-size: 1.9rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--accent-gold), var(--accent-teal));
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .brand-sub {
            font-size: 0.88rem;
            color: var(--text-muted);
            letter-spacing: 1.2px;
        }

        .nav-links {
            display: flex;
            gap: 1.8rem;
        }

        .nav-links a {
            font-weight: 600;
            padding: 0.7rem 1.6rem;
            border-radius: var(--radius-full);
            background: rgba(255,255,255,0.06);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: 0; left: 50%;
            width: 0; height: 3px;
            background: var(--accent-gold);
            transition: var(--transition);
            transform: translateX(-50%);
        }

        .nav-links a:hover::after,
        .nav-links a.active::after { width: 70%; }

        .nav-links a:hover,
        .nav-links a.active {
            background: rgba(255,215,0,0.18);
            color: var(--accent-gold-light);
            transform: translateY(-2px);
        }

        .menu-toggle {
            display: none;
            font-size: 1.9rem;
            color: var(--accent-gold);
            cursor: pointer;
        }

        /* HOME */
        #home {
            min-height: 100vh;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 2rem;
            overflow: hidden;
        }

        .home-bg {
            position: absolute;
            inset: 0;
            object-fit: cover;
            width: 100%;
            height: 100%;
            filter: brightness(0.38) contrast(1.15);
            z-index: -2;
        }

        .home-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(10,25,47,0.65), rgba(10,25,47,0.85));
            z-index: -1;
        }

        .home-content {
            max-width: 960px;
            position: relative;
            z-index: 2;
            animation: fadeInUp 1.2s ease-out;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(50px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .home-content h1 {
            font-size: 4.6rem;
            font-weight: 800;
            margin-bottom: 1.6rem;
            background: linear-gradient(135deg, var(--accent-gold), var(--accent-teal), var(--accent-purple));
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 8px 32px rgba(0,0,0,0.5);
        }

        .home-content p {
            font-size: 1.35rem;
            max-width: 720px;
            margin: 0 auto 2.5rem;
            color: var(--text-light);
            opacity: 0.95;
        }

        .home-buttons {
            display: flex;
            gap: 1.8rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 1.1rem 2.8rem;
            border-radius: var(--radius-full);
            font-weight: 700;
            font-size: 1.15rem;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: var(--shadow-md);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--accent-gold), var(--accent-gold-dark));
            color: var(--primary-dark);
        }

        .btn-primary:hover {
            transform: translateY(-6px) scale(1.04);
            box-shadow: 0 20px 40px rgba(255,215,0,0.4);
        }

        .btn-secondary {
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(8px);
            border: 2px solid var(--accent-gold);
            color: var(--accent-gold-light);
        }

        .btn-secondary:hover {
            background: var(--accent-gold);
            color: var(--primary-dark);
            border-color: transparent;
            transform: translateY(-6px) scale(1.04);
            box-shadow: 0 20px 40px rgba(255,215,0,0.35);
        }

        /* SECTIONS */
        .section { padding: 7rem 3rem; }
        .section-container { max-width: 1240px; margin: 0 auto; }

        .section-title {
            text-align: center;
            font-size: 3rem;
            margin-bottom: 4rem;
            position: relative;
            display: inline-block;
        }

        .section-title:after {
            content: '';
            position: absolute;
            bottom: -18px;
            left: 50%;
            transform: translateX(-50%);
            width: 140px;
            height: 5px;
            background: linear-gradient(90deg, var(--accent-gold), var(--accent-teal), var(--accent-purple));
            border-radius: 3px;
        }

        /* ABOUT */
        #about {
            background: linear-gradient(160deg, var(--primary-dark) 0%, var(--primary-navy) 100%);
        }

        .about-content {
            background: rgba(255,255,255,0.04);
            backdrop-filter: blur(12px);
            border-radius: var(--radius-xl);
            padding: 3.5rem;
            border: 1px solid rgba(255,215,0,0.14);
            box-shadow: var(--shadow-xl);
        }

        .about-text p {
            color: var(--text-muted);
            font-size: 1.15rem;
            margin-bottom: 1.6rem;
        }

        .about-text strong { color: var(--accent-gold); }

        .about-text h3 {
            color: var(--accent-teal);
            font-size: 1.8rem;
            margin: 2rem 0 1rem;
        }

        .about-text ul {
            list-style: none;
            margin: 1rem 0;
        }

        .about-text li {
            margin: 1rem 0;
            padding-left: 2rem;
            position: relative;
            color: var(--text-muted);
        }

        .about-text li:before {
            content: '→';
            color: var(--accent-gold);
            position: absolute;
            left: 0;
            font-weight: bold;
        }

        .highlight-box {
            background: linear-gradient(135deg, rgba(255,215,0,0.12), rgba(45,212,191,0.12));
            padding: 2.2rem;
            border-radius: var(--radius-lg);
            margin: 2.5rem 0;
            border-left: 5px solid var(--accent-gold);
            font-style: italic;
        }

        /* ===== REBRANDED SERVICES SECTION - WITH 6TH BOX + TICKET LINK ===== */
        #services {
            background: linear-gradient(135deg, var(--primary-light), var(--primary-navy));
            position: relative;
            overflow: hidden;
        }

        #services::before {
            content: '';
            position: absolute;
            top: -20%;
            right: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(45,212,191,0.1) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        #services::after {
            content: '';
            position: absolute;
            bottom: -20%;
            left: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(167,139,250,0.1) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .services-intro {
            text-align: center;
            max-width: 800px;
            margin: 0 auto 4rem;
        }

        .services-intro h3 {
            font-size: 2.2rem;
            color: var(--accent-gold);
            margin-bottom: 1rem;
        }

        .services-intro p {
            color: var(--text-muted);
            font-size: 1.2rem;
        }

        /* Founder Showcase - Text on Right, Photo on Left */
        .founder-showcase {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            margin-bottom: 5rem;
            align-items: center;
        }

        .founder-image-frame {
            position: relative;
            width: 100%;
            height: 500px;
            border-radius: 20px;
            overflow: hidden;
            border: 5px solid var(--accent-gold);
            box-shadow: 0 0 30px rgba(255,215,0,0.3);
            transition: var(--transition);
        }

        .founder-image-frame:hover {
            transform: scale(1.02);
            border-color: var(--accent-teal);
            box-shadow: 0 0 50px rgba(45,212,191,0.4);
        }

        .founder-image-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .founder-image-frame:hover img {
            transform: scale(1.05);
        }

        .founder-content {
            background: rgba(255,255,255,0.03);
            backdrop-filter: blur(10px);
            border-radius: var(--radius-xl);
            padding: 3rem;
            border: 1px solid rgba(255,215,0,0.15);
            box-shadow: var(--shadow-xl);
            transition: var(--transition);
        }

        .founder-content:hover {
            transform: translateY(-10px);
            box-shadow: 0 30px 60px rgba(0,0,0,0.4);
            border-color: var(--accent-gold);
        }

        .founder-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--accent-gold), var(--accent-coral));
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
            color: var(--primary-dark);
            margin-bottom: 2rem;
            transition: var(--transition);
        }

        .founder-content:hover .founder-icon {
            transform: rotate(10deg) scale(1.1);
        }

        .founder-content h4 {
            font-size: 2.2rem;
            color: var(--accent-gold);
            margin-bottom: 1.5rem;
        }

        .founder-content p {
            color: var(--text-muted);
            font-size: 1.1rem;
            margin-bottom: 2rem;
            line-height: 1.8;
        }

        .founder-quote {
            font-style: italic;
            font-size: 1.2rem;
            color: var(--accent-teal-light);
            padding: 1.5rem;
            border-left: 4px solid var(--accent-gold);
            background: rgba(255,255,255,0.02);
            border-radius: 0 var(--radius-lg) var(--radius-lg) 0;
        }

        /* Award Categories - Reimagined (now 6 items) */
        .categories-title {
            text-align: center;
            margin: 5rem 0 3rem;
        }

        .categories-title h3 {
            font-size: 2.5rem;
            color: var(--accent-gold);
            margin-bottom: 1rem;
            position: relative;
            display: inline-block;
        }

        .categories-title h3:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 25%;
            width: 50%;
            height: 4px;
            background: linear-gradient(90deg, var(--accent-teal), var(--accent-purple));
            border-radius: 2px;
        }

        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2.5rem;
        }

        .category-card {
            background: rgba(255,255,255,0.03);
            backdrop-filter: blur(12px);
            border-radius: var(--radius-lg);
            padding: 2.5rem 2rem;
            border: 1px solid rgba(255,255,255,0.05);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            z-index: 2;
        }

        .category-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--accent-teal), var(--accent-purple));
            opacity: 0;
            transition: var(--transition);
            z-index: -1;
        }

        .category-card:hover::before {
            opacity: 0.15;
        }

        .category-card:hover {
            transform: translateY(-15px) scale(1.02);
            border-color: var(--accent-gold);
            box-shadow: 0 30px 50px rgba(0,0,0,0.4);
        }

        .category-icon-wrapper {
            width: 80px;
            height: 80px;
            background: rgba(255,255,255,0.05);
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.8rem;
            transition: var(--transition);
        }

        .category-card:hover .category-icon-wrapper {
            background: var(--accent-gold);
            border-radius: 50%;
            transform: rotate(360deg);
        }

        .category-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--accent-teal), var(--accent-purple));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: white;
            transition: var(--transition);
        }

        .category-card:hover .category-icon {
            background: var(--primary-dark);
            color: var(--accent-gold);
            transform: scale(1.1);
        }

        .category-card h4 {
            font-size: 1.4rem;
            color: var(--accent-gold);
            margin-bottom: 1rem;
        }

        .category-card p {
            color: var(--text-muted);
            margin-bottom: 1.5rem;
            line-height: 1.7;
        }

        .category-tag {
            display: inline-block;
            background: rgba(255,215,0,0.1);
            color: var(--accent-gold-light);
            padding: 0.4rem 1.2rem;
            border-radius: var(--radius-full);
            font-size: 0.9rem;
            border: 1px solid rgba(255,215,0,0.3);
            transition: var(--transition);
        }

        .category-card:hover .category-tag {
            background: var(--accent-gold);
            color: var(--primary-dark);
            border-color: var(--accent-gold);
        }

        /* nomination CTA unchanged */
        .nomination-cta {
            margin-top: 5rem;
            text-align: center;
            background: linear-gradient(135deg, rgba(45,212,191,0.1), rgba(167,139,250,0.1));
            padding: 4rem;
            border-radius: var(--radius-xl);
            border: 1px solid rgba(255,215,0,0.2);
        }

        .nomination-cta h3 {
            font-size: 2.2rem;
            color: var(--accent-gold);
            margin-bottom: 1rem;
        }

        .nomination-cta p {
            color: var(--text-muted);
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto 2.5rem;
        }

        .cta-button {
            display: inline-flex;
            align-items: center;
            gap: 1rem;
            background: linear-gradient(135deg, var(--accent-gold), var(--accent-gold-dark));
            color: var(--primary-dark);
            padding: 1.2rem 3.5rem;
            border-radius: var(--radius-full);
            font-weight: 700;
            font-size: 1.2rem;
            transition: var(--transition);
            box-shadow: var(--shadow-xl);
        }

        .cta-button:hover {
            transform: translateY(-8px) scale(1.05);
            box-shadow: 0 30px 50px rgba(255,215,0,0.4);
        }

        .cta-button i {
            transition: var(--transition);
        }

        .cta-button:hover i {
            transform: translateX(5px) rotate(10deg);
        }

        /* TESTIMONIALS (renamed to testimonies) */
        #testimonials {
            background: linear-gradient(135deg, var(--primary-navy), var(--primary-dark));
        }

        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .testimonial-card {
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(12px);
            padding: 2.4rem;
            border-radius: var(--radius-lg);
            border: 1px solid rgba(251,113,133,0.25);
            transition: var(--transition);
        }

        .testimonial-card:hover {
            transform: translateY(-10px);
            border-color: var(--accent-coral);
            box-shadow: var(--shadow-lg);
        }

        .testimonial-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .stars { color: var(--accent-gold); font-size: 1.4rem; }

        .date { color: var(--text-muted); font-size: 0.9rem; }

        .testimonial-message {
            font-style: italic;
            margin: 1.5rem 0;
            line-height: 1.8;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .author-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--accent-coral);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        /* CONTACT */
        #contact {
            background: linear-gradient(135deg, var(--primary-light), var(--primary-navy));
        }

        .contact-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 3.5rem;
        }

        .contact-info, .contact-form {
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(12px);
            padding: 2.5rem;
            border-radius: var(--radius-lg);
            border: 1px solid rgba(167,139,250,0.3);
        }

        .contact-info h3 { color: var(--accent-purple); margin-bottom: 2rem; }

        .info-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
            color: var(--text-muted);
        }

        .info-item i {
            width: 45px;
            height: 45px;
            background: rgba(167,139,250,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent-purple);
            font-size: 1.3rem;
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
            flex-wrap: wrap;
        }

        .social-link {
            width: 58px;
            height: 58px;
            background: rgba(255,255,255,0.08);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.7rem;
            transition: var(--transition);
            border: 1px solid rgba(255,255,255,0.15);
        }

        .social-link:hover {
            background: var(--accent-gold);
            color: var(--primary-dark);
            transform: translateY(-8px) scale(1.15);
            box-shadow: 0 15px 30px rgba(255,215,0,0.35);
        }

        .form-group { margin-bottom: 1.5rem; }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 1rem;
            background: rgba(255,255,255,0.1);
            border: 2px solid transparent;
            border-radius: var(--radius-md);
            color: var(--text-light);
            font-size: 1rem;
            transition: all 0.3s;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--accent-teal);
            background: rgba(255,255,255,0.15);
        }

        .form-group textarea { min-height: 150px; resize: vertical; }

        .submit-btn {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, var(--accent-teal), var(--accent-purple));
            border: none;
            border-radius: var(--radius-md);
            color: white;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        /* FOOTER */
        footer {
            background: var(--primary-dark);
            padding: 4rem 2rem 2rem;
            border-top: 4px solid var(--accent-gold);
            color: var(--text-muted);
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-main {
            display: grid;
            grid-template-columns: 2fr 1fr 1.5fr;
            gap: 3rem;
            margin-bottom: 3rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid rgba(255,215,0,0.15);
        }

        .footer-about h4,
        .footer-quick h4,
        .footer-social h4 {
            color: var(--accent-gold);
            font-size: 1.3rem;
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 0.8rem;
        }

        .footer-about h4:after,
        .footer-quick h4:after,
        .footer-social h4:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: linear-gradient(90deg, var(--accent-gold), var(--accent-teal));
            border-radius: 2px;
        }

        .footer-about p {
            color: var(--text-muted);
            line-height: 1.8;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
        }

        .footer-about .brand-small {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .footer-about .brand-small i {
            color: var(--accent-gold);
            font-size: 1.2rem;
        }

        .footer-about .brand-small span {
            font-weight: 600;
            background: linear-gradient(135deg, var(--accent-gold), var(--accent-teal));
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .footer-quick ul {
            list-style: none;
        }

        .footer-quick li {
            margin-bottom: 1rem;
        }

        .footer-quick a {
            color: var(--text-muted);
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .footer-quick a:hover {
            color: var(--accent-gold);
            transform: translateX(8px);
        }

        .footer-quick a i {
            font-size: 0.8rem;
            opacity: 0;
            transition: var(--transition);
        }

        .footer-quick a:hover i {
            opacity: 1;
            transform: translateX(3px);
        }

        .footer-social-grid {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .footer-social-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: var(--text-muted);
            transition: var(--transition);
        }

        .footer-social-item:hover {
            color: var(--accent-gold);
            transform: translateX(8px);
        }

        .footer-social-item i {
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            transition: var(--transition);
        }

        .footer-social-item:hover i {
            background: var(--accent-gold);
            color: var(--primary-dark);
            transform: rotate(360deg);
        }

        .footer-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 2rem;
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        .footer-bottom-links {
            display: flex;
            gap: 2rem;
        }

        .footer-bottom-links a {
            color: var(--text-muted);
            transition: var(--transition);
        }

        .footer-bottom-links a:hover {
            color: var(--accent-gold);
        }

        /* RESPONSIVE */
        @media (max-width: 968px) {
            .contact-grid { grid-template-columns: 1fr; }
            .home-content h1 { font-size: 3.6rem; }
            .founder-showcase { grid-template-columns: 1fr; }
            .founder-image-frame { height: 400px; }
            .footer-main { grid-template-columns: 1fr; gap: 2rem; }
            .footer-bottom { flex-direction: column; gap: 1rem; text-align: center; }
        }

        @media (max-width: 768px) {
            .fixed-nav { padding: 1rem 1.5rem; }
            .menu-toggle { display: block; }
            .nav-links {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                width: 100%;
                background: var(--primary-dark);
                flex-direction: column;
                padding: 1.5rem;
            }
            .nav-links.active { display: flex; }
            .section { padding: 5rem 1.5rem; }
            .home-content h1 { font-size: 2.8rem; }
            .home-buttons { flex-direction: column; gap: 1.2rem; }
            .nomination-cta { padding: 2rem; }
            .footer-bottom-links { flex-wrap: wrap; justify-content: center; }
        }

        /* Simple success popup styling - white background, dark text */
        .popup-success {
            position: fixed;
            top: 30%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #ffffff;  /* clean white */
            color: #0a192f;       /* primary dark for contrast */
            padding: 1.5rem 3rem;
            border-radius: var(--radius-lg);
            font-weight: 700;
            font-size: 1.5rem;
            box-shadow: var(--shadow-xl);
            z-index: 2000;
            border: 3px solid var(--accent-gold);
            text-align: center;
            animation: fadePop 0.3s ease;
        }
        @keyframes fadePop {
            0% { opacity: 0; transform: translate(-50%, -30%); }
            100% { opacity: 1; transform: translate(-50%, -50%); }
        }
    </style>
</head>
<body>

    <!-- NAVBAR with clickable logo -->
    <nav class="fixed-nav">
        <div class="nav-left">
            <!-- Logo wrapped in clickable element -->
            <a href="#home" class="logo-link">
                <img src="logo.jpeg" alt="MEF Logo" class="logo">
            </a>
            <div class="brand-text">
                <span class="brand-sub">Make Education Fashionable</span>
            </div>
        </div>
        
        <div class="menu-toggle"><i class="fas fa-bars"></i></div>

        <div class="nav-links">
            <a href="#home" class="active">Home</a>
            <a href="#about">About</a>
            <a href="#services">Services</a>
            <a href="#testimonials">Testimonies</a>   <!-- renamed from Stories to Testimonies -->
            <a href="#contact">Contact</a>
        </div>
    </nav>

    <main class="content">

        <!-- HOME with graduates.jpeg background -->
        <section id="home">
            <img src="graduates.jpg" alt="MEF Background - Graduates" class="home-bg">   <!-- updated photo -->
            <div class="home-overlay"></div>
            
            <div class="home-content">
                <h1>Make Education Fashionable</h1>
                <p>Transforming education through inspiration, leadership, and real stories of triumph. Join the movement started by Prof. Mamokgethi Phakeng to celebrate learning and impact.</p>
                <div class="home-buttons">
                    <a href="#about" class="btn btn-primary">Learn More</a>
                    <a href="#contact" class="btn btn-secondary">Get in Touch</a>
                </div>
            </div>
        </section>

        <!-- ABOUT (unchanged) -->
        <section id="about" class="section">
            <div class="section-container">
                <h2 class="section-title">About MEF</h2>
                
                <div class="about-content">
                    <div class="about-text">
                        <p><strong>MEF (Make Education Fashionable)</strong> is a powerful social media campaign founded by <strong>Prof. Mamokgethi Phakeng</strong> (@fabacademic), one of South Africa's most distinguished academics and businesswomen.</p>

                        <p>Launched in <strong>2015</strong>, the campaign inspires people by sharing authentic stories of individuals who have earned post-school qualifications and used them to overcome challenges and transform their lives.</p>

                        <div class="highlight-box">
                            <p>“The main purpose of the campaign is to inspire through stories of victory — stories of those who succeeded despite challenges and whose qualifications changed their lives.”</p>
                        </div>

                        <h3>Campaign Impact</h3>
                        <ul>
                            <li>Participants have secured job opportunities</li>
                            <li>Many have found collaborators and built partnerships</li>
                            <li>It creates visibility and recognition for graduates</li>
                            <li>Brings positivity to social media spaces often filled with negativity</li>
                        </ul>

                        <h3>How to Participate</h3>
                        <ul>
                            <li>Post your graduation picture</li>
                            <li>Mention your qualification and institution</li>
                            <li>Share your personal story of victory with <b>#MakeEducationFashionable</b></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- SERVICES with 6 boxes (added 6th - Convocation with ticket link) -->
        <section id="services" class="section">
            <div class="section-container">
                <h2 class="section-title">Our Services & Awards</h2>
                
                <div class="services-intro">
                    <h3>Celebrating Excellence in Education</h3>
                    <p>MEF provides platforms for recognition, inspiration, and connection through our awards and nomination services.</p>
                </div>

                <!-- Founder Showcase -->
                <div class="founder-showcase">
                    <div class="founder-image-frame">
                        <img src="founder.jpeg" alt="Prof. Mamokgethi Phakeng - Founder of MEF">
                    </div>
                    <div class="founder-content">
                        <div class="founder-icon"><i class="fas fa-star"></i></div>
                        <h4>MEF Awards Program</h4>
                        <p>An annual celebration honoring individuals who have made significant contributions to education and community development across Africa. Founded by Prof. Mamokgethi Phakeng, this program recognizes excellence and inspires the next generation of leaders.</p>
                        <div class="founder-quote">
                            "Every story of victory deserves to be celebrated. Through MEF, we shine a light on those who have transformed their lives through education."
                        </div>
                        <ul class="showcase-features" style="list-style: none; margin: 2rem 0;">
                            <li style="margin: 1rem 0; padding-left: 2rem; position: relative; color: var(--text-muted);"><span style="content: '✓'; color: var(--accent-teal); position: absolute; left: 0; font-weight: bold; font-size: 1.3rem;">✓</span>5 prestigious award categories</li>
                            <li style="margin: 1rem 0; padding-left: 2rem; position: relative; color: var(--text-muted);"><span style="content: '✓'; color: var(--accent-teal); position: absolute; left: 0; font-weight: bold; font-size: 1.3rem;">✓</span>Open nominations across the continent</li>
                            <li style="margin: 1rem 0; padding-left: 2rem; position: relative; color: var(--text-muted);"><span style="content: '✓'; color: var(--accent-teal); position: absolute; left: 0; font-weight: bold; font-size: 1.3rem;">✓</span>Independent judging panel</li>
                            <li style="margin: 1rem 0; padding-left: 2rem; position: relative; color: var(--text-muted);"><span style="content: '✓'; color: var(--accent-teal); position: absolute; left: 0; font-weight: bold; font-size: 1.3rem;">✓</span>Recognition ceremony and media coverage</li>
                        </ul>
                        <div class="showcase-stats" style="display: flex; gap: 2rem; margin-top: 2rem;">
                            <div class="stat-item" style="text-align: center;"><div class="stat-number" style="font-size: 2.5rem; font-weight: 800; color: var(--accent-gold); line-height: 1;">100+</div><div class="stat-label" style="color: var(--text-muted); font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px;">Nominees</div></div>
                            <div class="stat-item" style="text-align: center;"><div class="stat-number" style="font-size: 2.5rem; font-weight: 800; color: var(--accent-gold); line-height: 1;">15</div><div class="stat-label" style="color: var(--text-muted); font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px;">Winners</div></div>
                            <div class="stat-item" style="text-align: center;"><div class="stat-number" style="font-size: 2.5rem; font-weight: 800; color: var(--accent-gold); line-height: 1;">4</div><div class="stat-label" style="color: var(--text-muted); font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px;">Countries</div></div>
                        </div>
                    </div>
                </div>

                <!-- Award Categories Title -->
                <div class="categories-title">
                    <h3>Award Categories & Events</h3>
                    <p>Six impactful ways to engage with MEF</p>
                </div>

                <!-- 6 BOXES (original 5 + new 6th with ticket link) -->
                <div class="categories-grid">
                    <!-- 1. African Development Research Award -->
                    <div class="category-card">
                        <div class="category-icon-wrapper"><div class="category-icon"><i class="fas fa-globe-africa"></i></div></div>
                        <h4>African Development Research Award</h4>
                        <p>Recognizes groundbreaking research that contributes meaningfully to African development, innovation, and sustainable solutions.</p>
                        <span class="category-tag">Research</span>
                    </div>
                    <!-- 2. AI Champion Award -->
                    <div class="category-card">
                        <div class="category-icon-wrapper"><div class="category-icon"><i class="fas fa-robot"></i></div></div>
                        <h4>AI Champion Award</h4>
                        <p>Honors visionary leaders in artificial intelligence who are driving innovation, ethical AI practices, and advocacy across the continent.</p>
                        <span class="category-tag">Innovation</span>
                    </div>
                    <!-- 3. Mamokgethi Phakeng Prize -->
                    <div class="category-card">
                        <div class="category-icon-wrapper"><div class="category-icon"><i class="fas fa-female"></i></div></div>
                        <h4>Mamokgethi Phakeng Prize</h4>
                        <p>Celebrates a trailblazing woman who breaks barriers, inspires change, and creates pathways for future generations in her field.</p>
                        <span class="category-tag">Leadership</span>
                    </div>
                    <!-- 4. Young Entrepreneur Award -->
                    <div class="category-card">
                        <div class="category-icon-wrapper"><div class="category-icon"><i class="fas fa-briefcase"></i></div></div>
                        <h4>Young Entrepreneur Award</h4>
                        <p>Recognizes dynamic young founders building innovative enterprises, creating employment, and driving economic growth.</p>
                        <span class="category-tag">Business</span>
                    </div>
                    <!-- 5. Youth in Agriculture Award -->
                    <div class="category-card">
                        <div class="category-icon-wrapper"><div class="category-icon"><i class="fas fa-seedling"></i></div></div>
                        <h4>Youth in Agriculture Award</h4>
                        <p>Honors young graduates transforming agriculture through innovation, sustainability, and modern farming practices.</p>
                        <span class="category-tag">Agriculture</span>
                    </div>
                    <!-- 6. NEW: MEF Convocation 2025 with ticket link -->
                    <div class="category-card">
                        <div class="category-icon-wrapper"><div class="category-icon"><i class="fas fa-ticket-alt"></i></div></div>
                        <h4>MEF Convocation 2025</h4>
                        <p>Join the flagship event celebrating educational achievements. Network with leaders, share stories, and be inspired.</p>
                        <a href="https://www.quicket.co.za/events/346942-make-education-fashionable-convocation-2025/#/" target="_blank" class="category-tag" style="background: var(--accent-gold); color: var(--primary-dark); border: none; padding: 0.7rem 1.8rem; font-weight: 700; display: inline-flex; align-items: center; gap: 0.5rem; margin-top: 0.5rem;">Get Tickets <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>

                <!-- Nomination CTA -->
                <div class="nomination-cta">
                    <h3>Ready to Share Your Story?</h3>
                    <p>Nominate yourself or someone inspiring for the MEF Awards. Every story of victory deserves to be celebrated.</p>
                    <a href="https://forms.gle/VhF17yFSkCF4RXAs7" class="cta-button" target="_blank">
                        <span></span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </section>

        <!-- TESTIMONIES (renamed from Stories) -->
        <section id="testimonials" class="section">
            <div class="section-container">
                <h2 class="section-title">Testimonies</h2>   <!-- title changed -->
                
                <div class="testimonials-grid">
                    <div class="testimonial-card">
                        <div class="testimonial-header">
                            <div class="stars">★★★★★</div>
                            <div class="date">Dec 2025</div>
                        </div>
                        <p class="testimonial-message">“MEF gave my story a platform — I went from feeling invisible to inspiring thousands. Thank you for making education fashionable again!”</p>
                        <div class="testimonial-author">
                            <div class="author-avatar">N</div>
                            <div>
                                <div style="font-weight:600;">Nomfundo</div>
                                <div style="color:var(--text-muted);font-size:0.9rem;">BCom Graduate • Johannesburg</div>
                            </div>
                        </div>
                    </div>

                    <div class="testimonial-card">
                        <div class="testimonial-header">
                            <div class="stars">★★★★★</div>
                            <div class="date">Nov 2025</div>
                        </div>
                        <p class="testimonial-message">“After sharing my journey in agriculture, I connected with investors. MEF truly changes lives.”</p>
                        <div class="testimonial-author">
                            <div class="author-avatar">T</div>
                            <div>
                                <div style="font-weight:600;">Thabo</div>
                                <div style="color:var(--text-muted);font-size:0.9rem;">BSc Agric • Limpopo</div>
                            </div>
                        </div>
                    </div>

                    <div class="testimonial-card">
                        <div class="testimonial-header">
                            <div class="stars">★★★★★</div>
                            <div class="date">Oct 2025</div>
                        </div>
                        <p class="testimonial-message">“Winning the Young Entrepreneur Award opened doors I never imagined. MEF is truly life-changing.”</p>
                        <div class="testimonial-author">
                            <div class="author-avatar">K</div>
                            <div>
                                <div style="font-weight:600;">Kabelo</div>
                                <div style="color:var(--text-muted);font-size:0.9rem;">Tech Founder • Cape Town</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CONTACT with popup on submit (white popup) -->
        <section id="contact" class="section">
            <div class="section-container">
                <h2 class="section-title">Get in Touch</h2>
                
                <div class="contact-grid">
                    <div class="contact-info">
                        <h3>Connect With Us</h3>
                        
                        <div class="info-item">
                            <i class="fas fa-envelope"></i>
                            <div>
                                <div style="font-weight:600;color:var(--accent-purple);">Email</div>
                                <div>pngnkosi@gmail.com</div>
                                <div>kgethi@perspicuty.africa</div>
                            </div>
                        </div>

                        <div class="social-links">
                            <a href="https://www.tiktok.com/@fabacademic" target="_blank" class="social-link"><i class="fab fa-tiktok"></i></a>
                            <a href="https://twitter.com/fabacademic" target="_blank" class="social-link"><i class="fab fa-twitter"></i></a>
                            <a href="https://instagram.com/fabacademic" target="_blank" class="social-link"><i class="fab fa-instagram"></i></a>
                            <a href="https://linkedin.com/in/mamokgethiphakeng" target="_blank" class="social-link"><i class="fab fa-linkedin"></i></a>
                            <a href="https://www.youtube.com/@Fabacademic" target="_blank" class="social-link"><i class="fab fa-youtube"></i></a>
                            <a href="https://www.facebook.com/kgethi.phakeng" target="_blank" class="social-link"><i class="fab fa-facebook"></i></a>
                        </div>
                    </div>
                    
                    <div class="contact-form">
                        <!-- prevent actual submit, show popup instead -->
                        <form id="contactForm" onsubmit="showPopup(event)">
                            <div class="form-group">
                                <input type="text" id="name" name="name" placeholder="Your Name" required>
                            </div>
                            <div class="form-group">
                                <input type="email" id="email" name="email" placeholder="Your Email" required>
                            </div>
                            <div class="form-group">
                                <input type="text" id="subject" name="subject" placeholder="Subject" required>
                            </div>
                            <div class="form-group">
                                <textarea id="message" name="message" placeholder="Your Message" required></textarea>
                            </div>
                            <button type="submit" class="submit-btn">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- FOOTER (unchanged) -->
    <footer>
        <div class="footer-container">
            <div class="footer-main">
                <div class="footer-about">
                    <h4>About MEF</h4>
                    <p>Make Education Fashionable is a movement founded by Prof. Mamokgethi Phakeng to celebrate educational achievements and inspire the next generation of African leaders.</p>
                    <div class="brand-small">
                        <i class="fas fa-graduation-cap"></i>
                        <span>MEF · Since 2015</span>
                    </div>
                </div>
                <div class="footer-quick">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="#home"><i class="fas fa-chevron-right"></i> Home</a></li>
                        <li><a href="#about"><i class="fas fa-chevron-right"></i> About Us</a></li>
                        <li><a href="#services"><i class="fas fa-chevron-right"></i> Services & Awards</a></li>
                        <li><a href="#testimonials"><i class="fas fa-chevron-right"></i> Testimonies</a></li>
                        <li><a href="#contact"><i class="fas fa-chevron-right"></i> Contact</a></li>
                    </ul>
                </div>
                <div class="footer-social">
                    <h4>Connect With Us</h4>
                    <div class="footer-social-grid">
                        <a href="https://www.tiktok.com/@fabacademic" target="_blank" class="footer-social-item"><i class="fab fa-tiktok"></i><span>TikTok</span></a>
                        <a href="https://twitter.com/fabacademic" target="_blank" class="footer-social-item"><i class="fab fa-twitter"></i><span>Twitter / X</span></a>
                        <a href="https://instagram.com/fabacademic" target="_blank" class="footer-social-item"><i class="fab fa-instagram"></i><span>Instagram</span></a>
                        <a href="https://linkedin.com/in/mamokgethiphakeng" target="_blank" class="footer-social-item"><i class="fab fa-linkedin"></i><span>LinkedIn</span></a>
                        <a href="https://www.youtube.com/@Fabacademic" target="_blank" class="footer-social-item"><i class="fab fa-youtube"></i><span>YouTube</span></a>
                        <a href="https://www.facebook.com/kgethi.phakeng" target="_blank" class="footer-social-item"><i class="fab fa-facebook"></i><span>Facebook</span></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div>© 2026 MEF – Make Education Fashionable. All rights reserved.</div>
                <div class="footer-bottom-links">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Use</a>
                    <a href="#">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.querySelector('.menu-toggle').addEventListener('click', () => {
            document.querySelector('.nav-links').classList.toggle('active');
        });

        // Smooth scroll + active link (including clickable logo)
        document.querySelectorAll('.nav-links a, .logo-link').forEach(link => {
            link.addEventListener('click', e => {
                // Only handle if it's an anchor link (has href starting with #)
                const href = link.getAttribute('href');
                if (href && href.startsWith('#')) {
                    e.preventDefault();
                    
                    // Update active class on nav links (skip logo)
                    if (!link.classList.contains('logo-link')) {
                        document.querySelectorAll('.nav-links a').forEach(l => l.classList.remove('active'));
                        link.classList.add('active');
                    }
                    
                    document.querySelector('.nav-links').classList.remove('active');

                    const target = document.querySelector(href);
                    if (target) {
                        window.scrollTo({
                            top: target.offsetTop - 80,
                            behavior: 'smooth'
                        });
                    }
                }
            });
        });

        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            document.querySelector('.fixed-nav').classList.toggle('scrolled', window.scrollY > 100);

            // Update active link on scroll
            const sections = document.querySelectorAll('section[id]');
            const scrollPos = window.scrollY + 100;

            sections.forEach(sec => {
                const top = sec.offsetTop;
                const height = sec.offsetHeight;
                if (scrollPos >= top && scrollPos < top + height) {
                    const id = sec.getAttribute('id');
                    document.querySelectorAll('.nav-links a').forEach(a => {
                        a.classList.remove('active');
                        if (a.getAttribute('href') === `#${id}`) a.classList.add('active');
                    });
                }
            });
        });

        // Popup function for contact form (now white)
        function showPopup(event) {
            event.preventDefault();  // stop form submission / page reload

            const popup = document.createElement('div');
            popup.className = 'popup-success';
            popup.innerText = ' Message Sent Successfully!';

            // Append to body
            document.body.appendChild(popup);

            // Remove after 3 seconds
            setTimeout(() => {
                popup.remove();
            }, 3000);
        }
    </script>

</body>
</html>