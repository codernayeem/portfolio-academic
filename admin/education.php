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
                    $degree = sanitizeInput($_POST['degree']);
                    $institution = sanitizeInput($_POST['institution']);
                    $duration = sanitizeInput($_POST['duration']);
                    $description = sanitizeInput($_POST['description']);
                    $achievements = sanitizeInput($_POST['achievements']);
                    
                    if (!empty($degree) && !empty($institution) && !empty($duration)) {
                        $stmt = $pdo->prepare("INSERT INTO education (degree, institution, duration, description, achievements) VALUES (?, ?, ?, ?, ?)");
                        if ($stmt->execute([$degree, $institution, $duration, $description, $achievements])) {
                            $success = "Education record added successfully!";
                        } else {
                            $error = "Failed to add education record.";
                        }
                    } else {
                        $error = "Please fill in all required fields.";
                    }
                    break;
                    
                case 'edit':
                    $id = (int)$_POST['id'];
                    $degree = sanitizeInput($_POST['degree']);
                    $institution = sanitizeInput($_POST['institution']);
                    $duration = sanitizeInput($_POST['duration']);
                    $description = sanitizeInput($_POST['description']);
                    $achievements = sanitizeInput($_POST['achievements']);
                    
                    if (!empty($degree) && !empty($institution) && !empty($duration)) {
                        $stmt = $pdo->prepare("UPDATE education SET degree = ?, institution = ?, duration = ?, description = ?, achievements = ? WHERE id = ?");
                        if ($stmt->execute([$degree, $institution, $duration, $description, $achievements, $id])) {
                            $success = "Education record updated successfully!";
                        } else {
                            $error = "Failed to update education record.";
                        }
                    } else {
                        $error = "Please fill in all required fields.";
                    }
                    break;
                    
                case 'delete':
                    $id = (int)$_POST['id'];
                    $stmt = $pdo->prepare("DELETE FROM education WHERE id = ?");
                    if ($stmt->execute([$id])) {
                        $success = "Education record deleted successfully!";
                    } else {
                        $error = "Failed to delete education record.";
                    }
                    break;
            }
        }
    }
    
    // Fetch all education records
    $education = $pdo->query("SELECT * FROM education ORDER BY id DESC")->fetchAll();
    
} catch (Exception $e) {
    $error = "Database error occurred.";
    $education = [];
    error_log("Education admin error: " . $e->getMessage());
}

$pageTitle = "Manage Education";
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
                    <a href="index.php">Portfolio Admin</a> / Education
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

            <!-- Add/Edit Education Form -->
            <div class="admin-section">
                <div class="admin-section-header">
                    <h2 class="admin-section-title">Add New Education</h2>
                </div>
                
                <form method="POST" class="admin-form" id="education-form">
                    <input type="hidden" name="action" value="add" id="form-action">
                    <input type="hidden" name="id" id="education-id">
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="degree" class="form-label">Degree *</label>
                            <input type="text" id="degree" name="degree" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <label for="duration" class="form-label">Duration *</label>
                            <input type="text" id="duration" name="duration" class="form-input" 
                                   placeholder="e.g., 2023 - Present" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="institution" class="form-label">Institution *</label>
                        <input type="text" id="institution" name="institution" class="form-input" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="description" class="form-label">Description</label>
                        <textarea id="description" name="description" class="form-textarea" rows="3"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="achievements" class="form-label">Achievements (comma-separated)</label>
                        <textarea id="achievements" name="achievements" class="form-textarea" rows="3"
                                  placeholder="Best Project Award, Current CGPA: 3.95/4.00"></textarea>
                    </div>
                    
                    <div style="display: flex; gap: var(--spacing-base);">
                        <button type="submit" class="btn btn-primary" id="submit-btn">Add Education</button>
                        <button type="button" class="btn btn-secondary" id="cancel-btn" onclick="resetForm()" style="display: none;">Cancel</button>
                    </div>
                </form>
            </div>

            <!-- Education List -->
            <div class="admin-section">
                <div class="admin-section-header">
                    <h2 class="admin-section-title">All Education Records</h2>
                </div>
                
                <?php if (empty($education)): ?>
                    <p class="text-muted">No education records found.</p>
                <?php else: ?>
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Degree</th>
                                <th>Institution</th>
                                <th>Duration</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($education as $edu): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($edu['degree']); ?></td>
                                    <td><?php echo htmlspecialchars($edu['institution']); ?></td>
                                    <td><?php echo htmlspecialchars($edu['duration']); ?></td>
                                    <td><?php echo htmlspecialchars(truncateText($edu['description'], 100)); ?></td>
                                    <td>
                                        <div class="admin-actions">
                                            <button type="button" class="btn btn-edit btn-sm" 
                                                    onclick="editEducation(<?php echo htmlspecialchars(json_encode($edu)); ?>)">
                                                Edit
                                            </button>
                                            <form method="POST" style="display: inline;" 
                                                  onsubmit="return confirm('Are you sure you want to delete this education record?')">
                                                <input type="hidden" name="action" value="delete">
                                                <input type="hidden" name="id" value="<?php echo $edu['id']; ?>">
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
        function editEducation(education) {
            document.getElementById('form-action').value = 'edit';
            document.getElementById('education-id').value = education.id;
            document.getElementById('degree').value = education.degree;
            document.getElementById('institution').value = education.institution;
            document.getElementById('duration').value = education.duration;
            document.getElementById('description').value = education.description || '';
            document.getElementById('achievements').value = education.achievements || '';
            
            document.getElementById('submit-btn').textContent = 'Update Education';
            document.getElementById('cancel-btn').style.display = 'inline-block';
            
            document.querySelector('.admin-section-title').textContent = 'Edit Education';
            document.getElementById('education-form').scrollIntoView({ behavior: 'smooth' });
        }
        
        function resetForm() {
            document.getElementById('education-form').reset();
            document.getElementById('form-action').value = 'add';
            document.getElementById('education-id').value = '';
            document.getElementById('submit-btn').textContent = 'Add Education';
            document.getElementById('cancel-btn').style.display = 'none';
            document.querySelector('.admin-section-title').textContent = 'Add New Education';
        }
    </script>
</body>
</html>
