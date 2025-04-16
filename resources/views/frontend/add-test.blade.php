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
                <h3 class="card-title">Ajouter un test</h3>
            </div>
            <div class="card-body">
                <form action="/tests" method="POST">
                    <div class="form-group">
                        <label for="title">Titre du test :</label>
                        <input type="text" id="title" name="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="type_id">Type de test :</label>
                        <select id="type_id" name="type_id" class="form-control" required>
                            <!-- Les options seront remplies dynamiquement avec les types de tests existants -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="time">Durée (en minutes) :</label>
                        <input type="number" id="time" name="time" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Questions :</label>
                        <div id="questions-container">
                            <div class="question-item">
                                <input type="text" name="questions[0][text]" class="form-control mb-2" placeholder="Question" required>
                                <input type="text" name="questions[0][tag]" class="form-control mb-2" placeholder="Tag (optionnel)">
                                <label>Réponses :</label>
                                <div class="answers-container">
                                    <div class="answer-item">
                                        <input type="text" name="questions[0][answers][0][text]" class="form-control mb-2" placeholder="Réponse" required>
                                        <input type="text" name="questions[0][answers][0][tag]" class="form-control mb-2" placeholder="Tag (optionnel)">
                                        <select name="questions[0][answers][0][is_correct]" class="form-control mb-2">
                                            <option value="1">Vrai</option>
                                            <option value="0">Faux</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-sm btn-success add-answer">Ajouter une réponse</button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-primary add-question mt-2">Ajouter une question</button>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">
                            Ajouter le test
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.footer')
@extends('layouts.script')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let questionIndex = 0;

        document.querySelector('.add-question').addEventListener('click', function () {
            questionIndex++;
            const questionItem = document.createElement('div');
            questionItem.classList.add('question-item', 'mt-3');
            questionItem.innerHTML = `
                <input type="text" name="questions[${questionIndex}][text]" class="form-control mb-2" placeholder="Question" required>
                <input type="text" name="questions[${questionIndex}][tag]" class="form-control mb-2" placeholder="Tag (optionnel)">
                <label>Réponses :</label>
                <div class="answers-container">
                    <div class="answer-item">
                        <input type="text" name="questions[${questionIndex}][answers][0][text]" class="form-control mb-2" placeholder="Réponse" required>
                        <input type="text" name="questions[${questionIndex}][answers][0][tag]" class="form-control mb-2" placeholder="Tag (optionnel)">
                        <select name="questions[${questionIndex}][answers][0][is_correct]" class="form-control mb-2">
                            <option value="1">Vrai</option>
                            <option value="0">Faux</option>
                        </select>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-success add-answer">Ajouter une réponse</button>
            `;
            document.getElementById('questions-container').appendChild(questionItem);

            questionItem.querySelector('.add-answer').addEventListener('click', function () {
                const answerIndex = questionItem.querySelectorAll('.answer-item').length;
                const answerItem = document.createElement('div');
                answerItem.classList.add('answer-item', 'mt-2');
                answerItem.innerHTML = `
                    <input type="text" name="questions[${questionIndex}][answers][${answerIndex}][text]" class="form-control mb-2" placeholder="Réponse" required>
                    <input type="text" name="questions[${questionIndex}][answers][${answerIndex}][tag]" class="form-control mb-2" placeholder="Tag (optionnel)">
                    <select name="questions[${questionIndex}][answers][${answerIndex}][is_correct]" class="form-control mb-2">
                        <option value="1">Vrai</option>
                        <option value="0">Faux</option>
                    </select>
                `;
                questionItem.querySelector('.answers-container').appendChild(answerItem);
            });
        });
    });
</script>
