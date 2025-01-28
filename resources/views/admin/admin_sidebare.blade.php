

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">

        <div class="sidebar-brand-text mx-3"> {{ Auth::user()->role }} </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('dashboard') }}"   >
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">


    <!-- Nav Item - Paiments-->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-dollar-sign"></i>
            <span>Paiements</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">

                <a class="collapse-item" href="{{ route('paiement_store') }}" >Paiments  Stores</a>
                <a class="collapse-item" href="{{ route('paiement_commerciaux') }}"  >Paiments  Commerciaux</a>
               
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">


    <!-- Nav Item  CATEGORY + PRODUITS  -->

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-mobile-alt"></i>
            <span>Produits</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item"   href="{{ route('ajouter_produit') }}" >Produits+</a>
               
            </div>
        </div>
    </li>

  

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#store"
            aria-expanded="true" aria-controls="store">
            <i class="fas fa-store"></i>
            <span>Stores</span>
        </a>
        <div id="store" class="collapse" aria-labelledby="storeUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item"   href="{{ route('liste_store') }}" >Liste</a>
            </div>
        </div>
    </li>




</ul>
<!-- End of Sidebar -->
