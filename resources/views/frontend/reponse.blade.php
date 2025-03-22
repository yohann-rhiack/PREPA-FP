@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')


@section('body')
<!-- Section pour ajouter une réponse -->
<div class="d-flex justify-content-center mt-5">
    <div class="card card-warning" style="width: 50%;">
        <div class="card-header text-center">
            <h3 class="card-title">Ajouter une réponse</h3>
        </div>
        <div class="card-body">
            <form action="/answers" method="POST">
                <div class="form-group">
                    <label for="content">Réponse :</label>
                    <textarea id="content" name="content" class="form-control" rows="3" placeholder="Entrez votre réponse" required></textarea>
                </div>
                <div class="form-group form-check text-center">
                    <input type="checkbox" id="tag" name="tag" value="1" class="form-check-input">
                    <label class="form-check-label" for="tag">Correcte ?</label>
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

<!-- Section pour la liste des réponses -->
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-center">
                    <a href="{{ route('frontend.reponse')}}" class="btn btn-block bg-gradient-primary w-25">
                        Ajouter une réponse <span class="fas fa-plus"></span>
                    </a>
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
                        <tr>
                            <td>La capitale de la France est Paris.</td>
                            <td class="text-center">
                                <span class="badge badge-success">Oui</span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fas fa-eye" style="color: blue; margin-right: 10px; cursor: pointer;"></i>
                                    <i class="fas fa-edit" style="color: green; margin-right: 10px; cursor: pointer;"></i>
                                    <i class="fas fa-trash" style="color: red; cursor: pointer;"></i>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Le Soleil tourne autour de la Terre.</td>
                            <td class="text-center">
                                <span class="badge badge-danger">Non</span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fas fa-eye" style="color: blue; margin-right: 10px; cursor: pointer;"></i>
                                    <i class="fas fa-edit" style="color: green; margin-right: 10px; cursor: pointer;"></i>
                                    <i class="fas fa-trash" style="color: red; cursor: pointer;"></i>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@extends('layouts.footer')
@extends('layouts.script')
