@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')


@section('body')
<!-- Section pour la liste des tests -->
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow rounded">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Liste des tests</h5>
                    {{-- <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addTestModal" id="btn-color">
                        <i class="fas fa-plus"></i> Ajouter un test
                    </button> --}}
                    <a href="{{ route('test.create') }}" class="btn btn-primary btn-sm" id="btn-color">
                        <i class="fas fa-plus"></i> Ajouter un test
                    </a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-center">
                            <thead class="thead-light">
                                <tr>
                                    <th>Titre</th>
                                    <th>Type de test</th>
                                    <th>Durée</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tests as $test)
                                    <tr>
                                        <td>{{ $test->title }}</td>
                                        <td>{{ $test->type->title }}</td>
                                        <td>{{ $test->time }}</td>
                                        <td class="d-flex justify-content-center align-items-center">
                                            <a href="{{ route('test.show', $test->id) }}" class="mx-1 text-success">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('test.edit', $test->id) }}" class="mx-1 text-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form id="delete-form-{{ $test->id }}" method="POST"
                                                  action="{{ route('test.destroy', $test->id) }}"
                                                  onsubmit="return confirm('Voulez-vous vraiment supprimer ce test ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link p-0 mx-1 text-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>


<!-- Modal pour ajouter un test -->
<div class="modal fade" id="addTestModal" tabindex="-1" role="dialog" aria-labelledby="addTestModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="addTestModalLabel">Ajouter un test</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body pt-0">
                <form action="{{ route('test.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label fw-semibold">Titre du test :</label>
                        <input type="text" id="title" name="title" class="form-control rounded-pill shadow-sm" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="type_id" class="form-label fw-semibold">Type de test :</label>
                            <select id="type_id" name="type_id" class="form-select rounded-pill shadow-sm" required>
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    
                        <div class="col-md-6 mb-3">
                            <label for="time" class="form-label fw-semibold">Durée (en minutes) :</label>
                            <input type="number" id="time" name="time" class="form-control rounded-pill shadow-sm" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="course_id" class="form-label fw-semibold">Cours :</label>
                            <select id="course_id" name="course_id" class="form-select rounded-pill shadow-sm">
                                <option value="">-- Aucun --</option> <!-- Option vide facultative -->
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>                    

                    <div class="mb-4">
                        <label class="form-label fw-bold">Questions :</label>
                        <div id="questions-container">
                            <div class="question-item border rounded p-3 mb-3" data-index="0">
                                <input name="questions[0][question]" class="form-control mb-2" placeholder="Question" required>
                                <input name="questions[0][tag]" class="form-control mb-2" placeholder="Tag (optionnel)">
                                <label class="fw-semibold">Réponses :</label>
                                <div class="answers-container">
                                    <div class="answer-item d-flex gap-2 align-items-center mb-2">
                                        <input type="text" name="questions[0][answers][0][content]" class="form-control" placeholder="Réponse" required>
                                        <select name="questions[0][answers][0][is_correct]" class="form-select w-auto">
                                            <option value="0">Faux</option>
                                            <option value="1">Vrai</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-success add-answer mt-2">
                                    <i class="fas fa-plus me-1"></i>Ajouter une réponse
                                </button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-primary add-question mt-2">
                            <i class="fas fa-plus-circle me-1"></i>Ajouter une question
                        </button>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-success rounded-pill px-4">
                            <i class="fas fa-check me-1"></i> Enregistrer le test
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal pour afficher les détails du test -->
<div class="modal fade" id="testDetailsModal" tabindex="-1" role="dialog" aria-labelledby="testDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="testDetailsModalLabel">Détails du test</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="testDetailsContent">
                <!-- Les informations du sujet seront insérées ici via AJAX -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" defer></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        // Assure-toi que le bouton ouvre le modal
        $('a[data-toggle="modal"]').click(function (event) {
            event.preventDefault();

            var subjectId = $(this).data('test-id'); // ID du sujet depuis le bouton
            var modal = $('#testDetailsModal'); // Assure-toi d'utiliser l'ID correct pour ton modal

            $.ajax({
                url: '/tests/' + subjectId + '/details',  // URL de la route pour récupérer les détails du test
                method: 'GET',
                success: function (data) {
                    console.log("Données reçues:", data); // Vérifie les données reçues dans la console

                    var content = '<p><strong>Titre du test:</strong> ' + data.title + '</p>';
                    content += '<p><strong>Type associé:</strong> ' + (data.type ? data.type.title : 'Aucun type associé') + '</p>';
                    content += '<p><strong>Durée:</strong> ' + data.time + ' minutes</p>';
                    content += '<p><strong>Questions:</strong></p><ul>';

                    if (data.questions && data.questions.length > 0) {
                        data.questions.forEach(function (question, index) {
                            content += '<li><strong>Question ' + (index + 1) + ':</strong> ' + question.question + '<ul>';
                            if (question.answers && question.answers.length > 0) {
                                question.answers.forEach(function (answer) {
                                    content += '<li>' + answer.content + ' (' + (answer.is_correct ? 'Correct' : 'Faux') + ')</li>';
                                });
                            } else {
                                content += '<li>Aucune réponse disponible</li>';
                            }
                            content += '</ul></li>';
                        });
                    } else {
                        content += '<li>Aucune question disponible</li>';
                    }
                    content += '</ul>';

                    // Insère le contenu dans le modal
                    modal.find('#testDetailsContent').html(content);

                    // Ouvre le modal
                    modal.modal('show');
                },
                error: function (xhr) {
                    console.error("Erreur AJAX:", xhr.responseText);
                    $('#testDetailsContent').html('<p>Une erreur s\'est produite lors du chargement des détails du test.</p>');
                }
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Ajouter une nouvelle question
        document.querySelector('.add-question').addEventListener('click', function () {
            const questionCount = document.querySelectorAll('.question-item').length;
            const container = document.querySelector('#questions-container');
            const questionDiv = document.createElement('div');
            questionDiv.classList.add('question-item', 'border', 'rounded', 'p-3', 'mb-3');
            questionDiv.setAttribute('data-index', questionCount);
    
            questionDiv.innerHTML = `
                <input name="questions[${questionCount}][question]" class="form-control mb-2" placeholder="Question" required>
                <input name="questions[${questionCount}][tag]" class="form-control mb-2" placeholder="Tag (optionnel)">
                <label class="fw-semibold">Réponses :</label>
                <div class="answers-container">
                    <div class="answer-item d-flex gap-2 align-items-center mb-2">
                        <input type="text" name="questions[${questionCount}][answers][0][content]" class="form-control" placeholder="Réponse" required>
                        <select name="questions[${questionCount}][answers][0][is_correct]" class="form-select w-auto">
                            <option value="0">Faux</option>
                            <option value="1">Vrai</option>
                        </select>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-outline-success add-answer mt-2">
                    <i class="fas fa-plus me-1"></i>Ajouter une réponse
                </button>
            `;
    
            container.appendChild(questionDiv);
        });
    
        // Ajouter une réponse
        document.addEventListener('click', function (e) {
            if (e.target.closest('.add-answer')) {
                const questionItem = e.target.closest('.question-item');
                const questionIndex = questionItem.getAttribute('data-index');
                const answersContainer = questionItem.querySelector('.answers-container');
                const answerCount = answersContainer.querySelectorAll('.answer-item').length;
    
                const answerDiv = document.createElement('div');
                answerDiv.classList.add('answer-item', 'd-flex', 'gap-2', 'align-items-center', 'mb-2');
                answerDiv.innerHTML = `
                    <input type="text" name="questions[${questionIndex}][answers][${answerCount}][content]" class="form-control" placeholder="Réponse" required>
                    <select name="questions[${questionIndex}][answers][${answerCount}][is_correct]" class="form-select w-auto">
                        <option value="0">Faux</option>
                        <option value="1">Vrai</option>
                    </select>
                `;
                answersContainer.appendChild(answerDiv);
            }
        });
    });
</script>
    
    <style>
        #btn-color{
            background: #6c63ff !important;
        }
        
    </style>
@endsection

@extends('layouts.footer')
@extends('layouts.script')


