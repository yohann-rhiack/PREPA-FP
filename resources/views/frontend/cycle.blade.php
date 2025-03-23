@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')

@section('body')
<!-- Section pour afficher la liste des cycles -->
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-center">
                    <!-- Bouton pour ouvrir le modal -->
                    <button type="button" class="btn btn-block bg-gradient-success w-25" data-toggle="modal" data-target="#addCycleModal">
                        Ajouter un cycle <span class="fas fa-plus"></span>
                    </button>
                </div>
            </div>

            <!-- /.card-header -->
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
                                <th>Nom</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cycles as $cycle)
                                <tr>
                                    <td>{{$cycle->name}}</td>
                                    <td>{{$cycle->description}}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <a href="{{ route('cycle.show', $cycle->id) }}" class="icon-link mx-2">
                                                <i class="fas fa-eye" style="color: blue;"></i>
                                            </a>
                                            <a href="{{ route('cycle.edit', $cycle->id) }}" class="icon-link mx-2">
                                                <i class="fas fa-edit" style="color: green;"></i>
                                            </a>
                                            <a href="#" onclick="event.preventDefault(); if(confirm('Voulez-vous vraiment supprimer ce cycle ?')) { document.getElementById('delete-form-{{ $cycle->id }}').submit(); }" class="icon-link mx-2">
                                                <i class="fas fa-trash" style="color: red;"></i>
                                            </a>
                                            <form id="delete-form-{{ $cycle->id }}" method="POST" action="{{ route('cycle.destroy', $cycle->id) }}" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

<!-- Modal pour ajouter un cycle -->
<div class="modal fade" id="addCycleModal" tabindex="-1" role="dialog" aria-labelledby="addCycleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCycleModalLabel">Ajouter un cycle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulaire d'ajout dans le modal -->
                <form action="{{ route('cycle.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nom du cycle :</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Entrez le nom du cycle" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description :</label>
                        <textarea id="description" name="description" class="form-control" rows="3" placeholder="Entrez la description du cycle"></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">
                            Ajouter le cycle
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
