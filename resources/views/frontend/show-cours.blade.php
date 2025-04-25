@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')

@section('body')
<div class="container-fluid px-0"> <!-- px-0 enlève les padding horizontaux -->
    <div class="row mx-0"> <!-- mx-0 enlève les marges horizontales -->
        <div class="col-12">
            <div class="card mb-4 shadow-sm rounded-0"> <!-- rounded-0 pour supprimer les arrondis si besoin -->
                <div class="card-header text-white" id="card-header">
                    <h4 class="mb-0">Détails du Cours</h4>
                </div>
                <div class="card-body">
                    <p><strong>Titre du cours :</strong> {{ $course->title }}</p>
                    <p><strong>Description du cours : </strong>{!! nl2br(e($course->content)) !!}</p>

                    <hr>

                    <h5 class="text-secondary">Chapitres</h5> 
                    @if($course->chapters->count() > 0)
                        <ul class="list-group">
                            @foreach($course->chapters as $chapter)
                                <li class="list-group-item">
                                    <strong>Titre du chapitre: </strong>{{ $chapter->title }}<br>
                                    <strong>Description du chapitre: </strong>{!! nl2br(e($chapter->chapter_description)) !!} <br>

                                    <strong>Résumé du Chapitre :</strong>
                                    @if($chapter->summary)
                                        {!! nl2br(e($chapter->summary->summary_description)) !!}
                                    @else
                                        <em>Aucun résumé disponible pour ce chapitre.</em>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p><em>Aucun chapitre ajouté pour ce cours.</em></p>
                    @endif

                    <a href="{{ route('frontend.cours') }}" class="btn btn-outline-primary mt-4" style="background-color: #6c63ff; color: white;">
                        ← Retour à la liste des cours
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
