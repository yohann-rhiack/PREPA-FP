@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')

@section('body')
<div class="content">
    <div class="container-fluid"> 
        <div class="card">
            {{-- <div class="card-header">
                <h3 class="card-title">Détails du cours</h3>
            </div> --}}
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Détails du Cours</h4>
                </div>
                <div class="card-body">
                    <p><strong>Titre du cours :</strong> {{ $course->title }}</p>
                    <p><strong>Description du cours : </strong>{!! nl2br(e($course->content)) !!}</p>
            
                    {{-- <hr>
            
                    <h5 class="text-secondary">Résumé du Cours :</h5>
                    <div>
                        @if($course->summary)
                            {!! nl2br(e($course->summary->summary_description)) !!}
                        @else
                            <em>Aucun résumé disponible pour ce cours.</em>
                        @endif
                    </div> --}}
            
                    <hr>
            
                    <h5 class="text-secondary">Chapitres</h5> 
                    @if($course->chapters->count() > 0)
                        <ul class="list-group">
                            @foreach($course->chapters as $chapter)
                                <li class="list">
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
            
                    <a href="{{ route('frontend.cours') }}" class="btn btn-outline-primary mt-4">
                        ← Retour à la liste des cours
                    </a>
                </div>
            </div>
            
        </div>
    </div>
</div>

@endsection

@extends('layouts.footer')
@extends('layouts.script')
