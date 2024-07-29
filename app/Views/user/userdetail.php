<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?php echo $title ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo site_url('user') ?>">List Pengguna</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $title ?></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">

                <div class="card">
                    <div class="card-body">

                        <div class="text-center">
                            <h2>Detail Pengguna</h2>
                            <hr>
                            <img class="profile-user-img img-fluid img-circle"
                                src="data:image/jpeg;base64,<?= base64_encode($user['students_img']) ?>"
                                alt="Foto Pengguna" width="100px">
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-md-2">
                            </div>

                            <div class="col-md-8">
                                <div class="data-container">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <p class="rounded border p-2">
                                            <?= $user['nama'] ?>
                                        </p>
                                    </div>

                                    <div class="form-group">
                                        <label>Email</label>
                                        <p class="rounded border p-2">
                                            <?= $user['email'] ?>
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label>NPM</label>
                                        <p class="rounded border p-2">
                                            <?= $user['npm'] ?>
                                        </p>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Jurusan</label>
                                                <p class="rounded border p-2">
                                                    <?= $user['jurusan'] ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Angkatan</label>
                                                <p class="rounded border p-2">
                                                    <?= $user['angkatan'] ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Fakultas</label>
                                        <p class="rounded border p-2">
                                            <?= $user['fakultas'] ?>
                                        </p>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Jumlah Peminjaman</label>
                                                <p class="rounded border p-2">
                                                    <?= $user['rents_users'] ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Total Waktu Peminjaman</label>
                                                <p class="rounded border p-2">
                                                    <?= $user['total_rent_time'] ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    </class>
                                    </di>
                                </div>

                                <div class="col-md-2">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>