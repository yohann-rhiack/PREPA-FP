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

    .actions button {
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

    .content .form-field {
      width: 100%;
      max-width: 100%;
      box-sizing: border-box;
      padding: 12px 16px;
      margin-bottom: 15px;
      border-radius: 6px;
      border: 1px solid #ccc;
      font-size: 16px;
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
    <div><strong>Créateur de quiz</strong></div>
  </header>

  <div class="container">
    <div class="sidebar">
      <div id="questionList"></div>
      <button class="add-btn add-question">Ajouter une question</button>
    </div>

    <div class="content">
      <form action="{{ route('test.store') }}" method="POST">
        @csrf

        <label for="title">Titre du test :</label>
        <input type="text" id="title" class="form-field" name="title" required />

        <label for="type_id">Type de test :</label>
        <select id="type_id" name="type_id" class="form-field" required>
          @foreach($types as $type)
            <option value="{{ $type->id }}">{{ $type->title }}</option>
          @endforeach
        </select>

        <label for="time">Durée (en minutes) :</label>
        <input type="number" id="time" class="form-field" name="time" required />

        <label for="course_id">Cours :</label>
        <select id="course_id" name="course_id" class="form-field">
          <option value="">-- Aucun --</option>
          @foreach($courses as $course)
            <option value="{{ $course->id }}">{{ $course->title }}</option>
          @endforeach
        </select>

    <div class="mb-4">
      <label class="form-label fw-bold">Questions :</label>
      <div id="questions-container">
        <div class="question-item border rounded p-3 mb-3" data-index="0">
          <input name="questions[0][question]" class="form-field" placeholder="Question" required>
          <input name="questions[0][tag]" class="form-field" placeholder="Tag (optionnel)"><br>
          <label class="fw-semibold">Réponses :</label>
            <div class="answers-container">
              <div class="answer-item d-flex gap-2 align-items-center mb-2">
                  <input type="text" name="questions[0][answers][0][content]" class="form-field" placeholder="Réponse" required>
                    <select name="questions[0][answers][0][is_correct]" class="form-field">
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
      {{-- <button type="button" class="btn btn-sm btn-outline-primary add-question mt-2">
        <i class="fas fa-plus-circle me-1"></i> Ajouter une question
      </button> --}}
    </div>        

        <div class="actions">
          <button type="button" onclick="quitter()">Quitter</button>
          <button type="submit">Enregistrer</button>
        </div>
      </form>
    </div>
  </div>


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
            <input name="questions[${questionCount}][question]" class="form-field" placeholder="Question" required>
            <input name="questions[${questionCount}][tag]" class="form-field" placeholder="Tag (optionnel)">
            <label class="fw-semibold">Réponses :</label>
            <div class="answers-container">
                <div class="answer-item d-flex gap-2 align-items-center mb-2">
                    <input type="text" name="questions[${questionCount}][answers][0][content]" class="form-field" placeholder="Réponse" required>
                    <select name="questions[${questionCount}][answers][0][is_correct]" class="form-field">
                        <option value="0">Faux</option>
                        <option value="1">Vrai</option>
                    </select>
                    <button type="button" class="btn btn-sm btn-danger delete-answer">
                      <i class="fas fa-trash me-1"></i> Supprimer la réponse
                    </button>
                </div>
            </div><br>
            <button type="button" class="btn btn-sm btn-outline-success add-answer mt-2">
                <i class="fas fa-plus me-1"></i> Ajouter une réponse
            </button>
            <button type="button" class="btn btn-sm btn-outline-danger delete-question mt-2">
                <i class="fas fa-trash me-1"></i> Supprimer cette question
            </button><br><br>
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
                <input type="text" name="questions[${questionIndex}][answers][${answerCount}][content]" class="form-field" placeholder="Réponse" required>
                <select name="questions[${questionIndex}][answers][${answerCount}][is_correct]" class="form-field">
                    <option value="0">Faux</option>
                    <option value="1">Vrai</option>
                </select>
                <button type="button" class="btn btn-sm btn-danger delete-answer">
                <i class="fas fa-trash me-1"></i> Supprimer la réponse
              </button>

            `;
            answersContainer.appendChild(answerDiv);
        }
    });

    // Supprimer une réponse
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('delete-answer')) {
            const answerItem = e.target.closest('.answer-item');
            answerItem.remove();
        }
    });

    // Supprimer une question
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('delete-question')) {
            const questionItem = e.target.closest('.question-item');
            questionItem.remove();
        }
    });
});
</script>

</body>
</html>
