@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')


@section('body')
<!-- Section pour la liste des chapitres -->
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-center">
                    <!-- Bouton qui déclenche le modal -->
                    <button type="button" class="btn btn-block bg-gradient-primary w-25" data-toggle="modal" data-target="#addChapterModal">
                        Ajouter un chapitre <span class="fas fa-plus"></span>
                    </button>
                </div>
            </div>

            <!-- /.card-header -->
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
                        <!-- Exemple de chapitre dans le tableau -->
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
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

<!-- Modal pour ajouter un chapitre -->
<div class="modal fade" id="addChapterModal" tabindex="-1" role="dialog" aria-labelledby="addChapterModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addChapterModalLabel">Ajouter un chapitre</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulaire d'ajout dans le modal -->
                <form action="/chapters" method="POST">
                    <div class="form-group">
                        <label for="title">Titre du chapitre :</label>
                        <input type="text" id="title" name="title" class="form-control" placeholder="Entrez le titre du chapitre" required>
                    </div>
                    <div class="form-group">
                        <label for="content">Contenu :</label>
                        <textarea id="content" name="content" class="form-control" rows="3" placeholder="Entrez le contenu"></textarea>
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
                            Enregistrer
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
