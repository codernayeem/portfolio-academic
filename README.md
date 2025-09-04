# Portfolio Academic - Md. Nayeem's Portfolio Website

A modern, dynamic portfolio website built with PHP and MySQL, featuring a complete admin panel for content management. The website showcases projects, achievements, education, and includes a contact system for potential clients and collaborators.

## 🚀 Features

### Frontend
- **Responsive Design**: Mobile-first approach with modern CSS Grid/Flexbox
- **Interactive Carousel**: Dynamic projects showcase with auto-play and touch support
- **Smooth Animations**: CSS transitions and JavaScript-powered scroll animations
- **Dark Theme**: Modern dark UI with neon accent colors
- **Contact Form**: AJAX-powered contact form with validation
- **Social Integration**: Links to GitHub, LinkedIn, WhatsApp, and Facebook

### Backend & Admin Panel
- **Secure Authentication**: Session-based admin login system
- **Complete CRUD Operations**: Manage projects, achievements, education records
- **Message Management**: View and track contact form submissions
- **Dashboard Analytics**: Overview of portfolio statistics
- **Content Management**: Easy-to-use interface for updating portfolio content

## 🛠️ Tech Stack

### Frontend
- **HTML5 & CSS3**: Semantic markup with modern CSS features
- **JavaScript (ES6+)**: Interactive functionality and AJAX requests
- **Responsive Design**: Mobile-first approach
- **Google Fonts**: Inter font family for typography

### Backend
- **PHP 7.4+**: Server-side logic and templating
- **MySQL**: Database for content storage
- **PDO**: Database abstraction layer for secure queries
- **Session Management**: Admin authentication system

### Development Tools
- **XAMPP**: Local development environment
- **Git**: Version control
- **Modern CSS**: CSS Grid, Flexbox, CSS Variables

## 📁 Project Structure

```
portfolio-academic/
├── index.php                 # Main portfolio page
├── README.md                 # Project documentation
├── admin/                    # Admin panel
│   ├── index.php            # Admin dashboard
│   ├── login.php            # Admin login
│   ├── logout.php           # Admin logout
│   ├── projects.php         # Project management
│   ├── achievements.php     # Achievement management
│   ├── education.php        # Education management
│   └── messages.php         # Contact message management
├── api/                     # API endpoints
│   └── contact.php          # Contact form handler
├── assets/                  # Static assets
│   ├── css/
│   │   ├── main.css         # Main stylesheet
│   │   └── admin.css        # Admin panel styles
│   └── js/
│       └── main.js          # Frontend JavaScript
├── database/
│   └── table_data.sql       # Database schema and sample data
└── includes/                # PHP includes
    ├── config.php           # Database configuration
    ├── header.php           # Common header
    └── footer.php           # Common footer
```

## 🗄️ Database Schema

### Tables Overview

1. **`projects`** - Portfolio projects showcase
   - Fields: id, title, description, technologies, github_link, demo_link, live_link, image_url, tags, timestamps

2. **`achievements`** - Awards and accomplishments
   - Fields: id, title, description, achievement_date, category, role, image_url, timestamps

3. **`education`** - Educational background
   - Fields: id, degree, institution, duration, description, achievements, timestamps

4. **`contact_messages`** - Contact form submissions
   - Fields: id, name, email, message, is_read, created_at

5. **`admin_users`** - Admin authentication
   - Fields: id, username, password, created_at

## 🚀 Installation & Setup

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx) or XAMPP for local development

### Local Development Setup

1. **Clone the repository**
   ```bash
   git clone https://github.com/codernayeem/portfolio-academic.git
   cd portfolio-academic
   ```

2. **Setup XAMPP**
   - Install XAMPP and start Apache and MySQL services
   - Place project in `xampp/htdocs/portfolio-academic`

3. **Database Setup**
   ```sql
   # Import the database
   mysql -u root -p < database/table_data.sql
   ```

4. **Configuration**
   - Update database credentials in `includes/config.php` if needed
   - Default admin credentials: username `admin`, password `admin`

5. **Access the application**
   - Portfolio: `http://localhost/portfolio-academic`
   - Admin Panel: `http://localhost/portfolio-academic/admin`

### Production Deployment

1. **Upload files** to your web server
2. **Create MySQL database** and import `database/table_data.sql`
3. **Update configuration** in `includes/config.php`:
   - Database credentials
   - Site URL
   - Security settings
4. **Change default admin password** for security

## 📱 Key Sections

### Home & About
- Personal introduction with typewriter effect
- Social media links
- Professional summary and goals
- Dynamic statistics display

### Skills & Technologies
- Interactive skill bars with animations
- Technology stack visualization
- Programming language proficiency levels

### Projects Showcase
- **Agro Care App**: Plant disease detection with ML (Flutter, Firebase, Flask)
- **Fly Me Game**: Console-based 2D game (C++)
- **Web Share Zone**: File sharing web application (Flask, SQLite)
- **KUET CSE 2K21 App**: Batch management mobile app (Kotlin, Firebase)

### Achievements & Teamwork
- **Bitfest 2025**: "KUET Rising Team" award in Game of Datathon
- **Kibo Robot Programming Challenge**: 1st place national, 3rd place international
- **SynergyX2024 Datathon**: 5th place in ML competition
- **Hult Prize KUET 2024**: 1st runner-up with farming solution

### Education Timeline
- **KUET CSE**: Current (2023-Present)
- **Narayanganj College**: HSC (2022)

### Contact System
- AJAX-powered contact form
- Real-time validation
- Message storage in database
- Admin notification system

## 🔐 Admin Panel Features

### Dashboard
- Statistics overview (projects, achievements, education, messages)
- Recent messages preview
- Quick action buttons
- Analytics cards

### Content Management
- **Projects**: Add, edit, delete project entries with images and links
- **Achievements**: Manage awards, competitions, and accomplishments
- **Education**: Update educational background and achievements
- **Messages**: View, mark as read, and manage contact form submissions

### Security Features
- Session-based authentication
- SQL injection prevention with PDO
- XSS protection with input sanitization

## 🎨 Design Features

### Modern UI/UX
- **Dark Theme**: Professional dark color scheme with neon accents
- **Responsive Layout**: Mobile-first design approach
- **Smooth Animations**: CSS transitions and JavaScript interactions
- **Interactive Elements**: Hover effects, carousel navigation, form feedback

## 🌐 Live Features

- **Contact Form**: Direct messaging system with email validation
- **Social Links**: GitHub, LinkedIn, WhatsApp, Facebook integration
- **External Links**: Direct links to project repositories and demos
- **Responsive Navigation**: Mobile-friendly menu system

