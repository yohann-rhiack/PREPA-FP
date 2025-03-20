@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')


@section('body')
<form action="/cycles" method="POST">
    <label for="name">Nom du cycle :</label>
    <input type="text" id="name" name="name" required>

    <label for="description">Description :</label>
    <textarea id="description" name="description"></textarea>

    <button type="submit">Ajouter le cycle</button>
</form>
@endsection

@extends('layouts.footer')
@extends('layouts.script')
