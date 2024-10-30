<?php
class CarRental {
    private $conn;
    private $table_name = "t_biaya_Rental";
    
    private $car_prices = [
        'Avanza' => 640000,
        'Innova' => 890000,
        'New Altis' => 1500000,
        'New Camry' => 2190000,
        'Alphard' => 3220000
    ];

    public function __construct($db) {
        $this->conn = $db;
    }

    public function createTable() {
        $query = "CREATE TABLE IF NOT EXISTS " . $this->table_name . " (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nama_penyewa VARCHAR(100),
            nama_mobil VARCHAR(50),
            program VARCHAR(50),
            biaya DECIMAL(10,2),
            lama_sewa INT,
            biaya_paket1 DECIMAL(10,2),
            biaya_paket2 DECIMAL(10,2),
            biaya_paket3 DECIMAL(10,2),
            biaya_harian DECIMAL(10,2),
            biaya_extra DECIMAL(10,2),
            total_biaya DECIMAL(10,2)
        )";
        
        try {
            $this->conn->exec($query);
            return true;
        } catch(PDOException $e) {
            echo "Error creating table: " . $e->getMessage();
            return false;
        }
    }

    public function getCarPrices() {
        return $this->car_prices;
    }

    public function calculateRental($data) {
        $base_price = $this->getBasePrice($data['mobil']);
        $duration = $data['lama_sewa'];
        $program = $data['program'];
        $extra_hours = isset($data['extra_hours']) ? $data['extra_hours'] : 0;

        // Menghitung biaya rental
        $rental_cost = $base_price * $duration;

        // Menerapkan diskon berdasarkan paket
        $discount = $this->getDiscount($program);
        
        $discounted_cost = $rental_cost * (1 - $discount);
        $extra_cost = $extra_hours * 100000;
        $total_cost = $discounted_cost + $extra_cost;

        // Menyimpan ke database
        $this->saveRental($data, $base_price, $discount, $discounted_cost, $extra_cost, $total_cost);

        return [
            'base_cost' => $rental_cost,
            'discount' => $discount,
            'extra_cost' => $extra_cost,
            'total_cost' => $total_cost
        ];
    }

    private function getBasePrice($car) {
        return isset($this->car_prices[$car]) ? $this->car_prices[$car] : 0;
    }

    private function getDiscount($program) {
        switch($program) {
            case 'Paket 1': return 0.10;
            case 'Paket 2': return 0.20;
            case 'Paket 3': return 0.25;
            default: return 0;
        }
    }

    private function saveRental($data, $base_price, $discount, $discounted_cost, $extra_cost, $total_cost) {
        $query = "INSERT INTO " . $this->table_name . "
                (nama_penyewa, nama_mobil, program, biaya, lama_sewa, 
                biaya_paket1, biaya_paket2, biaya_paket3, biaya_harian, biaya_extra, total_biaya)
                VALUES
                (:nama_penyewa, :nama_mobil, :program, :biaya, :lama_sewa,
                :biaya_paket1, :biaya_paket2, :biaya_paket3, :biaya_harian, :biaya_extra, :total_biaya)";

        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute([
                ':nama_penyewa' => $data['nama_penyewa'],
                ':nama_mobil' => $data['mobil'],
                ':program' => $data['program'],
                ':biaya' => $base_price,
                ':lama_sewa' => $data['lama_sewa'],
                ':biaya_paket1' => $discount == 0.10 ? $discounted_cost : 0,
                ':biaya_paket2' => $discount == 0.20 ? $discounted_cost : 0,
                ':biaya_paket3' => $discount == 0.25 ? $discounted_cost : 0,
                ':biaya_harian' => $discount == 0 ? $discounted_cost : 0,
                ':biaya_extra' => $extra_cost,
                ':total_biaya' => $total_cost
            ]);
            return true;
        } catch(PDOException $e) {
            echo "Error saving rental: " . $e->getMessage();
            return false;
        }
    }

    public function getAllTransactions() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC";
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error fetching transactions: " . $e->getMessage();
            return [];
        }
    }
}
