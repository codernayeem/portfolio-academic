-- Portfolio Website Database Setup - Final Version
-- Complete database setup for new system deployment
-- Created: September 4, 2025

-- Create database
CREATE DATABASE IF NOT EXISTS portfolio_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE portfolio_db;

-- Projects table
CREATE TABLE projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    technologies VARCHAR(500) NOT NULL,
    github_link VARCHAR(500),
    demo_link VARCHAR(500),
    live_link VARCHAR(500),
    image_url VARCHAR(500),
    tags VARCHAR(500),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Achievements table
CREATE TABLE achievements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    achievement_date DATE NOT NULL,
    category VARCHAR(100) DEFAULT 'Competition',
    role VARCHAR(255),
    image_url VARCHAR(500),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Contact messages table
CREATE TABLE contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    is_read BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Admin users table
CREATE TABLE admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Education table
CREATE TABLE education (
    id INT AUTO_INCREMENT PRIMARY KEY,
    degree VARCHAR(255) NOT NULL,
    institution VARCHAR(255) NOT NULL,
    duration VARCHAR(100) NOT NULL,
    description TEXT,
    achievements TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert default admin user (username: admin, password: admin)
INSERT INTO admin_users (username, password) VALUES 
('admin', 'admin');

-- Insert projects data
INSERT INTO projects (title, description, technologies, github_link, demo_link, live_link, image_url, tags) VALUES
('Agro Care App', 'A plant disease detection, marketplace & community app for farmers, gardeners & plant enthusiasts made with flutter and powered by Firebase and Flask. Won ''Best Project Award'' from KUET CSE Department.', 'Flutter, Firebase, ML, Android, Rest API, Flask', 'https://github.com/codernayeem/agro-care-app', 'https://github.com/codernayeem/agro-care-app/releases/tag/v1.0.0', 'https://github.com/codernayeem/agro-care-app/releases/tag/v1.0.0', 'https://raw.githubusercontent.com/codernayeem/codernayeem.github.io/refs/heads/main/public/images/agro_care_app.jpg', 'Flutter,Firebase,ML,Android,Rest API,Flask'),

('Fly Me Game', 'A console based 2D game made with C++. The player controls a plane to fly through the obstacles and collect the coins.', 'C++, Console, Game', 'https://github.com/codernayeem/fly-me-game', 'https://github.com/codernayeem/fly-me-game', 'https://github.com/codernayeem/fly-me-game', 'https://raw.githubusercontent.com/codernayeem/codernayeem.github.io/refs/heads/main/public/images/fly-me-game.png', 'C++,Console,Game'),

('Web Share Zone', 'A web application that allows users to share files with each other. Made with Flask, HTML, CSS, JavaScript, and SQLite.', 'Flask, HTML, CSS, JavaScript, SQLite', 'https://github.com/codernayeem/web-share-zone', 'https://github.com/codernayeem/web-share-zone', 'https://github.com/codernayeem/web-share-zone', 'https://raw.githubusercontent.com/codernayeem/codernayeem.github.io/refs/heads/main/public/images/web-share-zone.png', 'Flask,HTML,CSS,JavaScript,SQLite'),

('Kuet CSE 2K21 App', 'A mobile app for the students of KUET CSE 2K21 batch featuring a batchmate''s list & informations, teacher''s informations, routines & more. Made with Kotlin & Firebase', 'Kotlin, Firebase, Android', 'https://github.com/codernayeem', 'https://github.com/codernayeem', 'https://github.com/codernayeem', 'https://raw.githubusercontent.com/codernayeem/codernayeem.github.io/refs/heads/main/public/images/kuet-cse-app.jpeg', 'Kotlin,Firebase,Android');

-- Insert achievements data
INSERT INTO achievements (title, description, achievement_date, category, role, image_url) VALUES
('Game of Datathon - Bitfest 2025', 'Trained a ml model to predict matching score of the job requirements and the candidate''s information. Won ''KUET Rising Team'' award in the Game of Datathon competition at Bitfest 2025. Hosted by Department of CSE, KUET', '2025-01-15', 'Competition', 'Machine Learning Engineer', 'https://raw.githubusercontent.com/codernayeem/codernayeem.github.io/refs/heads/main/public/images/bitfest-datathon-25.jpg'),

('5th Kibo Robot Programming Challenge', '1st place in the national level and 3rd place in the international level competition. Programmed a robot to navigate, process images, and complete tasks. Hosted by Japan Aerospace Exploration Agency (JAXA).', '2024-12-15', 'Competition', 'Core Contributor', 'https://raw.githubusercontent.com/codernayeem/codernayeem.github.io/refs/heads/main/public/images/kibo-rpc5.jpg'),

('SynergyX2024 Datathon Competition', 'Hosted by Discipline of CS, Khulna University. Trained a ml model on the provided dataset. Placed 5th in the competition.', '2024-11-15', 'Competition', 'Machine Learning Engineer', 'https://raw.githubusercontent.com/codernayeem/codernayeem.github.io/refs/heads/main/public/images/ku-datathon.png'),

('Hult Prize Kuet 2024', 'Proposed a solution for the farming community in Bangladesh. I developed the mobile app (MVP) for the competition. We became the 1st runner up in the competition.', '2024-02-15', 'Competition', 'Mobile App Developer', 'https://raw.githubusercontent.com/codernayeem/codernayeem.github.io/refs/heads/main/public/images/hult-24.jpeg');

-- Insert education data
INSERT INTO education (degree, institution, duration, description, achievements) VALUES
('Bachelor of Science in Computer Science', 'Khulna University of Engineering & Technology (KUET)', '2023 - Present', 'Focusing on Mobile App Development and Machine Learning.', 'Best Project Award (Android App Development), Current CGPA: 3.96/4.00'),

('Higher Secondary Certificate (HSC)', 'Narayangang College', '2022', 'Completed HSC with a focus on Science and Mathematics.', 'Achieved GPA: 5.00/5.00 in Science Group, Participated in various science fairs and competitions');

-- End of database setup
