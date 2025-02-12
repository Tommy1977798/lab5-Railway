<?php
namespace App\Models;

use App\Core\Database;
use PDO;

class TrainModel {
    public function getAllTrains() {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT * FROM trains");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchTrains($query) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM trains WHERE train_name LIKE ? OR route LIKE ?");
        $stmt->execute(["%$query%", "%$query%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
