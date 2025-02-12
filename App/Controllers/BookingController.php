<?php
namespace App\Controllers;

use App\Models\BookingModel;

class BookingController {
    public function bookTicket($trainId) {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit();
        }
    
        $userId = $_SESSION['user_id'];
        $bookingModel = new BookingModel();
        $result = $bookingModel->createBooking($userId, $trainId);
    
        if ($result) {
            $_SESSION['flash_message'] = "Booking successful!";
        } else {
            $_SESSION['flash_message'] = "Booking failed. Please try again.";
        }
    
        header("Location: /my-bookings");
        exit();
    }
    

    public function cancelBooking($bookingId) {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit();
        }
    
        $bookingModel = new BookingModel();
        $result = $bookingModel->cancelBooking($bookingId, $_SESSION['user_id']);
    
        if ($result) {
            $_SESSION['flash_message'] = "Booking cancelled successfully!";
        } else {
            $_SESSION['flash_message'] = "Cancellation failed.";
        }
    
        header("Location: /my-bookings");
        exit();
    }
    

    public function viewBookings() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit();
        }

        $bookingModel = new BookingModel();
        $bookings = $bookingModel->getBookingsByUserId($_SESSION['user_id']);

        include __DIR__ . '/../Views/bookings.php';
    }

    
}
