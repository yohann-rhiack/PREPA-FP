@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')


@section('body')

<!-- section pour la liste des écoles -->
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-center">
                    <!-- Bouton qui déclenche le modal -->
                    <button type="button" class="btn btn-block bg-gradient-primary w-25" data-toggle="modal" data-target="#addSchoolModal">
                        Ajouter une école <span class="fas fa-plus"></span>
                    </button>
                </div>
            </div>

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

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>Nom de l'école</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schools as $school)
                                <tr>
                                    <td>{{$school->name}}</td>
                                    <td>{{$school->description}}</td>
                                    <td class="d-flex justify-content-center align-items-center">
                                        <a href="{{ route('school.edit', $school->id) }}" class="icon-link mx-2">
                                            <i class="fas fa-edit text-primary"></i>
                                        </a>
                                
                                        <a href="#" class="icon-link mx-2" data-toggle="modal"
                                        data-target="#schoolDetailsModal" data-school-id="{{ $school->id }}">
                                            <i class="fas fa-eye text-success"></i>
                                        </a>
                                
                                        <a href="#"
                                            onclick="event.preventDefault(); if(confirm('Voulez-vous vraiment supprimer cette école ?')) { document.getElementById('delete-form-{{ $school->id }}').submit(); }"
                                            class="icon-link">
                                            <i class="fas fa-trash text-danger"></i>
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

<!-- Modal pour ajouter une école -->
<div class="modal fade" id="addSchoolModal" tabindex="-1" role="dialog" aria-labelledby="addSchoolModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSchoolModalLabel">Ajouter une école</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('school.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nom de l'école :</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Entrez le nom de l'école" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description :</label>
                        <textarea id="description" name="description" class="form-control" rows="3" placeholder="Entrez une description"></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">
                            Enregistrer
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Nom de l'école :</strong> <span id="school-name"></span></p>
                <p><strong>Description :</strong> <span id="school-description"></span></p>
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
</style>

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

<script defer>
$(document).ready(function () {
    $('#schoolDetailsModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Bouton qui a déclenché le modal
        var schoolId = button.data('school-id'); // Récupération de l'ID de l'école

        // Requête AJAX pour récupérer les détails de l'école
        $.ajax({
            url: '/schools/' + schoolId, // URL de la route
            type: 'GET',
            success: function (data) {
                if (data.status !== 'error') {
                    // Remplir les champs du modal avec les données reçues
                    $('#school-name').text(data.name);  // Mise à jour du nom de l'école
                    $('#school-description').text(data.description);  // Mise à jour de la description
                } else {
                    $('#school-name').text('Erreur');
                    $('#school-description').text('Impossible de charger les détails.');
                }
            },
            error: function () {
                // En cas d'erreur, afficher un message
                $('#school-name').text('Erreur');
                $('#school-description').text('Impossible de charger les détails.');
            }
        });
    });
});

</script>


@endsection

@extends('layouts.footer')
@extends('layouts.script')  