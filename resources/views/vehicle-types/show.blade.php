@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Detalles del cliente</h5>
                <table class="table">
                    <tr>
                        <th>{{ __('name') }}</th>
                        <td>{{ $vehicle_type->name }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('hourly_rate') }}</th>
                        <td>{{ $vehicle_type->hourly_rate }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('created_at') }}</th>
                        <td>{{ $vehicle_type->created_at }}</td>
                    </tr>
                </table>
                <a href="{{ route('vehicle-types.index') }}" class="btn btn-primary">Volver</a>
            </div>
        </div>
    </div>
@endsection
