@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')

@section('body')
<div class="container-fluid px-0">
    <div class="row justify-content-center mx-0"> <!-- Centre horizontalement -->
        <div class="col-12 col-md-10 col-lg-8"> <!-- Largeur adaptée -->
            <div class="card mb-4 shadow-sm rounded-0">
                <div class="card-header bg-primary text-white" id="card-header">
                    <h3 class="card-title mb-0">Détails utilisateur</h3>
                </div>
                <div class="card-body">
                    <h4><strong>Nom :</strong> {{ $users->fname }}</h4>
                    <h4><strong>Prénom :</strong> {{ $users->lname }}</h4>
                    <h4><strong>Téléphone :</strong> {{ $users->phone }}</h4>
                    <h4><strong>Email :</strong> {{ $users->email }}</h4>

                    <h4><strong>Rôle :</strong></h4>
                    <ul>
                        @if(!$users->role)
                            <li>Aucun rôle attribué</li>
                        @else
                            <li>{{ $users->role->title }}</li>
                        @endif
                    </ul>

                    <a href="{{ route('frontend.utilisateur') }}" class="btn btn-outline-primary mt-4" style="background-color: #6c63ff; color: white;">
                        ← Retour à la liste des utilisateurs
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    #card-header{
        background-color: #6c63ff !important; /* Couleur de fond */
        
    }
</style>

@endsection

@extends('layouts.footer')
@extends('layouts.script')
