@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')

@section('body')
<div class="container-fluid px-0"> <!-- Enlève le padding horizontal -->
    <div class="row justify-content-center mx-0"> <!-- Centre horizontalement -->
        <div class="col-12 col-md-10 col-lg-8"> <!-- Adaptatif : largeurs différentes selon la taille d'écran -->
            <div class="card mb-4 shadow-sm rounded-0">
                <div class="card-header text-white" id="card-header">
                    <h3 class="card-title">Détails du Cycle</h3>
                </div>
                <div class="card-body">
                    <h2>{{ $cycle->name }}</h2>
                    <p><strong>Description :</strong> {{ $cycle->description }}</p>
                    <p><strong>Ecole :</strong> {{ $cycle->school->name ?? 'Non défini' }}</p>

                    <h3>Matières associées :</h3>
                    <ul class="list-group">
                        @foreach($cycle->subjects as $subject)
                            <li class="list-group-item">
                                <strong>{{ $subject->title }}</strong> – {{ $subject->description }}
                            </li>
                        @endforeach
                    </ul>

                    <a href="{{ route('frontend.cycle') }}" class="btn btn-outline-primary mt-4" style="background-color: #6c63ff; color: white;">
                        ← Retour à la liste des cycles
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
