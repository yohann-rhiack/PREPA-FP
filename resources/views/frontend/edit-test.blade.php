@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')

@section('body')
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Modifier le test</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('test.update', $test->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">Titre du test :</label>
                        <input type="text" id="title" name="title" class="form-control" value="{{ $test->title }}" required>
                    </div>
                    <div class="form-group">
                        <label for="type_id">Type de test :</label>
                        <select id="type_id" name="type_id" class="form-control" required>
                            @foreach($types ?? [] as $type)
                                <option value="{{ $type->id }}" {{ $test->type_id == $type->id ? 'selected' : '' }}>
                                    {{ $type->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="time">Durée (en minutes) :</label>
                        <input type="number" id="time" name="time" class="form-control" value="{{ $test->time }}" required>
                    </div>
                    <div class="form-group">
                        <label>Questions :</label>
                        <div id="questions-container">
                            @foreach($test->quizzes as $index => $quiz)
                                <div class="question-item mb-3" data-index="{{ $index }}">
                                    <input name="questions[{{ $index }}][question]" class="form-control mb-2" placeholder="Question" value="{{ $quiz->question }}" required>
                                    <input name="questions[{{ $index }}][tag]" class="form-control mb-2" placeholder="Tag (optionnel)" value="{{ $quiz->tag }}">
                                    <label>Réponses :</label>
                                    <div class="answers-container">
                                        @foreach($quiz->answers as $answerIndex => $answer)
                                            <div class="answer-item mb-2">
                                                <input type="text" name="questions[{{ $index }}][answers][{{ $answerIndex }}][content]" class="form-control mb-2" placeholder="Réponse" value="{{ $answer->content }}" required>
                                                <select name="questions[{{ $index }}][answers][{{ $answerIndex }}][is_correct]" class="form-control mb-2">
                                                    <option value="0" {{ !$answer->is_correct ? 'selected' : '' }}>Faux</option>
                                                    <option value="1" {{ $answer->is_correct ? 'selected' : '' }}>Vrai</option>
                                                </select>
                                                @if($loop->last && !$loop->first)
                                                    <button type="button" class="btn btn-sm btn-danger remove-answer">Supprimer la réponse</button>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                    @if($loop->last)
                                        <button type="button" class="btn btn-sm btn-success add-answer">Ajouter une réponse</button>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-sm btn-primary add-question mt-2">Ajouter une question</button>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Mettre à jour le test</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Ajouter une nouvelle question
        const addQuestionButton = document.querySelector('.add-question');
        addQuestionButton.addEventListener('click', function () {
            const questionCount = document.querySelectorAll('.question-item').length;
            const questionContainer = document.querySelector('#questions-container');
            const newQuestion = document.createElement('div');
            newQuestion.classList.add('question-item', 'mb-3');
            newQuestion.setAttribute('data-index', questionCount);

            newQuestion.innerHTML = `
                <input name="questions[${questionCount}][question]" class="form-control mb-2" placeholder="Question" required>
                <input name="questions[${questionCount}][tag]" class="form-control mb-2" placeholder="Tag (optionnel)">
                <label>Réponses :</label>
                <div class="answers-container">
                    <div class="answer-item mb-2">
                        <input type="text" name="questions[${questionCount}][answers][0][content]" class="form-control mb-2" placeholder="Réponse" required>
                        <select name="questions[${questionCount}][answers][0][is_correct]" class="form-control mb-2">
                            <option value="0">Faux</option>
                            <option value="1">Vrai</option>
                        </select>
                        <button type="button" class="btn btn-sm btn-danger remove-answer">Supprimer la réponse</button>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-success add-answer">Ajouter une réponse</button>
                <button type="button" class="btn btn-sm btn-danger remove-question mt-2">Supprimer la question</button>
            `;
            questionContainer.appendChild(newQuestion);
        });

        // Ajouter une nouvelle réponse à une question existante
        document.addEventListener('click', function (e) {
            if (e.target && e.target.classList.contains('add-answer')) {
                const questionItem = e.target.closest('.question-item');
                const questionIndex = questionItem.getAttribute('data-index');
                const answerCount = questionItem.querySelectorAll('.answer-item').length;
                const answersContainer = questionItem.querySelector('.answers-container');
                const newAnswer = document.createElement('div');
                newAnswer.classList.add('answer-item', 'mb-2');

                newAnswer.innerHTML = `
                    <input type="text" name="questions[${questionIndex}][answers][${answerCount}][content]" class="form-control mb-2" placeholder="Réponse" required>
                    <select name="questions[${questionIndex}][answers][${answerCount}][is_correct]" class="form-control mb-2">
                        <option value="0">Faux</option>
                        <option value="1">Vrai</option>
                    </select>
                    <button type="button" class="btn btn-sm btn-danger remove-answer">Supprimer la réponse</button>
                `;
                answersContainer.appendChild(newAnswer);
            }
        });

        // Supprimer une réponse
        document.addEventListener('click', function (e) {
            if (e.target && e.target.classList.contains('remove-answer')) {
                const answerItem = e.target.closest('.answer-item');
                answerItem.remove();
            }
        });

        // Supprimer une question
        document.addEventListener('click', function (e) {
            if (e.target && e.target.classList.contains('remove-question')) {
                const questionItem = e.target.closest('.question-item');
                questionItem.remove();
            }
        });
    });
</script>
@endsection

@extends('layouts.footer')
@extends('layouts.script')
