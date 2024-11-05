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
        <?php if ($this->session->userdata('success')) {
        ?>
            <div class="alert alert-success alert-dismissible mt-3">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Alert!</h5>
                <?= $this->session->userdata('success') ?>
            </div>
        <?php
        } ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
				<button type="button" class="btn btn-default mb-3" data-toggle="modal" data-target="#modal-default">
                        <i class="fas fa-list"></i> Tambah Data Transaksi
                    </button>
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
                                        <th class="text-center">Nip Pegawai</th>
                                        <th class="text-center">Tanggal BAST</th>
                                        <th class="text-center">Transaksi</th>
										<th class="text-center">Status</th>
										<th class="text-center">Kondisi</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($transaksi as $key => $value) {
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $value->imei_tab ?></td>
                                            <td><?= $value->nip_pegawai ?></td>
                                            <td><?= $value->tanggal_bast ?></td>
											<td>
												<?php
													switch ($value->transaksi) {
														case 'Penerimaan':
															echo '<span class="badge badge-success">PENERIMAAN</span>';
															break;
														case 'Pengembalian':
															echo '<span class="badge badge-warning">PENGEMBALIAN</span>';
															break;	
														default:
															echo '<span class="badge badge-secondary">Unknown</span>'; // For any unexpected value
															break;
													}
												?>
											</td>
											<td>
												<?php
													switch ($value->status) {
														case 'Lengkap':
															echo '<span class="badge badge-success">LENGKAP</span>';
															break;
														case 'Tidak Lengkap':
															echo '<span class="badge badge-warning">TIDAK LENGKAP</span>';
															break;	
														default:
															echo '<span class="badge badge-secondary">Unknown</span>'; // For any unexpected value
															break;
													}
												?>
											</td>
											<td>
												<?php
													switch ($value->kondisi) {
														case 'Berfungsi':
															echo '<span class="badge badge-success">BERFUNGSI</span>';
															break;
														case 'Tidak Berfungsi':
															echo '<span class="badge badge-warning">TIDAK BERFUNGSI</span>';
															break;	
														default:
															echo '<span class="badge badge-secondary">Unknown</span>'; // For any unexpected value
															break;
													}
												?>
											</td>
											<td class="text-center">
                                                <div class="btn-group">
                                                    <a href="<?= base_url('Admin/cKelolaData/deletetransaksi/' . $value->id_transaksi) ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                                    <button type="button" data-toggle="modal" data-target="#edit<?= $value->id_transaksi ?>" class="btn btn-warning"><i class="fas fa-edit"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>

                                </tbody>
                                <tfoot>
                                    <tr>
									<th class="text-center">No</th>
                                        <th class="text-center">Imei Tablet</th>
                                        <th class="text-center">Nip Pegawai</th>
                                        <th class="text-center">Tanggal BAST</th>
                                        <th class="text-center">Transaksi</th>
										<th class="text-center">Status</th>
										<th class="text-center">Kondisi</th>
                                        <th class="text-center">Action</th>
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
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <form action="<?= base_url('admin/ckeloladata/createtransaksi') ?>" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Transaksi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="imei_tab">IMEI Tablet</label>
                        <input type="text" name="imei_tab" value="<?= isset($t->imei_tab) ? $t->imei_tab : '' ?>" class="form-control" id="imei_tab" placeholder="IMEI Tab" required>
                    </div>
                    <div class="form-group">
                        <label for="imei_tab">NIP Pegawai</label>
                        <input type="text" name="nip_pegawai" value="<?= isset($t->nip_pegawai) ? $t->nip_pegawai : '' ?>" class="form-control" id="nip_pegawai" placeholder="NIP Pegawai" required>
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Tanggal BAST</label>
                        <input type="date" name="tanggal_bast" class="form-control" id="exampleInputEmail1" placeholder="Nama" required>
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Transaksi</label>
						<select class="form-control" name="transaksi" required>
						<option value="">--Pilih Transaksi---</option>
						<option value="Penerimaan">PENERIMAAN</option>
						<option value="Pengembalian">PENGEMBALIAN</option>
					</select>
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Status</label>
						<select class="form-control" name="status" required>
						<option value="">--Pilih Status---</option>
						<option value="Lengkap">LENGKAP</option>
						<option value="Tidak Lengkap">TIDAK LENGKAP</option>
					</select>
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Kondisi</label>
						<select class="form-control" name="kondisi" required>
						<option value="">--Pilih Kondisi---</option>
						<option value="Berfungsi">BERFUNGSI</option>
						<option value="Tidak Berfungsi">TIDAK BERFUNGSI</option>
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
<!-- /.modal -->
<?php
foreach ($transaksi as $key => $value) {
?>
    <div class="modal fade" id="edit<?= $value->id_transaksi ?>" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
            <form action="<?= base_url('admin/ckeloladata/updatetransaksi/' . $value->id_transaksi) ?>" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Data Transaksi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
					<div class="form-group">
    <label for="imei_tab">Imei Tablet</label>
    <select name="imei_tab" class="form-control" required>
        <option value="">--Pilih Imei Tablet--</option>
        <?php foreach ($tablet as $tab) : ?>
            <option value="<?= $tab->imei_tab ?>" <?= $tab->imei_tab == $value->imei_tab ? 'selected' : '' ?>>
                <?= $tab->imei_tab ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

<div class="form-group">
    <label for="nip_pegawai">Nip Pegawai</label>
    <select name="nip_pegawai" class="form-control" required>
        <option value="">--Pilih Nip Pegawai--</option>
        <?php foreach ($pegawai as $pgw) : ?>
            <option value="<?= $pgw->nip_pegawai ?>" <?= $pgw->nip_pegawai == $value->nip_pegawai ? 'selected' : '' ?>>
                <?= $pgw->nip_pegawai ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

						<div class="form-group">
                            <label for="exampleInputEmail1">Tanggal BAST</label>
                            <input type="date" name="tanggal_bast" value="<?= $value->tanggal_bast ?>" class="form-control" id="exampleInputEmail1" placeholder="Tanggal BAST" required>
                        </div>
						<div class="form-group">
                            <label for="exampleInputEmail1">Transaksi</label>
                            <select class="form-control" name="transaksi" required>
                                <option value="">--Pilih Role---</option>
                                <option value="1" <?php if ($value->transaksi == 'Penerimaan') {
                                                        echo 'selected';
                                                    } ?>>PENERIMAAN</option>
                                <option value="2" <?php if ($value->transaksi == 'Pengembalian') {
                                                        echo 'selected';
                                                    } ?>>PENGEMBALIAN</option>
                            </select>
                        </div>
						<div class="form-group">
                            <label for="exampleInputEmail1">Status</label>
                            <select class="form-control" name="status" required>
                                <option value="">--Pilih Status---</option>
                                <option value="1" <?php if ($value->status == 'Lengkap') {
                                                        echo 'selected';
                                                    } ?>>LENGKAP</option>
                                <option value="2" <?php if ($value->status == 'Tidak Lengkap') {
                                                        echo 'selected';
                                                    } ?>>TIDAK LENGKAP</option>
                            </select>
                        </div>
						<div class="form-group">
                            <label for="exampleInputEmail1">Kondisi</label>
                            <select class="form-control" name="kondisi" required>
                                <option value="">--Pilih Kondisi---</option>
                                <option value="1" <?php if ($value->kondisi == 'Berfungsi') {
                                                        echo 'selected';
                                                    } ?>>BERFUNGSI</option>
                                <option value="2" <?php if ($value->kondisi == 'Tidak Berfungsi') {
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
