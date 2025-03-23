@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')

@section('body')
<!-- Section pour la liste des cours -->
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-center">
                    <!-- Bouton qui déclenche le modal -->
                    <button type="button" class="btn btn-block bg-gradient-primary w-25" data-toggle="modal" data-target="#addCourseModal">
                        Ajouter un cours <span class="fas fa-plus"></span>
                    </button>
                </div>
            </div>

            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>Titre</th>
                            <th>Contenu</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($courses as $course)
                            <tr>
                                <td>{{ $course->title }}</td>
                                <td>{{ Str::limit($course->content, 50) }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <a href="{{ route('course.show', $course->id) }}">
                                            <i class="fas fa-eye" style="color: blue; margin-right: 10px; cursor: pointer;"></i>
                                        </a>
                                        <a href="{{ route('course.edit', $course->id) }}">
                                            <i class="fas fa-edit" style="color: green; margin-right: 10px; cursor: pointer;"></i>
                                        </a>
                                        <form action="{{ route('course.destroy', $course->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce cours ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="border: none; background: transparent;">
                                                <i class="fas fa-trash" style="color: red; cursor: pointer;"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

<!-- Modal pour ajouter un cours -->
<div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="addCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCourseModalLabel">Ajouter un cours</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulaire d'ajout dans le modal -->
                <form action="{{ route('course.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title">Titre du cours :</label>
                        <input type="text" id="title" name="title" class="form-control" placeholder="Entrez le titre du cours" required>
                    </div>
                    <div class="form-group">
                        <label for="content">Contenu :</label>
                        <textarea id="content" name="content" class="form-control" rows="3" placeholder="Entrez une description du contenu" required></textarea>
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
