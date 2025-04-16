@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')


@section('body')

<!-- Section pour la liste des tentatives -->
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow rounded">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Liste des tentatives</h5>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addAttemptModal">
                        <i class="fas fa-plus"></i> Ajouter une tentative
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
                                    <th>Heure de début</th>
                                    <th>Heure de fin</th>
                                    <th>Test</th>
                                    <th>Utilisateur</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($attempts as $attempt)
                                    <tr>
                                        <td>{{ $attempt->start_time }}</td>
                                        <td>{{ $attempt->end_time }}</td>
                                        <td>{{ $attempt->test->title ?? 'N/A' }}</td>
                                        <td>{{ $attempt->user->fname ?? 'N/A' }} {{ $attempt->user->lname ?? 'N/A' }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center align-items-center">
                                                <a href="{{ route('tentative.show', $attempt->id) }}" class="text-success mx-1" title="Voir">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('tentative.edit', $attempt->id) }}" class="text-primary mx-1" title="Modifier">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="#" class="text-danger mx-1" title="Supprimer"
                                                   onclick="event.preventDefault(); if(confirm('Voulez-vous vraiment supprimer cette tentative ?')) { document.getElementById('delete-form-{{ $attempt->id }}').submit(); }">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                <form id="delete-form-{{ $attempt->id }}" method="POST" action="{{ route('tentative.destroy', $attempt->id) }}" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                @if($attempts->isEmpty())
                                    <tr>
                                        <td colspan="5" class="text-center">Aucune tentative enregistrée.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal pour ajouter une tentative -->
<div class="modal fade" id="addAttemptModal" tabindex="-1" role="dialog" aria-labelledby="addAttemptModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content shadow-lg rounded-4">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" id="addAttemptModalLabel">Ajouter une tentative</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('tentative.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="start_time" class="form-label fw-semibold">Heure de début</label>
                        <input type="time" name="start_time" class="form-control rounded-pill shadow-sm" step="1" required>
                    </div>

                    <div class="mb-3">
                        <label for="end_time" class="form-label fw-semibold">Heure de fin</label>
                        <input type="time" name="end_time" class="form-control rounded-pill shadow-sm" step="1" required>
                    </div>

                    <div class="mb-3">
                        <label for="test_id" class="form-label fw-semibold">Test</label>
                        <select id="test_id" name="test_id" class="form-select rounded-pill shadow-sm" required>
                            @foreach($tests as $test)
                                <option value="{{ $test->id }}">{{ $test->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="user_id" class="form-label fw-semibold">Utilisateur</label>
                        <select id="user_id" name="user_id" class="form-select rounded-pill shadow-sm" required>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->fname }} {{ $user->lname }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill shadow">
                            <i class="fas fa-plus-circle me-2"></i> Ajouter la tentative
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal pour afficher les détails du sujet -->
<div class="modal fade" id="attemptDetailsModal" tabindex="-1" role="dialog" aria-labelledby="attemptDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="attemptDetailsModalLabel">Détails de la tentative</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="attemptDetailsContent">
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
    $(document).on('click', '[data-tentative-id]', function() {
        const attemptId = $(this).data('tentative-id');
        const url = `/tentative/${attemptId}`;

        $.ajax({
            url: url,
            method: 'GET',
            success: function(response) {
                if (response.status === 'success') {
                    const attempt = response.data;
                    let detailsHtml = `
                        <p><strong>Heure de début :</strong> ${attempt.start_time}</p>
                        <p><strong>Heure de fin :</strong> ${attempt.end_time}</p>
                        <p><strong>Test :</strong> ${attempt.test?.title || 'N/A'}</p>
                        <p><strong>Utilisateur :</strong> ${attempt.user?.fname || 'N/A'} ${attempt.user?.lname || 'N/A'}</p>
                    `;
                    $('#attemptDetailsContent').html(detailsHtml);
                    $('#attemptDetailsModal').modal('show');
                } else {
                    toastr.error('Impossible de charger les détails de la tentative.');
                }
            },
            error: function() {
                toastr.error('Une erreur est survenue lors du chargement des détails.');
            }
        });
    });
</script>

@endsection

@extends('layouts.footer')
@extends('layouts.script')
