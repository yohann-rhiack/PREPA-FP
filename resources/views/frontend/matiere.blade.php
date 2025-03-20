@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')


@section('body')
<form action="/subjects" method="POST">
    <label for="title">Titre de la matière :</label>
    <input type="text" id="title" name="title" required>

    <label for="description">Description :</label>
    <textarea id="description" name="description"></textarea>

    <button type="submit">Ajouter la matière</button>
</form>
@endsection

@extends('layouts.footer')
@extends('layouts.script')
