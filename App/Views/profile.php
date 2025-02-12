<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>My information</title>
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
    <h2>My information</h2>

    <?php if (isset($_SESSION['flash_message'])): ?>
        <p style="color: green; text-align: center;"><?= $_SESSION['flash_message']; ?></p>
        <?php unset($_SESSION['flash_message']); // ✅ 显示后清除 Flash Message ?>
    <?php endif; ?>

    <form method="POST" action="/update-profile">
        <label>User name: <input type="text" name="username" value="<?= $_SESSION['username'] ?? '' ?>" required></label><br>
        <label>new password: <input type="password" name="password"></label><br>
        <button type="submit">Updating</button>
    </form>
    <a href="/">Back to homepage</a>
    <footer class="footer">
        <p>© 2025 铁路站管理系统 | 设计 by Tommy1977798</p>
    </footer>
</body>
</html>
