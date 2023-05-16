@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Detalles del cliente</h5>
                <table class="table">
                    <tr>
                        <th>{{ __('customer') }}</th>
                        <td>{{ $vehicle->customer->name }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('type') }}</th>
                        <td>{{ $vehicle->vehicleType->name }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('plate') }}</th>
                        <td>{{ $vehicle->plate }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('created_at') }}</th>
                        <td>{{ $vehicle->created_at }}</td>
                    </tr>
                </table>
                <a href="{{ route('vehicles.index') }}" class="btn btn-primary">Volver</a>
            </div>
        </div>
    </div>
@endsection
