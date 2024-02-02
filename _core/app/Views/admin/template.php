<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $title ?></title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Aplikasi Inventory">
    <meta name="author" content="DukunWeb">
    <link rel="shortcut icon" href="<?= base_url() ?>/logoks.png">

    <link rel="stylesheet" href="<?= base_url('/assets/css/loader.css') ?>">

    <!-- FontAwesome JS-->
    <script defer src="<?= base_url() ?>/assets/plugins/fontawesome/js/all.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />


    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="<?= base_url() ?>/assets/css/portal.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <?= $this->renderSection('css') ?>
    <!-- App DATA TABEL -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/dataTables.bootstrap5.min.css">
</head>

<body class="app">

    <!-- lowadeer -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="<?= base_url() ?>/assets/images/users/logoks.png" alt>
                </div>
            </div>
        </div>
    </div>
    <?php if (session()->getFlashData('login')) : ?>

        <?php $pesan = "Hi, $admin->nama anda berhasil login !" ?>
        <?= "<script>
        const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
          }
        });

        Toast.fire({
          icon: 'success',
          title: 'Logined !',
          text: '$pesan',
           showClass: {
            popup: `
              animate__animated
              animate__fadeInUp
              animate__faster
            `
          },
          hideClass: {
            popup: `
              animate__animated
              animate__fadeOutDown
              animate__faster
            `
          }
        });
       
    </script>"; ?>

    <?php endif ?>
    <?php if (session()->getFlashData('error')) : ?>
        <div class="alert alert-danger">
            <? session()->getFlashData('error') ?>
            <?= "<script>
                        const Toast = Swal.mixin({
                        toast: true,
                        position: 'center',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                        });

                        Toast.fire({
                        icon: 'error',
                        title: 'GAGAL DARI TRMPLATE'
                        });
                    </script>";
            ?>
        </div>
    <?php endif ?>
    <?php if (session()->getFlashData('success')) : ?>

        <?php $pesan = session()->getFlashData('success') ?>
        <?= "<script>
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Success!',
        text: '<?= $pesan ?>',
        showConfirmButton: false,
        timer: 2100,
        showClass: {
            popup: `
                animate__animated
                animate__fadeInUp
            `
        },
        hideClass: {
            popup: `
                animate__animated
                animate__fadeOutDown
            `
        }
    });
