<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar " src="img/logoBulat.png" alt="Image" height="42" width="42">
        <div>
            <p class="app-sidebar__user-name"><?php echo $_SESSION['nama_user'] ?></p>
            <p class="app-sidebar__user-designation"><?php echo $_SESSION['username'] ?></p>
        </div>
    </div>
    <ul class="app-menu">
        <li><a class="app-menu__item   <?php if ($thisPage == "Home") echo "active"; ?>" href="index.php"><i class="app-menu__icon fa fa-home"></i><span class="app-menu__label">Home</span></a></li>
        <?php if ($_SESSION['role'] == 1 or $_SESSION['role'] == 3) : ?>
            <li><a class="app-menu__item   <?php if ($thisPage == "Produk") echo "active"; ?>" href="produk.php"><i class="app-menu__icon fa fa-cube"></i></i><span class="app-menu__label">Produk</span></a></li>
        <?php endif; ?>
        <?php if ($_SESSION['role'] == 1) : ?>
            <li><a class="app-menu__item   <?php if ($thisPage == "Penjualan") echo "active"; ?>" href="penjualan.php"><i class="app-menu__icon fa fa-cart-plus"></i></i><span class="app-menu__label">Penjualan</span></a></li>
        <?php endif; ?>
        <?php if ($_SESSION['role'] == 1) : ?>
            <li><a class="app-menu__item   <?php if ($thisPage == "Forecasting") echo "active"; ?>" href="forecasting.php"><i class="app-menu__icon fa fa-dashboard"></i></i><span class="app-menu__label">Forecasting</span></a></li>
        <?php endif; ?>
        <li><a class="app-menu__item   <?php if ($thisPage == "Perencanaan Produksi") echo "active"; ?>" href="perencanaanProduksi.php"><i class="app-menu__icon fa fa-files-o"></i></i><span class="app-menu__label">Perencaaan Produksi</span></a></li>

    </ul>
</aside>
