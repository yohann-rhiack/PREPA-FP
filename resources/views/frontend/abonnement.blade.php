@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')

@section('body')
<!-- Section pour la liste des abonnements -->
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow rounded">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Liste des abonnements</h5>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addSubscriptionModal">
                        <i class="fas fa-plus"></i> Ajouter un abonnement
                    </button>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                        </div>
                    @elseif(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-center align-middle">
                            <thead class="thead-light">
                                <tr>
                                    <th>Date de début</th>
                                    <th>Date de fin</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subscriptions as $subscription)
                                    <tr>
                                        <td>{{ $subscription->start_date }}</td>
                                        <td>{{ $subscription->end_date }}</td>
                                        <td>
                                            <span class="badge bg-{{ $subscription->status == 1 ? 'success' : 'secondary' }}">
                                                {{ $subscription->status == 1 ? 'Actif' : 'Inactif' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center align-items-center">
                                                <a href="#" class="text-success mx-1" data-bs-toggle="modal"
                                                   data-bs-target="#abonnementDetailsModal"
                                                   data-abonnement-id="{{ $subscription->id }}">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('abonnement.edit', $subscription->id) }}" class="text-primary mx-1">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form id="delete-form-{{ $subscription->id }}" method="POST"
                                                      action="{{ route('abonnement.destroy', $subscription->id) }}"
                                                      onsubmit="return confirm('Voulez-vous vraiment supprimer cet abonnement ?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link p-0 text-danger mx-1">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> <!-- table-responsive -->
                </div> <!-- card-body -->
            </div>
        </div>
    </div>
</div>


<!-- Modal pour ajouter un abonnement -->
<div class="modal fade" id="addSubscriptionModal" tabindex="-1" aria-labelledby="addSubscriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content shadow-lg rounded-4">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" id="addSubscriptionModalLabel">Ajouter un abonnement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('abonnement.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="start_date" class="form-label fw-semibold">Date de début</label>
                        <input type="date" id="start_date" name="start_date" class="form-control rounded-pill shadow-sm" required>
                    </div>

                    <div class="mb-3">
                        <label for="end_date" class="form-label fw-semibold">Date de fin</label>
                        <input type="date" id="end_date" name="end_date" class="form-control rounded-pill shadow-sm" required>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label fw-semibold">Statut</label>
                        <select id="status" name="status" class="form-select rounded-pill shadow-sm" required>
                            <option value="1" selected>Actif</option>
                            <option value="0">Inactif</option>
                        </select>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill shadow">
                            <i class="fas fa-plus me-2"></i> Ajouter l'abonnement
                        </button>
                    </div>
                </form>                
            </div>
        </div>
    </div>
</div>


<!-- Modal pour afficher les détails de l'abonnement -->
<div class="modal fade" id="abonnementDetailsModal" tabindex="-1" role="dialog" aria-labelledby="abonnementDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="abonnementDetailsModalLabel">Détails de l'abonnement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="abonnementDetailsContent">
                <!-- Les informations de l'école seront insérées ici via AJAX -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

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
        $('a[data-toggle="modal"]').click(function (event) {
            event.preventDefault();

            var abonnementId = $(this).data('abonnement-id'); // Récupère l'ID de l'abonnement
            var modal = $('#abonnementDetailsModal');

            $.ajax({
                url: '/frontend/abonnements/' + abonnementId + '/details',  // URL de la route pour récupérer les détails de l'abonnement
                method: 'GET',
                success: function (data) {
                    console.log("Données reçues:", data); // Vérifie les données reçues dans la console

                        var content = '<p><strong>Date de début:</strong> ' + (data.start_date || 'N/A') + '</p>';
                        content += '<p><strong>Date de fin:</strong> ' + (data.end_date || 'N/A') + '</p>';
                        content += '<p><strong>Statut:</strong> ' + (data.status == 1 ? 'Actif' : 'Inactif') + '</p>';

                        // Insère le contenu dans le modal
                        modal.find('#abonnementDetailsContent').html(content);

                    // Ouvre le modal
                    modal.modal('show');
                },
                error: function (xhr) {
                    console.error("Erreur AJAX:", xhr.responseText);
                    modal.find('#abonnementDetailsContent').html('<p>Une erreur s\'est produite lors du chargement des détails de l\'abonnement.</p>');
                }
            });
        });
    });
</script>

@endsection

@extends('layouts.footer')
@extends('layouts.script')
