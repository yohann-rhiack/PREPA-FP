@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')


@section('body')
<form action="/answers" method="POST">
    <label for="content">Réponse :</label>
    <textarea id="content" name="content" required></textarea>

    <label for="tag">Correcte ?</label>
    <input type="checkbox" id="tag" name="tag" value="1">

    <button type="submit">Ajouter la réponse</button>
</form>
@endsection

@extends('layouts.footer')
@extends('layouts.script')
