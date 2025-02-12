<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>User Login</title>
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
    <h2>User Login</h2>
    <form method="POST" action="/login">
        <label>User Name: <input type="text" name="username" required></label><br>
        <label>Password: <input type="password" name="password" required></label><br>
        <button type="submit">Login</button>
    </form>
    <p>don't have an account？<a href="/register">Sign up</a></p>
    <footer class="footer">
        <p>© 2025 铁路站管理系统 | 设计 by Tommy1977798</p>
    </footer>
</body>
</html>
