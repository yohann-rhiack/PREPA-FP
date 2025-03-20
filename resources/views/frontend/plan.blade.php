@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')


@section('body')
<form action="/plans" method="POST">
    <label for="title">Titre du plan :</label>
    <input type="text" id="title" name="title" required>

    <label for="description">Description :</label>
    <textarea id="description" name="description"></textarea>

    <label for="price">Prix :</label>
    <input type="number" id="price" name="price" required>

    <label for="course_id">Cours :</label>
    <select id="course_id" name="course_id" required>
        <!-- Les options seront remplies dynamiquement avec les cours existants -->
    </select>

    <button type="submit">Ajouter le plan</button>
</form>

@endsection

@extends('layouts.footer')
@extends('layouts.script')
