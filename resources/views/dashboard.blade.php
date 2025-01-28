@extends('admin.template')

@section('content')
    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('admin.admin_sidebare')
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>



                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    {{ Auth::user()->name }}
                                </span>
                                <img class="img-profile rounded-circle" src="{{ asset('img/undraw_profile.svg') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                {{-- <a class="dropdown-item" href="#">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                Settings
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                Activity Log
                            </a> --}}
                                <div class="dropdown-divider"></div>


                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button class="dropdown-item" type="submit"> Déconnexion </button>
                                    </form>
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>

                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Nombre de clients</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"> 130 </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-store  fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Nombre de commerciaux </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"> 13 </div>
                                        </div>
                                        <div class="col-auto">

                                            <i class="fas fa-user-tie fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>


                </div>
                <!-- /.container-fluid -->


                <div class="p-5">

                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Ajouter un Utilisateur</h1>
                    </div>

                    @if (session()->has('success'))
                        <div class="alert alert-success text-center"> {{ session('success') }}</div>
                    @endif


                    <form class="user" method="post" action="{{ route('create_user') }}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                    name="name" placeholder="Nom complet">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                    name="email" placeholder="Email@">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </div>

                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" class="form-control form-control-user" name="ps1"
                                    id="exampleInputPassword" placeholder="Mot de passe">
                                @error('ps1')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <input type="password" class="form-control form-control-user" name="ps1_confirmation"
                                    id="exampleRepeatPassword" placeholder="Retaper le M.D.P">
                                @error('ps1_confirmation')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <select class="form-control   p-4 " name="role">
                                    <option value=""> </option>
                                    <option value="admin"> Admin </option>
                                    <option value="commercial"> Commercial </option>
                                </select>
                                @error('role')
                                    {{ $message }}
                                @enderror
                            </div>

                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="tel" class="form-control form-control-user" id="tlf"
                                    name="tlf" placeholder="téléphone">
                                @error('tlf')
                                    {{ $message }}
                                @enderror
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Ajouter
                        </button>


                    </form>

                    <hr>

                    @if (count($commerciaux) > 0)
                        <div class="mt-2 mb-5  ">
                            <h1 class="text-center"> Liste des commerciaux </h1>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">id</th>
                                        <th scope="col">Nom</th>
                                        <th scope="col">solde</th>
                                        <th scope="col">téléphone </th>
                                        <th scope="col">Email </th>
                                        <th scope="col"> Action </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($commerciaux as $commercial)
                                        <tr>
                                            <th scope="row"> {{ $commercial->id }} </th>
                                            <td>{{ $commercial->name }} </td>
                                            <td>{{ $commercial->solde }} DA </td>
                                            <td>{{ $commercial->tlf }} </td>
                                            <td>{{ $commercial->email }} </td>
                                            <td>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-pen-square"></i>
                                                </button>


                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <div>
                                {{ $commerciaux->links() }}
                            </div>
                        </div>
                        <hr>
                    @endif

                    @if (count($admins) > 0)
                        <div class="mt-5 mb-2">
                            <h1 class="text-center"> Liste des Admins </h1>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">id</th>
                                        <th scope="col">Nom</th>
                                        <th scope="col">solde</th>
                                        <th scope="col">téléphone </th>
                                        <th scope="col"> Email </th>

                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($admins as $admin)
                                        <tr>
                                            <th scope="row"> {{ $admin->id }} </th>
                                            <td>{{ $admin->name }} </td>
                                            <td>{{ $admin->solde }} DA </td>
                                            <td>{{ $admin->tlf }} </td>
                                            <td>{{ $admin->email }} </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <div>
                                {{ $commerciaux->links() }}
                            </div>
                        </div>
                    @endif


                </div>


            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper  ======= -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


@endsection

@section('js')
    <script></script>
@endsection
