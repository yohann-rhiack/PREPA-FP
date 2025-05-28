@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')

@section('body')
<!-- Section pour la liste des cours -->
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow rounded">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Liste des cours</h5>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addCourseModal" id="btn-color">
                        <i class="fas fa-plus"></i> Ajouter un cours
                    </button>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success" id="success-message">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-center w-100">
                            <thead class="thead-light">
                                <tr>
                                    <th>Titre</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($courses as $course)
                                    <tr>
                                        <td>{{ $course->title }}</td>
                                        <td>{{ Str::limit($course->content, 50) }}</td>
                                        <td>
                                            <a href="{{ route('course.show', $course->id) }}" class="mx-1 text-success">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('course.edit', $course->id) }}" class="mx-1 text-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('course.destroy', $course->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce cours ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link text-danger p-0 mx-1">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal pour ajouter un cours -->
<div class="modal fade" id="addCourseModal" tabindex="-1" aria-labelledby="addCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content shadow-lg rounded-4">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" id="addCourseModalLabel">Ajouter un cours</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('course.store') }}" method="POST">
                    @csrf

                    <h5 class="fw-bold mb-3 text-primary">COURS</h5>

                    <div class="mb-3">
                        <label for="title" class="form-label fw-semibold">Titre du cours</label>
                        <input type="text" id="title" name="title" class="form-control rounded-pill shadow-sm" placeholder="Ex : Mathématiques, Histoire..." required>
                    </div>

                    <div class="mb-4">
                        <label for="content" class="form-label fw-semibold">Description</label>
                        <textarea id="content" name="content" class="form-control rounded-3 shadow-sm" rows="3" placeholder="Entrez une description du cours" required></textarea>
                    </div>

                    <!-- Champ enum pour les thèmes -->
                    <div class="mb-4">
                        <label for="theme" class="form-label fw-semibold">Thème</label>
                        <select id="theme" name="theme" class="form-select rounded-pill shadow-sm" required>
                            <option value="" disabled selected>Choisissez un thème</option>
                            <option value="SCIENCES">Sciences</option>
                            <option value="LETTRES">Lettres</option>
                            <option value="ECONOMIE">Économie</option>
                            <option value="TECHNOLOGIE">Technologie</option>
                            <option value="LANGUES">Langues</option>
                        </select>
                    </div>

                    <hr class="my-4" style="border: 1.5px dashed #ccc;">
                    <h5 class="fw-bold text-primary mb-3">CHAPITRES</h5>

                    <!-- Conteneur des chapitres dynamiques -->
                    <div id="chapters-container">
                        <div class="chapter-item border rounded-3 p-3 mb-3 shadow-sm">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Titre du chapitre</label>
                                <input type="text" name="chapter_title[]" class="form-control rounded-pill shadow-sm" placeholder="Ex : Introduction" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Description du chapitre</label>
                                <textarea name="chapter_description[]" class="form-control rounded-3 shadow-sm" rows="2" placeholder="Détaillez le contenu du chapitre" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Résumé du chapitre</label>
                                <textarea name="chapter_summary_description[]" class="form-control rounded-3 shadow-sm" rows="2" placeholder="Résumé concis" required></textarea>
                            </div>

                            <div class="text-end">
                                <button type="button" class="btn btn-outline-danger btn-sm remove-chapter">
                                    <i class="fas fa-trash-alt me-1"></i> Supprimer
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4 text-center">
                        <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill shadow-sm" id="add-chapter-btn">
                            <i class="fas fa-plus me-1"></i> Ajouter un chapitre
                        </button>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill shadow">
                            <i class="fas fa-save me-2"></i> Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const chaptersContainer = document.getElementById("chapters-container");
        const addChapterBtn = document.getElementById("add-chapter-btn");

        addChapterBtn.addEventListener("click", function () {
            let chapterHTML = `
                <div class="chapter-item border rounded-3 p-3 mb-3 shadow-sm">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Titre du chapitre</label>
                        <input type="text" name="chapter_title[]" class="form-control rounded-pill shadow-sm" placeholder="Entrez le titre du chapitre" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Description du chapitre</label>
                        <textarea name="chapter_description[]" class="form-control rounded-3 shadow-sm" rows="2" placeholder="Entrez la description du chapitre" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Résumé du chapitre</label>
                        <textarea name="chapter_summary_description[]" class="form-control rounded-3 shadow-sm" rows="2" placeholder="Entrez le résumé du chapitre" required></textarea>
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-outline-danger btn-sm remove-chapter">
                            <i class="fas fa-trash-alt me-1"></i> Supprimer
                        </button>
                    </div>
                </div>
            `;
            chaptersContainer.insertAdjacentHTML("beforeend", chapterHTML);
        });

        chaptersContainer.addEventListener("click", function (e) {
            if (e.target.classList.contains("remove-chapter") || e.target.closest('.remove-chapter')) {
                const item = e.target.closest(".chapter-item");
                if (chaptersContainer.querySelectorAll(".chapter-item").length > 1) {
                    item.remove();
                }
            }
        });
    });
</script>

<style>
        #btn-color{
            background: #6c63ff !important;
        }
</style>

@endsection

@extends('layouts.footer')
@extends('layouts.script')
