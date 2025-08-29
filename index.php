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
            <div class="hero-image">
                <img src="https://avatars.githubusercontent.com/u/65258767?v=4" alt="Md. Nayeem - Profile Photo">
            </div>
            <div class="hero-text">
                <h1 class="hero-title" data-typewriter>Md. Nayeem</h1>
                <p class="hero-subtitle">Mobile App Developer | ML Enthusiast | Flutter & Python</p>
                
                <div class="hero-social">
                    <a href="https://github.com/codernayeem" target="_blank" class="social-link">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z"/>
                        </svg>
                    </a>
                    <a href="https://linkedin.com/in/your-profile" target="_blank" class="social-link">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                    </a>
                    <a href="https://wa.me/your-number" target="_blank" class="social-link">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                        </svg>
                    </a>
                    <a href="https://facebook.com/your-profile" target="_blank" class="social-link">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                </div>
                
                <div class="hero-buttons">
                    <a href="#projects" class="btn btn-primary">View My Works</a>
                    <a href="#contact" class="btn btn-secondary">Get In Touch</a>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- About Section -->
<section id="about" class="section about">
    <div class="container">
        <h2 class="section-title">About Me</h2>
        <div class="about-content">
            <div class="about-text">
                <div class="about-sections-grid">
                    <div class="about-section-item">
                        <h3>Who am I?</h3>
                        <p>
                            I'm a passionate Mobile App Developer with strong expertise in Flutter. Currently focused on creating intuitive and performant mobile applications while exploring the fascinating world of Machine Learning. I'm also experienced in building RESTful APIs and working with databases.
                        </p>
                    </div>

                    <div class="about-section-item">
                        <h3>What I Do?</h3>
                        <ul class="about-skills">
                            <li>Develop cross-platform flutter app (Android & iOS)</li>
                            <li>Develop native android applications with kotlin</li>
                            <li>Create responsive web applications with React</li>
                            <li>Implement machine learning solutions</li>
                            <li>Design user-friendly interfaces</li>
                            <li>Write clean and maintainable code</li>
                        </ul>
                    </div>
                </div>

                <div class="about-section-item">
                    <h3>My Goals</h3>
                    <p>
                        I aim to leverage technology to solve real-world problems and create impactful solutions. My future goals include mastering AI/ML technologies and contributing to open-source projects that make a difference in people's lives.
                    </p>
                </div>
                
                <div class="about-stats">
                    <div class="stat-item">
                        <span class="stat-number">15+</span>
                        <span class="stat-label">Projects</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">5+</span>
                        <span class="stat-label">Years Learning</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">6+</span>
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