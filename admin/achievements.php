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
                    $achievement_date = sanitizeInput($_POST['achievement_date']);
                    $category = sanitizeInput($_POST['category']);
                    $role = sanitizeInput($_POST['role']);
                    $image_url = sanitizeInput($_POST['image_url']);
                    
                    if (!empty($title) && !empty($description) && !empty($achievement_date)) {
                        $stmt = $pdo->prepare("INSERT INTO achievements (title, description, achievement_date, category, role, image_url) VALUES (?, ?, ?, ?, ?, ?)");
                        if ($stmt->execute([$title, $description, $achievement_date, $category, $role, $image_url])) {
                            $success = "Achievement added successfully!";
                        } else {
                            $error = "Failed to add achievement.";
                        }
                    } else {
                        $error = "Please fill in all required fields.";
                    }
                    break;
                    
                case 'edit':
                    $id = (int)$_POST['id'];
                    $title = sanitizeInput($_POST['title']);
                    $description = sanitizeInput($_POST['description']);
                    $achievement_date = sanitizeInput($_POST['achievement_date']);
                    $category = sanitizeInput($_POST['category']);
                    $role = sanitizeInput($_POST['role']);
                    $image_url = sanitizeInput($_POST['image_url']);
                    
                    if (!empty($title) && !empty($description) && !empty($achievement_date)) {
                        $stmt = $pdo->prepare("UPDATE achievements SET title = ?, description = ?, achievement_date = ?, category = ?, role = ?, image_url = ? WHERE id = ?");
                        if ($stmt->execute([$title, $description, $achievement_date, $category, $role, $image_url, $id])) {
                            $success = "Achievement updated successfully!";
                        } else {
                            $error = "Failed to update achievement.";
                        }
                    } else {
                        $error = "Please fill in all required fields.";
                    }
                    break;
                    
                case 'delete':
                    $id = (int)$_POST['id'];
                    $stmt = $pdo->prepare("DELETE FROM achievements WHERE id = ?");
                    if ($stmt->execute([$id])) {
                        $success = "Achievement deleted successfully!";
                    } else {
                        $error = "Failed to delete achievement.";
                    }
                    break;
            }
        }
    }
    
    // Fetch all achievements
    $achievements = $pdo->query("SELECT * FROM achievements ORDER BY achievement_date DESC")->fetchAll();
    
} catch (Exception $e) {
    $error = "Database error occurred.";
    $achievements = [];
    error_log("Achievements admin error: " . $e->getMessage());
}

$pageTitle = "Manage Achievements";
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
                    <a href="admin">Portfolio Admin</a> / Achievements
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

            <!-- Add/Edit Achievement Form -->
            <div class="admin-section">
                <div class="admin-section-header">
                    <h2 class="admin-section-title">Add New Achievement</h2>
                </div>
                
                <form method="POST" class="admin-form" id="achievement-form">
                    <input type="hidden" name="action" value="add" id="form-action">
                    <input type="hidden" name="id" id="achievement-id">
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="title" class="form-label">Title *</label>
                            <input type="text" id="title" name="title" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <label for="category" class="form-label">Category *</label>
                            <select id="category" name="category" class="form-input" required>
                                <option value="">Select Category</option>
                                <option value="Competition">Competition</option>
                                <option value="Academic">Academic</option>
                                <option value="Project">Project</option>
                                <option value="Certification">Certification</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="description" class="form-label">Description *</label>
                        <textarea id="description" name="description" class="form-textarea" rows="4" required></textarea>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="role" class="form-label">Role</label>
                            <input type="text" id="role" name="role" class="form-input" 
                                   placeholder="e.g., Machine Learning Engineer">
                        </div>
                        <div class="form-group">
                            <label for="achievement_date" class="form-label">Achievement Date *</label>
                            <input type="date" id="achievement_date" name="achievement_date" class="form-input" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="image_url" class="form-label">Image URL</label>
                        <input type="url" id="image_url" name="image_url" class="form-input" 
                               placeholder="https://example.com/image.jpg">
                    </div>
                    
                    <div style="display: flex; gap: var(--spacing-base);">
                        <button type="submit" class="btn btn-primary" id="submit-btn">Add Achievement</button>
                        <button type="button" class="btn btn-secondary" id="cancel-btn" onclick="resetForm()" style="display: none;">Cancel</button>
                    </div>
                </form>
            </div>

            <!-- Achievements List -->
            <div class="admin-section">
                <div class="admin-section-header">
                    <h2 class="admin-section-title">All Achievements</h2>
                </div>
                
                <?php if (empty($achievements)): ?>
                    <p class="text-muted">No achievements found.</p>
                <?php else: ?>
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Role</th>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($achievements as $achievement): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($achievement['title']); ?></td>
                                    <td>
                                        <span class="status-badge status-read">
                                            <?php echo htmlspecialchars($achievement['category']); ?>
                                        </span>
                                    </td>
                                    <td><?php echo htmlspecialchars($achievement['role'] ?? 'N/A'); ?></td>
                                    <td><?php echo formatDate($achievement['achievement_date']); ?></td>
                                    <td><?php echo htmlspecialchars(truncateText($achievement['description'], 100)); ?></td>
                                    <td>
                                        <div class="admin-actions">
                                            <button type="button" class="btn btn-edit btn-sm" 
                                                    onclick="editAchievement(<?php echo htmlspecialchars(json_encode($achievement)); ?>)">
                                                Edit
                                            </button>
                                            <form method="POST" style="display: inline;" 
                                                  onsubmit="return confirm('Are you sure you want to delete this achievement?')">
                                                <input type="hidden" name="action" value="delete">
                                                <input type="hidden" name="id" value="<?php echo $achievement['id']; ?>">
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
        function editAchievement(achievement) {
            document.getElementById('form-action').value = 'edit';
            document.getElementById('achievement-id').value = achievement.id;
            document.getElementById('title').value = achievement.title;
            document.getElementById('description').value = achievement.description;
            document.getElementById('achievement_date').value = achievement.achievement_date;
            document.getElementById('category').value = achievement.category;
            document.getElementById('role').value = achievement.role || '';
            document.getElementById('image_url').value = achievement.image_url || '';
            
            document.getElementById('submit-btn').textContent = 'Update Achievement';
            document.getElementById('cancel-btn').style.display = 'inline-block';
            
            document.querySelector('.admin-section-title').textContent = 'Edit Achievement';
            document.getElementById('achievement-form').scrollIntoView({ behavior: 'smooth' });
        }
        
        function resetForm() {
            document.getElementById('achievement-form').reset();
            document.getElementById('form-action').value = 'add';
            document.getElementById('achievement-id').value = '';
            document.getElementById('submit-btn').textContent = 'Add Achievement';
            document.getElementById('cancel-btn').style.display = 'none';
            document.querySelector('.admin-section-title').textContent = 'Add New Achievement';
        }
    </script>
</body>
</html>
