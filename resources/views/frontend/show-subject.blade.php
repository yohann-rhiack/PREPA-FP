@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')

@section('body')
<div class="container-fluid px-0"> <!-- Supprime les padding horizontaux -->
    <div class="row justify-content-center mx-0"> <!-- Centre le contenu -->
        <div class="col-12 col-md-10 col-lg-8"> <!-- Largeur adaptative -->
            <div class="card mb-4 shadow-sm rounded-0">
                <div class="card-header text-white" id="card-header">
                    <h3 class="card-title">Détails de la Matière</h3>
                </div>
                <div class="card-body">
                    <h2>{{ $subjects->title }}</h2>
                    <p><strong>Description :</strong> {{ $subjects->description }}</p>

                    <h3>Cours associés :</h3>
                    <ul class="list-group">
                        @foreach($subjects->courses as $course)
                            <li class="list-group-item">
                                <strong>{{ $course->title }}</strong><br>
                                <span>Description : {{ $course->content }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <a href="{{ route('frontend.subject') }}" class="btn btn-outline-primary mt-4" style="background-color: #6c63ff; color: white;">
                        ← Retour à la liste des matières
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
