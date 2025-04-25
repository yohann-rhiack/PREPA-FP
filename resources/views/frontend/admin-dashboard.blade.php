@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')


@section('body')
    <h1>Dashboard</h1>
    <div class="row mb-4">
      <div class="col-md-3">
        <div class="card shadow-sm">
          <div class="card-body text-center">
            <div class="card-icon icon-blue"><i class="bi bi-file-earmark-text-fill"></i></div> <!-- Icône pour les tests -->
            <p class="mt-3 mb-1">Nombre de tests</p>
            <h4>{{ $testsCount }}</h4>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card shadow-sm">
          <div class="card-body text-center">
            <div class="card-icon icon-red"><i class="bi bi-people-fill"></i></div> <!-- Icône pour les utilisateurs -->
            <p class="mt-3 mb-1">Nombre d'utilisateurs</p>
            <h4>{{ $usersCount }}</h4>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card shadow-sm">
          <div class="card-body text-center">
            <div class="card-icon icon-green"><i class="bi bi-card-checklist"></i></div> <!-- Icône pour les abonnements -->
            <p class="mt-3 mb-1">Nombre d'abonnements</p>
            <h4>{{ $subscriptionsCount }}</h4>
          </div>
        </div>
      </div>
      
      <div class="col-md-3">
        <div class="card shadow-sm">
          <div class="card-body text-center">
            <div class="card-icon icon-light-yellow"><i class="bi bi-question-circle-fill"></i></div> <!-- Icône pour les questions -->
            <p class="mt-3 mb-1">Nombre de questions</p>
            <h4>{{ $quizzesCount }}</h4>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <!-- Tes quiz -->
      <div class="col-md-4">
        <div class="card shadow-sm h-100">
          <div class="card-header fw-bold">Tes quiz</div>
          <div class="card-body text-center d-flex flex-column justify-content-center">
            <p>Gérez vos quiz et créez-en de nouveaux pour vos utilisateurs.</p>
            <a href="{{ route('frontend.test') }}" class="btn btn-primary" id="couleur-bouton">Créer un quiz</a> <!-- Lien vers la page des quiz -->
          </div>
        </div>
      </div>

      <!-- Matière -->
      <div class="col-md-4">
        <div class="card shadow-sm h-100">
          <div class="card-header fw-bold">Matière</div>
          <div class="card-body text-center d-flex flex-column justify-content-center">
            <p>Ajoutez ou modifiez les matières disponibles pour vos cours.</p>
            <a href="{{ route('frontend.subject') }}" class="btn btn-primary" id="couleur-bouton">Gérer les matières</a> <!-- Lien vers la page des matières -->
          </div>
        </div>
      </div>

      <!-- Cours -->
      <div class="col-md-4">
        <div class="card shadow-sm h-100">
          <div class="card-header fw-bold">Cours</div>
          <div class="card-body text-center d-flex flex-column justify-content-center">
            <p>Ajoutez de nouveaux cours ou gérez les cours existants pour vos utilisateurs.</p>
            <a href="{{ route('frontend.cours') }}" class="btn btn-primary" id="couleur-bouton">Ajouter un cours</a> <!-- Lien vers la page des cours -->
          </div>
        </div>
      </div>
    </div>

    <style>
      #couleur-bouton {
        background-color: #6c63ff; /* Couleur de fond */
        color: white; /* Couleur du texte */

      }
    </style>
@endsection

@extends('layouts.footer')
@extends('layouts.script')
