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
                    <h5 class="mb-0">Liste des actualité</h5>
                    <button type="button" class="btn btn-primary btn-sm btn-color" id="openAddActualityModal">
                        <i class="fas fa-plus"></i> Ajouter une actualité
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
                                    <th>Titre de l'actualité</th>
                                    <th>Contenu</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($actualities as $actuality)
                                    <tr>
                                        <td>{{ $actuality->title }}</td>
                                        <td>{{ $actuality->content }}</td>
                                        <td>
                                            <a href="{{ route('actuality.edit', $actuality->id) }}" class="mx-1 text-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="#" class="mx-1 text-success" data-bs-toggle="modal"
                                               data-bs-target="#actualityDetailsModal" data-actuality-id="{{ $actuality->id }}">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="#" class="mx-1 text-danger"
                                               onclick="event.preventDefault(); if(confirm('Voulez-vous vraiment supprimer cette actualité ?')) { document.getElementById('delete-form-{{ $actuality->id }}').submit(); }">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                            <form id="delete-form-{{ $actuality->id }}" method="POST"
                                                  action="{{ route('actuality.destroy', $actuality->id) }}" style="display: none;">
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


<!-- Modal pour ajouter une actualité -->
<div class="modal fade" id="addActualityModal" tabindex="-1" aria-labelledby="addActualityModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content shadow-lg rounded-4">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" id="addActualityModalLabel">Ajouter une Actualité</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('actuality.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label fw-semibold">Titre de l'actualité</label>
                        <input type="text" id="title" name="title" class="form-control rounded-pill shadow-sm" placeholder="Ex : Nouveau concours" required>
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label fw-semibold">Contenu</label>
                        <textarea id="content" name="content" class="form-control rounded-3 shadow-sm" rows="3" placeholder="Contenu de actualité"></textarea>
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


<!-- Modal pour afficher les détails de l'actualité --> 
<div class="modal fade" id="actualityDetailsModal" tabindex="-1" role="dialog" aria-labelledby="actualityDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="actualityDetailsModalLabel">Détails de l'actualité</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="actualityDetailsContent">
                <!-- Les informations de l'actualité seront insérées ici via AJAX -->
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

            var actualityId = $(this).data('actuality-id'); // ID de l'actualité depuis le bouton
            var modal = $('#actualityDetailsModal');

            $.ajax({
                url: '/frontend/actualitys/' + actualityId + '/details',  // URL de la route pour récupérer les détails de l'actualité
                method: 'GET',
                success: function (data) {
                    console.log("Données reçues:", data); // Vérifie les données reçues dans la console

                    var content = '<p><strong>Titre de l\'actualité:</strong> ' + data.title + '</p>';
                    content += '<p><strong>Contenu:</strong> ' + (data.content || 'N/A') + '</p>';

                    // Insère le contenu dans le modal
                    modal.find('#actualityDetailsContent').html(content);

                    // Ouvre le modal
                    modal.modal('show');
                },
                error: function (xhr) {
                    console.error("Erreur AJAX:", xhr.responseText);
                    $('#actualityDetailsContent').html('<p>Une erreur s\'est produite lors du chargement des détails de l\'actualité.</p>');
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
        const openAddActualityModal = document.getElementById("openAddActualityModal");
        openAddActualityModal.addEventListener("click", function () {
            const modal = new bootstrap.Modal(document.getElementById("addActualityModal"));
            modal.show();
        });
    });
</script>


@endsection

@extends('layouts.footer')
@extends('layouts.script')