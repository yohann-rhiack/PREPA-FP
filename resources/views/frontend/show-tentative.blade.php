@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')

@section('body')
<div class="content">
    <div class="container-fluid"> 
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Détails tentative</h3>
            </div>
            <div class="card-body">
                <h3>Heure de début : {{ $attempt->start_time }}</h3>
                <h3>Heure de fin : {{ $attempt->end_time }}</h3>
                <p><strong>Test :</strong> {{ $attempt->test->title ?? 'Non défini' }}</p>
                <p><strong>Utilisateur :</strong> {{ $attempt->user->fname ?? 'Non défini' }} {{ $attempt->user->lname ?? '' }}</p>

                <a href="{{ route('frontend.tentative') }}" class="btn btn-primary">Retour</a>
            </div>
        </div>
    </div>
</div>

@endsection

@extends('layouts.footer')
@extends('layouts.script')
