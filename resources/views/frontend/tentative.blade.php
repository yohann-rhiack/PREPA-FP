@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')


@section('body')

<!-- Section pour la liste des tentatives -->
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-center">
                    <!-- Bouton qui déclenche le modal pour ajouter une tentative -->
                    <button type="button" class="btn btn-block bg-gradient-primary w-25" data-toggle="modal" data-target="#addAttemptModal">
                        Ajouter une tentative <span class="fas fa-plus"></span>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>Heure de début</th>
                            <th>Heure de fin</th>
                            <th>Test</th>
                            <th>Utilisateur</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>08:00</td>
                            <td>09:00</td>
                            <td>Test A</td>
                            <td>Jean Dupont</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fas fa-eye" style="color: blue; margin-right: 10px; cursor: pointer;"></i>
                                    <i class="fas fa-edit" style="color: green; margin-right: 10px; cursor: pointer;"></i>
                                    <i class="fas fa-trash" style="color: red; cursor: pointer;"></i>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>10:00</td>
                            <td>11:30</td>
                            <td>Test B</td>
                            <td>Marie Curie</td>
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

<!-- Modal pour ajouter une tentative -->
<div class="modal fade" id="addAttemptModal" tabindex="-1" role="dialog" aria-labelledby="addAttemptModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAttemptModalLabel">Ajouter une tentative</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulaire d'ajout dans le modal -->
                <form action="/attempts" method="POST">
                    <div class="form-group">
                        <label for="start_time">Heure de début :</label>
                        <input type="time" id="start_time" name="start_time" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="end_time">Heure de fin :</label>
                        <input type="time" id="end_time" name="end_time" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="test_id">Test :</label>
                        <select id="test_id" name="test_id" class="form-control" required>
                            <!-- Options dynamiques -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="user_id">Utilisateur :</label>
                        <select id="user_id" name="user_id" class="form-control" required>
                            <!-- Options dynamiques -->
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">
                            Ajouter la tentative
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
