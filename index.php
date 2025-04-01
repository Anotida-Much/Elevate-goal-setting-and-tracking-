<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description"
        content="Elevate: Your ultimate goal setting and tracking web app to help you achieve your aspirations and maximum potential.">
    <meta name="keywords" content="goal setting, goal tracking, productivity, personal development, Elevate">
    <meta name="author" content="Anotida Muchinhairi">
    <title>Elevate - Transform Your Dreams into Reality</title>

    <!-- Local CSS Libraries -->
    <link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="node_modules/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="node_modules/aos/dist/aos.css" rel="stylesheet">
    <link href="node_modules/animate.css/animate.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #0d6efd;
            --secondary-color: #0dcaf0;
            --accent-color: #ff6b6b;
            --dark-color: #2d3436;
            --light-color: #f8f9fa;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            color: var(--dark-color);
        }

        .navbar {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95) !important;
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.98) !important;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        }

        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(13, 110, 253, 0.2);
            padding-top: 80px;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('assets/img/pattern.png') repeat;
            opacity: 0.1;
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            color: white;
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
            animation: fadeInUp 1s ease;
        }

        .hero-subtitle {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            opacity: 0.9;
            max-width: 600px;
            animation: fadeInUp 1s ease 0.2s;
            animation-fill-mode: both;
        }

        .social-proof {
            display: flex;
            align-items: center;
            gap: 2rem;
            margin-top: 2rem;
            padding: 1.5rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: fadeInUp 1s ease 0.4s;
            animation-fill-mode: both;
        }

        .social-proof-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: transform 0.3s ease;
        }

        .social-proof-item:hover {
            transform: translateY(-5px);
        }

        .social-proof-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .social-proof-label {
            font-size: 1rem;
            opacity: 0.9;
            font-weight: 500;
        }

        .feature-card {
            border: none;
            border-radius: 20px;
            transition: all 0.4s ease;
            height: 100%;
            box-shadow: 0 10px 30px rgba(13, 110, 253, 0.1);
            background: white;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(13, 110, 253, 0.1);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(13, 110, 253, 0.2);
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .feature-card:hover::before {
            opacity: 1;
        }

        .feature-icon-wrapper {
            width: 90px;
            height: 90px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            background: rgba(13, 110, 253, 0.1);
            border-radius: 50%;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .feature-icon-wrapper::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .feature-card:hover .feature-icon-wrapper::before {
            opacity: 0.1;
        }

        .feature-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            transition: all 0.4s ease;
            position: relative;
            z-index: 1;
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.1);
            color: var(--secondary-color);
        }

        .testimonial-card {
            background: white;
            border-radius: 20px;
            padding: 2.5rem;
            margin: 1rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.4s ease;
            position: relative;
            border: 1px solid rgba(13, 110, 253, 0.1);
        }

        .testimonial-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .testimonial-card::before {
            content: '"';
            position: absolute;
            top: -20px;
            left: 20px;
            font-size: 5rem;
            color: var(--primary-color);
            opacity: 0.1;
            font-family: Georgia, serif;
            transition: all 0.4s ease;
        }

        .testimonial-card:hover::before {
            transform: scale(1.1);
        }

        .cta-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            padding: 6rem 0;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('assets/img/Achievement.png');
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
            opacity: 0.1;
        }

        .cta-content {
            position: relative;
            z-index: 2;
        }

        .cta-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .cta-subtitle {
            font-size: 1.5rem;
            margin-bottom: 2.5rem;
            opacity: 0.9;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        .btn {
            padding: 1rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            border: none;
            box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(13, 110, 253, 0.4);
        }

        .btn-outline-primary {
            border: 2px solid var(--primary-color);
        }

        .btn-outline-primary:hover {
            background: var(--primary-color);
            transform: translateY(-2px);
        }

        .section-title {
            position: relative;
            display: inline-block;
            margin-bottom: 3rem;
            font-weight: 800;
            font-size: 2.5rem;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            border-radius: 2px;
        }

        .floating-elements {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }

        .floating-element {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 20s infinite linear;
        }

        @keyframes float {
            0% {
                transform: translate(0, 0) rotate(0deg);
            }

            100% {
                transform: translate(100px, 100px) rotate(360deg);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .testimonial-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--primary-color);
            transition: all 0.3s ease;
        }

        .testimonial-card:hover .testimonial-avatar {
            transform: scale(1.1);
            border-color: var(--secondary-color);
        }

        footer {
            background: var(--dark-color);
            color: white;
            padding: 5rem 0 3rem;
            position: relative;
            overflow: hidden;
        }

        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        }

        footer h5 {
            color: white;
            font-weight: 700;
            margin-bottom: 1.5rem;
            font-size: 1.25rem;
            position: relative;
            padding-bottom: 0.5rem;
        }

        footer h5::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 2px;
            background: var(--primary-color);
        }

        footer p {
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.6;
        }

        footer ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        footer ul li {
            margin-bottom: 0.75rem;
        }

        footer a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
        }

        footer a:hover {
            color: var(--primary-color);
            transform: translateX(5px);
        }

        .footer-social {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .footer-social a {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .footer-social a:hover {
            background: var(--primary-color);
            transform: translateY(-3px);
        }

        .footer-bottom {
            margin-top: 4rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
            color: rgba(255, 255, 255, 0.6);
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.2rem;
            }

            .social-proof {
                flex-direction: column;
                gap: 1rem;
            }

            .cta-title {
                font-size: 2rem;
            }

            .section-title {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="assets/img/logo.jpg" alt="Elevate Logo" height="40" class="me-2">
                <span class="fw-bold text-primary">Elevate</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#how-it-works">How It Works</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#testimonials">Success Stories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="views/support.php">Support</a>
                    </li>
                </ul>
                <div class="d-flex gap-2">
                    <a href="views/login.php" class="btn btn-outline-primary">Login</a>
                    <a href="views/sign-up.php" class="btn btn-primary">Get Started Free</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section d-flex align-items-center">
        <div class="position-absolute w-100 h-100">
            <div class="floating-element" style="width: 100px; height: 100px; top: 20%; left: 10%;"></div>
            <div class="floating-element" style="width: 150px; height: 150px; top: 60%; right: 15%;"></div>
            <div class="floating-element" style="width: 80px; height: 80px; bottom: 20%; left: 20%;"></div>
        </div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-content text-white" data-aos="fade-right">
                    <h1 class="display-4 fw-bold mb-4">Transform Your Dreams into Reality</h1>
                    <p class="lead mb-4">Join thousands of achievers who are setting, tracking, and accomplishing their
                        goals with Elevate. Start your journey to success today.</p>
                    <div class="d-flex gap-3 mb-4">
                        <a href="views/sign-up.php" class="btn btn-light">Start Free Trial</a>
                        <a href="#features" class="btn btn-outline-light">See How It Works</a>
                    </div>
                    <div class="social-proof p-4">
                        <div class="row g-4">
                            <div class="col-4">
                                <div class="text-center">
                                    <div class="display-6 fw-bold">10K+</div>
                                    <div class="small">Active Users</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="text-center">
                                    <div class="display-6 fw-bold">95%</div>
                                    <div class="small">Success Rate</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="text-center">
                                    <div class="display-6 fw-bold">4.9/5</div>
                                    <div class="small">User Rating</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <img src="assets/img/Achievement.png" title="Achievement" alt="Elevate Dashboard Preview"
                        class="img-fluid rounded shadow-lg">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-5">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="display-4 fw-bold section-title">Why Choose Elevate?</h2>
                <p class="lead text-muted">Everything you need to achieve your goals, all in one place</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card feature-card h-100">
                        <div class="card-body text-center p-4">
                            <div
                                class="feature-icon-wrapper d-flex align-items-center justify-content-center mx-auto mb-4">
                                <i class="bi bi-bullseye fs-1 text-primary"></i>
                            </div>
                            <h3 class="h4 mb-3">Smart Goal Setting</h3>
                            <p class="text-muted mb-0">Set clear, achievable goals with our intuitive interface. Break
                                down complex goals into manageable steps and track your progress in real-time.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card feature-card h-100">
                        <div class="card-body text-center p-4">
                            <div
                                class="feature-icon-wrapper d-flex align-items-center justify-content-center mx-auto mb-4">
                                <i class="bi bi-graph-up fs-1 text-primary"></i>
                            </div>
                            <h3 class="h4 mb-3">Progress Tracking</h3>
                            <p class="text-muted mb-0">Monitor your achievements with detailed analytics and visual
                                progress indicators. Get insights that help you stay motivated and on track.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="card feature-card h-100">
                        <div class="card-body text-center p-4">
                            <div
                                class="feature-icon-wrapper d-flex align-items-center justify-content-center mx-auto mb-4">
                                <i class="bi bi-bell fs-1 text-primary"></i>
                            </div>
                            <h3 class="h4 mb-3">Smart Reminders</h3>
                            <p class="text-muted mb-0">Never miss a deadline with customizable reminders and
                                notifications. Stay focused and maintain momentum with intelligent scheduling.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="display-4 fw-bold section-title">How Elevate Works</h2>
                <p class="lead text-muted">Start achieving your goals in three simple steps</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card feature-card shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <div class="position-relative mb-4">
                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto"
                                    style="width: 80px; height: 80px;">
                                    <span class="display-4">1</span>
                                </div>
                            </div>
                            <h3 class="h4 mb-3">Set Your Goals</h3>
                            <p class="text-muted">Create clear, actionable goals with our intuitive interface. Break
                                down big dreams into manageable steps.</p>
                            <div class="mt-3">
                                <img src="assets/img/goal-setting-preview.png" alt="Goal Setting Preview"
                                    class="img-fluid rounded shadow-sm" style="max-height: 200px;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card feature-card shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <div class="position-relative mb-4">
                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto"
                                    style="width: 80px; height: 80px;">
                                    <span class="display-4">2</span>
                                </div>
                            </div>
                            <h3 class="h4 mb-3">Track Progress</h3>
                            <p class="text-muted">Monitor your achievements with visual progress indicators and detailed
                                analytics to stay motivated.</p>
                            <div class="mt-3">
                                <img src="assets/img/progress-tracking-preview.png" alt="Progress Tracking Preview"
                                    class="img-fluid rounded shadow-sm" style="max-height: 200px;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="card feature-card shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <div class="position-relative mb-4">
                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto"
                                    style="width: 80px; height: 80px;">
                                    <span class="display-4">3</span>
                                </div>
                            </div>
                            <h3 class="h4 mb-3">Achieve Success</h3>
                            <p class="text-muted">Celebrate milestones, adjust strategies, and watch your dreams become
                                reality with our supportive platform.</p>
                            <div class="mt-3">
                                <img src="assets/img/achievement-preview.png" alt="Achievement Preview"
                                    class="img-fluid rounded shadow-sm" style="max-height: 200px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5" data-aos="fade-up">
                <a href="views/sign-up.php" class="btn btn-primary btn-lg px-5">Start Your Journey Today</a>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-5">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="display-4 fw-bold section-title">Success Stories</h2>
                <p class="lead text-muted">Join thousands of successful users who have transformed their lives with
                    Elevate</p>
            </div>
            <div class="row">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="testimonial-card shadow-sm">
                        <div class="d-flex align-items-center mb-3">
                            <img src="assets/img/testimonial1.jpg" alt="User Avatar" class="testimonial-avatar me-3">
                            <div>
                                <h5 class="mb-0">Sarah Johnson</h5>
                                <p class="text-muted mb-0">Entrepreneur</p>
                            </div>
                        </div>
                        <p class="mb-0">"Elevate has completely transformed how I approach my goals. The progress
                            tracking and reminders keep me motivated!"</p>
                        <div class="mt-3">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="testimonial-card shadow-sm">
                        <div class="d-flex align-items-center mb-3">
                            <img src="assets/img/testimonial2.jpg" alt="User Avatar" class="testimonial-avatar me-3">
                            <div>
                                <h5 class="mb-0">Michael Chen</h5>
                                <p class="text-muted mb-0">Professional Athlete</p>
                            </div>
                        </div>
                        <p class="mb-0">"The best goal-setting app I've ever used. Simple, intuitive, and incredibly
                            effective."</p>
                        <div class="mt-3">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="testimonial-card shadow-sm">
                        <div class="d-flex align-items-center mb-3">
                            <img src="assets/img/testimonial3.jpg" alt="User Avatar" class="testimonial-avatar me-3">
                            <div>
                                <h5 class="mb-0">Emma Davis</h5>
                                <p class="text-muted mb-0">Student</p>
                            </div>
                        </div>
                        <p class="mb-0">"I've achieved more in the last 6 months with Elevate than I did in the previous
                            year!"</p>
                        <div class="mt-3">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content" data-aos="fade-up">
                <h2 class="cta-title">Ready to Transform Your Life?</h2>
                <p class="cta-subtitle">Join thousands of achievers who are already using Elevate to reach their goals.
                    Start your journey to success today.</p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="views/sign-up.php" class="btn btn-light btn-lg px-5">Get Started Free</a>
                    <a href="#features" class="btn btn-outline-light btn-lg px-5">Learn More</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-white py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <h5 class="mb-4">About Elevate</h5>
                    <p class="text-white-50">Transform your dreams into reality with Elevate. Our platform helps you
                        set, track, and achieve your goals with smart features and intuitive design.</p>
                    <div class="footer-social d-flex gap-3 mt-4">
                        <a href="#" class="d-flex align-items-center justify-content-center"><i
                                class="bi bi-facebook"></i></a>
                        <a href="#" class="d-flex align-items-center justify-content-center"><i
                                class="bi bi-twitter"></i></a>
                        <a href="#" class="d-flex align-items-center justify-content-center"><i
                                class="bi bi-linkedin"></i></a>
                        <a href="#" class="d-flex align-items-center justify-content-center"><i
                                class="bi bi-instagram"></i></a>
                    </div>
                </div>
                <div class="col-lg-2">
                    <h5>Quick Links</h5>
                    <ul>
                        <li><a href="#features">Features</a></li>
                        <li><a href="#how-it-works">How It Works</a></li>
                        <li><a href="#testimonials">Success Stories</a></li>
                        <li><a href="views/support.php">Support</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h5>Contact Us</h5>
                    <ul>
                        <li><a href="mailto:info@elevate.com"><i class="bi bi-envelope me-2"></i>info@elevate.com</a>
                        </li>
                        <li><a href="tel:+15551234567"><i class="bi bi-telephone me-2"></i>+1 (555) 123-4567</a></li>
                        <li><i class="bi bi-geo-alt me-2"></i>123 Success Street, NY</li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h5>Newsletter</h5>
                    <p>Subscribe to our newsletter for tips and updates.</p>
                    <form class="mt-3">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Enter your email">
                            <button class="btn btn-primary" type="submit">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="border-top border-white-10 mt-5 pt-4 text-center text-white-50">
                <p class="mb-0">&copy; 2024 Elevate. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Local JavaScript Libraries -->
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="node_modules/aos/dist/aos.js"></script>
    <script src="node_modules/gsap/dist/gsap.min.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function () {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Animate social proof numbers
        const socialProofNumbers = document.querySelectorAll('.social-proof-number');
        socialProofNumbers.forEach(number => {
            const target = parseInt(number.textContent);
            let current = 0;
            const increment = target / 50;
            const duration = 2000;
            const stepTime = duration / 50;

            const updateNumber = () => {
                current += increment;
                if (current < target) {
                    number.textContent = Math.round(current) + (number.textContent.includes('+') ? '+' : '');
                    setTimeout(updateNumber, stepTime);
                } else {
                    number.textContent = target + (number.textContent.includes('+') ? '+' : '');
                }
            };

            // Start animation when element is in view
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        updateNumber();
                        observer.unobserve(entry.target);
                    }
                });
            });

            observer.observe(number);
        });

        // Parallax effect for hero section
        window.addEventListener('scroll', function () {
            const hero = document.querySelector('.hero-section');
            const scrolled = window.pageYOffset;
            hero.style.backgroundPositionY = -(scrolled * 0.5) + 'px';
        });

        // Animate feature cards on hover
        const featureCards = document.querySelectorAll('.feature-card');
        featureCards.forEach(card => {
            card.addEventListener('mouseenter', function () {
                gsap.to(this, {
                    y: -10,
                    duration: 0.3,
                    ease: 'power2.out'
                });
            });

            card.addEventListener('mouseleave', function () {
                gsap.to(this, {
                    y: 0,
                    duration: 0.3,
                    ease: 'power2.out'
                });
            });
        });

        // Animate CTA section on scroll
        const ctaSection = document.querySelector('.cta-section');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    gsap.from(entry.target.querySelector('.cta-title'), {
                        y: 50,
                        opacity: 0,
                        duration: 1,
                        ease: 'power3.out'
                    });
                    gsap.from(entry.target.querySelector('.cta-subtitle'), {
                        y: 30,
                        opacity: 0,
                        duration: 1,
                        delay: 0.3,
                        ease: 'power3.out'
                    });
                    gsap.from(entry.target.querySelectorAll('.btn'), {
                        y: 20,
                        opacity: 0,
                        duration: 0.8,
                        stagger: 0.2,
                        ease: 'power3.out'
                    });
                    observer.unobserve(entry.target);
                }
            });
        });

        observer.observe(ctaSection);
    </script>
</body>

</html>