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
    $educationStmt = $pdo->query("SELECT * FROM education ORDER BY CASE WHEN duration LIKE '%Present%' THEN 1 ELSE 0 END DESC, duration DESC");
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
                    <a href="https://www.linkedin.com/in/nayeem898" target="_blank" class="social-link">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                    </a>
                    <a href="https://wa.me/+8801968199036" target="_blank" class="social-link">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                        </svg>
                    </a>
                    <a href="https://facebook.com/md.nayeem.898" target="_blank" class="social-link">
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


<!-- Skills Section -->
<section id="skills" class="section skills">
    <div class="container">
        <h2 class="section-title">Skills & Technologies</h2>
        <div class="skills-grid">
            <!-- Left Column -->
            <div class="skills-column">
                <div class="skill-item" data-level="90">
                    <div class="skill-header">
                        <div class="skill-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M14.314 0L2.3 12L6 15.7L21.684.013h-7.357zm.014 11.072L7.857 17.53l6.47 6.47H21.7l-6.46-6.468 6.46-6.46h-7.37z"/>
                            </svg>
                        </div>
                        <span class="skill-name">Flutter & Dart</span>
                    </div>
                    <div class="skill-progress">
                        <div class="progress-bar" data-width="90"></div>
                    </div>
                </div>

                <div class="skill-item" data-level="85">
                    <div class="skill-header">
                        <div class="skill-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M14.25.18l.9.2.73.26.59.3.45.32.34.34.25.34.16.33.1.3.04.26.02.2-.01.13V8.5l-.05.63-.13.55-.21.46-.26.38-.3.31-.33.25-.35.19-.35.14-.33.1-.3.07-.26.04-.21.02H8.77l-.69.05-.59.14-.5.22-.41.27-.33.32-.27.35-.2.36-.15.37-.1.35-.07.32-.04.27-.02.21v3.06H3.17l-.21-.03-.28-.07-.32-.12-.35-.18-.36-.26-.36-.36-.35-.46-.32-.59-.28-.73-.21-.88-.14-1.05-.05-1.23.06-1.22.16-1.04.24-.87.32-.71.36-.57.4-.44.42-.33.42-.24.4-.16.36-.1.32-.05.24-.01h.16l.06.01h8.16v-.83H6.18l-.01-2.75-.02-.37.05-.34.11-.31.17-.28.25-.26.31-.23.38-.2.44-.18.51-.15.58-.12.64-.1.71-.06.77-.04.84-.02 1.27.05zm-6.3 1.98l-.23.33-.08.41.08.41.23.34.33.22.41.09.41-.09.33-.22.23-.34.08-.41-.08-.41-.23-.33-.33-.22-.41-.09-.41.09zm13.09 3.95l.28.06.32.12.35.18.36.27.36.35.35.47.32.59.28.73.21.88.14 1.04.05 1.23-.06 1.23-.16 1.04-.24.86-.32.71-.36.57-.4.45-.42.33-.42.24-.4.16-.36.09-.32.05-.24.02-.16-.01h-8.22v.82h5.84l.01 2.76.02.36-.05.34-.11.31-.17.29-.25.25-.31.24-.38.2-.44.17-.51.15-.58.13-.64.09-.71.07-.77.04-.84.01-1.27-.04-1.07-.14-.9-.2-.73-.25-.59-.3-.45-.33-.34-.34-.25-.34-.16-.33-.1-.3-.04-.25-.02-.2.01-.13v-5.34l.05-.64.13-.54.21-.46.26-.38.3-.32.33-.24.35-.2.35-.14.33-.1.3-.06.26-.04.21-.02.13-.01h5.84l.69-.05.59-.14.5-.21.41-.28.33-.32.27-.35.2-.36.15-.36.1-.35.07-.32.04-.28.02-.21V6.07h2.09l.14.01zm-6.47 14.25l-.23.33-.08.41.08.41.23.33.33.23.41.08.41-.08.33-.23.23-.33.08-.41-.08-.41-.23-.33-.33-.23-.41-.08-.41.08z"/>
                            </svg>
                        </div>
                        <span class="skill-name">Python</span>
                    </div>
                    <div class="skill-progress">
                        <div class="progress-bar" data-width="85"></div>
                    </div>
                </div>

                <div class="skill-item" data-level="90">
                    <div class="skill-header">
                        <div class="skill-icon">
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 122.88 62.27" style="enable-background:new 0 0 122.88 62.27" xml:space="preserve">
                            <style type="text/css">.st0{fill-rule:evenodd;clip-rule:evenodd;fill:currentColor;} .st1{fill-rule:evenodd;clip-rule:evenodd;}</style>
                            <g><path class="st0" d="M61.44,62.27c33.93,0,61.44-13.94,61.44-31.14C122.88,13.94,95.37,0,61.44,0S0,13.94,0,31.14 C0,48.33,27.51,62.27,61.44,62.27L61.44,62.27z M93.88,24.99c-0.47-0.52-1.71-0.78-3.73-0.78H87.1l-1.79,9.19h1.75 c1.23,0,2.27-0.11,3.14-0.33c0.76-0.19,1.37-0.46,1.83-0.81c0.45-0.34,0.83-0.82,1.15-1.44c0.36-0.69,0.65-1.55,0.85-2.58 c0.19-0.96,0.24-1.75,0.16-2.38C94.14,25.45,94.04,25.16,93.88,24.99L93.88,24.99z M54.56,6.86h6.81c1.1,0,2,0.9,2,2 c0,0.17-0.02,0.34-0.06,0.5l-1.14,5.87h3.64c2.07,0,3.84,0.19,5.32,0.56c1.64,0.42,2.95,1.07,3.93,1.97 c0.85,0.78,1.45,1.74,1.81,2.88l0.71-3.67c0.13-0.98,0.97-1.74,1.98-1.74h13.2c2.2,0,4.14,0.3,5.82,0.91 c1.77,0.64,3.23,1.61,4.37,2.91c1.15,1.32,1.9,2.88,2.24,4.69c0.32,1.71,0.28,3.61-0.13,5.72c-0.17,0.85-0.4,1.69-0.69,2.51 c-0.29,0.81-0.64,1.58-1.05,2.31c-0.42,0.74-0.89,1.45-1.41,2.1c-0.53,0.66-1.12,1.3-1.77,1.89l0,0c-0.79,0.74-1.62,1.37-2.49,1.89 c-0.9,0.54-1.83,0.96-2.8,1.28c-0.94,0.31-2.02,0.54-3.22,0.69c-1.19,0.15-2.46,0.23-3.8,0.23h-4.23L82.28,49 c-0.13,0.98-0.97,1.74-1.98,1.74h-6.86v0c-0.12,0-0.25-0.01-0.38-0.04c-1.08-0.21-1.79-1.25-1.59-2.34l1.18-6.07 c-0.16,0.04-0.33,0.06-0.5,0.06v0h-6.92c-1.1,0-2-0.9-2-2c0-0.17,0.02-0.34,0.06-0.5l2.68-13.81c0.12-0.61,0.16-1.08,0.12-1.42 c-0.01-0.1,0.07-0.05,0.04-0.09l-0.28-0.07c-0.4-0.1-0.96-0.15-1.68-0.15h-3.8L57.2,40.74c-0.18,0.96-1.02,1.62-1.96,1.62v0h-6.81 c-1.1,0-2-0.9-2-2c0-0.17,0.02-0.34,0.06-0.5l0.36-1.87l-0.3,0.28l0,0c-0.79,0.74-1.62,1.37-2.49,1.89 c-0.9,0.54-1.83,0.96-2.8,1.28c-0.94,0.31-2.02,0.54-3.22,0.69c-1.19,0.15-2.46,0.23-3.8,0.23H30L28.71,49 c-0.13,0.98-0.97,1.74-1.98,1.74h-6.86v0c-0.12,0-0.25-0.01-0.38-0.04c-1.08-0.21-1.79-1.25-1.59-2.34l6.1-31.39 c0.13-0.98,0.97-1.74,1.98-1.74h13.2c2.2,0,4.14,0.3,5.82,0.91c1.78,0.64,3.23,1.61,4.37,2.91c0.34,0.39,0.65,0.81,0.93,1.25 l2.3-11.81C52.78,7.53,53.62,6.86,54.56,6.86L54.56,6.86L54.56,6.86z M40.32,24.99c-0.47-0.52-1.71-0.78-3.73-0.78h-3.06 l-1.79,9.19h1.75c1.23,0,2.27-0.11,3.14-0.33c0.76-0.19,1.37-0.46,1.83-0.81c0.45-0.34,0.83-0.82,1.15-1.44 c0.36-0.69,0.65-1.55,0.85-2.58c0.19-0.96,0.24-1.75,0.16-2.38C40.57,25.45,40.47,25.16,40.32,24.99L40.32,24.99z"/>
                            <path class="st1" d="M90.15,22.21c2.61,0,4.35,0.48,5.21,1.44c0.87,0.96,1.07,2.61,0.62,4.96c-0.47,2.44-1.39,4.18-2.74,5.22 c-1.35,1.04-3.42,1.56-6.18,1.56h-4.17l2.56-13.19H90.15L90.15,22.21z M54.56,8.86h6.81l-1.63,8.38h6.07c3.82,0,6.45,0.67,7.9,2 c1.45,1.33,1.88,3.49,1.3,6.47l-2.85,14.66h-6.92l2.71-13.94c0.31-1.59,0.19-2.67-0.34-3.24c-0.54-0.58-1.67-0.87-3.42-0.87h-5.44 l-3.51,18.05h-6.81L54.56,8.86L54.56,8.86z M36.59,22.21c2.61,0,4.35,0.48,5.21,1.44c0.87,0.96,1.08,2.61,0.62,4.96 c-0.47,2.44-1.39,4.18-2.74,5.22c-1.35,1.04-3.42,1.56-6.18,1.56h-4.17l2.56-13.19H36.59L36.59,22.21z M19.87,48.74h6.86l1.63-8.38 h5.88c2.59,0,4.73-0.27,6.4-0.82c1.68-0.54,3.2-1.46,4.57-2.74c1.15-1.06,2.08-2.22,2.79-3.5c0.71-1.27,1.22-2.68,1.52-4.22 c0.73-3.73,0.18-6.64-1.64-8.73c-1.82-2.08-4.72-3.13-8.69-3.13h-13.2L19.87,48.74L19.87,48.74z M73.43,48.74h6.86l1.63-8.38h5.88 c2.59,0,4.73-0.27,6.4-0.82c1.68-0.54,3.2-1.46,4.57-2.74c1.15-1.06,2.08-2.22,2.79-3.5c0.71-1.27,1.22-2.68,1.52-4.22 c0.73-3.73,0.18-6.64-1.64-8.73c-1.82-2.08-4.72-3.13-8.69-3.13h-13.2L73.43,48.74L73.43,48.74z"/></g></svg>
                        </div>
                        <span class="skill-name">PHP</span>
                    </div>
                    <div class="skill-progress">
                        <div class="progress-bar" data-width="90"></div>
                    </div>
                </div>

                <div class="skill-item" data-level="75">
                    <div class="skill-header">
                        <div class="skill-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M24 24H0V0h24L12 12 24 24z"/>
                            </svg>
                        </div>
                        <span class="skill-name">Kotlin</span>
                    </div>
                    <div class="skill-progress">
                        <div class="progress-bar" data-width="75"></div>
                    </div>
                </div>

                <div class="skill-item" data-level="80">
                    <div class="skill-header">
                        <div class="skill-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M14.23 12.004a2.236 2.236 0 0 1-2.235 2.236 2.236 2.236 0 0 1-2.236-2.236 2.236 2.236 0 0 1 2.235-2.236 2.236 2.236 0 0 1 2.236 2.236zm2.648-10.69c-1.346 0-3.107.96-4.888 2.622-1.78-1.653-3.542-2.602-4.887-2.602-.41 0-.783.093-1.106.278-1.375.793-1.683 3.264-.973 6.365C1.98 8.917 0 10.42 0 12.004c0 1.59 1.99 3.097 5.043 4.03-.704 3.113-.39 5.588.988 6.38.32.187.69.275 1.102.275 1.345 0 3.107-.96 4.888-2.624 1.78 1.654 3.542 2.603 4.887 2.603.41 0 .783-.09 1.106-.275 1.374-.792 1.683-3.263.973-6.365C22.02 15.096 24 13.59 24 12.004c0-1.59-1.99-3.097-5.043-4.032.704-3.11.39-5.587-.988-6.38-.318-.184-.688-.277-1.092-.278zm-.005 1.09v.006c.225 0 .406.044.558.127.666.382.955 1.835.73 3.704-.054.46-.142.945-.25 1.44-.96-.236-2.006-.417-3.107-.534-.66-.905-1.345-1.727-2.035-2.447 1.592-1.48 3.087-2.292 4.105-2.295zm-9.77.02c1.012 0 2.514.808 4.11 2.28-.686.72-1.37 1.537-2.02 2.442-1.107.117-2.154.298-3.113.538-.112-.49-.195-.964-.254-1.42-.23-1.868.054-3.32.714-3.707.19-.09.4-.127.563-.132zm4.882 3.05c.455.468.91.992 1.36 1.564-.44-.02-.89-.034-1.36-.034-.47 0-.92.014-1.36.034.44-.572.895-1.096 1.36-1.564zM12 8.1c.74 0 1.477.034 2.202.093.406.582.802 1.203 1.183 1.86.372.64.71 1.29 1.018 1.946-.308.655-.646 1.31-1.013 1.95-.38.66-.773 1.288-1.18 1.87-.728.063-1.466.098-2.21.098-.74 0-1.477-.035-2.202-.093-.406-.582-.802-1.204-1.183-1.86-.372-.64-.71-1.29-1.018-1.946.303-.657.646-1.313 1.013-1.954.38-.66.773-1.286 1.18-1.866.728-.064 1.466-.098 2.21-.098zm-3.635.254c-.24.377-.48.763-.704 1.16-.225.39-.435.782-.635 1.174-.265-.656-.49-1.31-.676-1.947.64-.15 1.315-.283 2.015-.386zm7.26 0c.695.103 1.365.23 2.006.387-.18.632-.405 1.282-.66 1.933-.2-.39-.41-.783-.64-1.174-.225-.392-.465-.774-.705-1.146zm3.063.675c.484.15.944.317 1.375.498 1.732.74 2.852 1.708 2.852 2.476-.005.768-1.125 1.74-2.857 2.475-.42.18-.88.342-1.355.493-.28-.958-.646-1.956-1.1-2.98.45-1.017.81-2.01 1.085-2.964zm-13.395.004c.278.96.645 1.957 1.1 2.98-.45 1.017-.812 2.01-1.086 2.964-.484-.15-.944-.318-1.37-.5-1.732-.737-2.852-1.706-2.852-2.474 0-.768 1.12-1.742 2.852-2.476.42-.18.88-.342 1.356-.494zm11.678 4.28c.265.657.49 1.312.676 1.948-.64.157-1.316.29-2.016.39.24-.375.48-.762.705-1.158.225-.39.435-.788.636-1.18zm-9.945.02c.2.392.41.783.64 1.175.23.39.465.772.705 1.143-.695-.102-1.365-.23-2.006-.386.18-.63.406-1.282.66-1.933zM17.92 16.32c.112.493.2.968.254 1.423.23 1.868-.054 3.32-.714 3.708-.147.09-.338.128-.563.128-1.012 0-2.514-.807-4.11-2.28.686-.72 1.37-1.536 2.02-2.44 1.107-.118 2.154-.3 3.113-.54zm-11.83.01c.96.234 2.006.415 3.107.532.66.905 1.345 1.727 2.035 2.446-1.595 1.483-3.092 2.295-4.11 2.295-.22-.005-.406-.05-.553-.132-.666-.38-.955-1.834-.73-3.703.054-.46.142-.944.25-1.438zm4.56.64c.44.02.89.034 1.36.034.47 0 .92-.014 1.36-.034-.44.572-.895 1.095-1.36 1.56-.465-.467-.92-.988-1.36-1.56z"/>
                            </svg>
                        </div>
                        <span class="skill-name">React & Node.js</span>
                    </div>
                    <div class="skill-progress">
                        <div class="progress-bar" data-width="80"></div>
                    </div>
                </div>

                <div class="skill-item" data-level="70">
                    <div class="skill-header">
                        <div class="skill-icon">
                            <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 534.01 508.99"><defs>
                            <style>
                                .cls-1{fill:none;}
                                .cls-2{clip-path:url(#clip-path);}
                                .cls-3{fill:currentColor;}
                                .cls-4{clip-path:url(#clip-path-2);}
                                .cls-5{fill:currentColor;}
                            </style>
                            <clipPath id="clip-path" transform="translate(23.09 1.92)"><polygon class="cls-1" points="452.23 123.16 235.73 0 235.73 506.11 322.33 456.07 322.33 313.67 387.76 351.2 386.8 254.02 322.33 216.49 322.33 159.72 452.23 235.73 452.23 123.16"/></clipPath><linearGradient id="linear-gradient" x1="-20.21" y1="-48.36" x2="510.92" y2="-48.36" gradientTransform="matrix(1, 0, 0, -1, 0, 204.21)" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#ff6f00"/><stop offset="1" stop-color="#ffa800"/></linearGradient><clipPath id="clip-path-2" transform="translate(23.09 1.92)"><polygon class="cls-1" points="0 123.16 216.49 0 216.49 506.11 129.89 456.07 129.89 159.72 0 235.73 0 123.16"/></clipPath><linearGradient id="linear-gradient-2" x1="-23.09" y1="-48.36" x2="508.03" y2="-48.36" xlink:href="#linear-gradient"/></defs><title>google-tensorflow</title><g class="cls-2"><path class="cls-3" d="M-20.21-1.92H510.92v509H-20.21Z" transform="translate(23.09 1.92)"/></g><g class="cls-4"><path class="cls-5" d="M-23.09-1.92H508v509H-23.09Z" transform="translate(23.09 1.92)"/></g></svg>
                        </div>
                        <span class="skill-name">TensorFlow & PyTorch</span>
                    </div>
                    <div class="skill-progress">
                        <div class="progress-bar" data-width="70"></div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="skills-column">
                <div class="skill-item" data-level="85">
                    <div class="skill-header">
                        <div class="skill-icon">
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 95.39 131.07" style="enable-background:new 0 0 95.39 131.07" xml:space="preserve"><style type="text/css">.st0{fill:currentColor;}
                                    .st1{fill:currentColor;}
                                    .st2{fill:currentColor;}
                                    .st3{fill:currentColor;fill-opacity:0.2;}
                                    .st4{opacity:0.2;fill:currentColor;enable-background:new ;}
                                    .st5{fill:url(#b_1_);}
                                </style>
                                <path class="st0" d="M0.05,105.75L16.18,2.52c0.2-1.27,1.18-2.26,2.44-2.48s2.52,0.4,3.13,1.53l16.68,31.12l6.65-12.66	c0.51-0.98,1.53-1.59,2.64-1.59s2.12,0.61,2.64,1.59l45.02,85.72L0.05,105.75L0.05,105.75z"/><path class="st1" d="M55.78,65.54L38.43,32.68L0.05,105.75L55.78,65.54z"/>
                                <path class="st2" d="M95.39,105.75L83.03,29.29c-0.19-1.1-0.97-2-2.03-2.34s-2.22-0.06-3.01,0.73L0.05,105.75l43.12,24.18	c2.71,1.51,6.01,1.51,8.71,0L95.39,105.75L95.39,105.75z"/>
                                <path class="st3" d="M83.03,29.29c-0.19-1.1-0.97-2-2.03-2.34s-2.22-0.06-3.01,0.73L62.52,43.19L50.36,20.03	c-0.51-0.98-1.53-1.59-2.64-1.59s-2.12,0.61-2.64,1.59l-6.65,12.66L21.75,1.57c-0.6-1.13-1.87-1.75-3.13-1.53s-2.25,1.22-2.44,2.48	L0.05,105.75H0l0.05,0.06l0.42,0.21l77.49-77.58c0.79-0.79,1.95-1.08,3.02-0.74s1.85,1.24,2.03,2.35l12.25,75.77l0.12-0.07	L83.03,29.29L83.03,29.29z M0.19,105.61L16.18,3.26c0.19-1.27,1.18-2.27,2.44-2.48s2.52,0.4,3.13,1.53l16.68,31.12l6.65-12.66	c0.51-0.98,1.53-1.59,2.64-1.59s2.12,0.61,2.64,1.59l11.92,22.66L0.19,105.61L0.19,105.61z"/>
                                <path class="st4" d="M51.89,129.2c-2.71,1.51-6.01,1.51-8.71,0L0.16,105.09l-0.1,0.66l43.12,24.18c2.71,1.51,6.01,1.51,8.71,0	l43.5-24.18l-0.11-0.69L51.89,129.2L51.89,129.2z"/>
                                <g><linearGradient id="b_1_" gradientUnits="userSpaceOnUse" x1="-243.4794" y1="345.2798" x2="-242.4362" y2="344.521" gradientTransform="matrix(95 0 0 -130.9998 23127.4414 45253.9336)"><stop offset="0" style="stop-color:#FFFFFF;stop-opacity:0.1"/><stop offset="0.14" style="stop-color:#FFFFFF;stop-opacity:0.08"/><stop offset="0.61" style="stop-color:#FFFFFF;stop-opacity:0.02"/><stop offset="1" style="stop-color:#FFFFFF;stop-opacity:0"/></linearGradient><path id="b" class="st5" d="M82.91,29.3c-0.19-1.1-0.97-2-2.02-2.34c-1.06-0.34-2.21-0.06-3,0.73L62.47,43.2L50.35,20.05 c-0.51-0.98-1.53-1.59-2.63-1.59s-2.11,0.61-2.63,1.59l-6.63,12.66L21.84,1.6c-0.6-1.13-1.86-1.75-3.12-1.53s-2.24,1.22-2.43,2.48 L0.22,105.73l42.97,24.17c2.7,1.51,5.99,1.51,8.68,0l43.34-24.17L82.91,29.3L82.91,29.3z"/></g></svg>
                        </div>
                        <span class="skill-name">Firebase</span>
                    </div>
                    <div class="skill-progress">
                        <div class="progress-bar" data-width="85"></div>
                    </div>
                </div>

                <div class="skill-item" data-level="80">
                    <div class="skill-header">
                        <div class="skill-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M8.851 18.56s-.917.534.653.714c1.902.218 2.874.187 4.969-.211 0 0 .552.346 1.321.646-4.699 2.013-10.633-.118-6.943-1.149M8.276 15.933s-1.028.761.542.924c2.032.209 3.636.227 6.413-.308 0 0 .384.389.987.602-5.679 1.661-12.007.13-7.942-1.218M13.116 11.475c1.158 1.333-.304 2.533-.304 2.533s2.939-1.518 1.589-3.418c-1.261-1.772-2.228-2.652 3.007-5.688 0-.001-8.216 2.051-4.292 6.573M19.33 20.504s.679.559-.747.991c-2.712.822-11.288 1.069-13.669.033-.856-.373.75-.89 1.254-.998.527-.114.828-.093.828-.093-.953-.671-6.156 1.317-2.643 1.887 9.58 1.553 17.462-.7 14.977-1.82M9.292 13.21s-4.362 1.036-1.544 1.412c1.189.159 3.561.123 5.77-.062 1.806-.152 3.618-.477 3.618-.477s-.637.272-1.098.587c-4.429 1.165-12.986.623-10.522-.568 2.082-1.006 3.776-.892 3.776-.892M17.116 17.584c4.503-2.34 2.421-4.589.968-4.285-.355.074-.515.138-.515.138s.132-.207.385-.297c2.875-1.011 5.086 2.981-.928 4.562 0-.001.07-.062.09-.118M14.401 0s2.494 2.494-2.365 6.33c-3.896 3.077-.888 4.832-.001 6.836-2.274-2.053-3.943-3.858-2.824-5.539 1.644-2.469 6.197-3.665 5.19-7.627M9.734 23.924c4.322.277 10.959-.153 11.116-2.198 0 0-.302.775-3.572 1.391-3.688.694-8.239.613-10.937.168 0-.001.553.457 3.393.639"/>
                            </svg>
                        </div>
                        <span class="skill-name">Java</span>
                    </div>
                    <div class="skill-progress">
                        <div class="progress-bar" data-width="80"></div>
                    </div>
                </div>

                <div class="skill-item" data-level="95">
                    <div class="skill-header">
                        <div class="skill-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M1.5 0h21l-1.91 21.563L11.977 24l-8.564-2.438L1.5 0zm7.031 9.75l-.232-2.718 10.059.003.23-2.622L5.412 4.41l.698 8.01h9.126l-.326 3.426-2.91.804-2.955-.81-.188-2.11H6.248l.33 4.171L12 19.351l5.379-1.443.744-8.157H8.531z"/>
                            </svg>
                        </div>
                        <span class="skill-name">HTML & CSS</span>
                    </div>
                    <div class="skill-progress">
                        <div class="progress-bar" data-width="95"></div>
                    </div>
                </div>

                <div class="skill-item" data-level="90">
                    <div class="skill-header">
                        <div class="skill-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                            </svg>
                        </div>
                        <span class="skill-name">Git & GitHub</span>
                    </div>
                    <div class="skill-progress">
                        <div class="progress-bar" data-width="90"></div>
                    </div>
                </div>

                <div class="skill-item" data-level="75">
                    <div class="skill-header">
                        <div class="skill-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M22.394 6c-.167-.29-.398-.543-.652-.69L12.926.22c-.509-.294-1.34-.294-1.848 0L2.26 5.31c-.508.293-.923 1.013-.923 1.6v10.18c0 .294.104.62.271.91.167.29.398.543.652.69l8.816 5.09c.508.293 1.34.293 1.848 0l8.816-5.09c.254-.147.485-.4.652-.69.167-.29.27-.616.27-.91V6.91c.003-.294-.1-.62-.268-.91zM12 19.109c-3.92 0-7.109-3.189-7.109-7.109S8.08 4.891 12 4.891a7.133 7.133 0 016.156 3.552l-3.076 1.781A3.567 3.567 0 0012 8.445c-1.96 0-3.554 1.595-3.554 3.555S10.04 15.555 12 15.555a3.57 3.57 0 003.08-1.778l3.077 1.78A7.135 7.135 0 0112 19.109z"/>
                            </svg>
                        </div>
                        <span class="skill-name">C & C++</span>
                    </div>
                    <div class="skill-progress">
                        <div class="progress-bar" data-width="75"></div>
                    </div>
                </div>

                <div class="skill-item" data-level="75">
                    <div class="skill-header">
                        <div class="skill-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 3C7.58 3 4 4.79 4 7s3.58 4 8 4 8-1.79 8-4-3.58-4-8-4zM4 9v3c0 2.21 3.58 4 8 4s8-1.79 8-4V9c0 2.21-3.58 4-8 4s-8-1.79-8-4zM4 14v3c0 2.21 3.58 4 8 4s8-1.79 8-4v-3c0 2.21-3.58 4-8 4s-8-1.79-8-4z"/>
                            </svg>
                        </div>
                        <span class="skill-name">Databases</span>
                    </div>
                    <div class="skill-progress">
                        <div class="progress-bar" data-width="75"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Projects Section -->
<section id="projects" class="section projects">
    <div class="container">
        <h2 class="section-title">Featured Projects</h2>
        <div class="projects-grid">
            <?php if (empty($projects)): ?>
                <div class="col-span-full">
                    <p class="text-center text-gray-500">No projects available at the moment.</p>
                </div>
            <?php else: ?>
                <?php foreach ($projects as $project): ?>
                    <div class="project-card">
                        <div class="project-image">
                            <?php if (!empty($project['image_url'])): ?>
                                <img src="<?php echo htmlspecialchars($project['image_url']); ?>" 
                                     alt="<?php echo htmlspecialchars($project['title']); ?>"
                                     onerror="this.parentElement.innerHTML='<span>No Image Available</span>'">
                            <?php else: ?>
                                <span>No Image Available</span>
                            <?php endif; ?>
                        </div>
                        <div class="project-content">
                            <h3 class="project-title"><?php echo htmlspecialchars($project['title']); ?></h3>
                            <p class="project-description">
                                <?php echo htmlspecialchars(truncateText($project['description'], 120)); ?>
                            </p>
                            <div class="project-tech">
                                <?php 
                                // Use tags if available, otherwise fall back to technologies
                                $techList = !empty($project['tags']) ? $project['tags'] : $project['technologies'];
                                $technologies = explode(',', $techList);
                                foreach ($technologies as $tech): 
                                ?>
                                    <span class="tech-tag"><?php echo htmlspecialchars(trim($tech)); ?></span>
                                <?php endforeach; ?>
                            </div>
                            <div class="project-links">
                                <?php if (!empty($project['github_link'])): ?>
                                    <a href="<?php echo htmlspecialchars($project['github_link']); ?>" 
                                       target="_blank" class="btn btn-secondary">
                                        GitHub
                                    </a>
                                <?php endif; ?>
                                <?php if (!empty($project['live_link'])): ?>
                                    <a href="<?php echo htmlspecialchars($project['live_link']); ?>" 
                                       target="_blank" class="btn btn-primary">
                                        Live Demo
                                    </a>
                                <?php elseif (!empty($project['demo_link'])): ?>
                                    <a href="<?php echo htmlspecialchars($project['demo_link']); ?>" 
                                       target="_blank" class="btn btn-primary">
                                        Live Demo
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Achievements Section -->
<section id="achievements" class="section achievements">
    <div class="container">
        <h2 class="section-title">Achievements & Teamwork</h2>
        <div class="achievements-container">
            <?php if (empty($achievements)): ?>
                <div class="text-center">
                    <p class="text-gray-500">No achievements available at the moment.</p>
                </div>
            <?php else: ?>
                <div class="achievements-scroll">
                    <?php 
                    // First set of achievements
                    foreach ($achievements as $index => $achievement): ?>
                        <div class="achievement-card">
                            <?php if (!empty($achievement['image_url'])): ?>
                                <div class="achievement-image">
                                    <img src="<?php echo htmlspecialchars($achievement['image_url']); ?>" 
                                         alt="<?php echo htmlspecialchars($achievement['title']); ?>"
                                         onerror="this.style.display='none'">
                                </div>
                            <?php endif; ?>
                            <div class="achievement-header">
                                <span class="achievement-category">
                                    <?php echo htmlspecialchars($achievement['category']); ?>
                                </span>
                                <span class="achievement-date">
                                    <?php echo formatDate($achievement['achievement_date']); ?>
                                </span>
                            </div>
                            <?php if (!empty($achievement['role'])): ?>
                                <div class="achievement-role">
                                    👤 <?php echo htmlspecialchars($achievement['role']); ?>
                                </div>
                            <?php endif; ?>
                            <h3><?php echo htmlspecialchars($achievement['title']); ?></h3>
                            <p><?php echo htmlspecialchars($achievement['description']); ?></p>
                        </div>
                    <?php endforeach; ?>
                    
                    <?php 
                    // Duplicate set for seamless loop
                    foreach ($achievements as $index => $achievement): ?>
                        <div class="achievement-card">
                            <?php if (!empty($achievement['image_url'])): ?>
                                <div class="achievement-image">
                                    <img src="<?php echo htmlspecialchars($achievement['image_url']); ?>" 
                                         alt="<?php echo htmlspecialchars($achievement['title']); ?>"
                                         onerror="this.style.display='none'">
                                </div>
                            <?php endif; ?>
                            <div class="achievement-header">
                                <span class="achievement-category">
                                    <?php echo htmlspecialchars($achievement['category']); ?>
                                </span>
                                <span class="achievement-date">
                                    <?php echo formatDate($achievement['achievement_date']); ?>
                                </span>
                            </div>
                            <?php if (!empty($achievement['role'])): ?>
                                <div class="achievement-role">
                                    👤 <?php echo htmlspecialchars($achievement['role']); ?>
                                </div>
                            <?php endif; ?>
                            <h3><?php echo htmlspecialchars($achievement['title']); ?></h3>
                            <p><?php echo htmlspecialchars($achievement['description']); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Education Section -->
<section id="education" class="section education">
    <div class="container">
        <h2 class="section-title">Education</h2>
        <?php if (empty($education)): ?>
            <div class="text-center">
                <p class="text-gray-500">No education records available at the moment.</p>
            </div>
        <?php else: ?>
            <div class="timeline">
                <?php foreach ($education as $index => $edu): ?>
                    <div class="timeline-item <?php echo $index % 2 == 0 ? 'left' : 'right'; ?>">
                        <div class="timeline-dot">
                            <div class="timeline-icon">🎓</div>
                        </div>
                        <div class="timeline-content">
                            <div class="timeline-card">
                                <div class="timeline-header">
                                    <h3 class="timeline-degree"><?php echo htmlspecialchars($edu['degree']); ?></h3>
                                    <span class="timeline-duration">
                                        <?php echo isset($edu['duration']) ? htmlspecialchars($edu['duration']) : '2023 - Present'; ?>
                                    </span>
                                </div>
                                <h4 class="timeline-institution"><?php echo htmlspecialchars($edu['institution']); ?></h4>
                                <p class="timeline-description"><?php echo htmlspecialchars($edu['description']); ?></p>
                                
                                <?php if (!empty($edu['achievements'])): ?>
                                    <div class="timeline-achievements">
                                        <strong>Key Achievements:</strong>
                                        <ul>
                                            <?php 
                                            $achievementList = explode(',', $edu['achievements']);
                                            foreach ($achievementList as $achievement): 
                                            ?>
                                                <li><?php echo htmlspecialchars(trim($achievement)); ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="section contact">
    <div class="container">
        <h2 class="section-title">Get In Touch</h2>
        <div class="contact-content">
            <div class="contact-info">
                <h3>Let's Connect</h3>
                <p class="contact-description">
                    I'm always open to discussing new opportunities, interesting projects, 
                    or just having a friendly chat about technology and development.
                </p>

                <div class="contact-cards">
                    <div class="contact-card">
                        <div class="contact-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                            </svg>
                        </div>
                        <div class="contact-info-content">
                            <span class="contact-label">Email</span>
                            <a href="mailto:nayeem.code@gmail.com" class="contact-value">nayeem.code@gmail.com</a>
                        </div>
                    </div>

                    <div class="contact-card">
                        <div class="contact-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                            </svg>
                        </div>
                        <div class="contact-info-content">
                            <span class="contact-label">Phone</span>
                            <a href="tel:+8801968199036" class="contact-value">+8801968199036</a>
                        </div>
                    </div>

                    <div class="contact-card">
                        <div class="contact-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                            </svg>
                        </div>
                        <div class="contact-info-content">
                            <span class="contact-label">Location</span>
                            <span class="contact-value">Khulna, Bangladesh</span>
                        </div>
                    </div>
                </div>
                
                <div class="contact-status">
                    <div class="status-indicator">
                        <span class="status-dot"></span>
                        <span class="status-text">Available for opportunities</span>
                    </div>
                </div>
            </div>
            
            <div class="contact-form-container">
                <div class="contact-form">
                    <div id="alert-container"></div>
                    
                    <form id="contact-form">
                        <div class="form-group">
                            <label for="name" class="form-label">Name *</label>
                            <input type="text" id="name" name="name" class="form-input" required placeholder="Your full name">
                        </div>
                        
                        <div class="form-group">
                            <label for="email" class="form-label">Email *</label>
                            <input type="email" id="email" name="email" class="form-input" required placeholder="your.email@example.com">
                        </div>
                        
                        <div class="form-group">
                            <label for="message" class="form-label">Message *</label>
                            <textarea id="message" name="message" class="form-textarea" rows="6" required placeholder="Tell me about your project or just say hello..."></textarea>
                        </div>
                        <div style="text-align: center;">
                        <button type="submit" id="submit-btn" class="btn btn-primary contact-submit">
                            Send Message
                        </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>