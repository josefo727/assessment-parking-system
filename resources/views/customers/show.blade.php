@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Detalles del cliente</h5>
                <table class="table">
                    <tr>
                        <th>{{ __('name') }}</th>
                        <td>{{ $customer->name }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('email') }}</th>
                        <td>{{ $customer->email }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('mobile') }}</th>
                        <td>{{ $customer->mobile }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('created_at') }}</th>
                        <td>{{ $customer->created_at }}</td>
                    </tr>
                </table>
                <a href="{{ route('customers.index') }}" class="btn btn-primary">Volver</a>
            </div>
        </div>
    </div>
@endsection
