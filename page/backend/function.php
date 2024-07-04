<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "forecasting3");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function registrasi($data)
{
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $nama_user = strtolower(stripslashes($data["nama_user"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);


    // cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo " <script> 
		alert ('username sudah terdaftar!')
		</script>";
        return false;
    }

    //cek konfirmasi password 
    if ($password !== $password2) {
        echo "<script>
		alert('konfirmasi password tidak sesuai!');
		</script>";
        return false;
    }
    // Enkripsi password 
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Tambahkan user baru ke database 
    mysqli_query($conn, "INSERT INTO users VALUES('','$username','$nama_user','$password')");
    return mysqli_affected_rows($conn);
}

function addProduk($data)
{
    global $conn;
    $nama_produk = htmlspecialchars($data["nama_produk"]);
    $harga   = htmlspecialchars($data["harga"]);
    $stok   = htmlspecialchars($data["stok"]);
    //validasi nama produk
    $cek_namaproduk = "SELECT nama_produk FROM produk WHERE nama_produk = '$_POST[nama_produk]'";
    $cek_namaproduk_proses = mysqli_query($conn, $cek_namaproduk);
    if (mysqli_affected_rows($conn) > 0) {
        return 0;
    } else {
        $query = "INSERT INTO produk(nama_produk,harga,stok) 
		VALUES ('$nama_produk','$harga','$stok') ";

        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }
}

function editProduk($data)
{
    global $conn;
    $id_produk = $data["id_produk"];
    $nama_produk = htmlspecialchars($data["nama_produk"]);
    $nama_produk_previous = htmlspecialchars($data["nama_produk_previous"]);
    $harga = htmlspecialchars($data["harga"]);
    $stok = htmlspecialchars($data["stok"]);

    if ($nama_produk == $nama_produk_previous) {
        $query = "UPDATE  produk SET  
        id_produk='$id_produk',
		harga = '$harga',
        stok = '$stok'
		WHERE id_produk= $id_produk";

        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    } elseif ($nama_produk != $nama_produk_previous) {
        $cek_namaproduk = "SELECT nama_produk FROM produk WHERE nama_produk = '$_POST[nama_produk]'";
        $cek_namaproduk_proses = mysqli_query($conn, $cek_namaproduk);
        if (mysqli_affected_rows($conn) > 0) {
            return 0;
        } else {
            $query = "UPDATE  produk SET  
            id_produk='$id_produk',
			nama_produk='$nama_produk',
			harga = '$harga',
            stok = '$stok'
			WHERE id_produk= $id_produk";
            echo $query;
            mysqli_query($conn, $query);
            return mysqli_affected_rows($conn);
        }
    }
}

function addPenjualan($data)
{
    global $conn;
    $date = htmlspecialchars($data["date"]);
    $id_produk = htmlspecialchars($data["id_produk"]);
    $total_penjualan = htmlspecialchars($data["total_penjualan"]);
    $query = "INSERT INTO penjualan(id_produk,tanggal,total_penjualan) 
    VALUES ('$id_produk','$date','$total_penjualan')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function editPenjualan($data)
{
    global $conn;
    $id_penjualan = $data["id_penjualan"];
    $id_produk = htmlspecialchars($data["id_produk"]);
    $tanggal = htmlspecialchars($data["tanggal"]);
    $total_penjualan = htmlspecialchars($data["total_penjualan"]);
    $query = "UPDATE  penjualan SET  
				id_produk = '$id_produk',
                tanggal = '$tanggal',
                total_penjualan = '$total_penjualan'
		 		WHERE id_penjualan = $id_penjualan";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function addPerencanaanProduksi($data)
{
    global $conn;
    $id_forecasting = htmlspecialchars($data["id_forecasting"]);
    $jumlah_produksi = htmlspecialchars($data["jumlah_produksi"]);
    $status = $data["status"];
    $query = "INSERT INTO perencanaan_produksi(id_forecasting,jumlah_produksi,status) 
    VALUES ('$id_forecasting','$jumlah_produksi','$status')";
    mysqli_query($conn, $query);
    echo $query;
    return mysqli_affected_rows($conn);
}

function editPerencanaanProduksi($data)
{
    global $conn;
    $id_perencanaan = $data["id_perencanaan"];
    $id_forecasting = htmlspecialchars($data["id_forecasting"]);
    $jumlah_produksi = htmlspecialchars($data["jumlah_produksi"]);
    $status = $data["status"];
    $query = "UPDATE  perencanaan_produksi SET  
				id_perencanaan = '$id_perencanaan',
                id_forecasting = '$id_forecasting',
                jumlah_produksi = '$jumlah_produksi',
                status = '$status'
		 		WHERE id_perencanaan = $id_perencanaan";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
