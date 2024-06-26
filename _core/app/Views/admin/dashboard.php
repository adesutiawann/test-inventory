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

<div class="row g-4 mb-3">
    <div class="col-12 col-lg-2">
        <div class="app-card app-card-basic d-flex flex-column align-items-start shadow-sm">
            <div class="app-card-header p-3 border-bottom-0">
                <div class="row align-items-center gx-3">
                    <div class="col-auto">
                        <div class="app-icon-holder ">
                            <i class="fa-solid fa-boxes-stacked"></i>
                        </div><!--//icon-holder-->

                    </div><!--//col monitor-->
                    <div class="col-auto">
                        <h4 class="app-card-title"><?= $total_tersedia ?></h4>Persediaan
                    </div><!--//col-->
                </div><!--//row-->
            </div><!--//app-card-header-->


        </div><!--//app-card-->


    </div><!--//col-->
    <div class="col-12 col-lg-2 ">
        <div class="app-card app-card-basic d-flex flex-column align-items-start  shadow-sm fa-radiation ">
            <div class="app-card-header p-3 border-bottom-0">
                <div class="row align-items-center gx-3">
                    <div class="col-auto">
                        <div class="app-icon-holder ">
                            <i class="fa-solid fa-building-circle-arrow-right "></i>
                        </div><!--//icon-holder-->

                    </div><!--//col-->
                    <div class="col-auto ">
                        <h4 class="app-card-title"><?= $total_terdistribusi ?></h4>
                        <small class="text-sm"> Terdistribusi </small>
                    </div><!--//col-->
                </div><!--//row-->
            </div><!--//app-card-header-->


        </div><!--//app-card-->
    </div><!--//col-->
    <div class="col-12 col-lg-2 ">
        <div class="app-card app-card-basic d-flex flex-column align-items-start  shadow-sm fa-radiation ">
            <div class="app-card-header p-3 border-bottom-0">
                <div class="row align-items-center gx-3">
                    <div class="col-auto">
                        <div class="app-icon-holder ">
                            <i class="fa-solid fa-boxes-packing"></i>
                        </div><!--//icon-holder-->

                    </div><!--//col-->
                    <div class="col-auto ">
                        <h4 class="app-card-title"><?= $total_backup ?></h4>
                        <small class="text-sm"> Backup </small>
                    </div><!--//col-->
                </div><!--//row-->
            </div><!--//app-card-header-->


        </div><!--//app-card-->
    </div><!--//col-->

    <div class="col-12 col-lg-2 ">
        <div class="app-card app-card-basic d-flex flex-column align-items-start  shadow-sm fa-radiation ">
            <div class="app-card-header p-3 border-bottom-0">
                <div class="row align-items-center gx-3">
                    <div class="col-auto">
                        <div class="app-icon-holder ">
                            <i class="fa-solid fa-chalkboard-user"></i>
                        </div><!--//icon-holder-->

                    </div><!--//col-->
                    <div class="col-auto ">
                        <h4 class="app-card-title"><?= $total_peminjaman ?></h4>
                        <small class="text-sm"> Peminjaman </small>
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
                            <i class="fa-solid fa-file-pen"></i>
                        </div><!--//icon-holder-->

                    </div><!--//col pc-->
                    <div class="col-auto">
                        <h4 class="app-card-title"><?= $total_pc ?></h4>Surat
                    </div><!--//col-->
                </div><!--//row-->
            </div><!--//app-card-header-->


        </div><!--//app-card-->
    </div><!--//col-->
    <div class="col-12 col-lg-2 ">
        <div class="app-card app-card-basic d-flex flex-column align-items-start  shadow-lg fa-radiation ">
            <div class="app-card-header p-3 border-bottom-0">
                <div class="row align-items-center gx-3">
                    <div class="col-auto">
                        <div class="app-icon-holder">
                            <i class="fa-solid fa-user"></i>
                        </div><!--//icon-holder-->

                    </div><!--//col-->
                    <div class="col-auto ">
                        <h4 class="app-card-title"><?= $total_admin ?></h4>
                        <small class="text-sm"><i class="fa-solid fa-circle text-success"></i> User Active</small>
                    </div><!--//col-->
                </div><!--//row-->
            </div><!--//app-card-header-->


        </div><!--//app-card-->
    </div><!--//col-->

