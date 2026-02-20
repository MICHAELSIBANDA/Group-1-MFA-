<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MEF · Make Education Fashionable</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Make Education Fashionable - A movement founded by Prof. Mamokgethi Phakeng to celebrate educational achievements and inspire the next generation of African leaders.">
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

        /* FIXED NAVBAR - with hide/show on scroll */
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
            transition: transform 0.4s ease, padding 0.4s ease, box-shadow 0.4s ease;
            transform: translateY(0);
        }

        .fixed-nav.hidden {
            transform: translateY(-100%);
        }

        .fixed-nav.scrolled {
            padding: 0.8rem 3.5rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.4);
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: 1.6rem;
        }

        .logo-link {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .logo {
            width: 60px;
            height: 60px;
            object-fit: contain;
            border: none;
            border-radius: 0;
            box-shadow: none;
            transition: transform 0.4s ease;
            background: transparent;
        }

        .logo:hover {
            transform: scale(1.08);
        }

        .brand-text {
            border: none;
            background: transparent;
        }
        
        .brand-text .brand-main {
            font-size: 1.5rem;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: 0.5px;
            line-height: 1.2;
        }
        
        .brand-text .brand-sub {
            font-size: 0.8rem;
            color: var(--text-muted);
            letter-spacing: 1.2px;
            margin-top: 0.2rem;
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
            display: inline-block;
        }

        .btn-primary {
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(8px);
            border: 2px solid var(--accent-gold);
            color: var(--accent-gold-light);
        }

        .btn-primary:hover {
            background: var(--accent-gold);
            color: var(--primary-dark);
            border-color: transparent;
            transform: translateY(-6px) scale(1.04);
            box-shadow: 0 20px 40px rgba(255,215,0,0.35);
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
            width: 100%;
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

        /* ALERT MESSAGES */
        .alert {
            padding: 1rem 1.5rem;
            border-radius: var(--radius-md);
            margin-bottom: 2rem;
            font-weight: 600;
        }

        .alert-success {
            background: rgba(45,212,191,0.2);
            border: 1px solid var(--accent-teal);
            color: var(--accent-teal-light);
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

        /* SERVICES */
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
            cursor: pointer;
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
            pointer-events: none;
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
            pointer-events: none;
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
            pointer-events: none;
        }

        .category-card p {
            color: var(--text-muted);
            margin-bottom: 1.5rem;
            line-height: 1.7;
            pointer-events: none;
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
            pointer-events: none;
        }

        .category-card:hover .category-tag {
            background: var(--accent-gold);
            color: var(--primary-dark);
            border-color: var(--accent-gold);
        }

        /* MODAL STYLES */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.8);
            backdrop-filter: blur(8px);
            z-index: 2000;
            display: none;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .modal-overlay.active {
            display: flex;
            opacity: 1;
        }
        
        .modal-content {
            background: var(--primary-light);
            max-width: 700px;
            width: 90%;
            border-radius: var(--radius-lg);
            padding: 2.5rem;
            border: 2px solid var(--accent-gold);
            box-shadow: var(--shadow-xl);
            position: relative;
            transform: scale(0.9);
            transition: transform 0.3s ease;
            max-height: 85vh;
            overflow-y: auto;
        }
        
        .modal-overlay.active .modal-content {
            transform: scale(1);
        }
        
        .modal-close {
            position: absolute;
            top: 1rem;
            right: 1.5rem;
            font-size: 2rem;
            color: var(--text-muted);
            cursor: pointer;
            transition: var(--transition);
        }
        
        .modal-close:hover {
            color: var(--accent-gold);
            transform: rotate(90deg);
        }
        
        .modal-title {
            font-size: 2rem;
            color: var(--accent-gold);
            margin-bottom: 1.5rem;
            padding-right: 2rem;
        }
        
        .modal-section {
            margin-bottom: 2rem;
        }
        
        .modal-section h4 {
            color: var(--accent-teal);
            font-size: 1.3rem;
            margin-bottom: 1rem;
        }
        
        .modal-section ul {
            list-style: none;
        }
        
        .modal-section li {
            margin: 0.8rem 0;
            padding-left: 2rem;
            position: relative;
            color: var(--text-muted);
        }
        
        .modal-section li:before {
            content: '✓';
            color: var(--accent-teal);
            position: absolute;
            left: 0;
            font-weight: bold;
            font-size: 1.2rem;
        }
        
        .modal-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
            flex-wrap: wrap;
        }
        
        .modal-btn {
            flex: 1;
            padding: 1rem;
            border-radius: var(--radius-full);
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: var(--transition);
            text-align: center;
            min-width: 150px;
        }
        
        .modal-btn-primary {
            background: linear-gradient(135deg, var(--accent-gold), var(--accent-gold-dark));
            color: var(--primary-dark);
            border: none;
        }
        
        .modal-btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(255,215,0,0.3);
        }
        
        .modal-btn-secondary {
            background: transparent;
            border: 2px solid var(--accent-gold);
            color: var(--accent-gold-light);
        }
        
        .modal-btn-secondary:hover {
            background: rgba(255,215,0,0.1);
            transform: translateY(-3px);
        }

        /* NOMINATION FORM SECTION */
        .nomination-form-section {
            margin-top: 3rem;
            background: rgba(255,255,255,0.03);
            backdrop-filter: blur(12px);
            border-radius: var(--radius-xl);
            padding: 3rem;
            border: 1px solid rgba(255,215,0,0.14);
            box-shadow: var(--shadow-xl);
        }

        .nomination-form-section h3 {
            color: var(--accent-gold);
            font-size: 2rem;
            text-align: center;
            margin-bottom: 2rem;
        }

        .nomination-form-section p {
            color: var(--text-muted);
            text-align: center;
            margin-bottom: 2.5rem;
            font-size: 1.1rem;
        }

        .nomination-form {
            max-width: 800px;
            margin: 0 auto;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            color: var(--text-muted);
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.8rem 1rem;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,215,0,0.3);
            border-radius: var(--radius-md);
            color: var(--text-light);
            font-size: 1rem;
            transition: var(--transition);
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--accent-gold);
            background: rgba(255,255,255,0.15);
        }

        .form-group select {
            color: var(--accent-gold);
        }

        .form-group select option {
            background: var(--primary-dark);
            color: var(--accent-gold);
        }

        .radio-group {
            display: flex;
            gap: 2rem;
            align-items: center;
            margin-top: 0.5rem;
        }

        .radio-group label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: normal;
            color: var(--text-muted);
            cursor: pointer;
        }

        .radio-group input[type="radio"] {
            width: auto;
            margin: 0;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin: 1rem 0;
        }

        .checkbox-group input {
            width: auto;
        }

        .checkbox-group label {
            margin-bottom: 0;
            font-weight: normal;
        }

        .linkedin-input {
            display: flex;
            align-items: center;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,215,0,0.3);
            border-radius: var(--radius-md);
            overflow: hidden;
        }

        .linkedin-input span {
            padding: 0.8rem 1rem;
            background: rgba(255,215,0,0.1);
            color: var(--accent-gold);
            border-right: 1px solid rgba(255,215,0,0.3);
            font-size: 0.9rem;
        }

        .linkedin-input input {
            border: none;
            border-radius: 0;
            background: transparent;
            flex: 1;
        }

        .linkedin-input input:focus {
            border: none;
            box-shadow: none;
        }

        .btn-gold {
            background: linear-gradient(135deg, var(--accent-gold), var(--accent-gold-dark));
            color: var(--primary-dark);
            border: none;
            padding: 1rem 2rem;
            border-radius: var(--radius-full);
            font-weight: 700;
            font-size: 1.1rem;
            cursor: pointer;
            transition: var(--transition);
            width: 100%;
            margin-top: 1rem;
        }

        .btn-gold:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(255,215,0,0.3);
        }

        .nomination-success {
            background: rgba(45,212,191,0.2);
            border: 1px solid var(--accent-teal);
            color: var(--accent-teal-light);
            padding: 2rem;
            border-radius: var(--radius-lg);
            text-align: center;
            margin-top: 2rem;
        }

        .nomination-success i {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .nomination-success h4 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            color: var(--accent-teal-light);
        }

        /* APPLICATION FORM STYLES */
        .application-form {
            margin-top: 2rem;
            border-top: 1px solid rgba(255,215,0,0.3);
            padding-top: 2rem;
        }
        
        .application-form h4 {
            color: var(--accent-gold);
            font-size: 1.3rem;
            margin-bottom: 1.5rem;
        }
        
        .application-form .form-group {
            margin-bottom: 1.2rem;
        }
        
        .application-form .form-group label {
            display: block;
            color: var(--text-muted);
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            font-weight: 600;
        }
        
        .application-form .form-group input,
        .application-form .form-group select,
        .application-form .form-group textarea {
            width: 100%;
            padding: 0.8rem 1rem;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,215,0,0.3);
            border-radius: var(--radius-md);
            color: var(--text-light);
            font-size: 1rem;
            transition: var(--transition);
        }
        
        .application-form .form-group input:focus,
        .application-form .form-group select:focus,
        .application-form .form-group textarea:focus {
            outline: none;
            border-color: var(--accent-gold);
            background: rgba(255,255,255,0.15);
        }
        
        .application-form .form-group select {
            color: var(--accent-gold);
            background: rgba(255,255,255,0.1);
        }
        
        .application-form .form-group select option {
            background: var(--primary-dark);
            color: var(--accent-gold);
            padding: 0.5rem;
        }
        
        .application-form .form-group textarea {
            min-height: 100px;
            resize: vertical;
        }
        
        .application-form .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }
        
        .application-form .checkbox-group {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin: 1rem 0;
        }
        
        .application-form .checkbox-group input {
            width: auto;
        }
        
        .application-form .checkbox-group label {
            margin-bottom: 0;
            font-weight: normal;
        }

        .application-success {
            text-align: center;
            padding: 2rem;
        }
        
        .application-success i {
            font-size: 4rem;
            color: var(--accent-teal);
            margin-bottom: 1rem;
        }
        
        .application-success h3 {
            color: var(--accent-gold);
            margin-bottom: 1rem;
        }
        
        .application-success p {
            color: var(--text-muted);
            margin-bottom: 2rem;
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

        .contact-form .form-group {
            margin-bottom: 1.5rem;
        }

        .contact-form .form-group input,
        .contact-form .form-group textarea {
            width: 100%;
            padding: 1rem;
            background: rgba(255,255,255,0.1);
            border: 2px solid transparent;
            border-radius: var(--radius-md);
            color: var(--text-light);
            font-size: 1rem;
            transition: all 0.3s;
        }

        .contact-form .form-group input:focus,
        .contact-form .form-group textarea:focus {
            outline: none;
            border-color: var(--accent-teal);
            background: rgba(255,255,255,0.15);
        }

        .contact-form .form-group textarea { min-height: 150px; resize: vertical; }

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
            .form-row {
                grid-template-columns: 1fr;
            }
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
            .footer-bottom-links { flex-wrap: wrap; justify-content: center; }
            .modal-content {
                padding: 1.5rem;
                width: 95%;
            }
            .modal-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>

    <!-- MODAL OVERLAY for Award Applications -->
    <div class="modal-overlay" id="categoryModal">
        <div class="modal-content">
            <span class="modal-close" id="modalClose">&times;</span>
            <h3 class="modal-title" id="modalTitle">Category Title</h3>
            
            <!-- Requirements Section (shown first) -->
            <div id="requirementsSection">
                <div class="modal-section">
                    <h4>Requirements:</h4>
                    <ul id="requirementsList">
                        <!-- Requirements will be populated by JavaScript -->
                    </ul>
                </div>
                
                <div class="modal-buttons">
                    <button class="modal-btn modal-btn-primary" id="showApplicationBtn">Apply Now</button>
                    <button class="modal-btn modal-btn-secondary" id="modalCancelBtn">Cancel</button>
                </div>
            </div>
            
            <!-- Application Form Section (shown after clicking Apply) - UPDATED with LinkedIn field -->
            <div id="applicationSection" style="display: none;">
                <div class="application-form">
                    <h4>Apply for <span id="applicationTitle"></span></h4>
                    <form id="awardApplicationForm" onsubmit="submitApplication(event)">
                        <input type="hidden" id="applicationCategory" name="category">
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="firstName">First Name *</label>
                                <input type="text" id="firstName" name="firstName" required>
                            </div>
                            <div class="form-group">
                                <label for="lastName">Last Name *</label>
                                <input type="text" id="lastName" name="lastName" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email Address *</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Phone Number *</label>
                            <input type="tel" id="phone" name="phone" required>
                        </div>
                        
                        <!-- Category field - automatically populated -->
                        <div class="form-group">
                            <label>Applying for Category *</label>
                            <input type="text" id="appliedCategory" value="" readonly style="color: var(--accent-gold); font-weight: 600;">
                        </div>
                        
                        <div class="form-group">
                            <label for="qualification">Highest Qualification *</label>
                            <select id="qualification" name="qualification" required>
                                <option value="">Select your qualification</option>
                                <option value="bachelors">Bachelor's Degree</option>
                                <option value="masters">Master's Degree</option>
                                <option value="phd">PhD/Doctorate</option>
                                <option value="diploma">Diploma</option>
                                <option value="certificate">Certificate</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="institution">Institution *</label>
                            <input type="text" id="institution" name="institution" required>
                        </div>
                        
                        <!-- Removed Graduation Year field, added LinkedIn field -->
                        <div class="form-group">
                            <label for="linkedin">LinkedIn Profile *</label>
                            <div class="linkedin-input">
                                <span>linkedin.com/in/</span>
                                <input type="text" id="linkedin" name="linkedin" placeholder="username" required>
                            </div>
                            <small style="color: var(--text-muted);">Enter your LinkedIn username or full profile URL</small>
                        </div>
                        
                        <div class="form-group">
                            <label for="achievements">Key Achievements *</label>
                            <textarea id="achievements" name="achievements" placeholder="Tell us about your achievements relevant to this award" required></textarea>
                        </div>
                        
                        <div class="checkbox-group">
                            <input type="checkbox" id="terms" name="terms" required>
                            <label for="terms">I confirm that all information provided is true and complete *</label>
                        </div>
                        
                        <div class="checkbox-group">
                            <input type="checkbox" id="notifications" name="notifications">
                            <label for="notifications">I would like to receive updates about MEF events and opportunities</label>
                        </div>
                        
                        <div class="modal-buttons">
                            <button type="submit" class="modal-btn modal-btn-primary">Submit Application</button>
                            <button type="button" class="modal-btn modal-btn-secondary" id="backToRequirementsBtn">Back</button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Success Section -->
            <div id="successSection" style="display: none;">
                <div class="application-success">
                    <i class="fas fa-check-circle"></i>
                    <h3>Application Submitted Successfully!</h3>
                    <p>Thank you for applying. We will review your application and contact you soon.</p>
                    <button class="modal-btn modal-btn-primary" onclick="closeModal()">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- NAVBAR with clickable logo -->
    <nav class="fixed-nav">
        <div class="nav-left">
            <a href="#home" class="logo-link">
                <img src="ko kae.jpeg" alt="MEF Logo" class="logo">
            </a>
            <div class="brand-text">
                <div class="brand-main">MAKE EDUCATION</div>
                <div class="brand-main" style="margin-top: -0.3rem;">FASHIONABLE</div>
                <div class="brand-sub">MEF · Since 2015</div>
            </div>
        </div>
        
        <div class="menu-toggle"><i class="fas fa-bars"></i></div>

        <div class="nav-links">
            <a href="#home" class="active">Home</a>
            <a href="#about">About</a>
            <a href="#services">Services</a>
            <a href="#testimonials">Testimonies</a>
            <a href="#contact">Contact</a>
        </div>
    </nav>

    <main class="content">

        <!-- HOME with graduates.jpeg background -->
        <section id="home">
            <img src="graduates.jpg" alt="MEF Background - Graduates" class="home-bg">
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

        <!-- ABOUT -->
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

        <!-- SERVICES (6 boxes + ticket link) -->
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
                    <p>Click on any category to view requirements and apply</p>
                </div>

                <!-- 6 BOXES (all clickable) -->
                <div class="categories-grid">
                    <!-- 1. African Development Research Award -->
                    <div class="category-card" data-category="research">
                        <div class="category-icon-wrapper"><div class="category-icon"><i class="fas fa-globe-africa"></i></div></div>
                        <h4>African Development Research Award</h4>
                        <p>Recognizes groundbreaking research that contributes meaningfully to African development, innovation, and sustainable solutions.</p>
                        <span class="category-tag">Research</span>
                    </div>
                    <!-- 2. AI Champion Award -->
                    <div class="category-card" data-category="ai">
                        <div class="category-icon-wrapper"><div class="category-icon"><i class="fas fa-robot"></i></div></div>
                        <h4>AI Champion Award</h4>
                        <p>Honors visionary leaders in artificial intelligence who are driving innovation, ethical AI practices, and advocacy across the continent.</p>
                        <span class="category-tag">Innovation</span>
                    </div>
                    <!-- 3. Mamokgethi Phakeng Prize -->
                    <div class="category-card" data-category="women">
                        <div class="category-icon-wrapper"><div class="category-icon"><i class="fas fa-female"></i></div></div>
                        <h4>Mamokgethi Phakeng Prize</h4>
                        <p>Celebrates a trailblazing woman who breaks barriers, inspires change, and creates pathways for future generations in her field.</p>
                        <span class="category-tag">Leadership</span>
                    </div>
                    <!-- 4. Young Entrepreneur Award -->
                    <div class="category-card" data-category="entrepreneur">
                        <div class="category-icon-wrapper"><div class="category-icon"><i class="fas fa-briefcase"></i></div></div>
                        <h4>Young Entrepreneur Award</h4>
                        <p>Recognizes dynamic young founders building innovative enterprises, creating employment, and driving economic growth.</p>
                        <span class="category-tag">Business</span>
                    </div>
                    <!-- 5. Youth in Agriculture Award -->
                    <div class="category-card" data-category="agriculture">
                        <div class="category-icon-wrapper"><div class="category-icon"><i class="fas fa-seedling"></i></div></div>
                        <h4>Youth in Agriculture Award</h4>
                        <p>Honors young graduates transforming agriculture through innovation, sustainability, and modern farming practices.</p>
                        <span class="category-tag">Agriculture</span>
                    </div>
                    <!-- 6. MEF Convocation 2025 with ticket link -->
                    <div class="category-card" onclick="window.open('https://www.quicket.co.za/events/346942-make-education-fashionable-convocation-2025/#/', '_blank')">
                        <div class="category-icon-wrapper"><div class="category-icon"><i class="fas fa-ticket-alt"></i></div></div>
                        <h4>MEF Convocation 2025</h4>
                        <p>Join the flagship event celebrating educational achievements. Network with leaders, share stories, and be inspired.</p>
                        <span class="category-tag">Get Tickets</span>
                    </div>
                </div>

                <!-- NEW: Enhanced Nomination Form Section -->
                <div class="nomination-form-section" id="nominationForm">
                    <h3>Share Your Story</h3>
                    <p>Nominate yourself or someone inspiring for the MEF Awards. Every story of victory deserves to be celebrated.</p>
                    
                    <div class="nomination-form" id="nominationFormContainer">
                        <form id="storyNominationForm" onsubmit="submitNomination(event)">
                            <!-- Nomination Type -->
                            <div class="form-group">
                                <label>I am nominating: *</label>
                                <div class="radio-group">
                                    <label>
                                        <input type="radio" name="nominationType" value="self" checked> Myself
                                    </label>
                                    <label>
                                        <input type="radio" name="nominationType" value="other"> Someone else
                                    </label>
                                </div>
                            </div>

                            <!-- Nominee Information -->
                            <div id="nomineeInfo">
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="nomineeFirstName">First Name *</label>
                                        <input type="text" id="nomineeFirstName" name="nomineeFirstName" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="nomineeLastName">Last Name *</label>
                                        <input type="text" id="nomineeLastName" name="nomineeLastName" required>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="nomineeEmail">Email Address *</label>
                                    <input type="email" id="nomineeEmail" name="nomineeEmail" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="nomineePhone">Phone Number *</label>
                                    <input type="tel" id="nomineePhone" name="nomineePhone" required>
                                </div>
                            </div>

                            <!-- Nominator Information (shown only when nominating someone else) -->
                            <div id="nominatorInfo" style="display: none;">
                                <h4 style="color: var(--accent-teal); margin: 1.5rem 0 1rem;">Your Information</h4>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="nominatorFirstName">Your First Name *</label>
                                        <input type="text" id="nominatorFirstName" name="nominatorFirstName">
                                    </div>
                                    <div class="form-group">
                                        <label for="nominatorLastName">Your Last Name *</label>
                                        <input type="text" id="nominatorLastName" name="nominatorLastName">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="nominatorEmail">Your Email Address *</label>
                                    <input type="email" id="nominatorEmail" name="nominatorEmail">
                                </div>
                                
                                <div class="form-group">
                                    <label for="nominatorPhone">Your Phone Number *</label>
                                    <input type="tel" id="nominatorPhone" name="nominatorPhone">
                                </div>
                                
                                <div class="form-group">
                                    <label for="relationship">Relationship to Nominee *</label>
                                    <input type="text" id="relationship" name="relationship" placeholder="e.g., Colleague, Mentor, Family member">
                                </div>
                            </div>

                            <!-- Award Category Selection -->
                            <div class="form-group">
                                <label for="nominationCategory">Award Category *</label>
                                <select id="nominationCategory" name="nominationCategory" required>
                                    <option value="">Select a category</option>
                                    <option value="research">African Development Research Award</option>
                                    <option value="ai">AI Champion Award</option>
                                    <option value="women">Mamokgethi Phakeng Prize</option>
                                    <option value="entrepreneur">Young Entrepreneur Award</option>
                                    <option value="agriculture">Youth in Agriculture Award</option>
                                </select>
                            </div>

                            <!-- Story/Inspiration -->
                            <div class="form-group">
                                <label for="storyTitle">Story Title *</label>
                                <input type="text" id="storyTitle" name="storyTitle" placeholder="Give your story a title" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="inspirationStory">Share Your/Their Story of Victory *</label>
                                <textarea id="inspirationStory" name="inspirationStory" rows="6" placeholder="Tell us about the journey, challenges overcome, and the impact of education..." required></textarea>
                            </div>

                            <!-- LinkedIn Profile (optional but recommended) -->
                            <div class="form-group">
                                <label for="nomineeLinkedIn">LinkedIn Profile (Optional but recommended)</label>
                                <div class="linkedin-input">
                                    <span>linkedin.com/in/</span>
                                    <input type="text" id="nomineeLinkedin" name="nomineeLinkedin" placeholder="username">
                                </div>
                                <small style="color: var(--text-muted);">Share the LinkedIn profile to help us verify the story</small>
                            </div>

                            <!-- Key Achievements -->
                            <div class="form-group">
                                <label for="keyAchievements">Key Achievements (Optional)</label>
                                <textarea id="keyAchievements" name="keyAchievements" rows="3" placeholder="List any relevant achievements, awards, or recognition..."></textarea>
                            </div>

                            <!-- Social Media Links -->
                            <div class="form-group">
                                <label for="socialLinks">Social Media Links (Optional)</label>
                                <input type="text" id="socialLinks" name="socialLinks" placeholder="Twitter, Instagram, etc.">
                            </div>

                            <!-- Consent -->
                            <div class="checkbox-group">
                                <input type="checkbox" id="nominationTerms" name="nominationTerms" required>
                                <label for="nominationTerms">I confirm that the information provided is true and accurate, and I have permission to share this story *</label>
                            </div>
                            
                            <div class="checkbox-group">
                                <input type="checkbox" id="nominationUpdates" name="nominationUpdates">
                                <label for="nominationUpdates">I'd like to receive updates about the nomination status and MEF events</label>
                            </div>

                            <button type="submit" class="btn-gold">Submit Nomination</button>
                        </form>
                    </div>

                    <!-- Success Message (hidden by default) -->
                    <div id="nominationSuccess" class="nomination-success" style="display: none;">
                        <i class="fas fa-check-circle"></i>
                        <h4>Nomination Submitted Successfully!</h4>
                        <p>Thank you for sharing this story of victory. We will review the nomination and contact you soon.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- TESTIMONIES -->
        <section id="testimonials" class="section">
            <div class="section-container">
                <h2 class="section-title">Testimonies</h2>
                
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

        <!-- CONTACT - Updated to show only success message, no error message -->
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
                        <!-- Only success message (error message removed) -->
                        <div id="contactSuccess" class="alert alert-success" style="display: none;">
                            <i class="fas fa-check-circle"></i> Your message has been sent successfully! We'll get back to you soon.
                        </div>

                        <form id="contactForm" onsubmit="submitContactForm(event)">
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

    <!-- FOOTER -->
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
                <div>© 2025 MEF – Make Education Fashionable. All rights reserved.</div>
                <div class="footer-bottom-links">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Use</a>
                    <a href="#">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Category data for requirements
        const categoryData = {
            research: {
                title: 'African Development Research Award',
                requirements: [
                    'PhD or equivalent research experience',
                    'Minimum 5 years of research in African development',
                    'Published at least 3 peer-reviewed papers',
                    'Demonstrated impact on African communities',
                    'South African citizen or permanent resident',
                    'Under 45 years of age'
                ]
            },
            ai: {
                title: 'AI Champion Award',
                requirements: [
                    'Minimum 3 years experience in AI/ML',
                    'Proven track record of AI innovation',
                    'Active involvement in AI ethics and advocacy',
                    'Portfolio of AI projects or implementations',
                    'South African citizen or permanent resident',
                    'Open to all ages'
                ]
            },
            women: {
                title: 'Mamokgethi Phakeng Prize',
                requirements: [
                    'Identify as a woman',
                    'Minimum 5 years leadership experience',
                    'Demonstrated impact in breaking barriers',
                    'Mentorship of young women',
                    'South African citizen or permanent resident',
                    'Open to all ages'
                ]
            },
            entrepreneur: {
                title: 'Young Entrepreneur Award',
                requirements: [
                    'Age 18-35 years',
                    'Own and run a registered business',
                    'Business operational for minimum 2 years',
                    'Minimum 3 employees',
                    'Demonstrated revenue growth',
                    'South African citizen or permanent resident'
                ]
            },
            agriculture: {
                title: 'Youth in Agriculture Award',
                requirements: [
                    'Age 18-35 years',
                    'Degree/Diploma in Agriculture or related field',
                    'Minimum 2 years experience in agriculture',
                    'Demonstrated innovation in farming',
                    'South African citizen or permanent resident',
                    'Sustainable farming practices'
                ]
            }
        };

        // Modal elements
        const modal = document.getElementById('categoryModal');
        const modalTitle = document.getElementById('modalTitle');
        const requirementsList = document.getElementById('requirementsList');
        const requirementsSection = document.getElementById('requirementsSection');
        const applicationSection = document.getElementById('applicationSection');
        const successSection = document.getElementById('successSection');
        const applicationTitle = document.getElementById('applicationTitle');
        const applicationCategory = document.getElementById('applicationCategory');
        const appliedCategory = document.getElementById('appliedCategory');
        const modalClose = document.getElementById('modalClose');
        const modalCancel = document.getElementById('modalCancelBtn');
        const showApplicationBtn = document.getElementById('showApplicationBtn');
        const backToRequirementsBtn = document.getElementById('backToRequirementsBtn');

        // Get all category cards (except the 6th one which has its own onclick)
        const categoryCards = document.querySelectorAll('.category-card:not([onclick])');
        
        // Add click event to each card
        categoryCards.forEach(card => {
            card.addEventListener('click', function(e) {
                const category = this.dataset.category;
                const data = categoryData[category];
                
                if (data) {
                    modalTitle.textContent = data.title;
                    applicationTitle.textContent = data.title;
                    appliedCategory.value = data.title;
                    applicationCategory.value = category;
                    
                    // Build requirements list
                    let requirementsHtml = '';
                    data.requirements.forEach(req => {
                        requirementsHtml += `<li>${req}</li>`;
                    });
                    requirementsList.innerHTML = requirementsHtml;
                    
                    // Show requirements section, hide others
                    requirementsSection.style.display = 'block';
                    applicationSection.style.display = 'none';
                    successSection.style.display = 'none';
                    
                    // Show modal
                    modal.classList.add('active');
                    document.body.style.overflow = 'hidden';
                }
            });
        });

        // Show application form
        showApplicationBtn.addEventListener('click', function() {
            requirementsSection.style.display = 'none';
            applicationSection.style.display = 'block';
            successSection.style.display = 'none';
        });

        // Back to requirements
        backToRequirementsBtn.addEventListener('click', function() {
            requirementsSection.style.display = 'block';
            applicationSection.style.display = 'none';
            successSection.style.display = 'none';
        });

        // Close modal function
        function closeModal() {
            modal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        // Close modal with X button
        modalClose.addEventListener('click', closeModal);
        
        // Close modal with Cancel button
        modalCancel.addEventListener('click', closeModal);
        
        // Close modal when clicking outside
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeModal();
            }
        });

        // Application submission
        function submitApplication(event) {
            event.preventDefault();
            
            // Here you would typically send the form data to a server
            // For now, we'll just show success message
            
            // Hide form, show success
            requirementsSection.style.display = 'none';
            applicationSection.style.display = 'none';
            successSection.style.display = 'block';
            
            console.log('Application submitted for:', applicationCategory.value);
        }

        // Nomination form handling
        const nominationTypeRadios = document.querySelectorAll('input[name="nominationType"]');
        const nominatorInfo = document.getElementById('nominatorInfo');
        const nomineeInfo = document.getElementById('nomineeInfo');
        
        nominationTypeRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'other') {
                    nominatorInfo.style.display = 'block';
                    // Make nominator fields required
                    document.getElementById('nominatorFirstName').required = true;
                    document.getElementById('nominatorLastName').required = true;
                    document.getElementById('nominatorEmail').required = true;
                    document.getElementById('nominatorPhone').required = true;
                    document.getElementById('relationship').required = true;
                } else {
                    nominatorInfo.style.display = 'none';
                    // Remove required from nominator fields
                    document.getElementById('nominatorFirstName').required = false;
                    document.getElementById('nominatorLastName').required = false;
                    document.getElementById('nominatorEmail').required = false;
                    document.getElementById('nominatorPhone').required = false;
                    document.getElementById('relationship').required = false;
                }
            });
        });

        function submitNomination(event) {
            event.preventDefault();
            
            // Hide form, show success
            document.getElementById('nominationFormContainer').style.display = 'none';
            document.getElementById('nominationSuccess').style.display = 'block';
            
            // Scroll to success message
            document.getElementById('nominationSuccess').scrollIntoView({ behavior: 'smooth' });
        }

        // Mobile menu toggle
        document.querySelector('.menu-toggle').addEventListener('click', () => {
            document.querySelector('.nav-links').classList.toggle('active');
        });

        // Smooth scroll + active link (including clickable logo)
        document.querySelectorAll('.nav-links a, .logo-link').forEach(link => {
            link.addEventListener('click', e => {
                const href = link.getAttribute('href');
                if (href && href.startsWith('#')) {
                    e.preventDefault();
                    
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

        // Navbar hide/show on scroll
        let lastScrollTop = 0;
        const navbar = document.querySelector('.fixed-nav');
        
        window.addEventListener('scroll', () => {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            // Add/remove scrolled class for padding change
            if (scrollTop > 100) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
            
            // Hide navbar when scrolling down, show when scrolling up
            if (scrollTop > lastScrollTop && scrollTop > 200) {
                // Scrolling down
                navbar.classList.add('hidden');
            } else {
                // Scrolling up
                navbar.classList.remove('hidden');
            }
            
            lastScrollTop = scrollTop;

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

        // CONTACT FORM HANDLING - Only shows success message, no error
        function submitContactForm(event) {
            event.preventDefault();
            
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const subject = document.getElementById('subject').value.trim();
            const message = document.getElementById('message').value.trim();
            const successDiv = document.getElementById('contactSuccess');
            
            // Simple validation - if all fields filled, show success
            if (name && email && subject && message) {
                // Show success message
                successDiv.style.display = 'block';
                
                // Clear the form
                document.getElementById('contactForm').reset();
                
                // Hide success message after 5 seconds
                setTimeout(() => {
                    successDiv.style.display = 'none';
                }, 5000);
            } else {
                // Instead of error message, just do nothing or could show a subtle hint
                // For now, we'll just not show any message
                console.log('Please fill all fields');
            }
        }
    </script>

</body>
</html>