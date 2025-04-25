@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')

@section('body')
<!-- section pour afficher les détails du test -->
<div class="container-fluid px-0">
    <div class="row justify-content-center mx-0"> <!-- Centre horizontalement -->
        <div class="col-12 col-md-10 col-lg-8"> <!-- Largeur adaptée -->
            <div class="card mb-4 shadow-sm rounded-0">
                <div class="card-header bg-primary text-white" id="card-header">
                    <h2 class="card-title mb-0">Détails du test</h2>
                </div>
                <div class="card-body">
                    <p><strong>Titre :</strong> {{ $test->title }}</p>
                    <p><strong>Type :</strong> {{ $test->type->title ?? 'Non défini' }}</p>
                    <p><strong>Durée :</strong> {{ $test->time }} minutes</p>
                    @if($test->course)
                        <p><strong>Cours :</strong> {{ $test->course->title }}</p>
                    @endif

                    <h3>Questions :</h3>
                    @if($test->quizzes->isEmpty())
                        <p><em>Aucune question disponible pour ce test.</em></p>
                    @else
                        <ul class="list-group">
                            @foreach($test->quizzes as $quiz)
                                <li class="list-group-item">
                                    <strong>{{ $quiz->question }}</strong> (Tag: {{ $quiz->tag ?? 'N/A' }})
                                    <ul class="mt-2">
                                        @foreach($quiz->answers as $answer)
                                            <li>
                                                {{ $answer->content }} - 
                                                @if($answer->is_correct)
                                                    <span class="text-success">Correct</span>
                                                @else
                                                    <span class="text-danger">Incorrect</span>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <a href="{{ route('frontend.test') }}" class="btn btn-outline-primary mt-4" style="background-color: #6c63ff; color: white;">
                        ← Retour à la liste des tests
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
