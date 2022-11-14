<link rel="stylesheet" href="../style/style.css?v=<?php echo time(); ?>">

<?php
require '../database/connection.php';
session_start();
if(!isset($_SESSION['username'])){
    echo "<script>window.location='login.php'</script>";
}
$id = $_GET['id'];
if(isset($_POST['buyNow'])){
    $sql = mysqli_query($conn, "SELECT stok_hp FROM produk WHERE id_hp = '$id'");
    while($i = mysqli_fetch_array($sql)){
        $sqlKurang = mysqli_query($conn, "UPDATE produk SET stok_hp = stok_hp - 1 WHERE id_hp = '$id'");
        echo "<script>alert('Produk berhasil dibeli silahkan cek email untuk informasi lebih lanjut!')</script>";
        echo "<script>window.location='products.php'</script>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="navbar">
    <div class="navbarTengah">
        <ul>
            <span>
                <li><a href="products.php">Kembali</a></li>
            </span>
        </ul>
    </div>
</div>

<div class="buyContainer">
    <form action="" method="post">
            <div class="tampilDetail">
                <label for=""></label>
                <?php
                $sql2 = "SELECT nama_hp, harga_hp, gambar FROM produk WHERE id_hp = '$id'";
                $result = $conn->query($sql2);  
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        ?>
                        <img src="../image/<?php echo $row['gambar'] ?>" alt="xphone1" style="max-width: 100px;height: auto;"><br>
                        <?php
                        echo $row['nama_hp'], "<br>";
                        echo "Rp.". $row['harga_hp'];
                    }
                }
                ?>
            </div>
            <div class="buyForm">
            <h3>Checkout Form</h3>
            <label for="">Nama lengkap</label>
            <input type="text" name="namaLengkap" required>

            <label for="">Alamat</label>
            <input type="text" name="alamat" required>
            <label for="">Kode Pos</label>
            <input type="number" name="kodePos" required>

            <label for="">Nomor Telepon</label>
            <input type="tel" name="tel" required>

            <label for="">Nomor Kartu MasterCard</label>
            <label for="MasterCard"></label>
            <input type="number" name="payment" required>

            <button class="logBtn" name="buyNow">Buy</button>
        </div>
    </form>
</div>