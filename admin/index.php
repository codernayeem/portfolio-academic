<?php
require_once '../includes/config.php';
redirectToAdmin();

try {
    $pdo = getDBConnection();
    
    // Get statistics
    $projectsCount = $pdo->query("SELECT COUNT(*) FROM projects")->fetchColumn();
    $achievementsCount = $pdo->query("SELECT COUNT(*) FROM achievements")->fetchColumn();
    $educationCount = $pdo->query("SELECT COUNT(*) FROM education")->fetchColumn();
    $messagesCount = $pdo->query("SELECT COUNT(*) FROM contact_messages")->fetchColumn();
    $unreadCount = $pdo->query("SELECT COUNT(*) FROM contact_messages WHERE is_read = 0")->fetchColumn();
    
    // Get recent messages
    $recentMessages = $pdo->query("SELECT * FROM contact_messages ORDER BY created_at DESC LIMIT 5")->fetchAll();
    
} catch (Exception $e) {
    $projectsCount = $achievementsCount = $educationCount = $messagesCount = $unreadCount = 0;
    $recentMessages = [];
    error_log("Dashboard error: " . $e->getMessage());
}

$pageTitle = "Admin Dashboard";
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
                <div class="admin-brand">Portfolio Admin</div>
                <div class="admin-user">
                    <span>Welcome, <?php echo htmlspecialchars($_SESSION['admin_username']); ?></span>
                    <a href="logout.php" class="btn btn-secondary btn-sm">Logout</a>
                </div>
            </nav>
        </div>
    </header>

    <main class="admin-main">
        <div class="admin-container">
            <!-- Statistics -->
            <div class="admin-stats">
                <div class="admin-stat-card">
                    <span class="admin-stat-number"><?php echo $projectsCount; ?></span>
                    <span class="admin-stat-label">Projects</span>
                </div>
                <div class="admin-stat-card">
                    <span class="admin-stat-number"><?php echo $achievementsCount; ?></span>
                    <span class="admin-stat-label">Achievements</span>
                </div>
                <div class="admin-stat-card">
                    <span class="admin-stat-number"><?php echo $educationCount; ?></span>
                    <span class="admin-stat-label">Education</span>
                </div>
                <div class="admin-stat-card">
                    <span class="admin-stat-number"><?php echo $messagesCount; ?></span>
                    <span class="admin-stat-label">Total Messages</span>
                </div>
                <div class="admin-stat-card">
                    <span class="admin-stat-number"><?php echo $unreadCount; ?></span>
                    <span class="admin-stat-label">Unread Messages</span>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="admin-section">
                <div class="admin-section-header">
                    <h2 class="admin-section-title">Quick Actions</h2>
                </div>
                <div style="display: flex; gap: var(--spacing-base); flex-wrap: wrap;">
                    <a href="projects.php" class="btn btn-primary">Manage Projects</a>
                    <a href="achievements.php" class="btn btn-primary">Manage Achievements</a>
                    <a href="education.php" class="btn btn-primary">Manage Education</a>
                    <a href="messages.php" class="btn btn-primary">View Messages</a>
                    <a href="../index.php" target="_blank" class="btn btn-secondary">View Portfolio</a>
                </div>
            </div>

            <!-- Recent Messages -->
            <div class="admin-section">
                <div class="admin-section-header">
                    <h2 class="admin-section-title">Recent Messages</h2>
                    <a href="messages.php" class="btn btn-secondary">View All</a>
                </div>
                
                <?php if (empty($recentMessages)): ?>
                    <p class="text-muted">No messages yet.</p>
                <?php else: ?>
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recentMessages as $message): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($message['name']); ?></td>
                                    <td><?php echo htmlspecialchars($message['email']); ?></td>
                                    <td><?php echo htmlspecialchars(truncateText($message['message'], 50)); ?></td>
                                    <td><?php echo formatDateTime($message['created_at']); ?></td>
                                    <td>
                                        <span class="status-badge <?php echo $message['is_read'] ? 'status-read' : 'status-unread'; ?>">
                                            <?php echo $message['is_read'] ? 'Read' : 'Unread'; ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <script src="../assets/js/admin.js"></script>
</body>
</html>
