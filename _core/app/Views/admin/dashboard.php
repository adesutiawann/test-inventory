<?= $this->extend('admin/template') ?>

<?= $this->section('css') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1 class="app-page-title">Dashboard</h1>

<div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
    <div class="inner">
        <div class="app-card-body p-3 p-lg-4">
            <h3 class="mb-3">Welcome, <?= $admin->nama ?>!</h3>
            <div class="row gx-5 gy-3">
                <div class="col-12">

                    <div>Selamat datang di aplikasi aset inventory, anda bisa mengelola data aset komputer dan lain sebagainya.</div>
                </div>
            </div>
            <!--//row-->
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <!--//app-card-body-->

    </div>
    <!--//inner-->
</div>
<!--//app-card-->

<div class="row g-4 mb-4">
    <div class="col-12 col-lg-2">
        <div class="app-card app-card-basic d-flex flex-column align-items-start shadow-sm">
            <div class="app-card-header p-3 border-bottom-0">
                <div class="row align-items-center gx-3">
                    <div class="col-auto">
                        <div class="app-icon-holder">
                            <i class="fa-solid fa-desktop"></i>
                        </div><!--//icon-holder-->

                    </div><!--//col monitor-->
                    <div class="col-auto">
                        <h4 class="app-card-title"><?= $total_mo ?></h4>.Unit
                    </div><!--//col-->
                </div><!--//row-->
            </div><!--//app-card-header-->


        </div><!--//app-card-->
    </div><!--//col-->
    <div class="col-12 col-lg-2">
        <div class="app-card app-card-basic d-flex flex-column align-items-start shadow-sm">
            <div class="app-card-header p-3 border-bottom-0">
                <div class="row align-items-center gx-3">
                    <div class="col-auto">
                        <div class="app-icon-holder">
                            <i class="fa-solid fa-server"></i>
                        </div><!--//icon-holder-->

                    </div><!--//col pc-->
                    <div class="col-auto">
                        <h4 class="app-card-title"><?= $total_pc ?></h4>.Unit
                    </div><!--//col-->
                </div><!--//row-->
            </div><!--//app-card-header-->


        </div><!--//app-card-->
    </div><!--//col-->
    <div class="col-12 col-lg-2">
        <div class="app-card app-card-basic d-flex flex-column align-items-start shadow-sm">
            <div class="app-card-header p-3 border-bottom-0">
                <div class="row align-items-center gx-3">
                    <div class="col-auto">
                        <div class="app-icon-holder">
                            <i class="fa-solid fa-laptop"></i>
                        </div><!--//icon-holder-->

                    </div><!--//col-->
                    <div class="col-auto">
                        <h4 class="app-card-title"><?= $total_l ?></h4>.Unit
                    </div><!--//col-->
                </div><!--//row-->
            </div><!--//app-card-header-->


        </div><!--//app-card-->
    </div><!--//col-->
    <div class="col-12 col-lg-2">
        <div class="app-card app-card-basic d-flex flex-column align-items-start shadow-sm">
            <div class="app-card-header p-3 border-bottom-0">
                <div class="row align-items-center gx-3">
                    <div class="col-auto">
                        <div class="app-icon-holder">
                            <i class="fa-solid fa-print"></i>
                        </div><!--//icon-holder prnint-->

                    </div><!--//col-->
                    <div class="col-auto">
                        <h4 class="app-card-title"><?= $total_p ?></h4>.Unit
                    </div><!--//col-->
                </div><!--//row-->
            </div><!--//app-card-header-->


        </div><!--//app-card-->
    </div><!--//col-->
    <div class="col-12 col-lg-2">
        <div class="app-card app-card-basic d-flex flex-column align-items-start shadow-sm">
            <div class="app-card-header p-3 border-bottom-0">
                <div class="row align-items-center gx-3">
                    <div class="col-auto">
                        <div class="app-icon-holder">
                            <i class="fa-solid fa-keyboard"></i>
                        </div><!--//icon-holder keyboard-->

                    </div><!--//col KEYBOARD-->
                    <div class="col-auto">
                        <h4 class="app-card-title"><?= $total_k ?></h4>.Unit
                    </div><!--//col-->
                </div><!--//row-->
            </div><!--//app-card-header-->


        </div><!--//app-card-->
    </div><!--//col-->
    <div class="col-12 col-lg-2">
        <div class="app-card app-card-basic d-flex flex-column align-items-start shadow-sm">
            <div class="app-card-header p-3 border-bottom-0">
                <div class="row align-items-center gx-3">
                    <div class="col-auto">
                        <div class="app-icon-holder">
                            <i class="fa-solid fa-computer-mouse"></i>
                        </div><!--//icon-holder mouse-->

                    </div><!--//col MOUSE -->
                    <div class="col-auto">
                        <h4 class="app-card-title"><?= $total_m ?></h4>.Unit
                    </div><!--//col-->
                </div><!--//row-->
            </div><!--//app-card-header-->


        </div><!--//app-card-->
    </div><!--//col-->
