@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')


@section('body')
<!-- Section pour ajouter un cycle -->
<div class="d-flex justify-content-center mt-5">
    <div class="card card-primary" style="width: 50%;">
        <div class="card-header text-center">
            <h3 class="card-title">Ajouter un cycle</h3>
        </div>
        <div class="card-body">
            <form action="/cycles" method="POST">
                <div class="form-group">
                    <label for="name">Nom du cycle :</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="description">Description :</label>
                    <textarea id="description" name="description" class="form-control" rows="4"></textarea>
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

<!-- Section pour afficher la liste des cycles -->
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-center">
                    <a href="{{ route('frontend.cycle') }}" class="btn btn-block bg-gradient-success w-25">
                        Ajouter un cycle <span class="fas fa-plus"></span>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Cycle Fondamental</td>
                            <td>Introduction aux bases académiques et pédagogiques.</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fas fa-eye" style="color: blue; margin-right: 10px; cursor: pointer;"></i>
                                    <i class="fas fa-edit" style="color: green; margin-right: 10px; cursor: pointer;"></i>
                                    <i class="fas fa-trash" style="color: red; cursor: pointer;"></i>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Cycle Avancé</td>
                            <td>Approfondissement des concepts avec plus de spécialisation.</td>
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
