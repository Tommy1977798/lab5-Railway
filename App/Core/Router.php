<?php
namespace App\Core;

use App\Controllers\UserController;
use App\Controllers\TrainController;
use App\Controllers\BookingController;

class Router {
    public function dispatch($uri) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        // 解析 URL，获取路径
        $parsed_url = parse_url($uri);
        $path = $parsed_url['path'];
        parse_str($parsed_url['query'] ?? '', $query_params); // 解析查询参数

        switch ($path) {
            case '/':
                include __DIR__ . '/../Views/home.php';
                break;
            case '/login':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    (new UserController())->login();
                } else {
                    include __DIR__ . '/../Views/login.php';
                }
                break;
            case '/register':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    (new UserController())->register();
                } else {
                    include __DIR__ . '/../Views/register.php';
                }
                break;
            case '/schedule':
                (new TrainController())->schedule();
                break;
            case '/my-bookings':
                (new BookingController())->viewBookings();
                break;
            case '/book':  // 处理预订请求
                if (isset($query_params['train_id'])) {
                    (new BookingController())->bookTicket($query_params['train_id']);
                } else {
                    echo "错误: 缺少列车 ID";
                }
                break;
            case '/cancel-booking':
                if (isset($_GET['booking_id'])) {
                    (new BookingController())->cancelBooking($_GET['booking_id']);
                } else {
                    echo "Invalid booking ID";
                }
                break;
                
            case '/update-profile':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    (new UserController())->updateProfile();
                } else {
                    (new UserController())->viewProfile();
                }
                break;
                
            case '/logout':
                session_destroy();
                header("Location: /");
                break;
            default:
                echo "404 page not found";
        }
    }
}
