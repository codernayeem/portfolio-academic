<?php
require_once '../includes/config.php';
redirectToAdmin();

$success = '';
$error = '';

try {
    $pdo = getDBConnection();
    
    // Handle form submissions
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['action'])) {
            switch ($_POST['action']) {
                case 'add':
                    $title = sanitizeInput($_POST['title']);
                    $description = sanitizeInput($_POST['description']);
                    $technologies = sanitizeInput($_POST['technologies']);
                    $tags = sanitizeInput($_POST['tags']);
                    $github_link = sanitizeInput($_POST['github_link']);
                    $demo_link = sanitizeInput($_POST['demo_link']);
                    $live_link = sanitizeInput($_POST['live_link']);
                    $image_url = sanitizeInput($_POST['image_url']);
                    
                    if (!empty($title) && !empty($description) && !empty($technologies)) {
                        $stmt = $pdo->prepare("INSERT INTO projects (title, description, technologies, tags, github_link, demo_link, live_link, image_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                        if ($stmt->execute([$title, $description, $technologies, $tags, $github_link, $demo_link, $live_link, $image_url])) {
                            $success = "Project added successfully!";
                        } else {
                            $error = "Failed to add project.";
                        }
                    } else {
                        $error = "Please fill in all required fields.";
                    }
                    break;
                    
                case 'edit':
                    $id = (int)$_POST['id'];
                    $title = sanitizeInput($_POST['title']);
                    $description = sanitizeInput($_POST['description']);
                    $technologies = sanitizeInput($_POST['technologies']);
                    $tags = sanitizeInput($_POST['tags']);
                    $github_link = sanitizeInput($_POST['github_link']);
                    $demo_link = sanitizeInput($_POST['demo_link']);
                    $live_link = sanitizeInput($_POST['live_link']);
                    $image_url = sanitizeInput($_POST['image_url']);
                    
                    if (!empty($title) && !empty($description) && !empty($technologies)) {
                        $stmt = $pdo->prepare("UPDATE projects SET title = ?, description = ?, technologies = ?, tags = ?, github_link = ?, demo_link = ?, live_link = ?, image_url = ? WHERE id = ?");
                        if ($stmt->execute([$title, $description, $technologies, $tags, $github_link, $demo_link, $live_link, $image_url, $id])) {
                            $success = "Project updated successfully!";
                        } else {
                            $error = "Failed to update project.";
                        }
                    } else {
                        $error = "Please fill in all required fields.";
                    }
                    break;
                    
                case 'delete':
                    $id = (int)$_POST['id'];
                    $stmt = $pdo->prepare("DELETE FROM projects WHERE id = ?");
                    if ($stmt->execute([$id])) {
                        $success = "Project deleted successfully!";
                    } else {
                        $error = "Failed to delete project.";
                    }
                    break;
            }
        }
    }
    
    // Fetch all projects
    $projects = $pdo->query("SELECT * FROM projects ORDER BY created_at DESC")->fetchAll();
    
} catch (Exception $e) {
    $error = "Database error occurred.";
    $projects = [];
    error_log("Projects admin error: " . $e->getMessage());
}

