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
                        <h4 class="app-card-title"><?= $total_m ?></h4>.Unit
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
                                <th class="meta stat-cell">Jumlah</th>
                                <th class="meta stat-cell">Persentasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-success">
                                <td><b>Redy</b>

                                </td>
                                <td>

                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 72%;" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"></div>

                                    </div>

                                </td>
                                <td class="stat-cell">67</td>
                                <td class="stat-cell">

                                    30%
                                </td>
                            </tr>

                            <tr class="text-warning">
                                <td><b>Risk</b>

                                </td>
                                <td>

                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 22%;" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"></div>

                                    </div>

                                </td>
                                <td class="stat-cell">67</td>
                                <td class="stat-cell">

                                    30%
                                </td>
                            </tr>

                            <tr class="text-danger" class="text-end">
                                <td><b>Blanks</b>

                                </td>
                                <td>

                                    <div class="progress">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 52%;" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"></div>

                                    </div>

                                </td>
                                <td class="stat-cell">67</td>
                                <td class="stat-cell">

                                    30%
                                </td>
                            </tr>
                            <tr>
                                <th colspan="2" class="meta text-end">Jumlah :</th>
                                <th colspan="2" class="meta ">9800 </th>
                            </tr>

                        </tbody>
                    </table>
                </div><!--//table-responsive-->
            </div><!--//app-card-body-->
        </div><!--//app-card-->
    </div><!--//col-->

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
                                <th class="meta stat-cell">Jumlah</th>
                                <th class="meta stat-cell">Persentasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-success">
                                <td><b>Redy</b>

                                </td>
                                <td>

                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 72%;" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"></div>

                                    </div>

                                </td>
                                <td class="stat-cell">67</td>
                                <td class="stat-cell">

                                    30%
                                </td>
                            </tr>

                            <tr class="text-warning">
                                <td><b>Risk</b>

                                </td>
                                <td>

                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 22%;" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"></div>

                                    </div>

                                </td>
                                <td class="stat-cell">67</td>
                                <td class="stat-cell">

                                    30%
                                </td>
                            </tr>

                            <tr class="text-danger">
                                <td><b>Blanks</b>

                                </td>
                                <td>

                                    <div class="progress">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 52%;" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"></div>

                                    </div>

                                </td>
                                <td class="stat-cell">67</td>
                                <td class="stat-cell">

                                    30%
                                </td>
                            </tr>
                            <tr>
                                <th colspan="2" class="meta text-end">Jumlah :</th>
                                <th colspan="2" class="meta ">9800 </th>
                            </tr>
                        </tbody>
                    </table>
                </div><!--//table-responsive-->
            </div><!--//app-card-body-->
        </div><!--//app-card-->
    </div><!--//col-->

    <div class="col-12 col-lg-6">

        <div class="app-card app-card-stats-table h-100 shadow-sm">
            <div class="app-card-header p-3">
                <div class="app-card-header p-1 border-bottom-0">
                    <div class="row align-items-center gx-3">
                        <div class="col-auto">
                            <div class="app-icon-holder">
                                <i class="fa-solid fa-laptop"></i>
                            </div><!--//icon-holder-->

                        </div><!--//col-->
                        <div class="col-auto">
                            <h4 class="app-card-title">Laptop</h4>
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
                                <th class="meta stat-cell">Jumlah</th>
                                <th class="meta stat-cell">Persentasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-success">
                                <td><b>Redy</b>

                                </td>
                                <td>

                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 72%;" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"></div>

                                    </div>

                                </td>
                                <td class="stat-cell">67</td>
                                <td class="stat-cell">

                                    30%
                                </td>
                            </tr>

                            <tr class="text-warning">
                                <td><b>Risk</b>

                                </td>
                                <td>

                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 22%;" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"></div>

                                    </div>

                                </td>
                                <td class="stat-cell">67</td>
                                <td class="stat-cell">

                                    30%
                                </td>
                            </tr>

                            <tr class="text-danger">
                                <td><b>Blanks</b>

                                </td>
                                <td>

                                    <div class="progress">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 52%;" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"></div>

                                    </div>

                                </td>
                                <td class="stat-cell">67</td>
                                <td class="stat-cell">

                                    30%
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div><!--//table-responsive-->
            </div><!--//app-card-body-->
        </div><!--//app-card-->
    </div><!--//col-->

    <div class="col-12 col-lg-6">

        <div class="app-card app-card-stats-table h-100 shadow-sm">
            <div class="app-card-header p-3">
                <div class="app-card-header p-1 border-bottom-0">
                    <div class="row align-items-center gx-3">
                        <div class="col-auto">
                            <div class="app-icon-holder">
                                <i class="fa-solid fa-print"></i>
                            </div><!--//icon-holder-->

                        </div><!--//col-->
                        <div class="col-auto">
                            <h4 class="app-card-title">Laptop</h4>
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
                                <th class="meta stat-cell">Jumlah</th>
                                <th class="meta stat-cell">Persentasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-success">
                                <td><b>Redy</b>

                                </td>
                                <td>

                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 72%;" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"></div>

                                    </div>

                                </td>
                                <td class="stat-cell">67</td>
                                <td class="stat-cell">

                                    30%
                                </td>
                            </tr>

                            <tr class="text-warning">
                                <td><b>Risk</b>

                                </td>
                                <td>

                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 22%;" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"></div>

                                    </div>

                                </td>
                                <td class="stat-cell">67</td>
                                <td class="stat-cell">

                                    30%
                                </td>
                            </tr>

                            <tr class="text-danger">
                                <td><b>Blanks</b>

                                </td>
                                <td>

                                    <div class="progress">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 52%;" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"></div>

                                    </div>

                                </td>
                                <td class="stat-cell">67</td>
                                <td class="stat-cell">

                                    30%
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div><!--//table-responsive-->
            </div><!--//app-card-body-->
        </div><!--//app-card-->
    </div><!--//col-->

    <div class="col-12 col-lg-6">

        <div class="app-card app-card-stats-table h-100 shadow-sm">
            <div class="app-card-header p-3">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <h4 class="app-card-title">Statistik PC</h4>
                    </div><!--//col-->
                    <div class="col-auto">
                        <div class="card-header-action">
                            <a href="#">25900 Unit</a>
                        </div><!--//card-header-actions-->
                    </div><!--//col-->
                </div><!--//row-->
            </div><!--//app-card-header-->
            <div class="app-card-body p-3 p-lg-4">
                <div class="table-responsive">
                    <table class="table table-borderless mb-0">
                        <thead>
                            <tr>
                                <th class="meta">Kondisi</th>
                                <th class="meta w-100">Progressbar</th>
                                <th class="meta stat-cell">Jumlah</th>
                                <th class="meta stat-cell">Persentasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-success">
                                <td><b>Redy</b>

                                </td>
                                <td>

                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 72%;" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"></div>

                                    </div>

                                </td>
                                <td class="stat-cell">67</td>
                                <td class="stat-cell">

                                    30%
                                </td>
                            </tr>

                            <tr class="text-warning">
                                <td><b>Risk</b>

                                </td>
                                <td>

                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 22%;" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"></div>

                                    </div>

                                </td>
                                <td class="stat-cell">67</td>
                                <td class="stat-cell">

                                    30%
                                </td>
                            </tr>

                            <tr class="text-danger">
                                <td><b>Blanks</b>

                                </td>
                                <td>

                                    <div class="progress">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 52%;" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"></div>

                                    </div>

                                </td>
                                <td class="stat-cell">67</td>
                                <td class="stat-cell">

                                    30%
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div><!--//table-responsive-->
            </div><!--//app-card-body-->
        </div><!--//app-card-->
    </div><!--//col-->

    <div class="col-12 col-lg-6">

        <div class="app-card app-card-stats-table h-100 shadow-sm">
            <div class="app-card-header p-3">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <h4 class="app-card-title">Statistik PC</h4>
                    </div><!--//col-->
                    <div class="col-auto">
                        <div class="card-header-action">
                            <a href="#">25900 Unit</a>
                        </div><!--//card-header-actions-->
                    </div><!--//col-->
                </div><!--//row-->
            </div><!--//app-card-header-->
            <div class="app-card-body p-3 p-lg-4">
                <div class="table-responsive">
                    <table class="table table-borderless mb-0">
                        <thead>
                            <tr>
                                <th class="meta">Kondisi</th>
                                <th class="meta w-100">Progressbar</th>
                                <th class="meta stat-cell">Jumlah</th>
                                <th class="meta stat-cell">Persentasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-success">
                                <td><b>Redy</b>

                                </td>
                                <td>

                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 72%;" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"></div>

                                    </div>

                                </td>
                                <td class="stat-cell">67</td>
                                <td class="stat-cell">

                                    30%
                                </td>
                            </tr>

                            <tr class="text-warning">
                                <td><b>Risk</b>

                                </td>
                                <td>

                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 22%;" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"></div>

                                    </div>

                                </td>
                                <td class="stat-cell">67</td>
                                <td class="stat-cell">

                                    30%
                                </td>
                            </tr>

                            <tr class="text-danger">
                                <td><b>Blanks</b>

                                </td>
                                <td>

                                    <div class="progress">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 52%;" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"></div>

                                    </div>

                                </td>
                                <td class="stat-cell">67</td>
                                <td class="stat-cell">

                                    30%
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div><!--//table-responsive-->
            </div><!--//app-card-body-->
        </div><!--//app-card-->
    </div><!--//col-->


</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<?= $this->endSection() ?>