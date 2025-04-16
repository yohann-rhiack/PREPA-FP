@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')

@section('body')

<!-- section pour la liste des matières -->
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow rounded">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Liste des matières</h5>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addSubjectModal">
                        <i class="fas fa-plus"></i> Ajouter une matière
                    </button>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success" id="success-message">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-center w-100">
                            <thead class="thead-light">
                                <tr>
                                    <th>Nom de la matière</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subjects as $subject)
                                    <tr>
                                        <td>{{ $subject->title }}</td>
                                        <td>{{ $subject->description }}</td>
                                        <td class="d-flex justify-content-center">
                                            <a href="{{ route('subject.show', $subject->id) }}" class="mx-1 text-success">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('subject.edit', $subject->id) }}" class="mx-1 text-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form id="delete-form-{{ $subject->id }}" method="POST"
                                                action="{{ route('subject.destroy', $subject->id) }}"
                                                onsubmit="return confirm('Voulez-vous vraiment supprimer cette matière ?');">
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


<!-- Modal pour ajouter une matière -->
<div class="modal fade" id="addSubjectModal" tabindex="-1" role="dialog" aria-labelledby="addSubjectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="addSubjectModalLabel">Ajouter une matière</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body pt-0">
                <form action="{{ route('subject.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label fw-semibold">Nom de la matière</label>
                        <input type="text" id="title" name="title" class="form-control rounded-pill shadow-sm" placeholder="Entrez le nom de la matière" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label fw-semibold">Description</label>
                        <textarea id="description" name="description" class="form-control rounded-3 shadow-sm" rows="3" placeholder="Entrez une description (facultatif)"></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="courses" class="form-label fw-semibold">Cours associés</label>
                        <select name="course_ids[]" id="courses" class="form-select shadow-sm" multiple>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->title }}</option>
                            @endforeach
                        </select>
                        <small class="text-muted">Vous pouvez sélectionner plusieurs cours avec Ctrl (ou Cmd sur Mac).</small>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary rounded-pill px-4 shadow">
                            <i class="fas fa-save me-1"></i> Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour afficher les détails du sujet -->
<div class="modal fade" id="subjectDetailsModal" tabindex="-1" role="dialog" aria-labelledby="subjectDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="subjectDetailsModalLabel">Détails de la matière</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="subjectDetailsContent">
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

            var subjectId = $(this).data('subject-id'); // ID du sujet depuis le bouton
            var modal = $('#subjectDetailsModal'); // Assure-toi d'utiliser l'ID correct pour ton modal

            $.ajax({
                url: '/subjects/' + subjectId + '/details',  // URL de la route pour récupérer les détails du sujet
                method: 'GET',
                success: function (data) {
                    console.log("Données reçues:", data); // Vérifie les données reçues dans la console

                    var content = '<p><strong>Titre de la matière:</strong> ' + data.title + '</p>';
                    content += '<p><strong>Description:</strong> ' + (data.description || 'N/A') + '</p>';
                    content += '<p><strong>Cours associés:</strong></p><ul>';
                    if (data.courses && data.courses.length > 0) {
                        data.courses.forEach(function(course) {
                            content += '<li>' + course.title + '</li>';
                        });
                    } else {
                        content += '<li>Aucun cours associé</li>';
                    }
                    content += '</ul>';

                    // Insère le contenu dans le modal
                    modal.find('#subjectDetailsContent').html(content);

                    // Ouvre le modal
                    modal.modal('show');
                },
                error: function (xhr) {
                    console.error("Erreur AJAX:", xhr.responseText);
                    $('#subjectDetailsContent').html('<p>Une erreur s\'est produite lors du chargement des détails du sujet.</p>');
                }
            });
        });
    });
</script>


@endsection

@extends('layouts.footer')
@extends('layouts.script')