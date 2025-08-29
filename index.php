<?php
require_once 'includes/config.php';

try {
    // Fetch projects from database
    $pdo = getDBConnection();
    $projectsStmt = $pdo->query("SELECT * FROM projects ORDER BY created_at DESC");
    $projects = $projectsStmt->fetchAll();
    
    // Fetch achievements from database
    $achievementsStmt = $pdo->query("SELECT * FROM achievements ORDER BY achievement_date DESC");
    $achievements = $achievementsStmt->fetchAll();
    
    // Fetch education from database
    $educationStmt = $pdo->query("SELECT * FROM education ORDER BY id DESC");
    $education = $educationStmt->fetchAll();
    
} catch (Exception $e) {
    $projects = [];
    $achievements = [];
    $education = [];
    error_log("Database error: " . $e->getMessage());
}

$pageTitle = "Home";
include 'includes/header.php';
?>

<!-- Hero Section -->
<section id="home" class="hero">
    <div class="container">
        <div class="hero-content">
            <h1 class="hero-title" data-typewriter>Hi, I'm Md. Nayeem</h1>
            <p class="hero-subtitle">App Developer • 3rd Year CSE at KUET</p>
            <p class="hero-description">
                Welcome to my digital portfolio! I'm a passionate developer who loves creating innovative mobile applications 
                and web solutions. Currently pursuing Computer Science and Engineering at Khulna University of Engineering & Technology.
            </p>
            <div class="hero-buttons">
                <a href="#projects" class="btn btn-primary">View My Work</a>
                <a href="#contact" class="btn btn-secondary">Get In Touch</a>
            </div>
        </div>
    </div>
</section>


<!-- About Section -->
<section id="about" class="section about">
    <div class="container">
        <h2 class="section-title">About Me</h2>
        <div class="about-content">
            <div class="about-image">
                <img src="https://avatars.githubusercontent.com/u/65258767?v=4" alt="Md. Nayeem - Profile Photo" >
            </div>
            <div class="about-text">
                <h3>My Journey</h3>
                <p>
                    I'm a dedicated Computer Science and Engineering student at KUET with a passion for developing 
                    innovative solutions through technology. My journey began with curiosity about how applications work, 
                    which led me to explore mobile app development, web technologies, and software engineering.
                </p>
                <p>
                    Currently in my third year, I've gained experience in various programming languages and frameworks, 
                    with a special focus on mobile app development using Flutter and Android native development. 
                    I enjoy tackling complex problems and turning ideas into reality through clean, efficient code.
                </p>
                <p>
                    When I'm not coding, you can find me participating in programming competitions, contributing to 
                    open-source projects, or exploring the latest trends in technology and software development.
                </p>
                
                <div class="about-stats">
                    <div class="stat-item">
                        <span class="stat-number">15+</span>
                        <span class="stat-label">Projects</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">3+</span>
                        <span class="stat-label">Years Learning</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">5+</span>
                        <span class="stat-label">Technologies</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">10+</span>
                        <span class="stat-label">Achievements</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php include 'includes/footer.php'; ?>