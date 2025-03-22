@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')


@section('body')
<!-- Section pour ajouter un chapitre -->
<div class="d-flex justify-content-center mt-5">
    <div class="card card-warning" style="width: 50%;">
        <div class="card-header text-center">
            <h3 class="card-title">Ajouter un chapitre</h3>
        </div>
        <div class="card-body">
            <form action="/chapters" method="POST">
                <div class="form-group">
                    <label for="title">Titre du chapitre :</label>
                    <input type="text" id="title" name="title" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="content">Contenu :</label>
                    <textarea id="content" name="content" class="form-control" rows="4"></textarea>
                </div>
                <div class="form-group">
                    <label for="course_id">Cours :</label>
                    <select id="course_id" name="course_id" class="form-control" required>
                        <!-- Options dynamiques -->
                    </select>
                </div>
                <div class="form-group">
                    <label for="parent_id">Chapitre parent (facultatif) :</label>
                    <select id="parent_id" name="parent_id" class="form-control">
                        <option value="">Aucun</option>
                        <!-- Options dynamiques -->
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">
                        Ajouter le chapitre
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Section pour la liste des chapitres -->
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-center">
                    <a href="{{ route('frontend.chapitre') }}" class="btn btn-block bg-gradient-primary w-25">
                        Ajouter un chapitre <span class="fas fa-plus"></span>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>Titre</th>
                            <th>Cours</th>
                            <th>Chapitre Parent</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Introduction à la programmation</td>
                            <td>Développement Web</td>
                            <td>Aucun</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fas fa-eye" style="color: blue; margin-right: 10px; cursor: pointer;"></i>
                                    <i class="fas fa-edit" style="color: green; margin-right: 10px; cursor: pointer;"></i>
                                    <i class="fas fa-trash" style="color: red; cursor: pointer;"></i>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Les bases de HTML</td>
                            <td>Développement Web</td>
                            <td>Introduction à la programmation</td>
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
