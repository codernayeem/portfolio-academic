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
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M7.01 10.207h-.944l-.515 2.648h.838c.556 0 .982-.122 1.292-.384.297-.251.426-.611.426-1.091 0-.392-.122-.672-.34-.85-.218-.18-.578-.275-1.004-.275-.297 0-.477-.297-.477-.477v-.571zm1.274-6.007c0-.436-.297-.838-.838-.838H6.153c-.436 0-.759.297-.759.838v1.274c0 .436.297.838.838.838h1.274c.436 0 .838-.297.838-.838V4.2zm6.239 0c0-.436-.297-.838-.838-.838H12.392c-.436 0-.838.297-.838.838v1.274c0 .436.297.838.838.838h1.294c.436 0 .838-.297.838-.838V4.2zM8.11 24c.717 0 1.292-.575 1.292-1.292v-5.395c0-.717-.575-1.292-1.292-1.292s-1.292.575-1.292 1.292v5.395c0 .717.575 1.292 1.292 1.292zm7.832 0c.717 0 1.292-.575 1.292-1.292v-5.395c0-.717-.575-1.292-1.292-1.292s-1.292.575-1.292 1.292v5.395c0 .717.575 1.292 1.292 1.292z"/>
                            </svg>
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
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M1.5 0L12 6.9L22.5 0v6.9L12 13.8L1.5 6.9V0zM1.5 10.8L12 17.7l10.5-6.9V24l-10.5-6.9L1.5 24V10.8z"/>
                            </svg>
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
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M3.89 15.673L6.255 7.107h.135l2.365 8.566h-1.425l-.615-2.292H4.928l-.615 2.292H3.89zm1.77-3.273h1.97L6.85 9.275 5.66 12.4zm8.164 3.273V7.107h1.425v7.541h3.445v1.025h-4.87z"/>
                                <path d="M11.996 0C5.373 0 0 5.373 0 11.996s5.373 11.996 11.996 11.996 11.996-5.373 11.996-11.996S18.619 0 11.996 0zM6.254 7.252l2.271 8.307h-1.425l-.588-2.139H4.725l-.588 2.139H2.712l2.271-8.307h1.271zm5.611 7.282V8.277h1.425v6.232h3.445v1.025h-4.87z"/>
                            </svg>
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

<?php include 'includes/footer.php'; ?>