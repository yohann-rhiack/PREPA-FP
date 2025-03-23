@section('sidebar')
    <aside class="main-sidebar sidebar-dark-primary elevation-4"> 
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="{{ asset ('/frontend')}}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="{{ asset ('/frontend')}}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">Alexander Pierce</a>
          </div>
        </div>

        <!-- SidebarSearch Form -->
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

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            {{-- <li class="nav-item menu-open">
              <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Tableau de bord
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Active Page</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Inactive Page</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Simple Link
                  <span class="right badge badge-danger">New</span>
                </p>
              </a> --}}
            </li>
            <li class="nav-item">
              <a href="{{ route('frontend.ecole')}}" class="nav-link">
                <i class="nav-icon fas fa-school"></i>
                <p>
                  Ecole
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('frontend.cours')}}" class="nav-link">
                <i class="nav-icon fas fa-chalkboard-teacher"></i>
                <p>
                  Cours
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('frontend.cycle')}}" class="nav-link">
                <i class="nav-icon fas fa-layer-group"></i>
                <p>
                  Cycles
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('frontend.subject')}}" class="nav-link">
                <i class="nav-icon fas fa-book-open"></i>
                <p>
                  Sujets
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('frontend.type')}}" class="nav-link">
                <i class="nav-icon fas fa-book-open"></i>
                <p>
                  Types
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('frontend.abonnement')}}" class="nav-link">
                <i class="nav-icon fas fa-book-open"></i>
                <p>
                  Souscriptions
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Utilisateurs
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('frontend.reponse')}}" class="nav-link">
                <i class="nav-icon fas fa-reply"></i>
                <p>
                  Réponses
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('frontend.tentative')}}"" class="nav-link">
                <i class="nav-icon fas fa-hourglass-start"></i>
                <p>
                  Tentatives
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('frontend.chapitre')}}" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  Chapitres
                </p>
              </a>
            </li>
            
            <li class="nav-item">
              <a href="{{ route('frontend.plan')}}" class="nav-link">
                <i class="nav-icon fas fa-crown"></i>
                <p>
                  Plans
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('frontend.question')}}" class="nav-link">
                <i class="nav-icon fas fa-question-circle"></i>
                <p>
                  Questions
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('frontend.resume')}}" class="nav-link">
                <i class="nav-icon fas fa-book-open"></i>
                <p>
                  Résumés
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('frontend.test')}}" class="nav-link">
                <i class="nav-icon fas fa-book-open"></i>
                <p>
                  Tests
                </p>
              </a>
            </li>
          </ul>
        </nav>

        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
@endsection