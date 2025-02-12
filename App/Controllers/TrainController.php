<?php
namespace App\Controllers;

use App\Models\TrainModel;

class TrainController {
    public function schedule() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $trainModel = new TrainModel();

        // Check if a search query is submitted
        $searchQuery = $_GET['search'] ?? '';

        if ($searchQuery) {
            $trains = $trainModel->searchTrains($searchQuery);  // Search function
        } else {
            $trains = $trainModel->getAllTrains();  // Get all trains if no search
        }

        include __DIR__ . '/../Views/schedule.php';
    }
}
