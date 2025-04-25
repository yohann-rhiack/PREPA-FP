@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')

@section('body')

<!-- section pour la liste des types -->
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow rounded">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Liste des types</h5>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addTypeModal" id="btn-color">
                        <i class="fas fa-plus"></i> Ajouter un type
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
                        <table class="table table-bordered table-hover text-center">
                            <thead class="thead-light">
                                <tr>
                                    <th>Titre</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($types as $type)
                                    <tr>
                                        <td>{{ $type->title }}</td>
                                        <td class="d-flex justify-content-center align-items-center">
                                            <a href="#"
                                               class="mx-1 text-success"
                                               data-bs-toggle="modal"
                                               data-bs-target="#typeDetailsModal"
                                               data-type-id="{{ $type->id }}"
                                               data-type-title="{{ $type->title }}">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('type.edit', $type->id) }}" class="mx-1 text-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form id="delete-form-{{ $type->id }}" method="POST"
                                                  action="{{ route('type.destroy', $type->id) }}"
                                                  onsubmit="return confirm('Voulez-vous vraiment supprimer ce type ?');">
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


<!-- Modal pour ajouter un type -->
<div class="modal fade" id="addTypeModal" tabindex="-1" role="dialog" aria-labelledby="addTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="addTypeModalLabel">Ajouter un type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body pt-0">
                <form action="{{ route('type.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="title" class="form-label fw-semibold">Titre du type :</label>
                        <input type="text" id="title" name="title" class="form-control rounded-pill shadow-sm" placeholder="Entrez le titre du type" required>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-success rounded-pill px-4 shadow">
                            <i class="fas fa-plus-circle me-1"></i> Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal pour afficher les détails d'un type -->
<div class="modal fade" id="typeDetailsModal" tabindex="-1" role="dialog" aria-labelledby="typeDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="typeDetailsModalLabel">Détails du type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Titre :</strong> <span id="type-title"></span></p>
                <!-- Ajoutez ici d'autres détails si nécessaire -->
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

    #btn-color{
            background: #6c63ff !important;
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

        $('#typeDetailsModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Bouton qui a déclenché le modal
            var typeTitle = button.data('type-title'); // Récupère les données du bouton
            var modal = $(this);
            modal.find('#type-title').text(typeTitle); // Met à jour le contenu du modal
        });
    });
</script>

@endsection

@extends('layouts.footer')
@extends('layouts.script')
