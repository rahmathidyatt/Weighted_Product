<?php
// Fungsi untuk membuat koneksi ke basis data
function Koneksi()
{
    // Menghubungkan ke basis data MySQL dengan host "localhost", username "root", password "", dan nama basis data "belajar"
    return mysqli_connect("localhost", "root", "", "belajar");
}

// Fungsi untuk mengeksekusi query SELECT dan mengembalikan hasilnya dalam bentuk array asosiatif
function Index($query)
{
    // Membuat koneksi ke basis data
    $koneksi = Koneksi();
    // Menjalankan query yang diberikan sebagai parameter
    $result = mysqli_query($koneksi, $query);
    // Inisialisasi array kosong untuk menyimpan hasil
    $rows = [];
    // Mengambil setiap baris hasil query dan menambahkannya ke dalam array $rows
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    // Mengembalikan array hasil
    return $rows;
}

// Fungsi untuk menambahkan data ke dalam tabel yang diberikan
function Add($table, $data)
{
    // Membuat koneksi ke basis data
    $koneksi = Koneksi();
    // Mengamankan data dari input pengguna untuk mencegah XSS
    $idles = htmlspecialchars($data["id_les"]);
    $idkriteria = htmlspecialchars($data["id_kriteria"]);
    $nilai = htmlspecialchars($data["nilai"]);
    // Menyusun query INSERT dengan data yang telah diamankan
    $query = "INSERT INTO $table VALUES (null, '$idles', '$idkriteria','$nilai')";

    // Menjalankan query INSERT
    mysqli_query($koneksi, $query);
    // Mengembalikan jumlah baris yang terpengaruh oleh query terakhir
    return mysqli_affected_rows($koneksi);
}

// Fungsi untuk mengedit data dalam tabel yang diberikan
function Edit($table, $data)
{
    // Membuat koneksi ke basis data
    $koneksi = Koneksi();
    // Mengamankan data dari input pengguna untuk mencegah XSS
    $idnilai = htmlspecialchars($data["id_nilai"]);
    $idles = htmlspecialchars($data["id_les"]);
    $idkriteria = htmlspecialchars($data["id_kriteria"]);
    $nilai = htmlspecialchars($data["nilai"]);
    // Menyusun query UPDATE dengan data yang telah diamankan
    $query = "UPDATE $table SET id_les = '$idles', id_kriteria = '$idkriteria', nilai = '$nilai' WHERE id_nilai = $idnilai";

    // Menjalankan query UPDATE
    mysqli_query($koneksi, $query);
    // Mengembalikan jumlah baris yang terpengaruh oleh query terakhir
    return mysqli_affected_rows($koneksi);
}

// Fungsi untuk menghapus data dari tabel yang diberikan
function Delete($table, $tableid, $id)
{
    // Membuat koneksi ke basis data
    $koneksi = Koneksi();
    // Menyusun query DELETE dengan ID yang diberikan
    $query = "DELETE FROM $table WHERE $tableid = $id";
    // Menjalankan query DELETE
    mysqli_query($koneksi, $query);

    // Mengembalikan jumlah baris yang terpengaruh oleh query terakhir
    return mysqli_affected_rows($koneksi);
}