</script>
"; ?>

    <?php endif ?>
    <?php if (session()->getFlashData('hapussuccess')) : ?>

        <?= "<script>
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Dihapus!',
                    text: 'Data telah dihapus.',
                    showConfirmButton: false,
                    timer: 2000
                  });
                        
                    </script>"; ?>

    <?php endif ?>


    <header class="app-header fixed-top">
        <div class="app-header-inner">
            <div class="container-fluid py-2">
                <div class="app-header-content">
                    <div class="row justify-content-between align-items-center">

                        <div class="col-auto">
                            <a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" role="img">
                                    <title>Menu</title>
                                    <path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" d="M4 7h22M4 15h22M4 23h22"></path>
                                </svg>
                            </a>
                        </div>
                        <!--//col-->

                        <div class="app-utilities col-auto">

                            <div class="app-utility-item app-user-dropdown dropdown">

                                <a class="dropdown-toggle" id="user-dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                                    <span class="text-dark pr-4">Hi,<strong><?= $admin->nama ?></strong></span>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="user-dropdown-toggle">
                                    <li>

                                        <a class="dropdown-item" href="<?= base_url('admin/profile') ?>">
                                            <span class="nav-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-check" viewBox="0 0 16 16">
                                                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                                    <path fill-rule="evenodd" d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                                </svg>
                                            </span> Update Profile</a>
                                    </li>
                                    <li>

                                        <a class="dropdown-item" href="<?= base_url('admin/password') ?>">
                                            <span class="nav-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shield-lock-fill" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 0c-.69 0-1.843.265-2.928.56-1.11.3-2.229.655-2.887.87a1.54 1.54 0 0 0-1.044 1.262c-.596 4.477.787 7.795 2.465 9.99a11.777 11.777 0 0 0 2.517 2.453c.386.273.744.482 1.048.625.28.132.581.24.829.24s.548-.108.829-.24a7.159 7.159 0 0 0 1.048-.625 11.775 11.775 0 0 0 2.517-2.453c1.678-2.195 3.061-5.513 2.465-9.99a1.541 1.541 0 0 0-1.044-1.263 62.467 62.467 0 0 0-2.887-.87C9.843.266 8.69 0 8 0zm0 5a1.5 1.5 0 0 1 .5 2.915l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99A1.5 1.5 0 0 1 8 5z" />
                                                </svg>
                                            </span>
                                            Ganti Password</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="<?= base_url('auth/logout') ?>">
                                            <span class="nav-icon pl-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                                                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                                                </svg>
                                            </span>
                                            Keluar</a></li>
                                </ul>
                            </div>
                            <!--//app-user-dropdown-->
                        </div>
                        <!--//app-utilities-->
                    </div>
                    <!--//row-->
                </div>
                <!--//app-header-content-->
            </div>
            <!--//container-fluid-->
        </div>
        <!--//app-header-inner-->
        <div id="app-sidepanel" class="app-sidepanel">
            <div id="sidepanel-drop" class="sidepanel-drop"></div>
            <div class="sidepanel-inner d-flex flex-column">
                <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
                <div class="app-branding">
                    <a class="app-logo" href="#"><img class="logo-icon me-2" src="<?= base_url() ?>/assets/images/users/logoks.png" alt="logo"><span class="logo-text">INVENTORY </span></a>

                </div>
                <!--//app-branding-->
                <?php
                $menu = $segment[1];
                // $submenu = $segment[2];
                ?>
                <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
                    <ul class="app-menu list-unstyled accordion" id="menu-accordion">
                        <li class="nav-item">
                            <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                            <a class="nav-link <?= ($menu == 'dashboard') ? 'active' : '' ?>" href="<?= base_url('admin/dashboard') ?>">
                                <span class="nav-icon">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-house-door" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M7.646 1.146a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5H9.5a.5.5 0 0 1-.5-.5v-4H7v4a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6zM2.5 7.707V14H6v-4a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v4h3.5V7.707L8 2.207l-5.5 5.5z" />
                                        <path fill-rule="evenodd" d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                                    </svg>
                                </span>
                                <span class="nav-link-text">Dashboard</span>
                            </a>
                            <!--//nav-link-->
                        </li>



                        <li class="nav-item has-submenu">
                            <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                            <a class="nav-link submenu-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-1" aria-expanded="false" aria-controls="submenu-1">
                                <span class="nav-icon">
                                    <i class="fa-solid fa-boxes-stacked"></i>
                                </span>
                                <span class="nav-link-text">Persediaan</span>
                                <span class="submenu-arrow">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                                    </svg>
                                </span>
                                <!--//submenu-arrow-->
                            </a>


                            <!--//nav-link-->
                            <div id="submenu-1" class="collapse submenu submenu-1 <?= ($menu == 'aset' || $menu == 'monitor' || $menu == 'keyboard' || $menu == 'mouse' || $menu == 'laptop' || $menu == 'printer') ? 'show' : '' ?>"" data-bs-parent=" #menu-accordion">
                                <ul class="submenu-list list-unstyled">


                                    <li class="submenu-item">
                                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                                        <a class="submenu-link <?= ($menu == 'aset') ? 'active' : '' ?>" href=" <?= base_url('admin/aset') ?>">

                                            <span class="nav-link-text">PC</span>
                                        </a>
                                        <!--//nav-link-->
                                    </li>

                                    <li class="submenu-item">
                                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                                        <a class="submenu-link <?= ($menu == 'monitor') ? 'active' : '' ?>"" href=" <?= base_url('admin/monitor') ?>">

                                            <span class="nav-link-text">Monitor</span>
                                        </a>
                                        <!--//nav-link-->
                                    </li>


                                    <li class="submenu-item">
                                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                                        <a class="submenu-link <?= ($menu == 'keyboard') ? 'active' : '' ?>" href=" <?= base_url('admin/keyboard') ?>">

                                            <span class="nav-link-text">Keyboard</span>
                                        </a>
                                        <!--//nav-link-->
                                    </li>

                                    <li class="submenu-item">
                                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                                        <a class="submenu-link <?= ($menu == 'mouse') ? 'active' : '' ?>"" href=" <?= base_url('admin/mouse') ?>">

                                            <span class="nav-link-text">Mouse</span>
                                        </a>
                                        <!--//nav-link-->
                                    </li>
                                    <li class="submenu-item">
                                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                                        <a class="submenu-link <?= ($menu == 'laptop') ? 'active' : '' ?>"" href=" <?= base_url('admin/laptop') ?>">

                                            <span class="nav-link-text">Laptop</span>
                                        </a>
                                        <!--//nav-link-->
                                    </li>
                                    <li class="submenu-item">
                                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                                        <a class="submenu-link <?= ($menu == 'printer') ? 'active' : '' ?>"" href=" <?= base_url('admin/printer') ?>">

                                            <span class="nav-link-text">Printer</span>
                                        </a>
                                        <!--//nav-link-->
                                    </li>

                                </ul>
                            </div>
                        </li>

                        <li class="nav-item has-submenu" <?= ($admin->level == '3') ? 'hidden' : '' ?>>
                            <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                            <a class="nav-link submenu-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-5" aria-expanded="false" aria-controls="submenu-5">
                                <span class="nav-icon">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-card-list" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M14.5 3h-13a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"></path>
                                        <path fill-rule="evenodd" d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5z"></path>
                                        <circle cx="3.5" cy="5.5" r=".5"></circle>
                                        <circle cx="3.5" cy="8" r=".5"></circle>
                                        <circle cx="3.5" cy="10.5" r=".5"></circle>

                                    </svg>
                                </span>
                                <span class="nav-link-text">SURAT</span>
                                <span class="submenu-arrow">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                                    </svg>
                                </span>
                                <!--//submenu-arrow-->
                            </a>


                            <!--//nav-link-->
                            <div id="submenu-5" class="collapse submenu submenu-5 <?= ($menu == 'sm' || $menu == 'sk' || $menu == 'sb' || $menu == 'suratkeluar') ? 'show' : '' ?>"" data-bs-parent=" #menu-accordion">
                                <ul class="submenu-list list-unstyled">


                                    <li class="submenu-item">
                                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                                        <a class="submenu-link <?= ($menu == 'sb') ? 'active' : '' ?>" href=" <?= base_url('admin/suratkeluar/add') ?>">

                                            <span class="nav-link-text">Surat Baru</span>
                                        </a>
                                        <!--//nav-link-->
                                    </li>


                                    <li class="submenu-item">
                                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                                        <a class="submenu-link <?= ($menu == 'suratkeluar') ? 'active' : '' ?>"" href=" <?= base_url('admin/suratkeluar') ?>">

                                            <span class="nav-link-text">Surat Keluar</span>
                                        </a>
                                        <!--//nav-link-->
                                    </li>
                                    <li class="submenu-item">
                                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                                        <a class="submenu-link <?= ($menu == 'sp') ? 'active' : '' ?>" href=" <?= base_url('admin/suratpinjam') ?>">

                                            <span class="nav-link-text">Surat Pinjam</span>
                                        </a>
                                        <!--//nav-link-->
                                    </li>

                                </ul>
                            </div>
                        </li>





                        <!--//nav-link-->
                        </li>



                        <!--//nav-item-->

                        <li class="nav-item has-submenu" <?= ($admin->level == '3') ? 'hidden' : (($admin->level == '3') ? 'hidden' : '') ?>>
                            <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                            <a class="nav-link submenu-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-2" aria-expanded="false" aria-controls="submenu-2">
                                <span class="nav-icon">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-folder" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9.828 4a3 3 0 0 1-2.12-.879l-.83-.828A1 1 0 0 0 6.173 2H2.5a1 1 0 0 0-1 .981L1.546 4h-1L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3v1z"></path>
                                        <path fill-rule="evenodd" d="M13.81 4H2.19a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4zM2.19 3A2 2 0 0 0 .198 5.181l.637 7A2 2 0 0 0 2.826 14h10.348a2 2 0 0 0 1.991-1.819l.637-7A2 2 0 0 0 13.81 3H2.19z"></path>
                                    </svg>
                                </span>
                                <span class="nav-link-text">Master Data</span>
                                <span class="submenu-arrow">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                                    </svg>
                                </span>
                                <!--//submenu-arrow-->
                            </a>


                            <!--//nav-link-->
                            <div id="submenu-2" class="collapse submenu submenu-2 <?= ($menu == 'manufacture' || $menu == 'type' || $menu == 'port' || $menu == 'prosesor' || $menu == 'generasi' || $menu == 'hdd' || $menu == 'ram' || $menu == 'rincian' || $menu == 'status' || $menu == 'stok' || $menu == 'kondisi' || $menu == 'port') ? 'show' : '' ?>" data-bs-parent=" #menu-accordion">
                                <ul class="submenu-list list-unstyled">


                                    <li class="submenu-item">
                                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                                        <a class="submenu-link <?= ($menu == 'manufacture') ? 'active' : '' ?>" href=" <?= base_url('admin/manufacture') ?>">

                                            <span class="nav-link-text">Manufaktur</span>
                                        </a>
                                        <!--//nav-link-->
                                    </li>

                                    <li class="submenu-item">
                                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                                        <a class="submenu-link <?= ($menu == 'type') ? 'active' : '' ?>"" href=" <?= base_url('admin/type') ?>">

                                            <span class="nav-link-text">Type Printer</span>
                                        </a>
                                        <!--//nav-link-->
                                    </li>
                                    <li class="submenu-item">
                                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                                        <a class="submenu-link <?= ($menu == 'prosesor') ? 'active' : '' ?>"" href=" <?= base_url('admin/prosesor') ?>">

                                            <span class="nav-link-text">Prosesor</span>
                                        </a>
                                        <!--//nav-link-->
                                    </li>
                                    <li class="submenu-item">
                                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                                        <a class="submenu-link <?= ($menu == 'generasi') ? 'active' : '' ?>"" href=" <?= base_url('admin/generasi') ?>">

                                            <span class="nav-link-text">Generasi</span>
                                        </a>

                                    </li>
                                    <li class="submenu-item">
                                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                                        <a class="submenu-link <?= ($menu == 'hdd') ? 'active' : '' ?>"" href=" <?= base_url('admin/hdd') ?>">

                                            <span class="nav-link-text">HDD/SSD</span>
                                        </a>

                                    </li>
                                    <li class="submenu-item">
                                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                                        <a class="submenu-link <?= ($menu == 'ram') ? 'active' : '' ?>"" href=" <?= base_url('admin/ram') ?>">

                                            <span class="nav-link-text">RAM</span>
                                        </a>

                                    </li>

                                    <li class="submenu-item">
                                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                                        <a class="submenu-link <?= ($menu == 'rincian') ? 'active' : '' ?>"" href=" <?= base_url('admin/rincian') ?>">

                                            <span class="nav-link-text">Rincian</span>
                                        </a>

                                    </li>
                                    <li class="submenu-item">
                                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                                        <a class="submenu-link <?= ($menu == 'status') ? 'active' : '' ?>"" href=" <?= base_url('admin/status') ?>">

                                            <span class="nav-link-text">Setatus</span>
                                        </a>

                                    </li>

                                    <li class="submenu-item">
                                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                                        <a class="submenu-link <?= ($menu == 'stok') ? 'active' : '' ?>"" href=" <?= base_url('admin/stok') ?>">

                                            <span class="nav-link-text">Stok</span>
                                        </a>

                                    </li>
                                    <li class="submenu-item">
                                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                                        <a class="submenu-link <?= ($menu == 'kondisi') ? 'active' : '' ?>"" href=" <?= base_url('admin/kondisi') ?>">

                                            <span class="nav-link-text">Kondisi</span>
                                        </a>

                                    </li>

                                    <li class="submenu-item">
                                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                                        <a class="submenu-link <?= ($menu == 'port') ? 'active' : '' ?>" href=" <?= base_url('admin/port') ?>">

                                            <span class="nav-link-text">Port</span>
                                        </a>

                                    </li>

                                </ul>
                            </div>
                        </li>
                        <!--//nav-link-->


                        <li class="nav-item">
                            <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                            <!-- <a class="nav-link <?= ($menu == 'import') ? 'active' : '' ?>"" href=" <?= base_url('admin/import') ?>">
                                <span class="nav-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-server" viewBox="0 0 16 16">
                                        <path d="M1.333 2.667C1.333 1.194 4.318 0 8 0s6.667 1.194 6.667 2.667V4c0 1.473-2.985 2.667-6.667 2.667S1.333 5.473 1.333 4V2.667z" />
                                        <path d="M1.333 6.334v3C1.333 10.805 4.318 12 8 12s6.667-1.194 6.667-2.667V6.334a6.51 6.51 0 0 1-1.458.79C11.81 7.684 9.967 8 8 8c-1.966 0-3.809-.317-5.208-.876a6.508 6.508 0 0 1-1.458-.79z" />
                                        <path d="M14.667 11.668a6.51 6.51 0 0 1-1.458.789c-1.4.56-3.242.876-5.21.876-1.966 0-3.809-.316-5.208-.876a6.51 6.51 0 0 1-1.458-.79v1.666C1.333 14.806 4.318 16 8 16s6.667-1.194 6.667-2.667v-1.665z" />
                                    </svg>
                                </span>
                                <span class="nav-link-text">Import Absensi</span>
                            </a> -->
                            <!--//nav-link-->
                        </li>

                        <!--//nav-item-->

                        <li class="nav-item" <?= ($admin->level == '2') ? 'hidden' : (($admin->level == '3') ? 'hidden' : '') ?>>
                            <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                            <a class="nav-link <?= ($menu == 'user') ? 'active' : '' ?>"" href=" <?= base_url('admin/user') ?>">
                                <span class="nav-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-rolodex" viewBox="0 0 16 16">
                                        <path d="M8 9.05a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                                        <path d="M1 1a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h.5a.5.5 0 0 0 .5-.5.5.5 0 0 1 1 0 .5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5.5.5 0 0 1 1 0 .5.5 0 0 0 .5.5h.5a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H6.707L6 1.293A1 1 0 0 0 5.293 1H1Zm0 1h4.293L6 2.707A1 1 0 0 0 6.707 3H15v10h-.085a1.5 1.5 0 0 0-2.4-.63C11.885 11.223 10.554 10 8 10c-2.555 0-3.886 1.224-4.514 2.37a1.5 1.5 0 0 0-2.4.63H1V2Z" />
                                    </svg>
                                </span>
                                <span class="nav-link-text">Account</span>
                            </a>
                            <!--//nav-link-->
                        </li>

                        <li class="nav-item">

                        <li class="nav-item">
                    </ul>
                    <!--//app-menu-->
                </nav>
                <!--//app-nav-->
                <div class="app-sidepanel-footer">
                    <nav class="app-nav app-nav-footer">
                        <ul class="app-menu footer-menu list-unstyled">

                            <!--//nav-item-->

                            <!--//nav-item-->
                            <li class="nav-item" <?= ($admin->level == '3') ? 'hidden' : '' ?>>
                                <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                                <a class="nav-link <?= ($menu == 'setting') ? 'active' : '' ?>"" href=" <?= base_url('') ?>">
                                    <span class="nav-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                                            <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z" />
                                            <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z" />
                                        </svg>
                                    </span>
                                    <span class="nav-link-text">Setting</span>
                                </a>
                                <!--//nav-link-->
                            </li>
                            <!--//nav-item-->
                        </ul>
                        <!--//footer-menu-->
                    </nav>
                </div>
                <!--//app-sidepanel-footer-->

            </div>
            <!--//sidepanel-inner-->
        </div>
        <!--//app-sidepanel-->
    </header>
    <!--//app-header-->

    <div class="app-wrapper">

        <div class="container-fluid">

            <div class="row">
                <div class="col-12 col-md-8 col-lg-12 mx-auto">
                    <div class="app-content pt-3 p-md-3 m-sm-6 p-lg-4">
                        <?= $this->renderSection('content') ?>
                    </div>
                </div>
            </div>

        </div>

        <!--//container-fluid-->
    </div>
    <!--//app-content-->

    <footer class="app-footer">
        <div class="container text-center py-3">
            <!--/* This template is free as long as you keep the footer attribution link. If you'd like to use the template without the attribution link, you can buy the commercial license via our website: themes.3rdwavemedia.com Thank you for your support. :) */-->
            <small class="copyright">Designed with <span class="sr-only">love</span> <i class="fa-solid fa-code" style="color: #fb866a;"></i> By <a class="app-link" href="" target="_blank">AdeSutiawan</a></small>

        </div>
    </footer>
    <!--//app-footer-->

    </div>
    <!--//app-wrapper-->


    <!-- Javascript -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/popper.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            {
                $('#tabel1').DataTable()
            }

        })
    </script>

    <script>
        function convertToUppercase(input) {
            input.value = input.value.toUpperCase();
        }
    </script>
    <script>
        document.getElementById('capitalizeInput').addEventListener('input', function() {
            this.value = this.value.replace(/\b\w/g, function(match) {
                return match.toUpperCase();
            });
        });
    </script>
    <script>
        document.getElementById('sentenceCaseInput').addEventListener('input', function() {
            this.value = this.value.replace(/(^|\.\s+|\!\s+|\?\s+)([a-z])/g, function(match) {
                return match.toUpperCase();
            });
        });
    </script>


    <!-- Charts JS -->

    <!-- <script src="<?= base_url() ?>/assets/plugins/chart.js/chart.min.js"></script> -->
    <!-- <script src="<?= base_url() ?>/assets/js/index-charts.js"></script> -->

    <!-- Page Specific JS -->
    <script src="<?= base_url('/assets/js/loader.js') ?>"></script>
    <script src="<?= base_url() ?>/assets/js/app.js"></script>

    <?= $this->renderSection('js') ?>

</body>

</html>