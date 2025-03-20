@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')


@section('body')
<form action="/schools" method="POST">
    <label for="name">Nom de l'école :</label>
    <input type="text" id="name" name="name" required>

    <label for="description">Description :</label>
    <textarea id="description" name="description"></textarea>

    <button type="submit">Ajouter l'école</button>
</form>
@endsection

@extends('layouts.footer')
@extends('layouts.script')
