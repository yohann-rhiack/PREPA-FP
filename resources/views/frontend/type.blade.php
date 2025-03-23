@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')

@section('body')

<!-- section pour la liste des types -->
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-center">
                    <!-- Bouton qui déclenche le modal -->
                    <button type="button" class="btn btn-block bg-gradient-primary w-25" data-toggle="modal" data-target="#addTypeModal">
                        Ajouter un type <span class="fas fa-plus"></span>
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
                                <th>Titre</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($types as $type)
                                <tr>
                                    <td>{{ $type->title }}</td>
                                    <td class="d-flex justify-content-center align-items-center">
                                        <a href="#" class="icon-link mx-2" data-toggle="modal"
                                        data-target="#schoolDetailsModal" data-school-id="{{ $type->id }}">
                                            <i class="fas fa-eye text-success"></i>
                                        </a>
                                        <a href="{{ route('type.edit', $type->id) }}" class="icon-link mx-2">
                                            <i class="fas fa-edit text-primary"></i>
                                        </a>
                                        <a href="#"
                                           onclick="event.preventDefault(); if(confirm('Voulez-vous vraiment supprimer ce type ?')) { document.getElementById('delete-form-{{ $type->id }}').submit(); }"
                                           class="icon-link">
                                            <i class="fas fa-trash text-danger"></i>
                                        </a>
                                        <form id="delete-form-{{ $type->id }}" method="POST"
                                              action="{{ route('type.destroy', $type->id) }}" style="display: none;">
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

<!-- Modal pour ajouter un type -->
<div class="modal fade" id="addTypeModal" tabindex="-1" role="dialog" aria-labelledby="addTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTypeModalLabel">Ajouter un type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('type.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title">Titre du type :</label>
                        <input type="text" id="title" name="title" class="form-control" placeholder="Entrez le titre du type" required>
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

@endsection

@extends('layouts.footer')
@extends('layouts.script')
