<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Transaksi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Transaksi</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible mt-3">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Alert!</h5>
                <?= $this->session->flashdata('success') ?>
            </div>
        <?php elseif ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible mt-3">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                <?= $this->session->flashdata('error') ?>
            </div>
        <?php endif; ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Informasi Transaksi</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Imei Tablet</th>
                                        <th class="text-center">NIP Pegawai</th>
                                        <th class="text-center">Nama Pegawai</th>
                                        <th class="text-center">Tanggal BAST</th>
                                        <th class="text-center">Transaksi</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Kondisi</th>
                                        <th class="text-center">Tanggal Pensiun</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    if (is_array($transaksi) || !empty($transaksi)) {
                                        foreach ($transaksi as $key => $value) {
                                            $formattedDate = $value['tanggal_bast'] ? date("d-m-Y", strtotime($value['tanggal_bast'])) : '-';
                                            $namaPegawai = isset($value['pegawai']['nama_pegawai']) ? $value['pegawai']['nama_pegawai'] : '-';
                                            $tmtPegawai = isset($value['pegawai']['tmt']) ? date("d-m-Y", strtotime($value['pegawai']['tmt'])) : '-';

                                    ?>
                                            <tr>
                                                <td class="text-center"><?= $no++ ?></td>
                                                <td class="text-center"><?= htmlspecialchars($value['imei_tab']) ?></td>
                                                <td class="text-center"><?= htmlspecialchars($value['nip_pegawai']) ?></td>
                                                <td class="text-center"><?= htmlspecialchars($namaPegawai) ?></td>
                                                <td class="text-center"><?= htmlspecialchars($formattedDate) ?></td>

                                                <td class="text-center">
                                                    <?php
                                                    if ($value['transaksi'] == 'PENERIMAAN') {
                                                        echo '<span class="badge badge-primary">PENERIMAAN</span>';
                                                    } elseif ($value['transaksi'] == 'PENGEMBALIAN') {
                                                        echo '<span class="badge badge-success">PENGEMBALIAN</span>';
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php
                                                    if ($value['status'] == 'LENGKAP') {
                                                        echo '<span class="badge badge-primary">LENGKAP</span>';
                                                    } elseif ($value['status'] == 'TIDAK_LENGKAP') {
                                                        echo '<span class="badge badge-success">TIDAK LENGKAP</span>';
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php
                                                    if ($value['kondisi'] == 'BERFUNGSI') {
                                                        echo '<span class="badge badge-primary">BERFUNGSI</span>';
                                                    } elseif ($value['kondisi'] == 'TIDAK_BERFUNGSI') {
                                                        echo '<span class="badge badge-success">TIDAK BERFUNGSI</span>';
                                                    }
                                                    ?>
                                                </td>

                                                <td class="text-center"><?= htmlspecialchars($tmtPegawai) ?></td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo '<tr><td colspan="8" class="text-center">Data Tidak Ditemukan</td></tr>';
                                    }
                                    ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Imei Tablet</th>
                                        <th class="text-center">NIP Pegawai</th>
                                        <th class="text-center">Nama Pegawai</th>
                                        <th class="text-center">Tanggal BAST</th>
                                        <th class="text-center">Transaksi</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Kondisi</th>
                                        <th class="text-center">Tanggal Pensiun</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<?php
foreach ($transaksi as $key => $value) {
?>
    <div class="modal fade" id="edit<?= $value['id_transaksi'] ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="<?= base_url('user/ckeloladata/updatetransaksi/' . $value['id_transaksi']) ?>" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Data Transaksi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">IMEI Device</label>
                            <input type="text" name="imei_tab" value="<?= $value['imei_tab'] ?>" class="form-control" id="exampleInputEmail1" placeholder="IMEI Device" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">NIP Pegawai</label>
                            <input type="text" name="nip_pegawai" value="<?= $value['nip_pegawai'] ?>" class="form-control" id="exampleInputEmail1" placeholder="NIP Pegawai" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tanggal BAST</label>
                            <input type="date" name="tanggal_bast" value="<?= isset($value['tanggal_bast']) ? date('Y-m-d', strtotime($value['tanggal_bast'])) : '' ?>" class="form-control" id="exampleInputEmail1" placeholder="Tanggal BAST" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Transaksi</label>
                            <select class="form-control" name="transaksi" required>
                                <option value="">--Pilih Role---</option>
                                <option value="PENERIMAAN" <?php if ($value['transaksi'] == 'PENERIMAAN') {
                                                                echo 'selected';
                                                            } ?>>PENERIMAAN</option>
                                <option value="PENGEMBALIAN" <?php if ($value['transaksi'] == 'PENGEMBALIAN') {
                                                                    echo 'selected';
                                                                } ?>>PENGEMBALIAN</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Status</label>
                            <select class="form-control" name="status" required>
                                <option value="">--Pilih Status---</option>
                                <option value="LENGKAP" <?php if ($value['status'] == 'LENGKAP') {
                                                            echo 'selected';
                                                        } ?>>LENGKAP</option>
                                <option value="TIDAK_LENGKAP" <?php if ($value['status'] == 'TIDAK_LENGKAP') {
                                                                    echo 'selected';
                                                                } ?>>TIDAK LENGKAP</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kondisi</label>
                            <select class="form-control" name="kondisi" required>
                                <option value="">--Pilih Kondisi---</option>
                                <option value="BERFUNGSI" <?php if ($value['kondisi'] == 'BERFUNGSI') {
                                                                echo 'selected';
                                                            } ?>>BERFUNGSI</option>
                                <option value="TIDAK_BERFUNGSI" <?php if ($value['kondisi'] == 'TIDAK_BERFUNGSI') {
                                                                    echo 'selected';
                                                                } ?>>TIDAK BERFUNGSI</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php
}
?>