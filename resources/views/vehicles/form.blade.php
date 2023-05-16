<div class="form-group col-4">
    <label for="plate">{{ __('plate') }}</label>
    <input type="text" name="plate" id="plate" class="form-control" value="{{ old('name', $vehicle->plate ?? '') }}">
    @error('plate')
        <span class="text-danger">
            {{ $message }}
        </span>
    @enderror
</div>

<div class="form-group col-4">
    <label for="customer_id">{{ __('Customer') }}</label>
    <select name="customer_id" id="customer_id" class="form-control">
        <option value="">
            Seleccione cliente
        </option>
        @foreach ($customers as $customer)
            <option value="{{ $customer->id }}" {{ old('customer_id', $vehicle->customer_id ?? '') == $customer->id ? 'selected' : '' }}>
                {{ $customer->name }}
            </option>
        @endforeach
    </select>
    @error('customer_id')
        <span class="text-danger">
            {{ $message }}
        </span>
    @enderror
</div>

<div class="form-group col-4">
    <label for="vehicle_type_id">{{ __('Vehicle type') }}</label>
    <select name="vehicle_type_id" id="vehicle_type_id" class="form-control">
        <option value="">
            Seleccione tipo
        </option>
        @foreach ($vehicleTypes as $vehicleType)
            <option value="{{ $vehicleType->id }}" {{ old('vehicle_type_id', $vehicle->vehicle_type_id ?? '') == $vehicleType->id ? 'selected' : '' }}>
                {{ $vehicleType->name }}
            </option>
        @endforeach
    </select>
    @error('vehicle_type_id')
        <span class="text-danger">
            {{ $message }}
        </span>
    @enderror
</div>

@include('partials.form-actions')
