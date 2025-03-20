@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')


@section('body')
<form action="/courses" method="POST">
    <label for="title">Titre du cours :</label>
    <input type="text" id="title" name="title" required>

    <label for="content">Contenu :</label>
    <textarea id="content" name="content"></textarea>

    <button type="submit">Ajouter le cours</button>
</form>
@endsection

@extends('layouts.footer')
@extends('layouts.script')
