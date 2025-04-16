@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')

@section('body')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Modifier la tentative</h3>
                </div>
                <div class="card-body">

                    <!-- Affichage des messages d'erreur -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Affichage du message de succès -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('tentative.update', $attempt->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="start_time">Heure de début</label>
                            <input type="time" name="start_time" id="start_time" class="form-control" 
                                   value="{{ old('start_time', $attempt->start_time) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="end_time">Heure de fin</label>
                            <input type="time" name="end_time" id="end_time" class="form-control" 
                                   value="{{ old('end_time', $attempt->end_time) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="test_id">Test</label>
                            <select name="test_id" id="test_id" class="form-control" required>
                                @foreach($tests as $test)
                                    <option value="{{ $test->id }}" 
                                            {{ (int)old('test_id', $attempt->test_id) === (int)$test->id ? 'selected' : '' }}>
                                        {{ $test->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="user_id">Utilisateur</label>
                            <select name="user_id" id="user_id" class="form-control" required>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" 
                                            {{ (int)old('user_id', $attempt->user_id) === (int)$user->id ? 'selected' : '' }}>
                                        {{ $user->fname }} {{ $user->lname }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    </form>
                    
                </div>
            </div>
       </div>
    </div>
</div>
@endsection

@extends('layouts.footer')
@extends('layouts.script')
