@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h4>Editar {{ __('Customer') }}</h4></div>

                <div class="card-body">
                    <form class="" action="{{ route('customers.update', $customer->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('customers.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

