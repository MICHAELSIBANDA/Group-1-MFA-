<?php
session_start();

// Include Composer autoload (if using Composer)
require_once __DIR__ . '/vendor/autoload.php';

// Include setup_db.php which connects to the database and creates tables if needed
require_once __DIR__ . '/setup_db.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Category mapping: short code => full display name and details
$categoryDetails = [
    'research' => [
        'name' => 'African Development Research Award',
        'description' => 'Celebrates research that addresses Africa\'s most pressing challenges. Research should solve real problems and improve people\'s lives.',
        'eligibility' => [
            'Master\'s, Doctoral, or Postdoctoral graduate from any African country',
            'Research directly addresses a significant challenge faced by Africa',
            'Demonstrable relevance to improving lives or solving problems in Africa',
            'Research can be in any field (engineering, health sciences, economics, social sciences, environmental studies)',
            'Open to researchers across the African continent'
        ],
        'criteria' => [
            'Academic excellence (high grades or notable research results)',
            'Evidence of research impact or potential for practical application',
            'Work with communities, publishing policy briefs, or innovating prototypes',
            'Preference for nominees who have not yet received widespread recognition'
        ],
        'prize' => 'R10,000 cash prize + fully covered travel and accommodation to Gauteng for the convocation',
        'max_winners' => 5,
        'open_to' => 'All African countries'
    ],
    'ai' => [
        'name' => 'AI Champion Award',
        'description' => 'Recognizes the growing importance of artificial intelligence in shaping the future of education, work, and society. Africans should be creators and leaders in technology.',
        'eligibility' => [
            'Open to all ages and educational backgrounds (from self-taught practitioners to researchers)',
            'South African citizen or permanent resident preferred',
            'Demonstrated excellence in artificial intelligence or digital innovation'
        ],
        'criteria' => [
            'Portfolio of AI projects, implementations, or research',
            'Active involvement in promoting AI literacy and adoption across Africa',
            'Evidence of using AI to address social or developmental challenges',
            'Experience in teaching or mentoring others in AI (preferred)',
            'Alignment with vision of Africans as creators, not just consumers, of technology'
        ],
        'prize' => 'R10,000 cash prize + potential in-kind support (mentorship, cloud computing credits, or tech resources)',
        'max_winners' => 5,
        'open_to' => 'South Africa (preferred)'
    ],
    'women' => [
        'name' => 'Mamokgethi Phakeng Prize',
        'description' => 'Honours excellence among female scholars in the mathematical sciences, named after Prof Phakeng\'s historic achievement as the first black African South African woman to earn a PhD in Mathematics Education (2002).',
        'eligibility' => [
            'Identify as a black African woman',
            'South African citizen or permanent resident',
            'Currently pursuing or recently completed a Master\'s or PhD in Mathematical Sciences',
            'Fields include: Applied Mathematics, Pure Mathematics, Mathematics Education, Statistics, or any math-related discipline'
        ],
        'criteria' => [
            'Demonstrated academic excellence (high grades or notable research results)',
            'Proven determination to succeed in a field where women have historically been underrepresented',
            'Active in mentoring other students or involved in outreach to inspire girls in STEM (preferred)',
            'Embody the spirit of perseverance and serve as a role model for other young women',
            'Published impactful research or solving real-world problems through thesis'
        ],
        'prize' => 'R10,000 cash prize + mentorship opportunity and public recognition at the convocation',
        'max_winners' => 5,
        'open_to' => 'South Africa'
    ],
    'entrepreneur' => [
        'name' => 'Young Entrepreneur Award',
        'description' => 'Celebrates graduates who have taken the initiative to start something of their own, showing innovation, resilience, and the potential to contribute to job creation.',
        'eligibility' => [
            'Age 18-35 years',
            'Completed tertiary education (at least a diploma or degree)',
            'Founded or co-founded a registered business operating in South Africa',
            'Business operational for minimum 1 year',
            'South African citizen or permanent resident (business must be in SA)'
        ],
        'criteria' => [
            'Demonstrated innovation, resilience, and growth potential',
            'Evidence of job creation or community impact',
            'Solving a real problem or filling a market gap',
            'Achieved notable milestones (growth in revenue, user base, or community impact)',
            'Overcome personal hardship or run the company with limited resources (preferred)',
            'Compelling personal story that can inspire other young entrepreneurs'
        ],
        'prize' => 'R10,000 cash prize (seed funding) + significant publicity for their business',
        'max_winners' => 5,
        'open_to' => 'South Africa'
    ],
    'agriculture' => [
        'name' => 'Youth in Agriculture Award',
        'description' => 'Honours young graduates who are proving that education and agriculture together can generate powerful results. Confronts the stereotype that "educated youth avoid farming."',
        'eligibility' => [
            'Age 18-35 years',
            'Completed tertiary education (any field)',
            'Making an impact in agriculture or the agricultural value chain',
            'Open to youth across the African continent'
        ],
        'criteria' => [
            'Areas include: hands-on farming, agricultural research, agri-entrepreneurship, agro-processing, or agricultural education',
            'Demonstrated progress, innovation, or impact in agriculture',
            'Proven that education and agriculture together can generate powerful results',
            'Overcame scepticism about choosing agriculture after higher education (preferred)',
            'Leadership or innovation in agriculture',
            'Returned to rural area to run community farming project (preferred)'
        ],
        'prize' => 'R10,000 cash prize to reinvest in agricultural projects or business',
        'max_winners' => 5,
        'open_to' => 'All African countries'
    ]
];

