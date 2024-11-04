<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Tablet</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Tablet</li>
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
                <div class="col-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Informasi Data Tablet</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Imei</th>
                                        <th class="text-center">Nama Tablet/Device</th>
										<th class="text-center">No BMN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    if (is_array($tablet) && !empty($tablet)) {
                                    foreach ($tablet as $key => $value) {
                                    ?>
                                        <tr>
                                            <td class="text-center"><?= $no++ ?></td>
                                            <td class="text-center"><?= htmlspecialchars($value['imei_tab']) ?></td>
                                            <td class="text-center"><?= htmlspecialchars($value['device']) ?></td>
                                            <td class="text-center"><?= htmlspecialchars($value['no_bmn']) ?></td>                                            
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    echo '<tr><td colspan="7" class="text-center">Data Tidak Ditemukan</td></tr>';
                                }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Imei</th>
                                        <th class="text-center">Nama Tablet/Device</th>
										<th class="text-center">No BMN</th>
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
        <form action="<?= base_url('admin/ckeloladata/createtablet') ?>" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Tablet</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Imei</label>
                        <input type="number" name="imei_tab" class="form-control" id="exampleInputEmail1" placeholder="Imei" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Tablet</label>
                        <input type="text" name="device" class="form-control" id="exampleInputEmail1" placeholder="Nama" required>
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">No BMN</label>
                        <input type="number" name="no_bmn" class="form-control" id="exampleInputEmail1" placeholder="Nama" required>
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
foreach ($tablet as $key => $value) {
?>
    <div class="modal fade" id="edit<?= $value->imei_tab?>">
        <div class="modal-dialog">
            <form action="<?= base_url('admin/ckeloladata/updatetablet/' . $value->imei_tab) ?>" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Data Tablet</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Imei </label>
                            <input type="number" name="imei_tab" value="<?= $value->imei_tab ?>" class="form-control" id="exampleInputEmail1" placeholder="Imei" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Tablet</label>
                            <input type="text" name="device" value="<?= $value->device ?>" class="form-control" id="exampleInputEmail1" placeholder="Nama device" required>
                        </div>
						<div class="form-group">
                            <label for="exampleInputEmail1">No BMN</label>
                            <input type="number" name="no_bmn" value="<?= $value->no_bmn ?>" class="form-control" id="exampleInputEmail1" placeholder="No BMN" required>
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
