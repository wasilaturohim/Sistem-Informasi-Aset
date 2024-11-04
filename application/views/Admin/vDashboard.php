<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMq+0Z2BOPsSOazC3Pa3cxD5U5bxDIkmNBt3s" crossorigin="anonymous">
    <!-- Tambahkan stylesheet lain di sini -->
</head>

<body>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark-bold">Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="cDashboard.php">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Info boxes -->
                <div class="row">
                    <!-- Info box 1 -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-hand-holding"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Tab Diterima</span>
                                <span class="info-box-number"><?= $transaksi['transaksi']['PENERIMAAN'] ?></span>
                            </div>
                        </div>
                    </div>
                    <!-- Info box 2 -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-reply"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Tab Dikembalikan</span>
                                <span class="info-box-number"><?= $transaksi['transaksi']['PENGEMBALIAN'] ?></span>
                            </div>
                        </div>
                    </div>
                    <!-- Info box 3 -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-thumbs-up"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Tab Lengkap</span>
                                <span class="info-box-number"><?= $transaksi['status']['LENGKAP'] ?></span>
                            </div>
                        </div>
                    </div>
                    <!-- Info box 4 -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-exclamation-triangle"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Tab Tidak Lengkap</span>
                                <span class="info-box-number"><?= $transaksi['status']['TIDAK_LENGKAP'] ?></span>
                            </div>
                        </div>
                    </div>
                    <!-- Info box 5 -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box">
                            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-check-circle"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Tab Berfungsi</span>
                                <span class="info-box-number"><?= $transaksi['kondisi']['BERFUNGSI'] ?></span>
                            </div>
                        </div>
                    </div>
                    <!-- Info box 6 -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box">
                            <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-times-circle"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Tab Tidak Berfungsi</span>
                                <span class="info-box-number"><?= $transaksi['kondisi']['TIDAK_BERFUNGSI'] ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Main row -->
                <div class="row">
                    <div class="col-md-8">
                        <!-- MAP & BOX PANE -->
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
</body>

</html>