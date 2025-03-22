@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')


@section('body')
<!-- Section pour ajouter un quiz -->
<div class="d-flex justify-content-center mt-5">
    <div class="card card-warning" style="width: 50%;">
        <div class="card-header text-center">
            <h3 class="card-title">Ajouter une question</h3>
        </div>
        <div class="card-body">
            <form action="/quizzes" method="POST">
                <div class="form-group">
                    <label for="question">Question :</label>
                    <textarea id="question" name="question" class="form-control" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="tag">Tag (facultatif) :</label>
                    <input type="text" id="tag" name="tag" class="form-control">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">
                        Ajouter la question
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Section pour la liste des questions -->
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-center">
                    <a href="{{ route('frontend.question') }}" class="btn btn-block bg-gradient-primary w-25">
                        Ajouter une question <span class="fas fa-plus"></span>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>Question</th>
                            <th>Tag</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Quelle est la capitale de la France ?</td>
                            <td>Géographie</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fas fa-eye" style="color: blue; margin-right: 10px; cursor: pointer;"></i>
                                    <i class="fas fa-edit" style="color: green; margin-right: 10px; cursor: pointer;"></i>
                                    <i class="fas fa-trash" style="color: red; cursor: pointer;"></i>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Combien font 7 x 8 ?</td>
                            <td>Mathématiques</td>
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
