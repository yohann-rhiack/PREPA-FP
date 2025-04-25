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
                    <h3 class="card-title">Modifier Abonnement</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('abonnement.update', $subscription->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="start_date">Date de début</label>
                                    <input type="date" class="form-control" name="start_date" value="{{ old('start_date', $subscription->start_date) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="end_date">Date de fin</label>
                                    <input type="date" class="form-control" name="end_date" value="{{ old('end_date', $subscription->end_date) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">Statut</label>
                                    <select id="status" name="status" class="form-control" required>
                                        <option value="1" {{ $subscription->status == 1 ? 'selected' : '' }}>Actif</option>
                                        <option value="0" {{ $subscription->status == 0 ? 'selected' : '' }}>Inactif</option>
                                    </select>
                                </div>
                            </div>
                        </div><br>

                        <div class="row">
                            <!-- Update Button -->
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success w-100">Mettre à Jour</button>
                            </div>

                            <!-- Back to Subscription List Button -->
                            <div class="col-md-6">
                                <a href="{{ route('frontend.abonnement') }}" class="btn btn-secondary w-100">Retour à la Liste</a>
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
