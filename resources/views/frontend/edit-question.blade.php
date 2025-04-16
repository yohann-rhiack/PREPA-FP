@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')

@section('body')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Modifier la Question</h3>
                </div>
                <div class="card-body">
                    <!-- Formulaire d'édition de la question -->
                    <form action="{{ route('quiz.update', $question->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="question">Question</label>
                                    <textarea id="question" name="question" class="form-control" rows="4" required>{{ old('question', $question->question) }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="tag">Tag (facultatif)</label>
                                    <input type="text" id="tag" name="tag" class="form-control" value="{{ old('tag', $question->tag) }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Bouton pour mettre à jour la question -->
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success w-100">Mettre à Jour</button>
                            </div>

                            <!-- Bouton pour retourner à la liste des questions -->
                            <div class="col-md-6">
                                <a href="{{ route('frontend.question') }}" class="btn btn-secondary w-100">Retour à la Liste</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@extends('layouts.footer')
@extends('layouts.script')
