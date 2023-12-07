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

<h1 class="app-page-title">Statistik Aset</h1>

<div class="row g-4 mb-4">
    <div class="col-12 col-lg-4">
        <div class="app-card app-card-basic d-flex flex-column align-items-start shadow-sm">
            <div class="app-card-header p-3 border-bottom-0">
                <div class="row align-items-center gx-3">
                    <div class="col-auto">
                        <div class="app-icon-holder">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-receipt" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27zm.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0l-.509-.51z"></path>
                                <path fill-rule="evenodd" d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z"></path>
                            </svg>
                        </div><!--//icon-holder-->

                    </div><!--//col-->
                    <div class="col-auto">
                        <h4 class="app-card-title">Invoices</h4>
                    </div><!--//col-->
                </div><!--//row-->
            </div><!--//app-card-header-->
            <div class="app-card-body px-4">

                <div class="intro">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam aliquet eros vel diam semper mollis.</div>
            </div><!--//app-card-body-->
            <div class="app-card-footer p-4 mt-auto">
                <a class="btn app-btn-secondary" href="#">Create New</a>
            </div><!--//app-card-footer-->
        </div><!--//app-card-->
    </div><!--//col-->
    <div class="col-12 col-lg-4">
        <div class="app-card app-card-basic d-flex flex-column align-items-start shadow-sm">
            <div class="app-card-header p-3 border-bottom-0">
                <div class="row align-items-center gx-3">
                    <div class="col-auto">
                        <div class="app-icon-holder">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-code-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"></path>
                                <path fill-rule="evenodd" d="M6.854 4.646a.5.5 0 0 1 0 .708L4.207 8l2.647 2.646a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 0 1 .708 0zm2.292 0a.5.5 0 0 0 0 .708L11.793 8l-2.647 2.646a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708 0z"></path>
                            </svg>
                        </div><!--//icon-holder-->

                    </div><!--//col-->
                    <div class="col-auto">
                        <h4 class="app-card-title">Apps</h4>
                    </div><!--//col-->
                </div><!--//row-->
            </div><!--//app-card-header-->
            <div class="app-card-body px-4">

                <div class="intro">Pellentesque varius, elit vel volutpat sollicitudin, lacus quam efficitur augue</div>
            </div><!--//app-card-body-->
            <div class="app-card-footer p-4 mt-auto">
                <a class="btn app-btn-secondary" href="#">Create New</a>
            </div><!--//app-card-footer-->
        </div><!--//app-card-->
    </div><!--//col-->
    <div class="col-12 col-lg-4">
        <div class="app-card app-card-basic d-flex flex-column align-items-start shadow-sm">
            <div class="app-card-header p-3 border-bottom-0">
                <div class="row align-items-center gx-3">
                    <div class="col-auto">
                        <div class="app-icon-holder">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-tools" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M0 1l1-1 3.081 2.2a1 1 0 0 1 .419.815v.07a1 1 0 0 0 .293.708L10.5 9.5l.914-.305a1 1 0 0 1 1.023.242l3.356 3.356a1 1 0 0 1 0 1.414l-1.586 1.586a1 1 0 0 1-1.414 0l-3.356-3.356a1 1 0 0 1-.242-1.023L9.5 10.5 3.793 4.793a1 1 0 0 0-.707-.293h-.071a1 1 0 0 1-.814-.419L0 1zm11.354 9.646a.5.5 0 0 0-.708.708l3 3a.5.5 0 0 0 .708-.708l-3-3z"></path>
                                <path fill-rule="evenodd" d="M15.898 2.223a3.003 3.003 0 0 1-3.679 3.674L5.878 12.15a3 3 0 1 1-2.027-2.027l6.252-6.341A3 3 0 0 1 13.778.1l-2.142 2.142L12 4l1.757.364 2.141-2.141zm-13.37 9.019L3.001 11l.471.242.529.026.287.445.445.287.026.529L5 13l-.242.471-.026.529-.445.287-.287.445-.529.026L3 15l-.471-.242L2 14.732l-.287-.445L1.268 14l-.026-.529L1 13l.242-.471.026-.529.445-.287.287-.445.529-.026z"></path>
                            </svg>
                        </div><!--//icon-holder-->

                    </div><!--//col-->
                    <div class="col-auto">
                        <h4 class="app-card-title">Tools</h4>
                    </div><!--//col-->
                </div><!--//row-->
            </div><!--//app-card-header-->
            <div class="app-card-body px-4">

                <div class="intro">Sed maximus, libero ac pharetra elementum, turpis nisi molestie neque, et tincidunt velit turpis non enim.</div>
            </div><!--//app-card-body-->
            <div class="app-card-footer p-4 mt-auto">
                <a class="btn app-btn-secondary" href="#">Create New</a>
            </div><!--//app-card-footer-->
        </div><!--//app-card-->
    </div><!--//col-->
</div>
<div class="row g-4 mb-4">
    <div class="col-6 col-lg-3">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">
                    <i class="fa-solid fa-desktop"></i> Destop
                </h4>
                <div class="stats-figure"><?= $total_d ?></div>
            </div>
            <!--//app-card-body-->
            <a class="app-card-link-mask" href="#"></a>
        </div>
        <!--//app-card-->
    </div>
    <!--//col-->

    <div class="col-6 col-lg-3">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">
                    <div class="app-icon-holder">
                        <i class="fa-solid fa-desktop"></i>
                    </div> Nootbooks
                </h4>
                <div class="stats-figure"><?= $total_n ?></div>
            </div>
            <!--//app-card-body-->
            <a class="app-card-link-mask" href="#"></a>
        </div>
        <!--//app-card-->
    </div>
    <!--//col-->
    <div class="col-6 col-lg-3">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">Total Aset Printer</h4>
                <div class="stats-figure"><?= $total_p ?></div>
            </div>
            <!--//app-card-body-->
            <a class="app-card-link-mask" href="#"></a>
        </div>
        <!--//app-card-->
    </div>
    <!--//col-->
    <div class="col-6 col-lg-3">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <div class="row-auto">
                    <div class="col-auto">
                        <div class="app-icon-holder">
                            <i class="fa-solid fa-desktop"></i>
                        </div><!--//icon-holder-->

                    </div><!--//col-->
                    <div class="col-auto">
                        <h4 class="stats-type mb-1">Server</h4>
                    </div><!--//col-->
                </div>

                <div class="stats-figure"><?= $total_s ?></div>
            </div>
            <!--//app-card-body-->
            <a class="app-card-link-mask" href="#"></a>
        </div>
        <!--//app-card-->
    </div>
    <!--//col-->
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