<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User</li>
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
                <div class="col-13  ">
                    <button type="button" class="btn btn-default mb-3" data-toggle="modal" data-target="#modal-default">
                        <i class="fas fa-user-plus"></i> Tambah Data User
                    </button>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Informasi User</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Username</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Nomor Handphone</th>
                                        <th class="text-center">Password</th>
                                        <th class="text-center">Role</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($user as $key => $value) {
                                    ?>
                                        <tr>
                                            <td class="text-center"><?= $no++ ?></td>
                                            <td class="text-center"><?= $value->email ?></td>
                                            <td class="text-center"><?= $value->username?></td>
                                            <td class="text-center"><?= $value->name ?></td>
                                            <td class="text-center"><?= $value->nomor_hp ?></td>
                                            <td class="text-center"><?= md5($value->password) ?></td>

                                            <td class="text-center">
												<?php
													// Check the ENUM value directly and display the corresponding badge
													switch ($value->role) {
														case 'Admin':
															echo '<span class="badge badge-success">ADMIN</span>';
															break;
														case 'Super':
															echo '<span class="badge badge-warning">SUPER</span>';
															break;
														case 'User':
															echo '<span class="badge badge-danger">USER</span>';
															break;	
														default:
															echo '<span class="badge badge-secondary">Unknown</span>'; // For any unexpected value
															break;
													}
												?>
											</td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="<?= base_url('Admin/cKelolaData/deleteuser/' . $value->id_user) ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                                    <button type="button" data-toggle="modal" data-target="#edit<?= $value->id_user ?>" class="btn btn-warning"><i class="fas fa-edit"></i></button>
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
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Username</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Nomor Handphone</th>
                                        <th class="text-center">Password</th>
                                        <th class="text-center">Role</th>
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
        <form action="<?= base_url('admin/ckeloladata/createuser') ?>" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email" required>
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Username</label>
                        <input type="text" name="username" class="form-control" id="exampleInputEmail1" placeholder="username" required>
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Nama</label>
                        <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Nama anda" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">No Telepon</label>
                        <input type="text" name="nomor_hp" class="form-control" maxlength="13" minlength="11" id="exampleInputEmail1" placeholder="No Telepon" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputEmail1" placeholder="password" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Role</label>
						<select class="form-control" name="role" required>
						<option value="">--Pilih Role---</option>
						<option value="Admin">Admin</option>
						<option value="Super">Super</option>
						<option value="User">User</option>
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
foreach ($user as $key => $value) {
?>
    <div class="modal fade" id="edit<?= $value->id_user ?>">
        <div class="modal-dialog">
            <form action="<?= base_url('admin/ckeloladata/updateuser/' . $value->id_user) ?>" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Data User</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" name="email" value="<?= $value->email ?>" class="form-control" id="exampleInputEmail1" placeholder="email" required>
                        </div>
						<div class="form-group">
                            <label for="exampleInputEmail1">Username</label>
                            <input type="text" name="username" value="<?= $value->username ?>" class="form-control" id="exampleInputEmail1" placeholder="Nama User" required>
                        </div><div class="form-group">
                            <label for="exampleInputEmail1">Nama</label>
                            <input type="text" name="name" value="<?= $value->name ?>" class="form-control" id="exampleInputEmail1" placeholder="Nama User" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">No Telepon</label>
                            <input type="text" name="nomor_hp" value="<?= $value->nomor_hp ?>" class="form-control" maxlength="13" minlength="11" id="exampleInputEmail1" placeholder="No Telepon" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="password" name="password" value="<?= $value->password ?>" class="form-control" id="exampleInputEmail1" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Role</label>
                            <select class="form-control" name="role" required>
                                <option value="">--Pilih Role---</option>
                                <option value="1" <?php if ($value->role == 'Admin') {
                                                        echo 'selected';
                                                    } ?>>Admin</option>
                                <option value="2" <?php if ($value->role == 'Super') {
                                                        echo 'selected';
                                                    } ?>>Super</option>
								<option value="3" <?php if ($value->role == 'User') {
                                                        echo 'selected';
                                                    } ?>>User</option>
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
}
?>