// Function to send email using PHPMailer
function sendEmail($to, $subject, $body, $env) {
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = $env['SMTP_HOST'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $env['SMTP_USER'];
        $mail->Password   = $env['SMTP_PASS'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = $env['SMTP_PORT'];

        // Recipients
        $mail->setFrom($env['SMTP_FROM'], $env['SMTP_FROM_NAME']);
        $mail->addAddress($to);

        // Content
        $mail->isHTML(false);
        $mail->Subject = $subject;
        $mail->Body    = $body;

        $mail->send();
        return true;
    } catch (Exception $e) {
        // Log error if needed
        error_log("Mailer Error: " . $mail->ErrorInfo);
        return false;
    }
}

// Load environment variables
$env = parse_ini_file(__DIR__ . '/.env');

// The $conn object is now available from setup_db.php

// Process form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['form_type'])) {
        $formType = $_POST['form_type'];

        if ($formType === 'award_application') {
            // Award application form (from modal)
            $firstName = trim($_POST['firstName'] ?? '');
            $lastName  = trim($_POST['lastName'] ?? '');
            $email     = trim($_POST['email'] ?? '');
            $phone     = trim($_POST['phone'] ?? '');
            $qualification = trim($_POST['qualification'] ?? '');
            $institution   = trim($_POST['institution'] ?? '');
            $linkedin      = trim($_POST['linkedin'] ?? '');
            $achievements  = trim($_POST['achievements'] ?? '');
            $categoryCode  = trim($_POST['category'] ?? '');

            if ($firstName && $lastName && $email && $phone && $qualification && $institution && $categoryCode && $achievements) {
                if (!empty($linkedin) && strpos($linkedin, 'linkedin.com') === false) {
                    $linkedin = 'https://linkedin.com/in/' . ltrim($linkedin, '/');
                }

                $stmt = $conn->prepare("INSERT INTO nominees (first_name, last_name, email, phone) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $firstName, $lastName, $email, $phone);
                if ($stmt->execute()) {
                    $nomineeId = $stmt->insert_id;
                    $stmt2 = $conn->prepare("INSERT INTO categories (category_type, qualification, institution, weblinkurl, achievement_description, nominee_id) VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt2->bind_param("sssssi", $categoryCode, $qualification, $institution, $linkedin, $achievements, $nomineeId);
                    if ($stmt2->execute()) {
                        $_SESSION['success'] = "Your award application has been submitted successfully!";
                        $fullCategory = $categoryDetails[$categoryCode]['name'] ?? $categoryCode;
                        $subject = "YOU'VE BEEN NOMINATED for the MEF Awards!";
                        $body = "Dear $firstName $lastName,\n\n";
                        $body .= "We are excited to inform you that you have been nominated for the **MEF Awards** in the **$fullCategory** category! 🌟\n";
                        $body .= "Someone who recognizes your excellence and contribution has shared your story. This nomination reflects the positive impact you have made.\n";
                        $body .= "Our panel will now review the submission, and we will be in touch soon regarding the outcome.\n\n";
                        $body .= "Nomination Details:\n";
                        $body .= "Category: $fullCategory\n";
                        $body .= "Qualification: $qualification\n";
                        $body .= "Institution: $institution\n";
                        $body .= "LinkedIn: $linkedin\n";
                        $body .= "Achievements: $achievements\n\n";
                        $body .= "Regards,\nMEF Awards Team";
                        sendEmail($email, $subject, $body, $env);
                    } else {
                        $_SESSION['error'] = "Failed to save category details.";
                    }
                    $stmt2->close();
                } else {
                    $_SESSION['error'] = "Failed to save nominee details.";
                }
                $stmt->close();
            } else {
                $_SESSION['error'] = "Please fill in all required fields.";
            }

        } elseif ($formType === 'standalone_nomination') {
            // Standalone nomination form (same fields as award_application + category dropdown)
            $firstName = trim($_POST['firstName'] ?? '');
            $lastName  = trim($_POST['lastName'] ?? '');
            $email     = trim($_POST['email'] ?? '');
            $phone     = trim($_POST['phone'] ?? '');
            $qualification = trim($_POST['qualification'] ?? '');
            $institution   = trim($_POST['institution'] ?? '');
            $linkedin      = trim($_POST['linkedin'] ?? '');
            $achievements  = trim($_POST['achievements'] ?? '');
            $categoryCode  = trim($_POST['category'] ?? '');

            if ($firstName && $lastName && $email && $phone && $qualification && $institution && $categoryCode && $achievements) {
                if (!empty($linkedin) && strpos($linkedin, 'linkedin.com') === false) {
                    $linkedin = 'https://linkedin.com/in/' . ltrim($linkedin, '/');
                }

                $stmt = $conn->prepare("INSERT INTO nominees (first_name, last_name, email, phone) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $firstName, $lastName, $email, $phone);
                if ($stmt->execute()) {
                    $nomineeId = $stmt->insert_id;
                    $stmt2 = $conn->prepare("INSERT INTO categories (category_type, qualification, institution, weblinkurl, achievement_description, nominee_id) VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt2->bind_param("sssssi", $categoryCode, $qualification, $institution, $linkedin, $achievements, $nomineeId);
                    if ($stmt2->execute()) {
                        $_SESSION['success'] = "Your nomination has been submitted successfully!";
                        $fullCategory = $categoryDetails[$categoryCode]['name'] ?? $categoryCode;
                        $subject = "YOU'VE BEEN NOMINATED for the MEF Awards!";
                        $body = "Dear $firstName $lastName,\n\n";
                        $body .= "We are excited to inform you that you have been nominated for the MEF Awards! 🌟\n";
                        $body .= "Your story has been shared by someone who recognizes your excellence and contribution. This nomination reflects the positive impact you have made.\n";
                        $body .= "Our panel will now review the submission, and we will be in touch soon regarding the outcome.\n\n";
                        $body .= "Nomination Details:\n";
                        $body .= "Category: $fullCategory\n";
                        $body .= "Qualification: $qualification\n";
                        $body .= "Institution: $institution\n";
                        $body .= "LinkedIn: $linkedin\n";
                        $body .= "Achievements: $achievements\n\n";
                        $body .= "Regards,\nMEF Awards Team";
                        sendEmail($email, $subject, $body, $env);
                    } else {
                        $_SESSION['error'] = "Failed to save category details.";
                    }
                    $stmt2->close();
                } else {
                    $_SESSION['error'] = "Failed to save nominee details.";
                }
                $stmt->close();
            } else {
                $_SESSION['error'] = "Please fill in all required fields.";
            }

        } elseif ($formType === 'contact') {
            // Contact form
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $subject = trim($_POST['subject'] ?? '');
            $message = trim($_POST['message'] ?? '');

            if ($name && $email && $subject && $message) {
                $adminEmail = $env['SMTP_FROM'];
                $mailSubject = "Contact Form Message from $name";
                $mailBody = "You have received a new message from the MEF contact form.\n\n";
                $mailBody .= "Name: $name\n";
                $mailBody .= "Email: $email\n";
                $mailBody .= "Subject: $subject\n";
                $mailBody .= "Message:\n$message\n";

                if (sendEmail($adminEmail, $mailSubject, $mailBody, $env)) {
                    $_SESSION['success'] = "Your message has been sent successfully!";
                } else {
                    $_SESSION['error'] = "Failed to send your message. Please try again later.";
                }
            } else {
                $_SESSION['error'] = "Please fill in all required fields.";
            }
        }

        // Redirect to avoid resubmission
        header('Location: index.php');
        exit;
    }
}

// Retrieve flash messages
$successMessage = $_SESSION['success'] ?? null;
$errorMessage = $_SESSION['error'] ?? null;
unset($_SESSION['success'], $_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>MEF · Make Education Fashionable</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <meta name="description" content="Make Education Fashionable - A movement founded by Prof. Mamokgethi Phakeng to celebrate educational achievements and inspire the next generation of African leaders.">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">

    <!-- Favicon links for all browsers (Chrome, Safari, Android, iOS) -->

    <!-- Standard favicon -->
    <link rel="icon" type="image/x-icon" href="favicon_io/favicon.ico">
    <link rel="icon" type="image/png" sizes="192x192" href="favicon_io/android-chrome-192x192.png">
    <link rel="icon" type="image/png" sizes="512x512" href="favicon_io/android-chrome-512x512.png">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon_io/apple-touch-icon.png">
    <link rel="manifest" href="favicon_io/site.webmanifest">

    <meta name="theme-color" content="#ffffff">
</head>
<body>

    <!-- Display flash messages (auto-hide after 5 seconds) -->
    <?php if ($successMessage): ?>
        <div class="alert alert-success" id="successMessage" style="position: fixed; top: 100px; right: 20px; z-index: 9999; background: #0a192f; border: 2px solid #2dd4bf; color: #2dd4bf; padding: 1rem 2rem; border-radius: 8px;">
            <i class="fas fa-check-circle"></i> <?= htmlspecialchars($successMessage) ?>
        </div>
        <script>
            setTimeout(function() {
                var msg = document.getElementById('successMessage');
                if (msg) msg.style.display = 'none';
            }, 5000);
        </script>
    <?php endif; ?>
    <?php if ($errorMessage): ?>
        <div class="alert alert-error" id="errorMessage" style="position: fixed; top: 100px; right: 20px; z-index: 9999; background: #0a192f; border: 2px solid #fb7185; color: #fb7185; padding: 1rem 2rem; border-radius: 8px;">
            <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($errorMessage) ?>
        </div>
        <script>
            setTimeout(function() {
                var msg = document.getElementById('errorMessage');
                if (msg) msg.style.display = 'none';
            }, 5000);
        </script>
    <?php endif; ?>

    <!-- MODAL OVERLAY for Award Applications -->
    <div class="modal-overlay" id="categoryModal">
        <div class="modal-content">
            <span class="modal-close" id="modalClose">&times;</span>
            <h3 class="modal-title" id="modalTitle">Category Title</h3>
            
            <div id="requirementsSection">
                <div class="modal-section">
                    <h4>About This Award</h4>
                    <p id="awardDescription" style="color: var(--text-muted); margin-bottom: 1.5rem;"></p>
                    
                    <h4>Eligibility Requirements:</h4>
                    <ul id="eligibilityList"></ul>
                    
                    <h4 style="margin-top: 1.5rem;">Selection Criteria:</h4>
                    <ul id="criteriaList"></ul>
                    
                    <div class="modal-section" style="background: rgba(255, 215, 0, 0.1); padding: 1rem; border-radius: var(--radius-md); margin-top: 1.5rem;">
                        <p style="color: var(--accent-gold); font-weight: 600; margin-bottom: 0.5rem;">🏆 Prize Details</p>
                        <p id="prizeDetails" style="color: var(--text-light);"></p>
                        <p id="openToDetails" style="color: var(--text-muted); font-size: 0.9rem; margin-top: 0.5rem;"></p>
                        <p style="color: var(--accent-teal); font-size: 0.9rem; margin-top: 0.5rem;">✨ Up to 5 winners may be selected in this category</p>
                    </div>
                </div>
                <div class="modal-buttons">
                    <button class="modal-btn modal-btn-primary" id="showApplicationBtn">Apply Now</button>
                    <button class="modal-btn modal-btn-secondary" id="modalCancelBtn">Cancel</button>
                </div>
            </div>
            
            <div id="applicationSection" style="display: none;">
                <div class="application-form">
                    <h4>Apply for <span id="applicationTitle"></span></h4>
                    <form method="POST" action="index.php">
                        <input type="hidden" name="form_type" value="award_application">
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
                        
                        <div class="form-group">
                            <label for="linkedin">LinkedIn Profile *</label>
                            <div class="linkedin-input">
                                <span>linkedin.com/in/</span>
                                <input type="text" id="linkedin" name="linkedin" placeholder="username" required>
                            </div>
                            <small style="color: var(--text-muted);">Enter your LinkedIn username</small>
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

    <!-- NEW MODAL OVERLAY for Standalone Nomination -->
    <div class="modal-overlay" id="nominationModal">
        <div class="modal-content" id="nominationModalContent">
            <span class="modal-close" id="nominationModalClose">&times;</span>
            <h3 class="modal-title">Nominate Yourself or Someone Else</h3>
            
            <div class="application-form">
                <form method="POST" action="index.php">
                    <input type="hidden" name="form_type" value="standalone_nomination">
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="modalFirstName">First Name *</label>
                            <input type="text" id="modalFirstName" name="firstName" required>
                        </div>
                        <div class="form-group">
                            <label for="modalLastName">Last Name *</label>
                            <input type="text" id="modalLastName" name="lastName" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="modalEmail">Email Address *</label>
                        <input type="email" id="modalEmail" name="email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="modalPhone">Phone Number *</label>
                        <input type="tel" id="modalPhone" name="phone" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="modalCategory">Award Category *</label>
                        <select id="modalCategory" name="category" required>
                            <option value="">Select a category</option>
                            <option value="research">African Development Research Award</option>
                            <option value="ai">AI Champion Award</option>
                            <option value="women">Mamokgethi Phakeng Prize</option>
                            <option value="entrepreneur">Young Entrepreneur Award</option>
                            <option value="agriculture">Youth in Agriculture Award</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="modalQualification">Highest Qualification *</label>
                        <select id="modalQualification" name="qualification" required>
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
                        <label for="modalInstitution">Institution *</label>
                        <input type="text" id="modalInstitution" name="institution" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="modalLinkedin">LinkedIn Profile *</label>
                        <div class="linkedin-input">
                            <span>linkedin.com/in/</span>
                            <input type="text" id="modalLinkedin" name="linkedin" placeholder="username" required>
                        </div>
                        <small style="color: var(--text-muted);">Enter your LinkedIn username</small>
                    </div>
                    
                    <div class="form-group">
                        <label for="modalAchievements">Key Achievements *</label>
                        <textarea id="modalAchievements" name="achievements" placeholder="Tell us about achievements relevant to this award" required></textarea>
                    </div>
                    
                    <div class="checkbox-group">
                        <input type="checkbox" id="modalTerms" name="terms" required>
                        <label for="modalTerms">I confirm that all information provided is true and complete *</label>
                    </div>
                    
                    <div class="modal-buttons">
                        <button type="submit" class="modal-btn modal-btn-primary">Submit Nomination</button>
                        <button type="button" class="modal-btn modal-btn-secondary" id="nominationModalCancel">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- NAVBAR with clickable logo and hamburger menu -->
    <nav class="fixed-nav">
        <div class="nav-left">
            <a href="#home" class="logo-link">
                <img src="realogo.png" alt="MEF Logo" class="logo">
            </a>
            <div class="brand-text">
                <div class="brand-main">MAKE EDUCATION FASHIONABLE</div>
                <div class="brand-sub">MEF · Since 2015</div>
            </div>
        </div>
        
        <div class="menu-toggle" id="menuToggle">
            <i class="fas fa-bars"></i>
        </div>

        <div class="nav-links" id="navLinks">
            <a href="#home" class="active">Home</a>
            <a href="#about">About</a>
            <a href="#services">Services</a>
            <a href="#testimonials">Testimonies</a>
            <a href="#contact">Contact</a>
        </div>
    </nav>

    <main class="content">

        <!-- HOME with looping typing animation on H1 -->
        <section id="home">
            <img src="graduates.jpg" alt="MEF Background - Graduates" class="home-bg">
            <div class="home-overlay"></div>
            <div class="home-content">
                <h1 id="typingHeading"></h1>
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
                            <li>Share your personal story of victory with <span class="highlight-hashtag">#MakeEducationFashionable</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- SERVICES (6 boxes + ticket link + standalone nomination button) -->
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
                        <ul class="showcase-features" style="list-style: none; margin: 1.5rem 0;">
                            <li style="margin: 0.8rem 0; padding-left: 2rem; position: relative; color: var(--text-muted); font-size: 0.95rem;"><span style="content: '✓'; color: var(--accent-teal); position: absolute; left: 0; font-weight: bold; font-size: 1.2rem;">✓</span>5 prestigious award categories</li>
                            <li style="margin: 0.8rem 0; padding-left: 2rem; position: relative; color: var(--text-muted); font-size: 0.95rem;"><span style="content: '✓'; color: var(--accent-teal); position: absolute; left: 0; font-weight: bold; font-size: 1.2rem;">✓</span>Open nominations across the continent</li>
                            <li style="margin: 0.8rem 0; padding-left: 2rem; position: relative; color: var(--text-muted); font-size: 0.95rem;"><span style="content: '✓'; color: var(--accent-teal); position: absolute; left: 0; font-weight: bold; font-size: 1.2rem;">✓</span>Independent judging panel</li>
                            <li style="margin: 0.8rem 0; padding-left: 2rem; position: relative; color: var(--text-muted); font-size: 0.95rem;"><span style="content: '✓'; color: var(--accent-teal); position: absolute; left: 0; font-weight: bold; font-size: 1.2rem;">✓</span>Recognition ceremony and media coverage</li>
                        </ul>
                        <div class="showcase-stats" style="display: flex; gap: 1.5rem; margin-top: 1.5rem; flex-wrap: wrap; justify-content: center;">
                            <div class="stat-item" style="text-align: center;"><div class="stat-number" style="font-size: 2rem; font-weight: 800; color: var(--accent-gold); line-height: 1;">100+</div><div class="stat-label" style="color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px;">Nominees</div></div>
                            <div class="stat-item" style="text-align: center;"><div class="stat-number" style="font-size: 2rem; font-weight: 800; color: var(--accent-gold); line-height: 1;">15</div><div class="stat-label" style="color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px;">Winners</div></div>
                            <div class="stat-item" style="text-align: center;"><div class="stat-number" style="font-size: 2rem; font-weight: 800; color: var(--accent-gold); line-height: 1;">4</div><div class="stat-label" style="color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px;">Countries</div></div>
                        </div>
                    </div>
                </div>

                <!-- Award Categories Title -->
                <div class="categories-title">
                    <h3>Award Categories & Events</h3>
                    <p style="color: var(--text-muted); font-size: 0.95rem;">Click on any category to view requirements and apply</p>
                </div>

                <!-- 6 BOXES (5 award categories + 1 convocation card) -->
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

                <!-- Standalone Nomination Button (opens modal) -->
                <div class="category-card nomination-form-section" id="nominationForm">
                    <h3>Nominate Yourself or Someone Else</h3>
                    <p>Every story of victory deserves to be celebrated. Click the button below to submit a nomination.</p>
                    
                    <!-- Button to open modal -->
                    <button class="btn-gold" id="openNominationModalBtn">
                        <i class="fas fa-pen"></i> Nominate Now
                    </button>
                </div>
            </div>
        </section>

        <!-- TESTIMONIES -->
        <section id="testimonials" class="section">
            <div class="section-container">
                <h2 class="section-title">Testimonies</h2>
                <div class="testimonials-grid">
                    <div class="testimonial-card">
                        <div class="testimonial-header"><div class="stars">★★★★★</div><div class="date">Dec 2025</div></div>
                        <p class="testimonial-message">“MEF gave my story a platform — I went from feeling invisible to inspiring thousands. Thank you for making education fashionable again!”</p>
                        <div class="testimonial-author"><div class="author-avatar">N</div><div><div style="font-weight:600;">Nomfundo</div><div style="color:var(--text-muted);font-size:0.85rem;">BCom Graduate • Johannesburg</div></div></div>
                    </div>
                    <div class="testimonial-card">
                        <div class="testimonial-header"><div class="stars">★★★★★</div><div class="date">Nov 2025</div></div>
                        <p class="testimonial-message">“After sharing my journey in agriculture, I connected with investors. MEF truly changes lives.”</p>
                        <div class="testimonial-author"><div class="author-avatar">T</div><div><div style="font-weight:600;">Thabo</div><div style="color:var(--text-muted);font-size:0.85rem;">BSc Agric • Limpopo</div></div></div>
                    </div>
                    <div class="testimonial-card">
                        <div class="testimonial-header"><div class="stars">★★★★★</div><div class="date">Oct 2025</div></div>
                        <p class="testimonial-message">“Winning the Young Entrepreneur Award opened doors I never imagined. MEF is truly life-changing.”</p>
                        <div class="testimonial-author"><div class="author-avatar">K</div><div><div style="font-weight:600;">Kabelo</div><div style="color:var(--text-muted);font-size:0.85rem;">Tech Founder • Cape Town</div></div></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CONTACT -->
        <section id="contact" class="section">
            <div class="section-container">
                <h2 class="section-title">Get in Touch</h2>
                <div class="contact-grid">
                    <div class="contact-info">
                        <h3>Connect With Us</h3>
                        <div class="info-item"><i class="fas fa-envelope"></i><div><div style="font-weight:600;color:var(--accent-purple);">Email</div><div style="font-size:0.9rem;">pngnkosi@gmail.com</div><div style="font-size:0.9rem;">kgethi@perspicuty.africa</div></div></div>
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
                        <form method="POST" action="index.php">
                            <input type="hidden" name="form_type" value="contact">
                            <div class="form-group"><input type="text" id="name" name="name" placeholder="Your Name" required></div>
                            <div class="form-group"><input type="email" id="email" name="email" placeholder="Your Email" required></div>
                            <div class="form-group"><input type="text" id="subject" name="subject" placeholder="Subject" required></div>
                            <div class="form-group"><textarea id="message" name="message" placeholder="Your Message" required></textarea></div>
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
                <div class="footer-about"><h4>About MEF</h4><p>Make Education Fashionable is a movement founded by Prof. Mamokgethi Phakeng to celebrate educational achievements and inspire the next generation of African leaders.</p><div class="brand-small"><i class="fas fa-graduation-cap"></i><span>MEF · Since 2015</span></div></div>
                <div class="footer-quick"><h4>Quick Links</h4><ul><li><a href="#home"><i class="fas fa-chevron-right"></i> Home</a></li><li><a href="#about"><i class="fas fa-chevron-right"></i> About Us</a></li><li><a href="#services"><i class="fas fa-chevron-right"></i> Services & Awards</a></li><li><a href="#testimonials"><i class="fas fa-chevron-right"></i> Testimonies</a></li><li><a href="#contact"><i class="fas fa-chevron-right"></i> Contact</a></li></ul></div>
                <div class="footer-social"><h4>Connect With Us</h4><div class="footer-social-grid"><a href="https://www.tiktok.com/@fabacademic" target="_blank" class="footer-social-item"><i class="fab fa-tiktok"></i><span>TikTok</span></a><a href="https://twitter.com/fabacademic" target="_blank" class="footer-social-item"><i class="fab fa-twitter"></i><span>Twitter / X</span></a><a href="https://instagram.com/fabacademic" target="_blank" class="footer-social-item"><i class="fab fa-instagram"></i><span>Instagram</span></a><a href="https://linkedin.com/in/mamokgethiphakeng" target="_blank" class="footer-social-item"><i class="fab fa-linkedin"></i><span>LinkedIn</span></a><a href="https://www.youtube.com/@Fabacademic" target="_blank" class="footer-social-item"><i class="fab fa-youtube"></i><span>YouTube</span></a><a href="https://www.facebook.com/kgethi.phakeng" target="_blank" class="footer-social-item"><i class="fab fa-facebook"></i><span>Facebook</span></a></div></div>
            </div>
            <div class="footer-bottom"><div>© 2025 MEF – Make Education Fashionable. All rights reserved.</div><div class="footer-bottom-links"><a href="#">Privacy Policy</a><a href="#">Terms of Use</a><a href="#">Cookie Policy</a></div></div>
        </div>
    </footer>

    <script>
    // LOOPING TYPING ANIMATION FOR HOME HEADING
    const headingSentence = "Make Education Fashionable";
    let headingIndex = 0;
    let isDeleting = false;
    const headingElement = document.getElementById("typingHeading");
    const typingSpeed = 100;
    const deletingSpeed = 50;
    const pauseTime = 2000;
    
    function typeHeadingEffect() {
        if (!headingElement) return;
        
        if (!isDeleting && headingIndex <= headingSentence.length) {
            headingElement.innerHTML = headingSentence.substring(0, headingIndex) + '<span class="typing-cursor"></span>';
            headingIndex++;
            
            if (headingIndex > headingSentence.length) {
                isDeleting = true;
                setTimeout(typeHeadingEffect, pauseTime);
                return;
            }
        } else if (isDeleting && headingIndex >= 0) {
            headingElement.innerHTML = headingSentence.substring(0, headingIndex) + '<span class="typing-cursor"></span>';
            headingIndex--;
            
            if (headingIndex < 0) {
                isDeleting = false;
                headingIndex = 0;
            }
        }
        
        const nextDelay = isDeleting ? deletingSpeed : typingSpeed;
        setTimeout(typeHeadingEffect, nextDelay);
    }

    // Start typing animation when page loads
    window.onload = function() {
        typeHeadingEffect();
        
        // Initialize category cards after page loads
        setTimeout(initCategoryCards, 100);
    };

    // Mobile menu toggle
    document.getElementById('menuToggle').addEventListener('click', function() {
        document.getElementById('navLinks').classList.toggle('active');
    });

    // Close mobile menu when clicking a link
    document.querySelectorAll('.nav-links a').forEach(link => {
        link.addEventListener('click', function() {
            document.getElementById('navLinks').classList.remove('active');
        });
    });

    // Smooth scroll + active link
    document.querySelectorAll('.nav-links a, .logo-link').forEach(link => {
        link.addEventListener('click', e => {
            const href = link.getAttribute('href');
            if (href && href.startsWith('#')) {
                e.preventDefault();
                if (!link.classList.contains('logo-link')) {
                    document.querySelectorAll('.nav-links a').forEach(l => l.classList.remove('active'));
                    link.classList.add('active');
                }
                
                const target = document.querySelector(href);
                if (target) {
                    const offset = 80;
                    const targetPosition = target.offsetTop - offset;
                    
                    window.scrollTo({
                        top: targetPosition,
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
        
        if (scrollTop > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
        
        if (scrollTop > lastScrollTop && scrollTop > 100) {
            navbar.classList.add('hidden');
        } else {
            navbar.classList.remove('hidden');
        }
        
        if (scrollTop === 0) {
            navbar.classList.remove('hidden');
        }
        
        lastScrollTop = scrollTop;

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

    // Category data from PHP
    const categoryDetails = <?php echo json_encode($categoryDetails); ?>;

    // Function to initialize category cards
    function initCategoryCards() {
        console.log('Initializing category cards...');
        
        // Get all category cards that have data-category attribute (the 5 award cards)
        const categoryCards = document.querySelectorAll('.category-card[data-category]');
        
        console.log('Found category cards:', categoryCards.length);
        
        categoryCards.forEach((card, index) => {
            // Remove any existing listeners
            card.removeEventListener('click', handleCategoryClick);
            // Add new listener
            card.addEventListener('click', handleCategoryClick);
            console.log(`Added click listener to card ${index + 1}:`, card.dataset.category);
        });
    }

    // Category click handler
    function handleCategoryClick(e) {
        e.preventDefault();
        e.stopPropagation();
        
        const card = this;
        const category = card.dataset.category;
        
        console.log('Card clicked:', category);
        
        if (!category) {
            console.log('No category found');
            return;
        }
        
        const data = categoryDetails[category];
        
        if (!data) {
            console.log('No data found for category:', category);
            return;
        }
        
        console.log('Opening modal for:', data.name);
        
        // Update modal content
        document.getElementById('modalTitle').textContent = data.name;
        document.getElementById('applicationTitle').textContent = data.name;
        document.getElementById('appliedCategory').value = data.name;
        document.getElementById('applicationCategory').value = category;
        document.getElementById('awardDescription').textContent = data.description;
        
        // Build eligibility list
        let eligibilityHtml = '';
        data.eligibility.forEach(req => {
            eligibilityHtml += `<li>${req}</li>`;
        });
        document.getElementById('eligibilityList').innerHTML = eligibilityHtml;
        
        // Build criteria list
        let criteriaHtml = '';
        data.criteria.forEach(crit => {
            criteriaHtml += `<li>${crit}</li>`;
        });
        document.getElementById('criteriaList').innerHTML = criteriaHtml;
        
        // Set prize and open to details
        document.getElementById('prizeDetails').textContent = data.prize;
        document.getElementById('openToDetails').textContent = `🌍 Open to: ${data.open_to}`;
        
        // Show requirements section
        document.getElementById('requirementsSection').style.display = 'block';
        document.getElementById('applicationSection').style.display = 'none';
        document.getElementById('successSection').style.display = 'none';
        
        // Show modal
        document.getElementById('categoryModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    // Award Modal elements
    const modal = document.getElementById('categoryModal');
    const modalClose = document.getElementById('modalClose');
    const modalCancel = document.getElementById('modalCancelBtn');
    const showApplicationBtn = document.getElementById('showApplicationBtn');
    const backToRequirementsBtn = document.getElementById('backToRequirementsBtn');

    // Show award application form
    showApplicationBtn.addEventListener('click', function() {
        document.getElementById('requirementsSection').style.display = 'none';
        document.getElementById('applicationSection').style.display = 'block';
        document.getElementById('successSection').style.display = 'none';
    });

    // Back to award requirements
    backToRequirementsBtn.addEventListener('click', function() {
        document.getElementById('requirementsSection').style.display = 'block';
        document.getElementById('applicationSection').style.display = 'none';
        document.getElementById('successSection').style.display = 'none';
    });

    // Close award modal
    function closeModal() {
        modal.classList.remove('active');
        document.body.style.overflow = 'auto';
    }

    modalClose.addEventListener('click', closeModal);
    modalCancel.addEventListener('click', closeModal);
    modal.addEventListener('click', function(e) { 
        if (e.target === modal) closeModal(); 
    });

    // Nomination modal elements
    const nominationModal = document.getElementById('nominationModal');
    const nominationModalClose = document.getElementById('nominationModalClose');
    const nominationModalCancel = document.getElementById('nominationModalCancel');
    const openNominationModalBtn = document.getElementById('openNominationModalBtn');

    // Nomination modal functions
    function openNominationModal() {
        nominationModal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeNominationModal() {
        nominationModal.classList.remove('active');
        document.body.style.overflow = 'auto';
    }

    if (openNominationModalBtn) {
        openNominationModalBtn.addEventListener('click', openNominationModal);
    }
    
    if (nominationModalClose) {
        nominationModalClose.addEventListener('click', closeNominationModal);
    }
    
    if (nominationModalCancel) {
        nominationModalCancel.addEventListener('click', closeNominationModal);
    }
    
    if (nominationModal) {
        nominationModal.addEventListener('click', function(e) { 
            if (e.target === nominationModal) closeNominationModal(); 
        });
    }

    // Close mobile menu when clicking outside
    document.addEventListener('click', function(e) {
        const navLinks = document.getElementById('navLinks');
        const menuToggle = document.getElementById('menuToggle');
        
        if (window.innerWidth <= 768 && 
            navLinks.classList.contains('active') && 
            !navLinks.contains(e.target) && 
            !menuToggle.contains(e.target)) {
            navLinks.classList.remove('active');
        }
    });

    // Initialize on DOM content loaded
    document.addEventListener('DOMContentLoaded', function() {
        initCategoryCards();
    });
</script>
</body>
</html>