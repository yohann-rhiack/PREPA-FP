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
                    <h3 class="card-title">Modifier utilisateur</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('utilisateur.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="fname">Nom de l'utilisateur</label>
                            <input type="text" class="form-control" name="fname" value="{{ $user->fname }}" required>
                        </div>

                        <div class="form-group">
                            <label for="lname">Prénom de l'utilisateur</label>
                            <input type="text" class="form-control" name="lname" value="{{ $user->lname }}" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Téléphone</label>
                            <input type="text" name="phone"  class="form-control" rows="4" value="{{ $user->phone }}" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" name="email" rows="4" value="{{ $user->email }}" required>
                        </div>


                        <div class="form-group">
                            <label for="role">Rôle de l'utilisateur</label>
                            <select name="role_id" class="form-control" required>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                        {{ $role->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div><br>

                        <div class="row">
                            <!-- Update Button -->
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success w-100">Mettre à Jour</button>
                            </div>

                            <!-- Back to List Button -->
                            <div class="col-md-6">
                                <a href="{{ route('frontend.utilisateur') }}" class="btn btn-secondary w-100">Retour à la Liste</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
       </div>
    </div>
</div>
@endsection

@extends('layouts.footer')
@extends('layouts.script')
