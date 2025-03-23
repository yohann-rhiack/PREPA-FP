@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')

@section('body')
<!-- Section pour la liste des abonnements -->
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-center">
                    <!-- Bouton pour ouvrir le modal -->
                    <button type="button" class="btn btn-block bg-gradient-primary w-25" data-toggle="modal" data-target="#addSubscriptionModal">
                        Ajouter un abonnement <span class="fas fa-plus"></span>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <!-- Affichage des messages de succès/erreur -->
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @elseif(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>Date de début</th>
                            <th>Date de fin</th>
                            <th>Statut</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Boucle pour afficher les abonnements -->
                        @foreach($subscriptions as $subscription)
                            <tr>
                                <td>{{ $subscription->start_date }}</td>
                                <td>{{ $subscription->end_date }}</td>
                                <td class="text-center">{{ $subscription->status == 1 ? 'Actif' : 'Inactif' }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <a href="{{ route('abonnement.show', $subscription->id) }}" class="fas fa-eye" style="color: blue; margin-right: 10px; cursor: pointer;"></a>
                                        <a href="{{ route('abonnement.edit', $subscription->id) }}" class="fas fa-edit" style="color: green; margin-right: 10px; cursor: pointer;"></a>
                                        <form action="{{ route('abonnement.destroy', $subscription->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="fas fa-trash" style="color: red; background: none; border: none; cursor: pointer;"></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour ajouter un abonnement -->
<div class="modal fade" id="addSubscriptionModal" tabindex="-1" role="dialog" aria-labelledby="addSubscriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSubscriptionModalLabel">Ajouter un abonnement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulaire d'ajout dans le modal -->
                <form action="{{ route('abonnement.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="start_date">Date de début :</label>
                        <input type="date" id="start_date" name="start_date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="end_date">Date de fin :</label>
                        <input type="date" id="end_date" name="end_date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Statut :</label>
                        <select id="status" name="status" class="form-control" required>
                            <option value="1" selected>Actif</option>
                            <option value="0">Inactif</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">
                            Ajouter l'abonnement
                        </button>
                    </div>
                </form>                
            </div>
        </div>
    </div>
</div>

@endsection

@extends('layouts.footer')
@extends('layouts.script')
