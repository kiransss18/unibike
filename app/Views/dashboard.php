<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?php echo $title ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $title ?></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box" style="background-color: #0b1a51; color:white">
                    <div class="text-center">
                        <a class="small-box-header" style="font-size:x-large; font-weight:bold; color: white">Data
                            Pengguna
                        </a>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 p-2 ml-3">
                            <h3><?= $totalUsers; ?></h3>

                            <p>Mahasiswa Terdaftar</p>
                        </div>
                        <div class="col-sm-5 p-2 mr-1" style="text-align: right;">
                            <i class="ion" style="color: white;">
                                <ion-icon name="people" style="font-size: 6em;"></ion-icon>
                            </i>
                        </div>
                    </div>
                    <a href=" <?php echo base_url('user') ?>" class="small-box-footer">Lihat Detail <i
                            class="fas fa-arrow-circle-right">
                        </i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box" style="background-color: #39b8f3; color:white">
                    <div class="text-center">
                        <a class="small-box-header" style="font-size:x-large; font-weight:bold; color: white">Data
                            Sepeda
                        </a>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 p-2 ml-3">
                            <h3><?= $totalBikes; ?></h3>

                            <p>Total Sepeda</p>
                        </div>
                        <div class="col-sm-5 p-2 mr-1" style="text-align: right;">
                            <i class="ion" style="color: white;">
                                <ion-icon name="bicycle" style="font-size: 6em;"></ion-icon>
                            </i>
                        </div>
                    </div>
                    <a href="<?php echo base_url('bikes') ?>" class="small-box-footer">Lihat Detail <i
                            class="fas fa-arrow-circle-right">
                        </i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-6 col-12">
                <!-- small box -->
                <div class="small-box" style="background-color: #f59a11; color:black">
                    <div class="text-center">
                        <a class="small-box-header" style="font-size:x-large; font-weight:bold; color: black">Data
                            Peminjaman
                        </a>
                    </div>
                    <div class="pt-1">
                        <div class="row justify-content-center p-2">
                            <div class="col sm-1 text-center">
                                <h3><?= $totalRents->total_pinjam; ?></h3>

                                <p>Total Sepeda Keluar</p>
                            </div>
                            <div class="col sm-3 text-center">
                                <div class="mt-2 mb-1">
                                    <ion-icon name="swap-vertical" style="font-size: 5em; stroke-width: 2;"></ion-icon>
                                </div>
                            </div>
                            <div class=" col sm-1 text-center">
                                <h3><?= $totalRents->total_kembali; ?></h3>

                                <p>Total Sepeda Kembali</p>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo base_url('rents') ?>" class="small-box-footer">Lihat Detail <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        <div class="row">
            <container class="col-lg-7">
                <div class="card card bg-light p-1">
                    <div class="card-header">
                        <h3 class="card-title" style="font-weight: bold;">
                            Peminjaman
                        </h3>
                        <div class="card-tools">
                            <div class="row">
                                <select name="tahun" id="tahunPilih" onchange="changeTahun()"
                                    class="form-select float-end mr-3 year-options" style="width:100px">
                                    <option value="2023">2023</option>
                                    <option value="2024" selected>2024</option>
                                    <option value="2025">2025</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="chart" id="rents-chart" style="position: relative; height: 100%;">
                                <canvas id="rents-chart-canvas" height="180"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </container>

            <container class="col-lg-5">
                <div class="card card bg-light p-1">
                    <div class="card-header">
                        <h4 class="text-center" style="font-weight: bold;">
                            Pengguna
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid mb-5">
                            <div class="chart" id="user-chart" style="position: relative; height: 100%;">
                                <canvas id="user-chart-canvas" height="224"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </container>
            <script>
                const usersData = <?= json_encode($usersData, JSON_PRETTY_PRINT) ?>;
                const rentsData = <?= json_encode($rentsData, JSON_PRETTY_PRINT) ?>;
            </script>

        </div>
        <div class="row">
            <container class="col-lg-12">
                <div class="card card bg-light p-3">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="container-fluid" style="height: 480px; overflow-y: auto; ">
                                    <table class="table">
                                        <thead style="position: sticky; top:0; background-color:#f8f9fa">
                                            <tr class="text-center">
                                                <th class="align-middle col-sm-1">Shelter</th>
                                                <th class="align-middle col-sm-1">Total Sepeda Tersedia</th>
                                                <th class="align-middle col-sm-1">Persentase Pemakaian</th>
                                            </tr>
                                        </thead>

                                        <?php foreach ($shelters as $shelter) { ?>
                                            <tr>
                                                <td class="align-middle text-center">
                                                    <?= $shelter['nama_shelter'] ?>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <?= $shelter['total_sepeda'] ?>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <?= $shelter['pinjam_persen'] ?>
                                                </td>

                                            </tr>
                                        <?php } ?>
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="fluid-map m-3">
                                    <div id="map"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </container>
        </div>
    </div>
</section>