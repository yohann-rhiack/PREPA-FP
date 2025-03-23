@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')


@section('body')
<!-- Section pour la liste des plans -->
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-center">
                    <!-- Bouton pour ouvrir le modal -->
                    <button type="button" class="btn btn-block bg-gradient-primary w-25" data-toggle="modal" data-target="#addPlanModal">
                        Ajouter un plan <span class="fas fa-plus"></span>
                    </button>
                </div>
            </div>

            <!-- /.card-header -->
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
                        <!-- Exemple de plan dans le tableau -->
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
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

<!-- Modal pour ajouter un plan -->
<div class="modal fade" id="addPlanModal" tabindex="-1" role="dialog" aria-labelledby="addPlanModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPlanModalLabel">Ajouter un plan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulaire d'ajout dans le modal -->
                <form action="/plans" method="POST">
                    <div class="form-group">
                        <label for="title">Titre du plan :</label>
                        <input type="text" id="title" name="title" class="form-control" placeholder="Entrez le titre du plan" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description :</label>
                        <textarea id="description" name="description" class="form-control" rows="3" placeholder="Entrez la description du plan"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Prix :</label>
                        <input type="number" id="price" name="price" class="form-control" placeholder="Entrez le prix" required>
                    </div>
                    <div class="form-group">
                        <label for="course_id">Cours :</label>
                        <select id="course_id" name="course_id" class="form-control" required>
                            <!-- Les options seront remplies dynamiquement avec les cours existants -->
                            <option value="1">Développement Web</option>
                            <option value="2">Introduction à la programmation</option>
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
</div>


@endsection

@extends('layouts.footer')
@extends('layouts.script')
