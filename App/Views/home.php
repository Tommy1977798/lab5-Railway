<?php  
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>Railway Station mamagement system</title>
    <link rel="stylesheet" href="/src/styles.css">
</head>
<body>
<div class="navbar">
        <a href="/">Main page</a>
        <a href="/schedule">Timesheet</a>
        <a href="/my-bookings">My reservation</a>
        <a href="/update-profile">My profile</a>
        <a href="/logout">logout</a>
    </div>
    <h1>Welcome to Railway Station mamagement system</h1>
    <?php if (isset($_SESSION['user_id'])): ?>
        <p style="text-align: center;">Hello, <?= htmlspecialchars($_SESSION['username'] ?? '用户') ?>!</p>
    <?php else: ?>
        <p style="text-align: center;"><a href="/login" class="btn">login</a> | <a href="/register" class="btn">signup</a></p>
    <?php endif; ?>
    <footer class="footer">
        <p>© 2025 铁路站管理系统 | 设计 by Tommy1977798</p>
    </footer>
</body>
</html>
