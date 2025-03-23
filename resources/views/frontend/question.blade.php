@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')

@section('body')

<!-- Section pour la liste des questions -->
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-center">
                    <!-- Bouton pour ouvrir le modal -->
                    <button type="button" class="btn btn-block bg-gradient-primary w-25" data-toggle="modal" data-target="#addQuestionModal">
                        Ajouter une question <span class="fas fa-plus"></span>
                    </button>
                </div>
            </div>

            <!-- /.card-header -->
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success" role="alert" id="success-message">
                    {{ session('success') }}
                </div>
                @endif
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>Question</th>
                            <th>Tag</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Exemple de question dans le tableau -->
                        @foreach($questions as $question)
                        <tr>
                            <td>{{ $question->question }}</td>
                            <td>{{ $question->tag }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center align-items-center">
                                    <a href="{{ route('quiz.show', $question->id) }}" class="mx-2">
                                        <i class="fas fa-eye" style="color: blue; cursor: pointer;"></i>
                                    </a>
                                    <a href="{{ route('quiz.edit', $question->id) }}" class="mx-2">
                                        <i class="fas fa-edit" style="color: green; cursor: pointer;"></i>
                                    </a>
                                    <a href="#" onclick="event.preventDefault(); if(confirm('Voulez-vous vraiment supprimer cette question ?')) { document.getElementById('delete-form-{{ $question->id }}').submit(); }" class="mx-2">
                                        <i class="fas fa-trash" style="color: red; cursor: pointer;"></i>
                                    </a>
                                    <form id="delete-form-{{ $question->id }}" method="POST" action="{{ route('quiz.destroy', $question->id) }}" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

<!-- Modal pour ajouter une question -->
<div class="modal fade" id="addQuestionModal" tabindex="-1" role="dialog" aria-labelledby="addQuestionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addQuestionModalLabel">Ajouter une question</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulaire d'ajout dans le modal -->
                <form action="{{ route('quiz.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="question">Question :</label>
                        <textarea id="question" name="question" class="form-control" rows="4" placeholder="Entrez la question" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="tag">Tag (facultatif) :</label>
                        <input type="text" id="tag" name="tag" class="form-control" placeholder="Entrez un tag facultatif">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">
                            Ajouter la question
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" defer></script>

<script defer>
    document.addEventListener("DOMContentLoaded", function() {
        var successMessage = document.getElementById('success-message');
        if (successMessage) {
            setTimeout(function () {
                successMessage.style.display = 'none';
            }, 5000);
        }

        @if (session('success'))
            toastr.success('{{ session('success') }}', 'Succès', { positionClass: 'toast-top-right', timeOut: 5000 });
        @endif

        @if (session('error'))
            toastr.error('{{ session('error') }}', 'Erreur', { positionClass: 'toast-top-right', timeOut: 5000 });
        @endif
    });
</script>

@endsection

@extends('layouts.footer')
@extends('layouts.script')
