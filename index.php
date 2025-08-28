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


<?php include 'includes/footer.php'; ?>