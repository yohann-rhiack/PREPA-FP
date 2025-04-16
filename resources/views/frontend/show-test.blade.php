@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')

@section('body')
<!-- section pour afficher les détails du test -->
<div class="content">
    <div class="container-fluid"> 
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Détails du test</h2>
            </div>
            <div class="card-body">
                <p><strong>Titre :</strong> {{ $test->title }}</p>
                <p><strong>Type :</strong> {{ $test->type->title ?? 'Non défini' }}</p>
                <p><strong>Durée :</strong> {{ $test->time }} minutes</p>
                <h3>Questions :</h3>

                @if($test->quizzes->isEmpty())
                    <p><em>Aucune question disponible pour ce test.</em></p>
                @else
                    <ul>
                        @foreach($test->quizzes as $quiz)
                            <li>
                                <strong>{{ $quiz->question }}</strong> (Tag: {{ $quiz->tag ?? 'N/A' }})
                                <ul>
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
                

                <a href="{{ route('frontend.test') }}" class="btn btn-primary">Retour</a>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.footer')
@extends('layouts.script')
