<?php

include_once("models/DB.php");
include_once("models/TabelPembalap.php");
include_once("views/ViewPembalap.php");
include_once("presenters/PresenterPembalap.php");

$tabelPembalap = new TabelPembalap('localhost', 'mvp_db', 'root', '');
$viewPembalap = new ViewPembalap();
$presenter = new PresenterPembalap($tabelPembalap, $viewPembalap);


/* =======================
   RENDER FORM (GET)
======================= */
if (isset($_GET['screen'])) {

    // TAMBAH PEMBALAP
    if ($_GET['screen'] == 'add') {
        echo $presenter->tampilkanFormPembalap();
        exit;
    }

    // EDIT PEMBALAP
    if ($_GET['screen'] == 'edit' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $data = $tabelPembalap->getPembalapById($id);   // <-- Ambil data dari model

        if ($data) {
            echo $presenter->tampilkanFormPembalap($data);
        } else {
            echo "Data tidak ditemukan!";
        }
        exit;
    }
}


/* =======================
   ACTION CRUD (POST)
======================= */
if (isset($_POST['action'])) {

    $action = $_POST['action'];

    // CREATE
    if ($action == 'add') {
        $presenter->tambahPembalap(
            $_POST['nama'],
            $_POST['tim'],
            $_POST['negara'],
            $_POST['poinMusim'],
            $_POST['jumlahMenang']
        );
    }

    // UPDATE
    if ($action == 'edit') {
        $presenter->ubahPembalap(
            $_POST['id'],
            $_POST['nama'],
            $_POST['tim'],
            $_POST['negara'],
            $_POST['poinMusim'],
            $_POST['jumlahMenang']
        );
    }

    // DELETE
    if ($action == 'delete') {
        $presenter->hapusPembalap($_POST['id']);
    }

    // Selesai → kembali ke daftar
    header("Location: index.php");
    exit;
}


/* =======================
   DEFAULT : LIST PEMBALAP
======================= */
echo $presenter->tampilkanPembalap();