$pageTitle = "Manage Projects";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle . ' - ' . SITE_NAME; ?></title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <header class="admin-header">
        <div class="container">
            <nav class="admin-nav">
                <div class="admin-brand">
                    <a href="admin">Portfolio Admin</a> / Projects
                </div>
                <div class="admin-user">
                    <a href="index.php" class="btn btn-secondary btn-sm">Dashboard</a>
                    <a href="logout.php" class="btn btn-secondary btn-sm">Logout</a>
                </div>
            </nav>
        </div>
    </header>

    <main class="admin-main">
        <div class="admin-container">
            <?php if ($success): ?>
                <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
            <?php endif; ?>
            
            <?php if ($error): ?>
                <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <!-- Add/Edit Project Form -->
            <div class="admin-section">
                <div class="admin-section-header">
                    <h2 class="admin-section-title">Add New Project</h2>
                </div>
                
                <form method="POST" class="admin-form" id="project-form">
                    <input type="hidden" name="action" value="add" id="form-action">
                    <input type="hidden" name="id" id="project-id">
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="title" class="form-label">Title *</label>
                            <input type="text" id="title" name="title" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <label for="technologies" class="form-label">Technologies *</label>
                            <input type="text" id="technologies" name="technologies" class="form-input" 
                                   placeholder="Flutter, PHP, MySQL" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="tags" class="form-label">Tags (comma-separated)</label>
                        <input type="text" id="tags" name="tags" class="form-input" 
                               placeholder="Flutter,Firebase,ML,Android">
                        <small style="color: #666;">If empty, technologies will be used as tags</small>
                    </div>
                    
                    <div class="form-group">
                        <label for="description" class="form-label">Description *</label>
                        <textarea id="description" name="description" class="form-textarea" rows="4" required></textarea>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="github_link" class="form-label">GitHub Link</label>
                            <input type="url" id="github_link" name="github_link" class="form-input">
                        </div>
                        <div class="form-group">
                            <label for="demo_link" class="form-label">Demo Link</label>
                            <input type="url" id="demo_link" name="demo_link" class="form-input">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="live_link" class="form-label">Live Link</label>
                            <input type="url" id="live_link" name="live_link" class="form-input">
                        </div>
                        <div class="form-group">
                            <label for="image_url" class="form-label">Image URL</label>
                            <input type="url" id="image_url" name="image_url" class="form-input">
                        </div>
                    </div>
                    
                    <div style="display: flex; gap: var(--spacing-base);">
                        <button type="submit" class="btn btn-primary" id="submit-btn">Add Project</button>
                        <button type="button" class="btn btn-secondary" id="cancel-btn" onclick="resetForm()" style="display: none;">Cancel</button>
                    </div>
                </form>
            </div>

            <!-- Projects List -->
            <div class="admin-section">
                <div class="admin-section-header">
                    <h2 class="admin-section-title">All Projects</h2>
                </div>
                
                <?php if (empty($projects)): ?>
                    <p class="text-muted">No projects found.</p>
                <?php else: ?>
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Technologies</th>
                                <th>Description</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($projects as $project): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($project['title']); ?></td>
                                    <td><?php echo htmlspecialchars($project['technologies']); ?></td>
                                    <td><?php echo htmlspecialchars(truncateText($project['description'], 80)); ?></td>
                                    <td><?php echo formatDate($project['created_at']); ?></td>
                                    <td>
                                        <div class="admin-actions">
                                            <button type="button" class="btn btn-edit btn-sm" 
                                                    onclick="editProject(<?php echo htmlspecialchars(json_encode($project)); ?>)">
                                                Edit
                                            </button>
                                            <form method="POST" style="display: inline;" 
                                                  onsubmit="return confirm('Are you sure you want to delete this project?')">
                                                <input type="hidden" name="action" value="delete">
                                                <input type="hidden" name="id" value="<?php echo $project['id']; ?>">
                                                <button type="submit" class="btn btn-delete btn-sm">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <script>
        function editProject(project) {
            document.getElementById('form-action').value = 'edit';
            document.getElementById('project-id').value = project.id;
            document.getElementById('title').value = project.title;
            document.getElementById('description').value = project.description;
            document.getElementById('technologies').value = project.technologies;
            document.getElementById('tags').value = project.tags || '';
            document.getElementById('github_link').value = project.github_link || '';
            document.getElementById('demo_link').value = project.demo_link || '';
            document.getElementById('live_link').value = project.live_link || '';
            document.getElementById('image_url').value = project.image_url || '';
            
            document.getElementById('submit-btn').textContent = 'Update Project';
            document.getElementById('cancel-btn').style.display = 'inline-block';
            
            document.querySelector('.admin-section-title').textContent = 'Edit Project';
            document.getElementById('project-form').scrollIntoView({ behavior: 'smooth' });
        }
        
        function resetForm() {
            document.getElementById('project-form').reset();
            document.getElementById('form-action').value = 'add';
            document.getElementById('project-id').value = '';
            document.getElementById('submit-btn').textContent = 'Add Project';
            document.getElementById('cancel-btn').style.display = 'none';
            document.querySelector('.admin-section-title').textContent = 'Add New Project';
        }
    </script>
</body>
</html>
