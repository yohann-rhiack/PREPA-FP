@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')


@section('body')
<!-- Section pour ajouter un plan -->
<div class="d-flex justify-content-center mt-5">
    <div class="card card-warning" style="width: 50%;">
        <div class="card-header text-center">
            <h3 class="card-title">Ajouter un plan</h3>
        </div>
        <div class="card-body">
            <form action="/plans" method="POST">
                <div class="form-group">
                    <label for="title">Titre du plan :</label>
                    <input type="text" id="title" name="title" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="description">Description :</label>
                    <textarea id="description" name="description" class="form-control" rows="4"></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Prix :</label>
                    <input type="number" id="price" name="price" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="course_id">Cours :</label>
                    <select id="course_id" name="course_id" class="form-control" required>
                        <!-- Les options seront remplies dynamiquement avec les cours existants -->
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">
                        Ajouter le plan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Section pour la liste des plans -->
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-center">
                    <a href="{{ route('frontend.plan') }}" class="btn btn-block bg-gradient-primary w-25">
                        Ajouter un plan <span class="fas fa-plus"></span>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>Titre</th>
                            <th>Description</th>
                            <th>Prix</th>
                            <th>Cours</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Plan Standard</td>
                            <td>Accès aux cours de base.</td>
                            <td>10€</td>
                            <td>Développement Web</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fas fa-eye" style="color: blue; margin-right: 10px; cursor: pointer;"></i>
                                    <i class="fas fa-edit" style="color: green; margin-right: 10px; cursor: pointer;"></i>
                                    <i class="fas fa-trash" style="color: red; cursor: pointer;"></i>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Plan Premium</td>
                            <td>Accès à tous les cours et support personnalisé.</td>
                            <td>50€</td>
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
