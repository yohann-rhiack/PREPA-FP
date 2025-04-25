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
                    <h5 class="mb-0">Liste des rôles</h5>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addRoleModal" id="btn-color">
                        <i class="fas fa-plus"></i> Ajouter un rôle
                    </button>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
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
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>{{ $role->title }}</td>
                                        <td class="d-flex justify-content-center align-items-center">
                                            <a href="#" class="mx-1 text-success" data-bs-toggle="modal"
                                               data-bs-target="#roleDetailsModal"
                                               data-role-id="{{ $role->id }}"
                                               data-role-title="{{ $role->title }}">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('role.edit', $role->id) }}" class="mx-1 text-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form id="delete-form-{{ $role->id }}" method="POST"
                                                  action="{{ route('role.destroy', $role->id) }}"
                                                  onsubmit="return confirm('Voulez-vous vraiment supprimer ce rôle ?');">
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


<!-- Modal pour ajouter un rôle -->
<div class="modal fade" id="addRoleModal" tabindex="-1" aria-labelledby="addRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content shadow-lg rounded-4">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" id="addRoleModalLabel">Ajouter un rôle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('role.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label fw-semibold">Titre du rôle</label>
                        <input type="text" id="title" name="title" class="form-control rounded-pill shadow-sm" placeholder="Ex : Responsable pédagogique" required>
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



<!-- Modal pour afficher les détails d'un type -->
<div class="modal fade" id="roleDetailsModal" tabindex="-1" role="dialog" aria-labelledby="roleDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="roleDetailsModalLabel">Détails du role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Role :</strong> <span id="role-title"></span></p>
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

        $('#roleDetailsModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Bouton qui a déclenché le modal
            var roleTitle = button.data('role-title'); // Récupère les données du bouton
            var modal = $(this);
            modal.find('#role-title').text(roleTitle); // Met à jour le contenu du modal
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
