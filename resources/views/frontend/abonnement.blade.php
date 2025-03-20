@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')


@section('body')
<form action="/subscriptions" method="POST">
    <label for="start_date">Date de début :</label>
    <input type="date" id="start_date" name="start_date" required>

    <label for="end_date">Date de fin :</label>
    <input type="date" id="end_date" name="end_date" required>

    <label for="status">Statut :</label>
    <input type="checkbox" id="status" name="status" value="1" checked>

    <button type="submit">Ajouter l'abonnement</button>
</form>
@endsection

@extends('layouts.footer')
@extends('layouts.script')
