<?php
namespace App\Models;

use App\Core\Database;
use PDO;

class BookingModel {
    public function createBooking($userId, $trainId) {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO bookings (user_id, train_id, booking_date, status) VALUES (?, ?, NOW(), 'Confirmed')");
        return $stmt->execute([$userId, $trainId]);
    }

    public function cancelBooking($bookingId, $userId) {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM bookings WHERE id = ? AND user_id = ?");
        return $stmt->execute([$bookingId, $userId]);
    }
    

    public function getBookingsByUserId($userId) {
        $db = Database::getConnection();
        $stmt = $db->prepare("
            SELECT b.id, t.train_name, t.departure_time, t.arrival_time, b.status
            FROM bookings b
            JOIN trains t ON b.train_id = t.id
            WHERE b.user_id = ?
            ORDER BY b.booking_date DESC
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
