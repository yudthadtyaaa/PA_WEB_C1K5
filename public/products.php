<?php
require '../database/connection.php';
date_default_timezone_set('Etc/GMT-8');
session_start();
if(!isset($_SESSION['username'])){
    echo "<script>alert('Silahkan login terlebih dahulu!')</script>";
    echo "<script>window.location='login.php'</script>";
}
?>

<link rel="stylesheet" href="../style/style.css?v=<?php echo time(); ?>">
<title>Products Mango</title>

<div class="navbar">
    <div class="navbarKiri">
        <ul>
            <span>
                <li><a href="index.php">Mango</a></li>
                <li><a href="index.php">Home</a></li>
                <li><a href="products.php">Products</a></li>
            </span>
        </ul>
    </div>
    <div class="navbarKanan">
        <ul>
            <span>
                <?php
                    error_reporting(0);
                    if($_SESSION['username'])
                    echo '<li><a href="logout.php">Logout</a></li>';
                    else{
                        echo '<li><a href="login.php">Login</a></li>';
                    }
                ?>
            </span>
        </ul>
    </div>
</div>

<?php

?>

<form action="" method="post">
<div class="productsPage">
    <div class="filter">
        <input type="text" name="search" placeholder="Cari produk di Mango">
    </div>
    <div class="catalog">
        <?php

        $tampil = mysqli_query($conn, "SELECT * FROM produk");
        if(mysqli_num_rows($tampil) > 0){
            while($i = mysqli_fetch_array($tampil)){
        ?>
        <input type="hidden" name="id_user" value="<?php echo $_SESSION['username']['id'] ?>">  
        <input type="hidden" name="id_hp" value="<?php echo $i['id_hp'] ?>">
        <div class="catalogCard">
                <div class="nShadow">
                    <img src="../image/<?php echo $i['gambar'] ?>" alt="xphone1" style="max-width: 100px;height: auto;">
                    <h3><?php echo $i['nama_hp'] ?></h3>
                    <p>Rp. <?php echo $i['harga_hp'] ?></p>
                    <!-- <input type="submit" name="submit" class="cartSubmit" value="Buy now" href="detailProduct.php?id=<?php echo $keranjang["id_hp"]; ?>"> -->
                    <div class="buy">
                    <?php
                        if($i['stok_hp'] == 0){
                            echo("Stok Habis");
                        } else{
                            ?>
                            <a href="detailProduct.php?id=<?php echo $i['id_hp'] ?>">Buy Now</a>
                            <?php
                        }
                    ?>
                    </div>
            </div>
        </div>
        <?php
            }
        } else{
            echo '<h3>Produk belum tersedia silahkan kembali lagi</h3>';
        }
        ?>
    </div>
    </form>
</div>