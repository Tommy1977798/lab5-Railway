<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>My bookings</title>
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
    <h2>My bookings</h2>
    <table border="1">
        <tr>
            <th>Train's name</th>
            <th>Departuring time</th>
            <th>Arriving time</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php if (isset($_SESSION['flash_message'])): ?>
            <p class="success-message"><?= $_SESSION['flash_message']; ?></p>
            <?php unset($_SESSION['flash_message']); ?>
       <?php endif; ?>

        <?php foreach ($bookings as $booking): ?>
            <tr>
                <td><?= $booking['train_name'] ?></td>
                <td><?= $booking['departure_time'] ?></td>
                <td><?= $booking['arrival_time'] ?></td>
                <td><?= $booking['status'] ?></td>
                <td>
                 <a href="/cancel-booking?booking_id=<?= $booking['id'] ?>" class="btn">Cancel</a>
                </td>

            </tr>
        <?php endforeach; ?>
    </table>
    <a href="/">Back to home page</a>
    <footer class="footer">
        <p>© 2025 铁路站管理系统 | 设计 by Tommy1977798</p>
    </footer>
</body>
</html>