</div>
<!--//row-->
<div class="row g-4 mb-4">


    <div class="col-12 col-lg-6">

        <div class="app-card app-card-stats-table h-100 shadow-sm">
            <div class="app-card-header p-3">

                <div class="app-card-header p-1 border-bottom-0">
                    <div class="row align-items-center gx-3">
                        <div class="col-auto">
                            <div class="app-icon-holder">
                                <i class="fa-solid fa-server"></i>
                            </div><!--//icon-holder-->

                        </div><!--//col-->
                        <div class="col-auto">
                            <h4 class="app-card-title">Personal Computer</h4>
                        </div><!--//col-->
                    </div><!--//row-->

                </div>

            </div><!--//app-card-header-->

            <div class="app-card-body p-3 p-lg-4">
                <div class="table-responsive">
                    <table class="table table-borderless mb-0">
                        <thead>
                            <tr>
                                <th class="meta">Kondisi</th>
                                <th class="meta w-100">Progressbar</th>
                                <th class="meta stat-cell">Persentasi</th>
                                <th class="meta stat-cell">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-success">
                                <td><b>Redy</b>

                                </td>
                                <td>

                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: <?= $pc_ok = ($total_pc_ok / $total_pc) * 100 ?>%;" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"></div>

                                    </div>

                                </td>
                                <td class="stat-cell"> <?= number_format($pc_ok) ?>% </td>
                                <td class="stat-cell"><?= $total_pc_ok ?></td>
                            </tr>

                            <tr class="text-warning">
                                <td><b>Risk</b>

                                </td>
                                <td>

                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width:  <?= $pc_r = ($total_pc_rusak / $total_pc) * 100 ?>%;" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"></div>

                                    </div>

                                </td>
                                <td class="stat-cell"> <?= number_format($pc_r) ?>% </td>
                                <td class="stat-cell"><?= $total_pc_rusak ?></td>
                            </tr>

                            <tr class="text-danger">
                                <td><b>Blanks</b>

                                </td>
                                <td>

                                    <div class="progress">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: <?= $p = ($total_pc_blanks / $total_pc) * 100 ?>%;" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"></div>

                                    </div>

                                </td>
                                <td class="stat-cell"><?= number_format($p) ?>%</td>
                                <td class="stat-cell"><?= $total_pc_blanks ?> </td>
                            </tr>
                            <tr>
                                <th colspan="3" class="meta text-end">Total :</th>
                                <th colspan="2" class="meta stat-cell text-and"><?= $total_pc ?> </th>
                            </tr>
                        </tbody>
                    </table>
                </div><!--//table-responsive-->
            </div><!--//app-card-body-->
        </div><!--//app-card-->
    </div><!--// KALKULASI PC-->

    <div class="col-12 col-lg-6">

        <div class="app-card app-card-stats-table h-100 shadow-sm">
            <div class="app-card-header p-3">

                <div class="app-card-header p-1 border-bottom-0">
                    <div class="row align-items-center gx-3">
                        <div class="col-auto">
                            <div class="app-icon-holder">
                                <i class="fa-solid fa-desktop"></i>
                            </div><!--//icon-holder-->

                        </div><!--//col-->
                        <div class="col-auto">
                            <h4 class="app-card-title">Monitor</h4>
                        </div><!--//col-->
                    </div><!--//row-->

                </div>

            </div><!--//app-card-header-->

            <div class="app-card-body p-3 p-lg-4">
                <div class="table-responsive">
                    <table class="table table-borderless mb-0">
                        <thead>
                            <tr>
                                <th class="meta">Kondisi</th>
                                <th class="meta w-100">Progressbar</th>
                                <th class="meta stat-cell">Persentasi</th>
                                <th class="meta stat-cell">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-success">
                                <td><b>Redy</b>

                                </td>
                                <td>

                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: <?= $mo_ok = ($total_mo_ok / $total_mo) * 100 ?>%;" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"></div>

                                    </div>

                                </td>
                                <td class="stat-cell"> <?= number_format($mo_ok) ?>% </td>
                                <td class="stat-cell"><?= $total_mo_ok ?></td>
                            </tr>

                            <tr class="text-warning">
                                <td><b>Risk</b>

                                </td>
                                <td>

                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width:  <?= $mo_r = ($total_mo_rusak / $total_mo) * 100 ?>%;" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"></div>

                                    </div>

                                </td>
                                <td class="stat-cell"> <?= number_format($mo_r) ?>% </td>
                                <td class="stat-cell"><?= $total_mo_rusak ?></td>
                            </tr>

                            <tr class="text-danger">
                                <td><b>Blanks</b>

                                </td>
                                <td>

                                    <div class="progress">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: <?= $p = ($total_mo_blanks / $total_mo) * 100 ?>%;" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"></div>

                                    </div>

                                </td>
                                <td class="stat-cell"><?= number_format($p) ?>%</td>
                                <td class="stat-cell"><?= $total_mo_blanks ?> </td>
                            </tr>
                            <tr>
                                <th colspan="3" class="meta text-end">Total :</th>
                                <th colspan="2" class="meta stat-cell text-and"><?= $total_mo ?> </th>
                            </tr>
                        </tbody>
                    </table>
                </div><!--//table-responsive-->
            </div><!--//app-card-body-->
        </div><!--//app-card-->
    </div><!--//KALKULASI MONITOR-->

    <div class="col-12 col-lg-6">

        <div class="app-card app-card-stats-table h-100 shadow-sm">
            <div class="app-card-header p-3">

                <div class="app-card-header p-1 border-bottom-0">
                    <div class="row align-items-center gx-3">
                        <div class="col-auto">
                            <div class="app-icon-holder">
                                <i class="fa-solid fa-keyboard"></i>
                            </div><!--//icon-holder-->

                        </div><!--//col-->
                        <div class="col-auto">
                            <h4 class="app-card-title">Keyboard</h4>
                        </div><!--//col-->
                    </div><!--//row-->

                </div>

            </div><!--//app-card-header-->

            <div class="app-card-body p-3 p-lg-4">
                <div class="table-responsive">
                    <table class="table table-borderless mb-0">
                        <thead>
                            <tr>
                                <th class="meta">Kondisi</th>
                                <th class="meta w-100">Progressbar</th>
                                <th class="meta stat-cell">Persentasi</th>
                                <th class="meta stat-cell">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-success">
                                <td><b>Redy</b>

                                </td>
                                <td>

                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: <?= $ky_ok = ($total_ky_ok / $total_ky) * 100 ?>%;" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"></div>

                                    </div>

                                </td>
                                <td class="stat-cell"> <?= number_format($ky_ok) ?>% </td>
                                <td class="stat-cell"><?= $total_ky_ok ?></td>
                            </tr>

                            <tr class="text-warning">
                                <td><b>Risk</b>

                                </td>
                                <td>

                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width:  <?= $ky_r = ($total_ky_rusak / $total_ky) * 100 ?>%;" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"></div>

                                    </div>

                                </td>
                                <td class="stat-cell"> <?= number_format($ky_r) ?>% </td>
                                <td class="stat-cell"><?= $total_ky_rusak ?></td>
                            </tr>

                            <tr class="text-danger">
                                <td><b>Blanks</b>

                                </td>
                                <td>

                                    <div class="progress">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: <?= $p = ($total_ky_blanks / $total_ky) * 100 ?>%;" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"></div>

                                    </div>

                                </td>
                                <td class="stat-cell"><?= number_format($p) ?>%</td>
                                <td class="stat-cell"><?= $total_ky_blanks ?> </td>
                            </tr>
                            <tr>
                                <th colspan="3" class="meta text-end">Total :</th>
                                <th colspan="2" class="meta stat-cell text-and"><?= $total_ky ?> </th>
                            </tr>
                        </tbody>
                    </table>
                </div><!--//table-responsive-->
            </div><!--//app-card-body-->
        </div><!--//app-card-->
    </div><!--//KALKULASI KEYBOARD-->




</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<?= $this->endSection() ?>