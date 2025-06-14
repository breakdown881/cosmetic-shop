<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@lang('translate.overview')</title>
    <!-- Create favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('') }}/adm/images/logo.jpg">
    <!-- Custom fonts for this template-->
    <link href="{{ asset('') }}/adm/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="{{ asset('') }}/adm/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ asset('') }}/adm/css/sb-admin.css" rel="stylesheet">
    <link href="{{ asset('') }}/adm/css/admin.css" rel="stylesheet">
</head>

<body id="page-top">
    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
        <a class="navbar-brand mr-1" href="index.html">@lang('translate.brand')</a>
        <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
            <i class="fas fa-bars"></i>
        </button>
        <!-- Navbar Search -->
        <!-- Navbar -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item no-arrow text-white">
                <span>Chào Hoàng Hải</span> |
                <a class="text-white nounderline" href="#" data-toggle="modal" data-target="#logoutModal">
                    @lang('translate.logout')
                </a>
            </li>
        </ul>
    </nav>
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="sidebar navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="../../pages/dashboard/index.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>@lang('translate.overview')</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="">
                    <i class="fas fa-shopping-cart"></i>
                    <span>@lang('translate.orders')</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="">
                    <a class="dropdown-item" href="#">@lang('translate.list')</a>
                    <a class="dropdown-item" href="#">@lang('translate.add')</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="">
                    <i class="fab fa-product-hunt"></i>
                    <span>@lang('translate.products')</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="">
                    <a class="dropdown-item" href="#">@lang('translate.list')</a>
                    <a class="dropdown-item" href="#">@lang('translate.add')</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="">
                    <i class="fas fa-comments"></i>
                    <span>@lang('translate.comments')</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="">
                    <a class="dropdown-item" href="#">@lang('translate.list')</a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="">
                    <i class="far fa-image"></i>
                    <span>@lang('translate.images')</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="">
                    <a class="dropdown-item" href="#">@lang('translate.list')</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="">
                    <i class="fas fa-user-alt"></i>
                    <span>@lang('translate.customers')</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="">
                    <a class="dropdown-item" href="#">@lang('translate.list')</a>
                    <a class="dropdown-item" href="#">@lang('translate.add')</a>
                </div>
            </li>
            @php
                $isBrand = ($currentMenu ?? '') === 'brands';
            @endphp
            <li class="nav-item dropdown {{ $isBrand ? 'show' : '' }}">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="" aria-expanded="{{ $isBrand ? 'true' : 'false' }}">
                    <i class="fas fa-folder"></i>
                    <span>@lang('translate.brands')</span>
                </a>
                <div class="dropdown-menu {{ $isBrand ? 'show' : '' }}" aria-labelledby="">
                    <a class="dropdown-item {{ request()->is('admin/brands') ? 'active' : '' }}" href="{{ route('admin.brand.index') }}">@lang('translate.list')</a>
                    <a class="dropdown-item {{ request()->is('admin/brands/*') ? 'active' : '' }}" href="{{ route('admin.brand.create') }}">@lang('translate.add')</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="">
                    <i class="fas fa-folder"></i>
                    <span>@lang('translate.categories')</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="">
                    <a class="dropdown-item" href=".#">@lang('translate.list')</a>
                    <a class="dropdown-item" href="#">@lang('translate.add')</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="">
                    <i class="fas fa-percentage"></i>
                    <span>@lang('translate.discounts')</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="">
                    <a class="dropdown-item" href="#">@lang('translate.list')</a>
                    <a class="dropdown-item" href="#">@lang('translate.add')</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="">
                    <i class="fas fa-shipping-fast"></i>
                    <span>@lang('translate.feeShips')</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="">
                    <a class="dropdown-item" href="#">@lang('translate.list')</a>
                    <a class="dropdown-item" href="#">@lang('translate.add')</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="">
                    <i class="fas fa-users"></i>
                    <span>@lang('translate.staffs')</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="">
                    <a class="dropdown-item" href="#">@lang('translate.list')</a>
                    <a class="dropdown-item" href="#">@lang('translate.add')</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="">
                    <i class="fas fa-user-shield"></i>
                    <span>@lang('translate.authorizations')</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="">
                    <a class="dropdown-item" href="#">@lang('translate.listRole')</a>
                    <a class="dropdown-item" href="#">@lang('translate.add')</a>
                    <a class="dropdown-item" href="#">@lang('translate.listAction')</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-star-half-alt"></i>
                    <span>@lang('translate.orderStatus')</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="">
                    <i class="fas fa-file-alt"></i>
                    <span>@lang('translate.newsLetter')</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="">
                    <a class="dropdown-item" href="#">@lang('translate.list')</a>
                    <a class="dropdown-item" href="#">@lang('translate.sendMail')</a>
                </div>
            </li>
        </ul>

        <div id="content-wrapper">
            @include('admin.layout.message')
            @yield('content')
        </div>

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright © Hoàng Hải</span>
                </div>
            </div>
        </footer>
    </div>
    <!-- /.content-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('translate.exitConfirm')</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">@lang('translate.cancel')</button>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            @lang('translate.exit')
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('') }}/adm/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('') }}/adm/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('') }}/adm/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="{{ asset('') }}/adm/vendor/datatables/jquery.dataTables.js"></script>
    <script src="{{ asset('') }}/adm/vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('') }}/adm/js/sb-admin.min.js"></script>
    <!-- Demo scripts for this page-->
    <script src="{{ asset('') }}/adm/js/demo/datatables-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('') }}/adm/js/admin.js"></script>
    @stack('scripts')
</body>

</html>
