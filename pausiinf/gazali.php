<?php
// Set default nilai
$nomorTransaksi = "";
$namaPembeli = "";
$judulBuku = "";
$jumlahBuku = "";
$hargaBuku = "";
$result = "";

// Cek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari formulir
    $nomorTransaksi = $_POST["nomor_transaksi"];
    $namaPembeli = $_POST["nama_pembeli"];
    $judulBuku = $_POST["judul_buku"];
    $jumlahBuku = $_POST["jumlah_buku"];
    $hargaBuku = $_POST["harga_buku"];

    // Validasi input (disini kita hanya memastikan bahwa semua field tidak kosong)
    if (!empty($nomorTransaksi) && !empty($namaPembeli) && !empty($judulBuku) && !empty($jumlahBuku) && !empty($hargaBuku)) {
        // Menghitung total belanja
        $totalBelanja = $jumlahBuku * $hargaBuku;

        // Menghitung diskon 10% jika total belanja lebih dari 150.000
        if ($totalBelanja > 150000) {
            $diskonBelanja = 0.1;
        } else {
            $diskonBelanja = 0;
        }

        // Menghitung diskon transaksi 5% untuk 50 transaksi pertama
        if ($nomorTransaksi <= 50) {
            $diskonTransaksi = 0.05;
        } else {
            $diskonTransaksi = 0;
        }

        // Menghitung total belanja setelah diskon
        $totalSetelahDiskon = $totalBelanja - ($totalBelanja * ($diskonBelanja + $diskonTransaksi));

$diskonBelanjaAmount = $totalBelanja * $diskonBelanja;
        $diskonTransaksiAmount = $totalBelanja * $diskonTransaksi;

        // Menampilkan hasil
        $result = "Nomor Transaksi: $nomorTransaksi<br>
                    Nama Pembeli: $namaPembeli<br>
                    Harga: Rp " . number_format($hargaBuku, 0, ',', '.') . "<br>
                    Diskon Belanja: (" . ($diskonBelanja * 100) . "%) : Rp " . number_format($diskonBelanjaAmount, 0, ',', '.') . "<br>
                    Diskon Transaksi: (" . ($diskonTransaksi * 100) . "%) : Rp " . number_format($diskonTransaksiAmount, 0, ',', '.') . "<br>
                    Total Bayar: Rp " . number_format($totalSetelahDiskon, 0, ',', '.');
    } else {
        // Pesan error jika ada field yang kosong
        $result = "Mohon isi semua field.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Pembelian Buku</title>
</head>
<body>
    <h2>Input Pembelian Buku</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        Nomor Transaksi: <input type="text" name="nomor_transaksi" value="<?php echo $nomorTransaksi; ?>"><br>
        Nama Pembeli: <input type="text" name="nama_pembeli" value="<?php echo $namaPembeli; ?>"><br>
        Judul Buku: <input type="text" name="judul_buku" value="<?php echo $judulBuku; ?>"><br>
        Jumlah Buku: <input type="text" name="jumlah_buku" value="<?php echo $jumlahBuku; ?>"><br>
        Harga Buku: Rp <input type="text" name="harga_buku" value="<?php echo $hargaBuku; ?>"><br>
        <input type="submit" value="Hitung">
    </form>

    <?php
    // Menampilkan hasil
    echo $result;
    ?>
</body>
</html>
