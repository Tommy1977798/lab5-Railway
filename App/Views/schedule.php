<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>Timesheet</title>
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
    <h2>Timesheet</h2>
    <form method="GET" action="/schedule">
            <input type="text" name="search" placeholder="Search by train name or route" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
            <button type="submit">Search</button>
        </form>
    <table border="1">
        <tr>
            <th>Train's name</th>
            <th>Departuring time</th>
            <th>Arriving time</th>
            <th>Route</th>
            <th>Action</th>
        </tr>
        <?php if (empty($trains)): ?>
                <tr><td colspan="5">No trains found.</td></tr>
            <?php else: ?>
        <?php foreach ($trains as $train): ?>
            <tr>
                <td><?= $train['train_name'] ?></td>
                <td><?= $train['departure_time'] ?></td>
                <td><?= $train['arrival_time'] ?></td>
                <td><?= $train['route'] ?></td>
                <td>
                    <a href="/book?train_id=<?= $train['id'] ?>">Book</a>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php endif; ?>
    </table>
    <a href="/">Back to home page</a>
    <footer class="footer">
        <p>© 2025 铁路站管理系统 | 设计 by Tommy1977798</p>
    </footer>
</body>
</html>