</div>
<!--//row-->
<div class="row g-4 mb-4">



    <div class="col-12 col-lg-12">

        <div class="app-card app-card-stats-table h-100 shadow-sm rounded-4">
            <div class="app-card-header p-3">

                <div class="app-card-header p-1 border-bottom-0">
                    <div class="row align-items-center gx-3 ">
                        <div class="col-auto bg-dark">
                            <div class="app-icon-holder">
                                <i class="fa-solid fa-chart-simple"></i>
                            </div><!--//icon-holder-->

                        </div><!--//col-->
                        <div class="col-auto">
                            <i class="fa-solid fa-chart-simple"></i>
                            <h3 class="app-card-title">Statistik</h3>
                        </div><!--//col-->


                    </div><!--//row-->

                </div>

            </div><!--//app-card-header-->

            <div class="app-card-body p-3 p-lg-4">
                <div class="table-responsive">
                    <table class="table table-borderless mb-0">
                        <thead>
                            <tr>
                                <th class=""></th>
                                <th class=" w-100"></th>
                                <th class="meta text-white stat-cell bg-danger text-center">R</th>
                                <th class="meta text-white stat-cell bg-warning text-center">Y</th>
                                <th class="meta text-white stat-cell bg-success text-center">G</th>
                                <th class="meta stat-cell table-info ">SUM</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!--//keyboard-->

                            <tr class="shadow-lg">
                                <td>
                                    <div class="row align-items-center gx-3">
                                        <div class="col-auto">
                                            <div class="app-icon-holder">
                                                <i class="fa-solid fa-desktop text-danger"></i>
                                            </div><!--//icon-holder-->

                                        </div><!--//col-->

                                    </div><!--//row-->
                                </td>
                                <td class=" ">
                                    <h5 class="meta">Monitor</h5>
                                    <div class="progress h-50">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: <?= $mo_d = ($total_mo > 0) ? ($total_mo_blanks / $total_mo) * 100 : 0;
                                                                                                                ?>%;" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100">
                                            <b><?= number_format($mo_d) ?>%</b>
                                        </div>
                                        <div class="progress-bar bg-warning" role="progressbar" style="width:  <?= $mo_w = ($total_mo_rusak > 0) ? ($total_mo_rusak / $total_mo) * 100 : 0; ?>%;" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"><b><?= number_format($mo_w) ?>%</b></div>
                                        <div class="progress-bar bg-success" role="progressbar" style="width: <?= $mo_s = ($total_mo_ok > 0) ? ($total_mo_ok / $total_mo) * 100 : 0; ?>%;" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"><b><?= number_format($mo_s) ?>%</b></div>
                                    </div>


                                </td>

                                <td class="stat-cell text-danger  ">
                                    <div class="mt-2"><b><?= $total_mo_blanks ?></b></div>
                                </td>
                                <td class="stat-cell text-warning">
                                    <div class="mt-2"><b><?= $total_mo_rusak ?></b>
                                    </div>
                                </td>
                                <td class="stat-cell text-success">
                                    <div class="mt-2"><b><?= $total_mo_ok ?></b>
                                    </div>
                                </td>
                                <td class="stat-cell ">
                                    <div class="mt-2"><b><?= $total_mo ?></b>
                                    </div>
                                </td>

                            </tr>
                            <!--//mouse-->
                            <tr class="shadow-lg">
                                <td>
                                    <div class="row align-items-center gx-3">
                                        <div class="col-auto">
                                            <div class="app-icon-holder text-danger">
                                                <i class="fa-solid fa-server text-server"></i>
                                            </div><!--//icon-holder-->

                                        </div><!--//col-->

                                    </div><!--//row-->
                                </td>
                                <td class=" ">
                                    <h5 class="meta">Personal Computer</h5>
                                    <div class="progress h-50 ">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: <?= $pc_d = ($total_pc_blanks > 0) ? ($total_pc_blanks / $total_pc) * 100 : 0; ?>%;" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"><b><?= number_format($pc_d) ?>%</b></div>
                                        <div class="progress-bar bg-warning" role="progressbar" style="width:  <?= $pc_w = ($total_pc_rusak > 0) ? ($total_pc_rusak / $total_pc) * 100 : 0; ?>%;" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"><b><?= number_format($pc_w) ?>%</b></div>
                                        <div class="progress-bar bg-success" role="progressbar" style="width: <?= $pc_s = ($total_pc_ok > 0) ? ($total_pc_ok / $total_pc) * 100 : 0; ?>%;" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"><b><?= number_format($pc_s) ?>%</b></div>
                                    </div>


                                </td>
                                <div class="">
                                    <td class="stat-cell text-danger  ">
                                        <div class="mt-2"><b><?= $total_pc_blanks ?></b></div>
                                    </td>
                                    <td class="stat-cell text-warning">
                                        <div class="mt-2"><b><?= $total_pc_rusak ?></b>
                                        </div>
                                    </td>
                                    <td class="stat-cell text-success">
                                        <div class="mt-2"><b><?= $total_pc_ok ?></b>
                                        </div>
                                    </td>
                                    <td class="stat-cell ">
                                        <div class="mt-2"><b><?= $total_pc ?></b>
                                        </div>
                                    </td>
                                </div>
                            </tr>
                            <!--//mouse-->
                            <tr class="shadow-lg">
                                <td>
                                    <div class="row align-items-center gx-3">
                                        <div class="col-auto">
                                            <div class="app-icon-holder">
                                                <i class="fa-solid fa-keyboard text-danger"></i>
                                            </div><!--//icon-holder-->

                                        </div><!--//col-->

                                    </div><!--//row-->
                                </td>
                                <td class=" ">
                                    <h5 class="meta">Keyboard</h5>
                                    <div class="progress h-50 ">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: <?= $ky_d = ($total_ky_blanks > 0) ? ($total_ky_blanks / $total_ky) * 100 : 0; ?>%;" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"><b><?= number_format($ky_d) ?>%</b></div>
                                        <div class="progress-bar bg-warning" role="progressbar" style="width:  <?= $ky_w = ($total_ky_rusak > 0) ? ($total_ky_rusak / $total_ky) * 100 : 0; ?>%;" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"><b><?= number_format($ky_w) ?>%</b></div>
                                        <div class="progress-bar bg-success" role="progressbar" style="width: <?= $ky_s = ($total_ky_ok > 0) ? ($total_ky_ok / $total_ky) * 100 : 0; ?>%;" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"><b><?= number_format($ky_s) ?>%</b></div>
                                    </div>


                                </td>
                                <div class="">
                                    <td class="stat-cell text-danger  ">
                                        <div class="mt-2"><b><?= $total_ky_blanks ?></b></div>
                                    </td>
                                    <td class="stat-cell text-warning">
                                        <div class="mt-2"><b><?= $total_ky_rusak ?></b>
                                        </div>
                                    </td>
                                    <td class="stat-cell text-success">
                                        <div class="mt-2"><b><?= $total_ky_ok ?></b>
                                        </div>
                                    </td>
                                    <td class="stat-cell ">
                                        <div class="mt-2"><b><?= $total_ky ?></b>
                                        </div>
                                    </td>
                                </div>
                            </tr>

                            <!--//KEYBOARD-->
                            <tr class="shadow-lg">
                                <td>
                                    <div class="row align-items-center gx-3">
                                        <div class="col-auto">
                                            <div class="app-icon-holder">
                                                <i class="fa-solid fa-mouse text-danger"></i>
                                            </div><!--//icon-holder-->

                                        </div><!--//col-->

                                    </div><!--//row-->
                                </td>
                                <td class=" ">
                                    <h5 class="meta">Mouse</h5>
                                    <div class="progress h-50 ">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: <?= $ms_d = ($total_ms_blanks > 0) ? ($total_ms_blanks / $total_ms) * 100 : 0; ?>%;" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"><?= number_format($ms_d) ?>%</div>
                                        <div class="progress-bar bg-warning" role="progressbar" style="width:  <?= $ms_w = ($total_ms_rusak > 0) ? ($total_ms_rusak / $total_ms) * 100 : 0; ?>%;" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"><?= number_format($ms_w) ?>%</div>
                                        <div class="progress-bar bg-success" role="progressbar" style="width: <?= $ms_s = ($total_ms_ok > 0) ? ($total_ms_ok / $total_ms) * 100 : 0; ?>%;" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"><?= number_format($ms_s) ?>%</div>
                                    </div>


                                </td>
                                <div class="">
                                    <td class="stat-cell text-danger  ">
                                        <div class="mt-2"><b><?= $total_ms_blanks ?></b></div>
                                    </td>
                                    <td class="stat-cell text-warning">
                                        <div class="mt-2"><b><?= $total_ms_rusak ?></b>
                                        </div>
                                    </td>
                                    <td class="stat-cell text-success">
                                        <div class="mt-2"><b><?= $total_ms_ok ?></b>
                                        </div>
                                    </td>
                                    <td class="stat-cell ">
                                        <div class="mt-2"><b><?= $total_ms ?></b>
                                        </div>
                                    </td>
                                </div>
                            </tr>

                            <!--//LAPTOP-->
                            <tr class="shadow-lg">
                                <td>
                                    <div class="row align-items-center gx-3">
                                        <div class="col-auto">
                                            <div class="app-icon-holder">
                                                <i class="fa-solid fa-laptop text-success"></i>
                                            </div><!--//icon-holder-->

                                        </div><!--//col-->

                                    </div><!--//row-->
                                </td>
                                <td class=" ">
                                    <h5 class="meta">Laptop</h5>
                                    <div class="progress h-50 ">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: <?= $la_d = ($total_la_blanks > 0) ? ($total_la_blanks / $total_la) * 100 : 0; ?>%;" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"><?= number_format($la_d) ?>%</div>
                                        <div class="progress-bar bg-warning" role="progressbar" style="width:  <?= $la_w = ($total_la_rusak > 0) ? ($total_la_rusak / $total_la) * 100 : 0;  ?>%;" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"><?= number_format($la_w) ?>%</div>
                                        <div class="progress-bar bg-success" role="progressbar" style="width: <?= $la_s = ($total_la_ok > 0) ?  ($total_la_ok / $total_la) * 100 : 0;  ?>%;" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"><?= number_format($la_s) ?>%</div>
                                    </div>


                                </td>
                                <div class="">
                                    <td class="stat-cell text-danger  ">
                                        <div class="mt-2"><b><?= $total_la_blanks ?></b></div>
                                    </td>
                                    <td class="stat-cell text-warning">
                                        <div class="mt-2"><b><?= $total_la_rusak ?></b>
                                        </div>
                                    </td>
                                    <td class="stat-cell text-success">
                                        <div class="mt-2"><b><?= $total_la_ok ?></b>
                                        </div>
                                    </td>
                                    <td class="stat-cell ">
                                        <div class="mt-2"><b><?= $total_la ?></b>
                                        </div>
                                    </td>
                                </div>
                            </tr>
                            <!--//PRINTER-->
                            <tr class="shadow">
                                <td>
                                    <div class="row align-items-center gx-3">
                                        <div class="col-auto">
                                            <div class="app-icon-holder  text-warning">
                                                <i class="fa-solid fa-print text-warning"></i>
                                            </div><!--//icon-holder-->

                                        </div><!--//col-->

                                    </div><!--//row-->
                                </td>
                                <td class=" ">
                                    <h5 class="meta">Printer</h5>
                                    <div class="progress h-50 ">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: <?= $pr_d = ($total_pr_blanks > 0) ? ($total_pr_blanks / $total_pr) * 100 : 0; ?>%;" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"><?= number_format($pr_d) ?>%</div>
                                        <div class="progress-bar bg-warning" role="progressbar" style="width:  <?= $pr_w = ($total_pr_rusak > 0) ? ($total_pr_rusak / $total_pr) * 100 : 0; ?>%;" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"><?= number_format($pr_w) ?>%</div>
                                        <div class="progress-bar bg-success" role="progressbar" style="width: <?= $pr_s = ($total_pr_ok > 0) ? ($total_pr_ok / $total_pr) * 100 : 0; ?>%;" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"><?= number_format($pr_s) ?>%</div>
                                    </div>


                                </td>
                                <div class="">
                                    <td class="stat-cell text-danger  ">
                                        <div class="mt-2"><b><?= $total_pr_blanks ?></b></div>
                                    </td>
                                    <td class="stat-cell text-warning">
                                        <div class="mt-2"><b><?= $total_pr_rusak ?></b>
                                        </div>
                                    </td>
                                    <td class="stat-cell text-success">
                                        <div class="mt-2"><b><?= $total_pr_ok ?></b>
                                        </div>
                                    </td>
                                    <td class="stat-cell ">
                                        <div class="mt-2"><b><?= $total_pr ?></b>
                                        </div>
                                    </td>
                                </div>
                            </tr>
                            <!--//KABEL-->
                            <tr class="shadow">
                                <td>
                                    <div class="row align-items-center gx-3">
                                        <div class="col-auto">
                                            <div class="app-icon-holder  text-dark">

                                                <i class="fa-solid fa-plug-circle-bolt text-dark"></i>
                                            </div><!--//icon-holder-->

                                        </div><!--//col-->

                                    </div><!--//row-->
                                </td>
                                <td class=" ">
                                    <h5 class="meta">Kabel</h5>
                                    <div class="progress h-50">
                                        <?php
                                        // Array of different background colors
                                        $bgColors = ['bg-danger', 'bg-warning', 'bg-success', 'bg-info', 'bg-primary'];

                                        // Counter for color index
                                        $colorIndex = 0;

                                        // Calculate the total sum
                                        $totalSum = array_sum(array_column($kabel, 'jumlah'));
                                        ?>

                                        <?php foreach ($kabel as $row) : ?>
                                            <?php
                                            // Get the current background color
                                            $currentColor = $bgColors[$colorIndex % count($bgColors)];

                                            // Calculate width and set the background color
                                            $kb_d = ($row->jumlah > 0) ? ($row->jumlah / $totalSum) * 100 : 0;
                                            ?>
                                            <div class="progress-bar <?= $currentColor ?>" role="progressbar" style="width: <?= $kb_d ?>%;" aria-valuenow="<?= $kb_d ?>" aria-valuemin="0" aria-valuemax="100">
                                                <?= $row->type . ' ' . $row->jumlah ?>
                                            </div>

                                            <?php

                                            // Increment the color index for the next iteration
                                            $colorIndex++;
                                            ?>

                                        <?php endforeach; ?>

                                    </div>



                                </td>
                                <div class="">

                                    <td colspan="4" class="stat-cell ">
                                        <div class="mt-2"><b><?= $totalSum ?></b>
                                        </div>
                                    </td>

                                </div>
                            </tr>
                            <tr>
                                <th colspan="2" class="meta text-end">Total Aset :</th>
                                <th colspan="4" class="meta stat-cell text-and">
                                    <h2><?= $total_aset ?></h2>
                                </th>
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