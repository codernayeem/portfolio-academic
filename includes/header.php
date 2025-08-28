<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' - ' . SITE_NAME : SITE_NAME; ?></title>
    <meta name="description" content="Portfolio of a passionate App Developer and 3rd Year CSE student at KUET">
    
    <!-- CSS Files -->
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>/assets/css/main.css">
    <?php if (isset($additionalCSS)) echo $additionalCSS; ?>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo SITE_URL; ?>/assets/images/favicon.ico">
    
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <header class="header">
        <nav class="navbar">
            <div class="nav-container">
                <div class="nav-brand">
                    <a href="<?php echo SITE_URL; ?>"> Md. Nayeem</a>
                </div>
                <div class="nav-menu" id="nav-menu">
                    <a href="#home" class="nav-link">Home</a>
                    <a href="#about" class="nav-link">About</a>
                    <a href="#skills" class="nav-link">Skills</a>
                    <a href="#projects" class="nav-link">Projects</a>
                    <a href="#achievements" class="nav-link">Achievements</a>
                    <a href="#education" class="nav-link">Education</a>
                    <a href="#contact" class="nav-link">Contact</a>
                </div>
                <div class="nav-toggle" id="nav-toggle">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
            </div>
        </nav>
    </header>

    <main class="main-content"><?php // Content will be inserted here ?>
