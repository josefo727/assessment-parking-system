<div class="row lists-container">
    <div class="list-container col-md-6 overflow-auto d-flex flex-column py-2">
        <div class="card my-1 mx-2">
            <div class="input-group">
                <span
                    class="input-group-text"
                    id="search"
                >
                    <x-bx-search width="25px"/>
                </span>
                <input
                    id="search-vehicle"
                    type="text"
                    class="form-control"
                    placeholder="Buscar..."
                    aria-label="Buscar"
                    aria-describedby="search"
                    wire:model="search"
                >
                <button
                    wire:click="$set('search', '')"
                    class="btn btn-primary"
                    type="button" id="clear"
                >
                    <x-bx-x width="25px"/>
                </button>
            </div>
        </div>

        @foreach ($vehicles as $vehicle)
            <div class="card my-1 mx-2 vehicle">
                <span
                    class="stretched-link {{ $selectedVehicleId === $vehicle->id ? 'selected' : '' }}"
                    wire:click.prevent="selectVehicle({{ $vehicle->id }})"
                >
                    <div class="card-body">
                        <h5 class="card-title">
                            {{ $vehicle->vehicleType->name }}
                            de placa: {{ $vehicle->plate }}
                            | {{ $vehicle->customer->name }}
                        </h5>
                    </div>
                </span>
            </div>
        @endforeach
    </div>
    <div class="separator-container">
        <hr class="separator" />
    </div>
    <div id="listrecords" class="list-container col-md-6 overflow-auto d-flex flex-column py-2">
        @if($canRecordIncome)
            <div class="card my-1 mx-2 record">
                <div class="row col-12">
                    <div class="card-body record-container">
                        <h5 class="card-title col-9 mx-2">Registrar ingreso</h5>
                        <div class="col-3 actions px-1">
                            <button
                                class="btn btn-sm w-4 rounded-2"
                                wire:click.prevent="recordIncome"
                            >
                                <x-bx-log-in height="40px"/>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @foreach($records as $record)
            <div class="card my-1 mx-2 record">
                <div class="row col-12">
                    <div class="card-body record-container">
                        @if(is_null($record->exit_at))
                            <h5 class="card-title col-9 mx-2">
                                Ingresó el {{ $record->entry_at->format('d-m-Y h:m A') }}
                                ({{$record->elapsedTimeForHumans()}})
                            </h5>
                            <div class="col-3 actions px-1">
                                <button
                                    class="btn btn-sm w-4 rounded-2"
                                    wire:click.prevent="recordOutflow({{$record->id}})"
                                >
                                    <x-bx-log-out height="40px"/>
                                </button>
                            </div>
                        @else
                            <h5 class="card-title col-9 mx-2">
                                Salida {{ $record->exit_at->format('d-m-Y h:m A') }}
                                Total: USD $ {{$record->total_amount}}
                            </h5>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@push('styles')
<style>
.separator-container {
    display: none;
}
.list-container {
    height: calc(100vh - 220px);
}
.vehicle {
    cursor: pointer;
    background-color: azure;
}
h5 {
    margin-bottom: 0 !important;
}
.selected {
    background-color: #88ff86;
}
.record {
    background-color: #e1e1e1;
}
.record-container {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    height: 54px;
    align-items: center;
}
.record-container > .card-title {
    margin-bottom: 0;
}
.actions {
    text-align: end;
}
.info-delay {
    margin-top: -24px;
}
.list-group-item {
    width: 100%;
    background-color: #acd9db;
    cursor: pointer;
}
.reason {
    margin-left: 10px;
    width: 100%;
}
.submit-container {
    margin: 11px;
}
@media screen and (max-width: 767px) {
    .separator-container {
        display: flex;
        justify-content: center;
    }
    .separator{
        margin: 1rem 0 !important;
        width: 96%;
        border: 2px solid #616876;
        width: 90%;
    }
    .lists-container{
        height: calc(100vh - 140px);
    }
    .list-container{
        height: calc(50vh - 86px);
    }
}
</style>
@endpush


