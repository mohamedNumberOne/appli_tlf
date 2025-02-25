 @switch(Auth::user() -> role)
     @case('admin')
         {{-- admin Sidebar --}}
         <div class="sidebar" data-background-color="dark">
             <div class="sidebar-logo">
                 <!-- Logo Header -->
                 <div class="logo-header" data-background-color="dark">
                     <a href="index.html" class="logo">
                         <img src="{{ asset('assets/img/kaiadmin/logo_light.svg') }}" alt="navbar brand" class="navbar-brand"
                             height="20" />
                     </a>
                     <div class="nav-toggle">
                         <button class="btn btn-toggle toggle-sidebar">
                             <i class="gg-menu-right"></i>
                         </button>
                         <button class="btn btn-toggle sidenav-toggler">
                             <i class="gg-menu-left"></i>
                         </button>
                     </div>
                     <button class="topbar-toggler more">
                         <i class="gg-more-vertical-alt"></i>
                     </button>
                 </div>
                 <!-- End Logo Header -->

             </div>
             <div class="sidebar-wrapper scrollbar scrollbar-inner">
                 <div class="sidebar-content">
                     <ul class="nav nav-secondary">
                         <li class="nav-item">
                             <a data-bs-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                                 <i class="fas fa-home"></i>
                                 <p>Dashboard</p>
                                 <span class="caret"></span>
                             </a>
                             <div class="collapse" id="dashboard">
                                 <ul class="nav nav-collapse">
                                     <li>
                                         <a href="{{ route('dashboard') }}">
                                             <span class="sub-item">Dashboard </span>
                                         </a>
                                     </li>
                                 </ul>
                             </div>
                         </li>

                         <li class="nav-item">
                             <a data-bs-toggle="collapse" href="#base">
                                 <i class="fas fa-dollar-sign"></i>
                                 <p>Paiements</p>
                                 <span class="caret"></span>
                             </a>
                             <div class="collapse" id="base">
                                 <ul class="nav nav-collapse">

                                     <li>
                                         <a href="{{ route('paiement_store') }}">
                                             <span class="sub-item">Store-Commerciaux</span>
                                         </a>
                                     </li>
                                     <li>
                                         <a href="{{ route('paiement_commerciaux') }}">
                                             <span class="sub-item">Commerciaux-Admin</span>
                                         </a>
                                     </li>

                                 </ul>
                             </div>
                         </li>
                         <li class="nav-item">
                             <a data-bs-toggle="collapse" href="#sidebarLayouts">
                                 <i class="fas fa-store"></i>
                                 <p> Stores </p>
                                 <span class="caret"></span>
                             </a>
                             <div class="collapse" id="sidebarLayouts">
                                 <ul class="nav nav-collapse">
                                     <li>
                                         <a href="{{ route('liste_store') }}">
                                             <span class="sub-item">Liste</span>
                                         </a>
                                     </li>
                                 </ul>
                             </div>
                         </li>
                         <li class="nav-item">
                             <a data-bs-toggle="collapse" href="#tlf">
                                 <i class="fas fa-mobile-alt"></i>
                                 <p> Produits </p>
                                 <span class="caret"></span>
                             </a>
                             <div class="collapse" id="tlf">
                                 <ul class="nav nav-collapse">
                                     <li>
                                         <a href="{{ route('ajouter_produit') }}">
                                             <span class="sub-item">Liste</span>
                                         </a>
                                     </li>
                                     {{-- <li>
                                         <a href="icon-menu.html">
                                             <span class="sub-item">Catégories</span>
                                         </a>
                                     </li> --}}
                                 </ul>
                             </div>
                         </li>
                     </ul>
                 </div>
             </div>
         </div>
         {{-- End admin Sidebar --}}
     @break

     @case('commercial')
         {{-- commercial Sidebar --}}
         <div class="sidebar" data-background-color="dark">
             <div class="sidebar-logo">
                 <!-- Logo Header -->
                 <div class="logo-header" data-background-color="dark">

                     <div class="nav-toggle">
                         <button class="btn btn-toggle toggle-sidebar">
                             <i class="gg-menu-right"></i>
                         </button>
                         <button class="btn btn-toggle sidenav-toggler">
                             <i class="gg-menu-left"></i>
                         </button>
                     </div>
                     <button class="topbar-toggler more">
                         <i class="gg-more-vertical-alt"></i>
                     </button>
                 </div>
                 <!-- End Logo Header -->

             </div>
             <div class="sidebar-wrapper scrollbar scrollbar-inner">
                 <div class="sidebar-content">
                     <ul class="nav nav-secondary">
                         <li class="nav-item">
                             <a data-bs-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                                 <i class="fas fa-home"></i>
                                 <p>Dashboard</p>
                                 <span class="caret"></span>
                             </a>
                             <div class="collapse" id="dashboard">
                                 <ul class="nav nav-collapse">
                                     <li>
                                         <a href="{{ route('dashboard_commercial') }}">
                                             <span class="sub-item">Dashboard </span>
                                         </a>
                                     </li>
                                 </ul>
                             </div>
                         </li>

                         <li class="nav-item">
                             <a data-bs-toggle="collapse" href="#sidebarLayouts">
                                 <i class="fas fa-store"></i>
                                 <p> Stores </p>
                                 <span class="caret"></span>
                             </a>
                             <div class="collapse" id="sidebarLayouts">
                                 <ul class="nav nav-collapse">
                                     <li>
                                         <a href="{{ route('create_store_page') }}">
                                             <span class="sub-item">Ajouter un Store</span>
                                         </a>
                                     </li>
                                     <li>
                                         <a href="{{ route('commercial_liste_store') }}">
                                             <span class="sub-item">Mes stores </span>
                                         </a>
                                     </li>
                                 </ul>
                             </div>
                         </li>
                     </ul>
                 </div>
             </div>
         </div>
         {{-- End commercial Sidebar --}}
     @break

     @case('prop_store')
         {{-- commercial Sidebar --}}
         <div class="sidebar" data-background-color="dark">
             <div class="sidebar-logo">
                 <!-- Logo Header -->
                 <div class="logo-header" data-background-color="dark">

                     <div class="nav-toggle">
                         <button class="btn btn-toggle toggle-sidebar">
                             <i class="gg-menu-right"></i>
                         </button>
                         <button class="btn btn-toggle sidenav-toggler">
                             <i class="gg-menu-left"></i>
                         </button>
                     </div>
                     <button class="topbar-toggler more">
                         <i class="gg-more-vertical-alt"></i>
                     </button>
                 </div>
                 <!-- End Logo Header -->

             </div>
             <div class="sidebar-wrapper scrollbar scrollbar-inner">
                 <div class="sidebar-content">
                     <ul class="nav nav-secondary">
                         <li class="nav-item">
                             <a data-bs-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                                 <i class="fas fa-home"></i>
                                 <p>Dashboard</p>
                                 <span class="caret"></span>
                             </a>
                             <div class="collapse" id="dashboard">
                                 <ul class="nav nav-collapse">
                                     <li>
                                         <a href="{{ route('dashboard_store') }}">
                                             <span class="sub-item">Dashboard </span>
                                         </a>
                                     </li>
                                 </ul>
                             </div>
                         </li>

                         <li class="nav-item">
                             <a data-bs-toggle="collapse" href="#sidebarLayouts">
                                 <i class="fas fa-clipboard-check"></i>
                                 <p> Mes ventes </p>
                                 <span class="caret"></span>
                             </a>
                             <div class="collapse" id="sidebarLayouts">
                                 <ul class="nav nav-collapse">
                                     <li>
                                         <a href="{{ route('ajouter_vente_page') }}">
                                             <span class="sub-item">Ajouter </span>
                                         </a>
                                     </li>
                                     <li>
                                         <a href="{{ route('mes_ventes') }}">
                                             <span class="sub-item">Mes ventes </span>
                                         </a>

                                     </li>

                                 </ul>
                             </div>
                         </li>

                         <li class="nav-item">
                             <a data-bs-toggle="collapse" href="#retours" class="collapsed" aria-expanded="false">
                                 <i class="fas fa-undo-alt"></i>
                                 <p>Retours</p>
                                 <span class="caret"></span>
                             </a>
                             <div class="collapse" id="retours">
                                 <ul class="nav nav-collapse">
                                     <li>
                                         <a href="{{ route('page_retours') }}">
                                             <span class="sub-item">Mes retours </span>
                                         </a>
                                     </li>
                                 </ul>
                             </div>
                         </li>


                         <li class="nav-item">
                             <a data-bs-toggle="collapse" href="#paimnt_str">
                                 <i class="fas fa-dollar-sign" ></i>
                                 <p> Paiements </p>
                                 <span class="caret"></span>
                             </a>
                             <div class="collapse" id="paimnt_str">
                                 <ul class="nav nav-collapse">
                                     <li>
                                         <a href="{{ route('ajouter_paiement_page') }}">
                                             <span class="sub-item">Ajouter un Paiement</span>
                                         </a>
                                     </li>
                                     
                                 </ul>
                             </div>
                         </li>


                     </ul>
                 </div>
             </div>
         </div>
         {{-- End commercial Sidebar --}}
     @break
 @endswitch
