@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')


@section('body')
<form action="/quizzes" method="POST">
    <label for="question">Question :</label>
    <textarea id="question" name="question" required></textarea>

    <label for="tag">Tag (facultatif) :</label>
    <input type="text" id="tag" name="tag">

    <button type="submit">Ajouter la question</button>
</form>
@endsection

@extends('layouts.footer')
@extends('layouts.script')
