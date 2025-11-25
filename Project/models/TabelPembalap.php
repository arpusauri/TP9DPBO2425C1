<?php

include_once ("models/DB.php");
include_once ("KontrakModel.php");

class TabelPembalap extends DB implements KontrakModel {

    // Konstruktor untuk inisialisasi database
    public function __construct($host, $db_name, $username, $password) {
        parent::__construct($host, $db_name, $username, $password);
    }

    // Method untuk mendapatkan semua pembalap
    public function getAllPembalap(): array {
        $query = "SELECT * FROM pembalap";
        $this->executeQuery($query);
        return $this->getAllResult();
    }

    // Method untuk mendapatkan pembalap berdasarkan ID
    public function getPembalapById($id): ?array {
        $query = "SELECT * FROM pembalap WHERE id = ?";
        $this->executeQuery($query, [$id]);
        $result = $this->getAllResult();
        return $result ? $result[0] : null;
    }

    // Method untuk menambah pembalap
    public function addPembalap($nama, $tim, $negara, $poinMusim, $jumlahMenang): void {
        $query = "INSERT INTO pembalap (nama, tim, negara, poinMusim, jumlahMenang) VALUES (?, ?, ?, ?, ?)";
        $this->executeQuery($query, [$nama, $tim, $negara, $poinMusim, $jumlahMenang]);
    }

    // Method untuk mengupdate pembalap
    public function updatePembalap($id, $nama, $tim, $negara, $poinMusim, $jumlahMenang): void {
        $query = "UPDATE pembalap SET nama = ?, tim = ?, negara = ?, poinMusim = ?, jumlahMenang = ? WHERE id = ?";
        $this->executeQuery($query, [$nama, $tim, $negara, $poinMusim, $jumlahMenang, $id]);
    }

    // Method untuk menghapus pembalap
    public function deletePembalap($id): void {
        $query = "DELETE FROM pembalap WHERE id = ?";
        $this->executeQuery($query, [$id]);
    }

}

?>