@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')


@section('body')
<form action="/chapters" method="POST">
    <label for="title">Titre du chapitre :</label>
    <input type="text" id="title" name="title" required>

    <label for="content">Contenu :</label>
    <textarea id="content" name="content"></textarea>

    <label for="course_id">Cours :</label>
    <select id="course_id" name="course_id" required>
        <!-- Les options seront remplies dynamiquement avec les cours existants -->
    </select>

    <label for="parent_id">Chapitre parent (facultatif) :</label>
    <select id="parent_id" name="parent_id">
        <!-- Les options seront remplies dynamiquement avec les chapitres existants -->
    </select>

    <button type="submit">Ajouter le chapitre</button>
</form>

@endsection

@extends('layouts.footer')
@extends('layouts.script')
