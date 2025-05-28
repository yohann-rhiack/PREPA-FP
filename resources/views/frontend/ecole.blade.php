@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')


@section('body')

<!-- section pour la liste des écoles -->
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow rounded">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Liste des écoles</h5>
                    <button type="button" class="btn btn-primary btn-sm btn-color" id="openAddSchoolModal">
                        <i class="fas fa-plus"></i> Ajouter une école
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
                                    <th>Nom de l'école</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($schools as $school)
                                    <tr>
                                        <td>{{ $school->name }}</td>
                                        <td>{{ $school->description }}</td>
                                        <td>
                                            <a href="{{ route('school.edit', $school->id) }}" class="mx-1 text-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="#" class="mx-1 text-success" data-bs-toggle="modal"
                                               data-bs-target="#schoolDetailsModal" data-school-id="{{ $school->id }}">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="#" class="mx-1 text-danger"
                                               onclick="event.preventDefault(); if(confirm('Voulez-vous vraiment supprimer cette école ?')) { document.getElementById('delete-form-{{ $school->id }}').submit(); }">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                            <form id="delete-form-{{ $school->id }}" method="POST"
                                                  action="{{ route('school.destroy', $school->id) }}" style="display: none;">
                                                @csrf
                                                @method('DELETE')
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


<!-- Modal pour ajouter une école -->
<div class="modal fade" id="addSchoolModal" tabindex="-1" aria-labelledby="addSchoolModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content shadow-lg rounded-4">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" id="addSchoolModalLabel">Ajouter une école</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('school.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Nom de l'école</label>
                        <input type="text" id="name" name="name" class="form-control rounded-pill shadow-sm" placeholder="Ex : Lycée Moderne de Cocody" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label fw-semibold">Description</label>
                        <textarea id="description" name="description" class="form-control rounded-3 shadow-sm" rows="3" placeholder="Brève description de l’école..."></textarea>
                    </div>

                    <div class="form-group">
                        <label for="img_school">Image de l'école</label>
                        <input type="file" name="img_school" id="img_school" class="form-control">
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill shadow">
                            <i class="fas fa-save me-2"></i> Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal pour afficher les détails de l'école --> 
<div class="modal fade" id="schoolDetailsModal" tabindex="-1" role="dialog" aria-labelledby="schoolDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="schoolDetailsModalLabel">Détails de l'école</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="schoolDetailsContent">
                <!-- Les informations de l'école seront insérées ici via AJAX -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>



<style>
    .icon-link {
        margin: 0 10px;
        font-size: 1.5em;
        text-decoration: none;
    }

    .icon-link:hover {
        opacity: 0.7;
    }

    .modal-content {
        border-radius: 1rem;
    }

    input.form-control, textarea.form-control {
        transition: all 0.3s ease-in-out;
    }

    input.form-control:focus, textarea.form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .form-label {
        color: #333;
    }

</style>

<style>
    .btn-color{
            background: #6c63ff !important;
        }
</style>

<!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" defer></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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

<!-- Le script pour récupérer et afficher les données -->
<script>
    $(document).ready(function () {
        // Assure-toi que le bouton ouvre le modal
        $('a[data-bs-toggle="modal"]').click(function (event) {
            event.preventDefault();

            var schoolId = $(this).data('school-id'); // ID de l'école depuis le bouton
            var modal = $('#schoolDetailsModal');

            $.ajax({
                url: '/frontend/schools/' + schoolId + '/details',  // URL de la route pour récupérer les détails de l'école
                method: 'GET',
                success: function (data) {
                    console.log("Données reçues:", data); // Vérifie les données reçues dans la console

                    var content = '<p><strong>Nom de l\'école:</strong> ' + data.name + '</p>';
                    content += '<p><strong>Description:</strong> ' + (data.description || 'N/A') + '</p>';
                    content += '<p><strong>Logo:</strong><br><img src="' + data.img_school + '" alt="Logo de l\'école" style="max-width: 40%; height: 40%;"/></p>';

                    // Insère le contenu dans le modal
                    modal.find('#schoolDetailsContent').html(content);

                    // Ouvre le modal
                    modal.modal('show');
                },
                error: function (xhr) {
                    console.error("Erreur AJAX:", xhr.responseText);
                    $('#schoolDetailsContent').html('<p>Une erreur s\'est produite lors du chargement des détails de l\'école.</p>');
                }
            });
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Vérifie si Bootstrap est chargé
        if (typeof bootstrap === 'undefined') {
            console.error("Bootstrap n'est pas chargé. Assurez-vous que les fichiers JS et CSS de Bootstrap sont inclus.");
            return;
        }

        // Initialisation manuelle du modal pour le bouton
        const openAddSchoolModal = document.getElementById("openAddSchoolModal");
        openAddSchoolModal.addEventListener("click", function () {
            const modal = new bootstrap.Modal(document.getElementById("addSchoolModal"));
            modal.show();
        });
    });
</script>


@endsection

@extends('layouts.footer')
@extends('layouts.script')