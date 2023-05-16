@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h4>Crear {{ __('Vehicle type') }}</h4></div>

                <div class="card-body">
                    <form class="row col-12" action="{{ route('vehicle-types.store') }}" method="POST">
                        @csrf
                        @include('vehicle-types.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

