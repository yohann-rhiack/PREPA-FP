@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')

@section('body')
<!-- Section pour la liste des résumés -->
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-center">
                    <!-- Bouton pour ouvrir le modal -->
                    <button type="button" class="btn btn-block bg-gradient-primary w-25" data-toggle="modal" data-target="#addSummaryModal">
                        Ajouter un résumé <span class="fas fa-plus"></span>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>Résumé</th>
                            <th>Chapitre</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($summaries as $summary)
                            <tr>
                                <td>{{ $summary->title }}</td>
                                <td>{{ $summary->chapter->title }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <a href="{{ route('resume.show', $summary->id) }}" class="fas fa-eye" style="color: blue; margin-right: 10px;"></a>
                                        <a href="{{ route('resume.edit', $summary->id) }}" class="fas fa-edit" style="color: green; margin-right: 10px;"></a>
                                        <form action="{{ route('resume.destroy', $summary->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="fas fa-trash" style="color: red; border: none; background: none;"></button>
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

<!-- Modal pour ajouter un résumé -->
<div class="modal fade" id="addSummaryModal" tabindex="-1" role="dialog" aria-labelledby="addSummaryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSummaryModalLabel">Ajouter un résumé</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulaire d'ajout dans le modal -->
                <form action="{{ route('resume.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="content">Résumé :</label>
                        <textarea id="content" name="content" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="chapter_id">Chapitre :</label>
                        <select id="chapter_id" name="chapter_id" class="form-control" required>
                            <!-- Les options seront remplies dynamiquement avec les chapitres existants -->
                            {{-- @foreach($chapters as $chapter)
                                <option value="{{ $chapter->id }}">{{ $chapter->title }}</option>
                            @endforeach --}}
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Ajouter le résumé</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.footer')
@extends('layouts.script')
