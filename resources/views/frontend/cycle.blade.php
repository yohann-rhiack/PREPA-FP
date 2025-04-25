@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')

@section('body')
<!-- Section pour afficher la liste des cycles -->
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow rounded">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Liste des cycles</h5>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addCycleModal" id="btn-color">
                        <i class="fas fa-plus"></i> Ajouter un cycle
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
                                    <th>Nom</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cycles as $cycle)
                                    <tr>
                                        <td>{{ $cycle->name }}</td>
                                        <td>{{ $cycle->description }}</td>
                                        <td class="d-flex justify-content-center">
                                            <a href="{{ route('cycle.show', $cycle->id) }}" class="mx-1 text-success">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('cycle.edit', $cycle->id) }}" class="mx-1 text-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form id="delete-form-{{ $cycle->id }}" method="POST"
                                                action="{{ route('cycle.destroy', $cycle->id) }}"
                                                onsubmit="return confirm('Voulez-vous vraiment supprimer ce cycle ?');">
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


<!-- Modal pour ajouter un cycle -->
<div class="modal fade" id="addCycleModal" tabindex="-1" role="dialog" aria-labelledby="addCycleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="addCycleModalLabel">Ajouter un cycle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body pt-0">
                <!-- Formulaire d'ajout dans le modal -->
                <form action="{{ route('cycle.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Nom du cycle</label>
                        <input type="text" name="name" id="name" class="form-control rounded-pill shadow-sm" placeholder="Entrez le nom du cycle" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label fw-semibold">Description</label>
                        <textarea name="description" id="description" class="form-control rounded-3 shadow-sm" rows="3" placeholder="Entrez une description (facultatif)"></textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="school_id" class="form-label fw-semibold">Ecole :</label>
                        <select id="school_id" name="school_id" class="form-select rounded-pill shadow-sm" required>
                            @foreach($schools as $school)
                                <option value="{{ $school->id }}">{{ $school->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="subjects" class="form-label fw-semibold">Matières associées</label>
                        <select name="subject_ids[]" id="subjects" class="form-select shadow-sm select2" multiple="multiple">
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->title }}</option> 
                            @endforeach
                        </select>
                        <small class="text-muted">Maintenez Ctrl (ou Cmd sur Mac) pour sélectionner plusieurs matières.</small>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-success rounded-pill px-4 shadow">
                            <i class="fas fa-plus-circle me-1"></i> Créer le cycle
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Inclure Select2 (via CDN) -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#subjects').select2({
            placeholder: "Sélectionnez les matières",
            allowClear: true
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
