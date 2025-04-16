@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')


@section('body')
<!-- Section pour la liste des plans -->
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow rounded">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Liste des utilisateurs</h5>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addUserModal">
                        <i class="fas fa-plus"></i> Ajouter un utilisateur
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
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Email</th>
                                    <th>Téléphone</th>
                                    <th>Rôle</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <td>{{ $user->fname }}</td>
                                        <td>{{ $user->lname }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>
                                            <span class="badge bg-info text-dark">
                                                {{ $user->role->title ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center align-items-center">
                                                <a href="{{ route('utilisateur.show', $user->id) }}" class="text-success mx-1" title="Voir">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('utilisateur.edit', $user->id) }}" class="text-primary mx-1" title="Modifier">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('utilisateur.destroy', $user->id) }}" method="POST" class="mx-1" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link p-0 m-0 text-danger" title="Supprimer">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Aucun utilisateur disponible.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Modal pour ajouter un utilisateur -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content shadow-lg rounded-4">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" id="addUserModalLabel">Ajouter un utilisateur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('utilisateur.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="fname" class="form-label fw-semibold">Prénom</label>
                        <input type="text" id="fname" name="fname" class="form-control rounded-pill shadow-sm" placeholder="Entrez le prénom" required>
                    </div>

                    <div class="mb-3">
                        <label for="lname" class="form-label fw-semibold">Nom</label>
                        <input type="text" id="lname" name="lname" class="form-control rounded-pill shadow-sm" placeholder="Entrez le nom" required>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label fw-semibold">Téléphone</label>
                        <input type="text" id="phone" name="phone" class="form-control rounded-pill shadow-sm" placeholder="Entrez le numéro de téléphone" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input type="email" id="email" name="email" class="form-control rounded-pill shadow-sm" placeholder="Entrez l'email" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Mot de passe</label>
                        <input type="password" id="password" name="password" class="form-control rounded-pill shadow-sm" placeholder="Entrez le mot de passe" required>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label fw-semibold">Confirmation mot de passe</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control rounded-pill shadow-sm" placeholder="Confirmer le mot de passe" required>
                    </div>

                    <div class="mb-3">
                        <label for="role_id" class="form-label fw-semibold">Rôle</label>
                        <select id="role_id" name="role_id" class="form-select rounded-pill shadow-sm" required>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill shadow">
                            <i class="fas fa-user-plus me-2"></i> Ajouter un utilisateur
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal pour afficher les détails du sujet -->
<div class="modal fade" id="userDetailsModal" tabindex="-1" role="dialog" aria-labelledby="userDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userDetailsModalLabel">Détails utilisateur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="userDetailsContent">
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

            var userId = $(this).data('user-id'); // ID du sujet depuis le bouton
            var modal = $('#userDetailsModal'); // Assure-toi d'utiliser l'ID correct pour ton modal

            $.ajax({
                url: '/users/' + userId + '/details',  // URL de la route pour récupérer les détails du sujet
                method: 'GET',
                success: function (data) {
                    console.log("Données reçues:", data); // Vérifie les données reçues dans la console

                    var content = '<p><strong>Nom:</strong> ' + data.fname + '</p>';
                    content += '<p><strong>Prénom:</strong> ' + data.fname +'</p>';
                    content += '<p><strong>Téléphone:</strong> ' + data.phone +'</p>';
                    content += '<p><strong>Email:</strong> ' + data.email +'</p>';
                    content += '<p><strong>Role:</strong></p><ul>';
                    if (data.roles && data.roles.length > 0) {
                        data.roles.forEach(function(course) {
                            content += '<li>' + role.title + '</li>';
                        });
                    } else {
                        content += '<li>Aucun role associé</li>';
                    }
                    content += '</ul>';

                    // Insère le contenu dans le modal
                    modal.find('#userDetailsContent').html(content);

                    // Ouvre le modal
                    modal.modal('show');
                },
                error: function (xhr) {
                    console.error("Erreur AJAX:", xhr.responseText);
                    $('#userDetailsContent').html('<p>Une erreur s\'est produite lors du chargement des détails de l\'utilisateur.</p>');
                }
            });
        });
    });
</script>


@endsection

@extends('layouts.footer')
@extends('layouts.script')
