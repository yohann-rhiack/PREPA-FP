@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')

@section('body')
<div class="container-fluid px-0">
    <div class="row mx-0">
        <div class="col-12">
            <div class="card mb-4 shadow-sm rounded-0">
                <div class="card-header bg-dark text-white">
                    <h3 class="card-title mb-0">Détails tentative</h3>
                </div>
                <div class="card-body">
                    <h4><strong>Heure de début :</strong> {{ $attempt->start_time }}</h4>
                    <h4><strong>Heure de fin :</strong> {{ $attempt->end_time }}</h4>
                    <p><strong>Test :</strong> {{ $attempt->test->title ?? 'Non défini' }}</p>
                    <p><strong>Utilisateur :</strong> {{ $attempt->user->fname ?? 'Non défini' }} {{ $attempt->user->lname ?? '' }}</p>

                    <a href="{{ route('frontend.tentative') }}" class="btn btn-outline-primary mt-4">← Retour</a>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@extends('layouts.footer')
@extends('layouts.script')
