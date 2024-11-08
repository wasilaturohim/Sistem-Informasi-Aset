<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-blue-warning elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?= base_url('asset/AdminLTE/') ?>dist/img/logo_pustek.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-LIGHT">PUSTEKINFO</span>
    </a>

    <?php
    // Inisialisasi cURL
    $ch = curl_init();
    $apiUrl = $this->config->item('api_url') . '/user/me';

    // Endpoint API untuk mendapatkan data user
    curl_setopt($ch, CURLOPT_URL, ($apiUrl)); // Ganti dengan URL API sebenarnya
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $_SESSION['token'] // Sesuaikan cara menyimpan token
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    // Decode JSON response
    $user = json_decode($response, true);

    // Ambil nilai username
    $username = isset($user['username']) ? $user['username'] : 'Guest';
    ?>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Selamat Datang, <br><?php echo htmlspecialchars($username); ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="<?= base_url('Super/cDashboard') ?>" class="nav-link   <?php if ($this->uri->segment(1) == 'Super' && $this->uri->segment(2) == 'cDashboard') {
                                                                                        echo 'active';
                                                                                    }  ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item has-treeview <?php if ($this->uri->segment(1) == 'Super' && $this->uri->segment(2) == 'cKelolaData') {
                                                        echo 'menu-open';
                                                    }  ?>">
                    <a href="<?= base_url('Super/cKelolaData') ?>" class="nav-link  <?php if ($this->uri->segment(1) == 'Super' && $this->uri->segment(2) == 'cKelolaData') {
                                                                                        echo 'active';
                                                                                    }  ?>">
                        <i class="nav-icon fas fa-archive"></i>
                        <p>
                            Data Master
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('Super/cKelolaData/tablet') ?>" class="nav-link <?php if ($this->uri->segment(1) == 'Super' && $this->uri->segment(2) == 'cKelolaData' && $this->uri->segment(3) == 'tablet') {
                                                                                                        echo 'active';
                                                                                                    }  ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Device</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('Super/cKelolaData/pegawai') ?>" class="nav-link <?php if ($this->uri->segment(1) == 'Super' && $this->uri->segment(2) == 'cKelolaData' && $this->uri->segment(3) == 'pegawai') {
                                                                                                        echo 'active';
                                                                                                    }  ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pegawai</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('Super/cKelolaData/user') ?>" class="nav-link <?php if ($this->uri->segment(1) == 'Super' && $this->uri->segment(2) == 'cKelolaData' && $this->uri->segment(3) == 'user') {
                                                                                                    echo 'active';
                                                                                                }  ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('Super/cKelolaData/transaksi') ?>" class="nav-link   <?php if ($this->uri->segment(1) == 'Super' && $this->uri->segment(2) == 'cKelolaData' && $this->uri->segment(3) == 'transaksi') {
                                                                                                    echo 'active';
                                                                                                }  ?>">
                        <i class="nav-icon fas fa-clipboard-check"></i>
                        <p>Transaksi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('cAuth/logout') ?>" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>SignOut</p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>