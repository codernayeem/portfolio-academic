<?php
require_once '../includes/config.php';
redirectToAdmin();

$success = '';
$error = '';

try {
    $pdo = getDBConnection();
    
    // Handle mark as read/unread
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['action']) && isset($_POST['id'])) {
            $id = (int)$_POST['id'];
            
            switch ($_POST['action']) {
                case 'mark_read':
                    $stmt = $pdo->prepare("UPDATE contact_messages SET is_read = 1 WHERE id = ?");
                    if ($stmt->execute([$id])) {
                        $success = "Message marked as read.";
                    }
                    break;
                    
                case 'mark_unread':
                    $stmt = $pdo->prepare("UPDATE contact_messages SET is_read = 0 WHERE id = ?");
                    if ($stmt->execute([$id])) {
                        $success = "Message marked as unread.";
                    }
                    break;
                    
                case 'delete':
                    $stmt = $pdo->prepare("DELETE FROM contact_messages WHERE id = ?");
                    if ($stmt->execute([$id])) {
                        $success = "Message deleted successfully.";
                    } else {
                        $error = "Failed to delete message.";
                    }
                    break;
            }
        }
        
        // Mark all as read
        if (isset($_POST['mark_all_read'])) {
            $stmt = $pdo->prepare("UPDATE contact_messages SET is_read = 1");
            if ($stmt->execute()) {
                $success = "All messages marked as read.";
            }
        }
    }
    
    // Fetch all messages
    $messages = $pdo->query("SELECT * FROM contact_messages ORDER BY created_at DESC")->fetchAll();
    $unreadCount = $pdo->query("SELECT COUNT(*) FROM contact_messages WHERE is_read = 0")->fetchColumn();
    
} catch (Exception $e) {
    $error = "Database error occurred.";
    $messages = [];
    $unreadCount = 0;
    error_log("Messages admin error: " . $e->getMessage());
}

$pageTitle = "Contact Messages";
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
                    <a href="admin">Portfolio Admin</a> / Messages
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

            <!-- Messages Overview -->
            <div class="admin-section">
                <div class="admin-section-header">
                    <h2 class="admin-section-title">Contact Messages</h2>
                    <div style="display: flex; gap: var(--spacing-base);">
                        <?php if ($unreadCount > 0): ?>
                            <form method="POST" style="display: inline;">
                                <input type="hidden" name="mark_all_read" value="1">
                                <button type="submit" class="btn btn-secondary btn-sm">
                                    Mark All Read (<?php echo $unreadCount; ?>)
                                </button>
                            </form>
                        <?php endif; ?>
                        <span class="admin-stat-number" style="font-size: var(--font-size-base); margin: 0;">
                            Total: <?php echo count($messages); ?>
                        </span>
                    </div>
                </div>
                
                <?php if (empty($messages)): ?>
                    <p class="text-muted">No messages received yet.</p>
                <?php else: ?>
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($messages as $message): ?>
                                <tr class="<?php echo !$message['is_read'] ? 'unread-row' : ''; ?>">
                                    <td style="font-weight: <?php echo !$message['is_read'] ? '600' : 'normal'; ?>;">
                                        <?php echo htmlspecialchars($message['name']); ?>
                                    </td>
                                    <td>
                                        <a href="mailto:<?php echo htmlspecialchars($message['email']); ?>">
                                            <?php echo htmlspecialchars($message['email']); ?>
                                        </a>
                                    </td>
                                    <td>
                                        <div style="max-width: 300px;">
                                            <p class="message-preview" onclick="showFullMessage(<?php echo $message['id']; ?>)">
                                                <?php echo htmlspecialchars(truncateText($message['message'], 100)); ?>
                                            </p>
                                            <div id="full-message-<?php echo $message['id']; ?>" class="message-expanded">
                                                <?php echo nl2br(htmlspecialchars($message['message'])); ?>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?php echo formatDateTime($message['created_at']); ?></td>
                                    <td>
                                        <span class="status-badge <?php echo $message['is_read'] ? 'status-read' : 'status-unread'; ?>">
                                            <?php echo $message['is_read'] ? 'Read' : 'Unread'; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="admin-actions">
                                            <?php if ($message['is_read']): ?>
                                                <form method="POST" style="display: inline;">
                                                    <input type="hidden" name="action" value="mark_unread">
                                                    <input type="hidden" name="id" value="<?php echo $message['id']; ?>">
                                                    <button type="submit" class="btn btn-secondary btn-sm">Mark Unread</button>
                                                </form>
                                            <?php else: ?>
                                                <form method="POST" style="display: inline;">
                                                    <input type="hidden" name="action" value="mark_read">
                                                    <input type="hidden" name="id" value="<?php echo $message['id']; ?>">
                                                    <button type="submit" class="btn btn-primary btn-sm">Mark Read</button>
                                                </form>
                                            <?php endif; ?>
                                            
                                            <form method="POST" style="display: inline;" 
                                                  onsubmit="return confirm('Are you sure you want to delete this message?')">
                                                <input type="hidden" name="action" value="delete">
                                                <input type="hidden" name="id" value="<?php echo $message['id']; ?>">
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
        function showFullMessage(messageId) {
            const fullMessage = document.getElementById('full-message-' + messageId);
            if (fullMessage.style.display === 'none') {
                fullMessage.style.display = 'block';
            } else {
                fullMessage.style.display = 'none';
            }
        }
    </script>
</body>
</html>
