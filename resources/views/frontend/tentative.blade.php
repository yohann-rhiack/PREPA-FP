@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')


@section('body')
<form action="/attempts" method="POST">
    <label for="start_time">Heure de début :</label>
    <input type="time" id="start_time" name="start_time" required>

    <label for="end_time">Heure de fin :</label>
    <input type="time" id="end_time" name="end_time" required>

    <label for="test_id">Test :</label>
    <select id="test_id" name="test_id" required>
        <!-- Les options seront remplies dynamiquement avec les tests existants -->
    </select>

    <label for="user_id">Utilisateur :</label>
    <select id="user_id" name="user_id" required>
        <!-- Les options seront remplies dynamiquement avec les utilisateurs existants -->
    </select>

    <button type="submit">Ajouter la tentative</button>
</form>

@endsection

@extends('layouts.footer')
@extends('layouts.script')
