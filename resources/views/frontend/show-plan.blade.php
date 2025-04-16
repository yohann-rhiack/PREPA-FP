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
                <h3>Détails du plan</h3>
            </div>
            <div class="card-body">
                <p><strong>Titre :</strong> {{ $plans->title }}</p>
                <p><strong>Description :</strong> {{ $plans->description }}</p>
                <p><strong>Prix :</strong> {{ $plans->price }} FCFA</p>
                <p><strong>Cours :</strong> {{ $plans->course->title ?? 'N/A' }}</p>
                <a href="{{ route('frontend.plan') }}" class="btn btn-primary">Retour à la liste</a>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.footer')
@extends('layouts.script')
