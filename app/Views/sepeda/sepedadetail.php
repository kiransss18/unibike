<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?php echo $title ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo site_url('bikes') ?>">List Sepeda</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $title ?></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-1">
            </div>
            <div class="col-md-10">

                <div class="card">
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-5 align-self-center">
                                    <div class="container-fluid">
                                        <div class="text-center">
                                            <img src="data:image/jpeg;base64,<?php echo base64_encode($bike['foto']); ?>"
                                                alt="Bike Image" class="img-fluid" width="320">
                                        </div>
                                        <br>
                                        <p class="text-center">
                                            status :
                                            <?php if ($bike['status'] == 1) {
                                                echo '<span class="text-success">Tersedia</span>';
                                            } elseif ($bike['status'] == 2) {
                                                echo '<span class="text-muted">Dipinjam</span>';
                                            } elseif ($bike['status'] == 3) {
                                                echo '<span class="text-danger">Tidak Tersedia</span>';
                                            }
                                            ?>
                                        </p>
                                        <p class="text-center">
                                            baterai :
                                            <?php $baterai = $bike['baterai'];
                                            if ($baterai <= 30) {
                                                echo '<span class="text-danger"> ' . $baterai . '%</span>'; // red battery
                                            } elseif ($baterai <= 70) {
                                                echo '<span class="text-warning"> ' . $baterai . '%</span>'; // yellow battery
                                            } else {
                                                echo '<span class="text-success"> ' . $baterai . '%</span>'; // green battery
                                            }
                                            ?>
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-7">
                                    <h3 class="text-primary">
                                        <span class="font-weight-bold">
                                            <?= $bike['id_bikes'] ?>
                                        </span>
                                        |
                                        <span>
                                            <?= $bike['seri'] ?>
                                        </span>
                                        <a href="<?= site_url('bike/edit/' . $bike['id_bikes']) ?>"
                                            class=" fa fa-pencil-alt"></a>
                                    </h3>
                                    <br>

                                    <div class="form-group">
                                        <label>Tahun</label>
                                        <p class="rounded border p-2">
                                            <?= $bike['tahun'] ?>
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label>Jumlah Peminjaman</label>
                                        <p class="rounded border p-2">
                                            <?= $bike['rents_bikes'] ?>
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label>Total Waktu Pemakaian</label>
                                        <p class="rounded border p-2">
                                            <?= $bike['total_bike_times'] ?>
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label>Lokasi Shelter</label>
                                        <p class="rounded border p-2">
                                            <?php if ($bike['status'] == 1) {
                                                echo '<span>Shelter A</span>';
                                            } elseif ($bike['status'] == 2) {
                                                echo '<span>Shelter B</span>';
                                            } elseif ($bike['status'] == 3) {
                                                echo '<span>Shelter C</span>';
                                            } elseif ($bike['status'] == 4) {
                                                echo '<span>Shelter D</span>';
                                            } elseif ($bike['status'] == 5) {
                                                echo '<span>Shelter E</span>';
                                            }
                                            ?>
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label>Deskripsi</label>
                                        <p class="rounded border p-2">
                                            <?= $bike['deskripsi'] ?>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-1">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
</section>