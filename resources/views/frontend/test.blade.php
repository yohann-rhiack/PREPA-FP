@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')


@section('body')
<form action="/tests" method="POST">
    <label for="title">Titre du test :</label>
    <input type="text" id="title" name="title" required>

    <label for="type_id">Type de test :</label>
    <select id="type_id" name="type_id" required>
        <!-- Les options seront remplies dynamiquement avec les types de tests existants -->
    </select>

    <label for="time">Durée (en minutes) :</label>
    <input type="number" id="time" name="time" required>

    <button type="submit">Ajouter le test</button>
</form>

@endsection

@extends('layouts.footer')
@extends('layouts.script')
