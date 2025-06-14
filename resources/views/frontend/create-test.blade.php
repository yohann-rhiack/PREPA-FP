{{-- @extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')

@section('body')
<div class="content">
    <div class="container-fluid">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title mb-0">Ajouter un test</h3>
            </div>
            <div class="card-body">
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
                                <option value="">-- Aucun --</option>
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
                                    <i class="fas fa-plus me-1"></i> Ajouter une réponse
                                </button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-primary add-question mt-2">
                            <i class="fas fa-plus-circle me-1"></i> Ajouter une question
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
@endsection

@extends('layouts.footer')
@extends('layouts.script')

{{-- 
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Créateur de Quiz</title>
    <style>
      body {
        margin: 0;
        font-family: "Segoe UI", sans-serif;
        display: flex;
        flex-direction: column;
        height: 100vh;
      }

      header {
        background-color: #5f4cc6;
        color: white;
        padding: 10px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
      }

      header .actions button {
        background-color: white;
        color: #5f4cc6;
        border: none;
        padding: 8px 14px;
        border-radius: 6px;
        margin-left: 10px;
        cursor: pointer;
        font-weight: bold;
      }

      .container {
        display: flex;
        flex: 1;
      }

      .sidebar {
        width: 250px;
        background-color: #f4f4f4;
        padding: 15px;
        border-right: 1px solid #ccc;
        overflow-y: auto;
      }

      .question-item {
        background-color: white;
        border: 1px solid #ccc;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 6px;
      }

      .question-item:hover {
        background-color: #eaeaea;
      }

      .add-btn {
        background-color: #5f4cc6;
        color: white;
        padding: 10px;
        border: none;
        border-radius: 6px;
        width: 100%;
        font-weight: bold;
        cursor: pointer;
      }

      .content {
        flex: 1;
        padding: 20px;
        background-color: #6a5ae0;
      }

      .content input[type="text"],
      .content textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border-radius: 6px;
        border: 1px solid #ccc;
        font-size: 16px;
        padding-top: 20px;
        padding-bottom: 20px;
      }

      .answers {
        display: grid;
        grid-template-columns: 1fr 1fr;
        column-gap: 60px;
        row-gap: 15px;
        margin-top: 20px;
        padding: 0 10px;
      }

      .answers input {
        background-color: white;
        padding: 12px;
        margin-bottom: 10px;
        border-radius: 6px;
        border: 1px solid #ccc;
      }

      .upload-box {
        background-color: #d6d1f5;
        padding: 20px;
        text-align: center;
        border: 2px dashed #999;
        border-radius: 10px;
        margin-bottom: 20px;
      }

      .upload-box input {
        display: none;
      }

      #questionTitle {
        width: 98%;
        margin-right: 10px;
        margin-left: 10px;
      }
    </style>
  </head>
  <body>
    <header>
      <div><strong>Nom de quiz</strong></div>
      <div class="actions">
        <button onclick="quitter()">Quitter</button>
        <button onclick="enregistrer()">Enregistrer</button>
      </div>
    </header>

    <div class="container">
      <div class="sidebar">
        <div id="questionList">
          <!-- Questions ajoutées ici -->
        </div>
        <button class="add-btn" onclick="addQuestion()">Ajouter une question</button>
      </div>

      <div class="content">
        <input
          type="text"
          id="questionTitle"
          placeholder="Écrire la question ici"
        />

        <div class="answers" id="answersContainer">
          <input type="text" placeholder="Ajouter la réponse 1" />
          <input type="text" placeholder="Ajouter la réponse 2" />
          <input type="text" placeholder="Ajouter la réponse 3" />
          <input type="text" placeholder="Ajouter la réponse 4" />
        </div>
      </div>
    </div>

    <script>
      let questions = [];
      let currentIndex = null;

      function addQuestion() {
        saveCurrentQuestion();
        const newQuestion = {
          title: `Question ${questions.length + 1}`,
          answers: ["", "", "", ""],
        };
        questions.push(newQuestion);
        currentIndex = questions.length - 1;
        loadQuestion(currentIndex);
        renderQuestionList();
      }

      function loadQuestion(index) {
        const q = questions[index];
        document.getElementById("questionTitle").value = q.title;

        const container = document.getElementById("answersContainer");
        container.innerHTML = "";
        q.answers.forEach((ans, i) => {
          const input = document.createElement("input");
          input.type = "text";
          input.value = ans;
          input.placeholder = `Ajouter la réponse ${i + 1}`;
          input.oninput = () => {
            q.answers[i] = input.value;
          };
          container.appendChild(input);
        });
      }

      function saveCurrentQuestion() {
        if (currentIndex !== null) {
          questions[currentIndex].title = document.getElementById("questionTitle").value;
          const inputs = document.querySelectorAll("#answersContainer input");
          questions[currentIndex].answers = Array.from(inputs).map(input => input.value);
        }
      }

      function renderQuestionList() {
        const list = document.getElementById("questionList");
        list.innerHTML = "";

        questions.forEach((q, i) => {
          const div = document.createElement("div");
          div.className = "question-item";

          div.innerHTML = `
            <div style="display:flex; justify-content:space-between; align-items:center;">
              <div onclick="selectQuestion(${i})" style="flex:1; cursor:pointer;">
                <strong>Question ${i + 1}</strong>
                <p style="margin:0;">${q.title}</p>
              </div>
              <button onclick="supprimerQuestion(${i})" style="background:red; color:white; border:none; border-radius:4px; padding:5px; cursor:pointer;">🗑️</button>
            </div>
          `;
          list.appendChild(div);
        });
      }

      function selectQuestion(i) {
        saveCurrentQuestion();
        currentIndex = i;
        loadQuestion(i);
        renderQuestionList();
      }

      function supprimerQuestion(index) {
        if (confirm("Supprimer cette question ?")) {
          questions.splice(index, 1);
          if (currentIndex === index) {
            currentIndex = null;
            if (questions.length > 0) {
              currentIndex = 0;
              loadQuestion(0);
            } else {
              document.getElementById("questionTitle").value = "";
              document.getElementById("answersContainer").innerHTML = "";
            }
          } else if (currentIndex > index) {
            currentIndex -= 1;
            loadQuestion(currentIndex);
          }
          renderQuestionList();
        }
      }

      function enregistrer() {
        saveCurrentQuestion();
        console.log("Questions enregistrées :", questions);
        alert("Quiz enregistré !");
      }

      function quitter() {
        if (confirm("Voulez-vous vraiment quitter ? Les changements non enregistrés seront perdus.")) {
          window.location.href = "/";
        }
      }
    </script>
  </body>
</html> --}} 

@extends('layouts.main_quizz')
