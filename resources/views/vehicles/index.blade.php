@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4>{{ __('Vehicles') }}</h4>
                    <a class="btn btn-sm btn-primary" href="{{ route('vehicles.create') }}">
                        Crear {{ __('Vehicle') }}
                    </a>
                </div>

                <div class="card-body">
                    <livewire:data-table
                        :columns="$columns"
                        :data="$vehicles"
                        :route="$route"
                    />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    h4 {
        margin-bottom: 0 !important;
    }
</style>
@endpush
