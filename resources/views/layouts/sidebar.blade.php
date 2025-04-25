{{-- @section('sidebar')
  <aside class="main-sidebar sidebar-dark-primary elevation-4 "> 
    <a href="#" class="brand-link d-flex justify-content-center align-items-center">
      <img src="{{ asset ('/frontend')}}/dist/img/prepa-fp.png" alt="Prepa FP Logo" style="opacity: .8;">
    </a>

    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset ('/frontend')}}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->lname }}</a>
        </div>
      </div>

      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ route('frontend.admin-dashboard') }}" class="nav-link {{ request()->routeIs('frontend.admin-dashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Tableau de bord</p>
            </a>
          </li>
          <li class="nav-item sidebar-color">
            <a href="{{ route('frontend.ecole') }}" class="nav-link {{ request()->routeIs('frontend.ecole') ? 'active' : '' }}">
              <i class="nav-icon fas fa-school"></i>
              <p>Gestion des écoles</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('frontend.cours') }}" class="nav-link {{ request()->routeIs('frontend.cours') ? 'active' : '' }}">
              <i class="nav-icon fas fa-chalkboard-teacher"></i>
              <p>Gestion des cours</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('frontend.subject') }}" class="nav-link {{ request()->routeIs('frontend.subject') ? 'active' : '' }}">
              <i class="nav-icon fas fa-book"></i>
              <p>Gestion des matières </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('frontend.cycle') }}" class="nav-link {{ request()->routeIs('frontend.cycle') ? 'active' : '' }}">
              <i class="nav-icon fas fa-layer-group"></i>
              <p>Gestion des cycles</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('frontend.type') }}" class="nav-link {{ request()->routeIs('frontend.type') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tags"></i>
              <p>Types</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('frontend.question') }}" class="nav-link {{ request()->routeIs('frontend.question') ? 'active' : '' }}">
              <i class="nav-icon fas fa-question-circle"></i>
              <p>Questions</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('frontend.reponse') }}" class="nav-link {{ request()->routeIs('frontend.reponse') ? 'active' : '' }}">
              <i class="nav-icon fas fa-reply"></i>
              <p>Réponses</p>
            </a>
          </li>
          <li class="nav-item  ">
            <a href="{{ route('frontend.test') }}" class="nav-link {{ request()->routeIs('frontend.test') ? 'active' : '' }}">
              <i class="nav-icon fas fa-vial"></i>
              <p>Gestion des tests</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('frontend.abonnement') }}" class="nav-link {{ request()->routeIs('frontend.abonnement') ? 'active' : '' }}">
              <i class="nav-icon fas fa-credit-card"></i>
              <p>Abonnements</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('frontend.role') }}" class="nav-link {{ request()->routeIs('frontend.role') ? 'active' : '' }}">
              <i class="nav-icon fas fa-id-badge"></i>
              <p>Role</p>
            </a>
          </li>                      
          <li class="nav-item">
            <a href="{{ route('frontend.utilisateur') }}" class="nav-link {{ request()->routeIs('frontend.utilisateur') ? 'active' : '' }}">
              <i class="nav-icon fas fa-user"></i>
              <p>Utilisateurs</p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="{{ route('frontend.tentative') }}" class="nav-link {{ request()->routeIs('frontend.tentative') ? 'active' : '' }}">
              <i class="nav-icon fas fa-hourglass-start"></i>
              <p>Résultats & Tentatives</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('frontend.chapitre') }}" class="nav-link {{ request()->routeIs('frontend.chapitre') ? 'active' : '' }}">
              <i class="nav-icon fas fa-chalkboard"></i>
              <p>Chapitres</p>
            </a>
          </li>            
          <li class="nav-item">
            <a href="{{ route('frontend.plan') }}" class="nav-link {{ request()->routeIs('frontend.plan') ? 'active' : '' }}">
              <i class="nav-icon fas fa-crown"></i>
              <p>Plans d’abonnement</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                    Déconnexion
                </p>
            </a>
            
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
          <li class="nav-item">
            <a href="{{ route('frontend.resume') }}" class="nav-link {{ request()->routeIs('frontend.resume') ? 'active' : '' }}">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>Résumés</p>
            </a>
          </li>             
        </ul>
      </nav>
    </div>
  </aside>


@endsection --}}

@section('sidebar')
<div class="sidebar">
  {{-- <div class="mb-4 text-center">
    <img src="ton-logo.png" alt="Logo" class="img-fluid" style="height: 80px;">
  </div> --}}

  <ul class="nav flex-column">
    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('frontend.admin-dashboard') ? 'active' : '' }}" href="{{ route('frontend.admin-dashboard') }}"><i class="bi bi-grid-fill"></i> Accueil</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#"><i class="bi bi-bar-chart"></i> Performances</a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('frontend.ecole') ? 'active' : '' }}" href="{{ route('frontend.ecole') }}"><i class="bi bi-mortarboard"></i> Ecoles</a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('frontend.cours') ? 'active' : '' }}" href="{{ route('frontend.cours') }}"><i class="bi bi-journal-text"></i> Cours</a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('frontend.subject') ? 'active' : '' }}" href="{{ route('frontend.subject') }}"><i class="bi bi-journal-richtext"></i> Matières</a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('frontend.cycle') ? 'active' : '' }}" href="{{ route('frontend.cycle') }}"><i class="bi bi-building"></i> Cycles</a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('frontend.type') ? 'active' : '' }}" href="{{ route('frontend.type') }}"><i class="bi bi-file-earmark-check"></i> Types</a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('frontend.test') ? 'active' : '' }}" href="{{ route('frontend.test') }}"><i class="bi bi-person-vcard"></i> Tests</a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('frontend.role') ? 'active' : '' }}" href="{{ route('frontend.role') }}"><i class="bi bi-person-gear"></i> Roles</a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('frontend.abonnement') ? 'active' : '' }}" href="{{ route('frontend.abonnement') }} "><i class="bi bi-credit-card-2-front"></i> Abonnement</a>
    </li>
    
    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('frontend.utilisateur') ? 'active' : '' }}" href="{{ route('frontend.utilisateur') }}"><i class="bi bi-people "></i> Utilisateurs</a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('frontend.tentative') ? 'active' : '' }}" href="{{ route('frontend.tentative') }}"><i class="bi bi-hourglass-top"></i> Tentatives</a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('frontend.plan') ? 'active' : '' }}" href="{{ route('frontend.plan') }}"><i class="bi bi-box-seam"></i> Plans</a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('frontend.actualite') ? 'active' : '' }}" href="{{ route('frontend.actualite') }}"><i class="bi bi-box-seam"></i> Actualité</a>
    </li>
    <li class="nav-item">
      <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
        <i class="bi bi-box-arrow-right"></i> 
              Déconnexion
      </a>  
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
      </form>
    </li>
  </ul>
</div>
@endsection