@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')


@section('body')
<form action="/summaries" method="POST">
    <label for="content">Résumé :</label>
    <textarea id="content" name="content" required></textarea>

    <label for="chapter_id">Chapitre :</label>
    <select id="chapter_id" name="chapter_id" required>
        <!-- Les options seront remplies dynamiquement avec les chapitres existants -->
    </select>

    <button type="submit">Ajouter le résumé</button>
</form>
@endsection

@extends('layouts.footer')
@extends('layouts.script')
