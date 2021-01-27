<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ $data->namasekolah }} - @yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="/assets/css/custom.css" rel="stylesheet">
    <!-- Data Tables Style -->
    <link href="/assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Select2 Style -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.4.0/dist/select2-bootstrap4.min.css"
        rel="stylesheet">
    <style>
        #no_kartu_auto {
            /* display: none !important; */
            z-index: -999;
        }

    </style>
</head>
@if(trim($__env->yieldContent('sidebar')) == null)

<body id="page-top">
    @else

    <body id="page-top" class="bg-info">
        @endif

        <!-- Page Wrapper -->
        <div id="wrapper">

            @if(trim($__env->yieldContent('sidebar')) == null)
            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
                    <!-- <div class="sidebar-brand-icon">
                    <img src="/images/Logo1.png" alt="..." class="avatar-img rounded-circle" width="50">
                </div> -->
                    <div class="sidebar-brand-text mx-3">{{ $data->namasekolah }}</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Menu
                </div>
                <li class="nav-item">
                    <a class="nav-link" href="/">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>
                @if(auth()->user()->role != 2 && auth()->user()->role != 3 && auth()->user()->role != 7 )
                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages"
                        aria-expanded="true" aria-controls="collapsePages">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Master</span>
                    </a>
                    <div id="collapsePages" class="collapse" aria-labelledby="headingPages"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            @if(auth()->user()->role != 7)
                            <a class="collapse-item" href="/siswa">Data Siswa</a>
                            <a class="collapse-item" href="/kelas">Data Kelas</a>
                            <a class="collapse-item" href="/guru">Data Guru</a>
                            @endif
                            @if(auth()->user()->role == 4 || auth()->user()->role == 5)
                            <a class="collapse-item" href="/matapelajaran">Data Mata Pelajaran</a>
                            @endif
                            @if(auth()->user()->role == 4)
                            <a class="collapse-item" href="/admin">Data User</a>
                            <a class="collapse-item" href="/logo">Data Sekolah & Logo</a>
                            @endif
                        </div>
                    </div>
                </li>
                @endif

                @if(auth()->user()->role == 4 || auth()->user()->role == 5)
                <!-- <li class="nav-item">
                    <a class="nav-link" href="/jadwal">
                        <i class="fas fa-fw fa-folder-open"></i>
                        <span>Data Jadwal</span></a>
                </li> -->
                @endif
                @if(auth()->user()->role == 7 || auth()->user()->role == 4 || auth()->user()->role == 6)
                <li class="nav-item">
                    <a class="nav-link" href="/agendasiswa">
                        <i class="fas fa-fw fa-folder-open"></i>
                        <span>Data Agenda Siswa</span></a>
                </li>
                @endif
                @if(!empty($walikelas) || auth()->user()->role == 4 )
                <li class="nav-item">
                    <a class="nav-link" href="/absensisiswa">
                        <i class="fas fa-fw fa-folder-open"></i>
                        <span>Data Absensi Siswa</span></a>
                </li>
                @endif
                @if(auth()->user()->role == 4 || auth()->user()->role == 6)
                <!-- <li class="nav-item">
                    <a class="nav-link" href="/presensiall">
                        <i class="fas fa-fw fa-folder-open"></i>
                        <span>Data Presensi</span></a>
                </li> -->
                <!-- <li class="nav-item">
                    <a class="nav-link" href="/absensiguru">
                        <i class="fas fa-fw fa-folder-open"></i>
                        <span>Data Presensi Guru</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/absensistaf">
                        <i class="fas fa-fw fa-folder-open"></i>
                        <span>Data Presensi Staf</span></a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="/settingrfid">
                        <i class="fas fa-fw fa-folder-open"></i>
                        <span>Setting RFID</span></a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="/absensirfid">
                        <i class="fas fa-fw fa-folder-open"></i>
                        <span>Absen RFID</span></a>
                </li> -->
                @endif
                @if(auth()->user()->role != 1)
                <!-- <li class="nav-item">
                    <a class="nav-link" href="/presensime">
                        <i class="fas fa-fw fa-folder-open"></i>
                        <span>Data Kehadiran Pribadi</span></a>
                </li> -->
                @endif
               
                @if(auth()->user()->role == 7)
                <!-- Nav Item - Charts -->
                <!-- <li class="nav-item">
                    <a class="nav-link" href="/laporanabsensiswa">
                        <i class="far fa-fw fa-chart-bar"></i>
                        <span>Laporan Presensi Siswa</span></a>
                </li> -->
                @endif
                @if(auth()->user()->role == 3 || auth()->user()->role == 6 || auth()->user()->role == 4 || auth()->user()->role == 7)
                <!-- <li class="nav-item">
                    <a class="nav-link" href="/laporanabsenguru">
                        <i class="far fa-fw fa-chart-bar"></i>
                        <span>Laporan Presensi Guru</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/laporanabsenstaf">
                        <i class="far fa-fw fa-chart-bar"></i>
                        <span>Laporan Presensi Staf</span></a>
                </li> -->

                <li class="nav-item">
                    <a class="nav-link" href="/laporanabsensiswa">
                        <i class="far fa-fw fa-chart-bar"></i>
                        <span>Laporan Presensi Siswa</span></a>
                </li>
                @endif
                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

            </ul>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            @php
                            if(auth()->user()->role == 1){
                            $role = 'Staf Pembayaran';
                            }elseif(auth()->user()->role == 2){
                            $role = 'Siswa';
                            }elseif(auth()->user()->role == 3){
                            $role = 'Kepala Sekolah';
                            }elseif(auth()->user()->role == 5){
                            $role = 'Staf Pembelajaran';
                            }elseif(auth()->user()->role == 6){
                            $role = 'Staf Absensi';
                            }elseif(auth()->user()->role == 7){
                            $role = 'Guru';
                            }else{
                            $role = 'Administrator';
                            }
                            @endphp

                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span>Login Sebagai : {{ $role }}
                                        {{ !empty($walikelas) ? '| Wali Kelas : '.$walikelas->namaKelas : '' }}</span>
                                    <div class="topbar-divider d-none d-sm-block"></div>
                                    <span
                                        class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->name }}</span>
                                    <img class="img-profile rounded-circle" src="/images/{{ $data->logo }}">
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    <!-- <a class="dropdown-item" href="/user">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Profile
                                    </a> -->
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item btn-logout" href="/logout">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>

                        </ul>

                    </nav>
                    @endif
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <!-- Page Heading -->
                        @if(trim($__env->yieldContent('sidebar')) == null)
                        <h1 class="h3 mb-4 text-gray-800">@yield('title')</h1>
                        @endif
                        @if(trim($__env->yieldContent('sidebar')) == null)
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ Session::get('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        @if ($message = Session::get('failed'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ Session::get('failed') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        @endif
                        @yield('content')
                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->
                @if(trim($__env->yieldContent('sidebar')) == null)
                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Your Website 2020</span>
                        </div>
                    </div>
                </footer>
                @endif
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <!-- <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div> -->
        <!-- Bootstrap core JavaScript-->
        <script src="/assets/vendor/jquery/jquery.min.js"></script>
        <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Sweet Alert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        <!-- Data Tables -->
        <script src="/assets/vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Chart -->
        <script src="/assets/vendor/chart.js/Chart.min.js"></script>
        <!-- Select 2 -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="/assets/js/chart.js"></script>

        <!-- Text Editor -->
        <script src="https://cdn.tiny.cloud/1/wcb9pe2k9npdjl15ggu0oad1k88dnph0q8qit0pfc1q5bkix/tinymce/5/tinymce.min.js"
            referrerpolicy="origin"></script>

        <!-- Custom scripts for all pages-->
        <script src="/assets/js/sb-admin-2.min.js"></script>
        <script src="/assets/js/script.js"></script>


        <script>
            tinymce.init({
                selector: 'textarea.editor',
                plugins: "table | lists | image",
                table_toolbar: "tableprops tabledelete | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol | insert",
                toolbar: "numlist bullist align image",
            });

        </script>
        <script>
            $(document).ready(function () {
                $('.btn-passs').on('click', function (e) {
                    console.log('ok')
                    let url = $(this).attr('href')
                    console.log(url)
                    let text = $(this).data('original-title')
                    e.preventDefault();
                    Swal.fire({
                        title: 'Kamu yakin ingin merubah kata sandi',
                        text: "kata sandi secara default akan dirubah ke tanggal lahir siswa!",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: text
                    }).then((result) => {
                        if (result.value) {
                            document.location.href = url;
                        }
                    });
                });
            });

        </script>
    </body>

</html>
