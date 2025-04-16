@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')

@section('body')
<!-- Section pour la liste des réponses -->
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-center">
                    <!-- Bouton qui déclenche le modal -->
                    <button type="button" class="btn btn-block bg-gradient-primary w-25" data-toggle="modal" data-target="#addAnswerModal">
                        Ajouter une réponse <span class="fas fa-plus"></span>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>Réponse</th>
                            <th>Correcte</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($answers as $answer)
                            <tr>
                                <td>{{ $answer->content }}</td>
                                <td class="text-center">
                                    <span class="badge badge-{{ $answer->correct == 1 ? 'success' : 'danger' }}">
                                        {{ $answer->correct == 1 ? 'Oui' : 'Non' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <a href="{{ route('answer.show', $answer->id) }}" class="text-primary">
                                            <i class="fas fa-eye" style="margin-right: 10px; cursor: pointer;"></i>
                                        </a>
                                        <a href="{{ route('answer.edit', $answer->id) }}" class="text-success">
                                            <i class="fas fa-edit" style="margin-right: 10px; cursor: pointer;"></i>
                                        </a>
                                        <form action="{{ route('answer.destroy', $answer->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link p-0 text-danger" style="cursor: pointer;">
                                                <i class="fas fa-trash"></i>
                                            </button>
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

<!-- Modal pour ajouter une réponse -->
<div class="modal fade" id="addAnswerModal" tabindex="-1" role="dialog" aria-labelledby="addAnswerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAnswerModalLabel">Ajouter une réponse</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulaire d'ajout dans le modal -->
                <form action="{{ route('answer.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="content">Réponse :</label>
                        <textarea id="content" name="content" class="form-control" rows="3" placeholder="Entrez votre réponse" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="tag">Tag :</label>
                        <select id="tag" name="tag" class="form-control" required>
                            <option value="1">Oui</option>
                            <option value="0">Non</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">
                            Ajouter la réponse
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
