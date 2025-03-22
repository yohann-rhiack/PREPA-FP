@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')


@section('body')
<!-- Section pour ajouter une tentative -->
<div class="d-flex justify-content-center mt-5">
    <div class="card card-warning" style="width: 50%;">
        <div class="card-header text-center">
            <h3 class="card-title">Ajouter une tentative</h3>
        </div>
        <div class="card-body">
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

<!-- Section pour la liste des tentatives -->
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-center">
                    <a href="{{ route('frontend.tentative')}}" class="btn btn-block bg-gradient-primary w-25">
                        Ajouter une tentative <span class="fas fa-plus"></span>
                    </a>
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


@endsection

@extends('layouts.footer')
@extends('layouts.script')
