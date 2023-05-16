<div class="form-group col-8">
    <label for="name">{{ __('name') }}</label>
    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $vehicle_type->name ?? '') }}">
    @error('name')
        <span class="text-danger">
            {{ $message }}
        </span>
    @enderror
</div>

<div class="form-group col-4">
    <label for="hourly_rate">{{ __('hourly_rate') }}</label>
    <input type="number" step="0.01" min="0" max="99.99" pattern="\d+(\.\d{2})?" name="hourly_rate" id="hourly_rate" class="form-control" value="{{ old('hourly_rate', $vehicle_type->hourly_rate ?? '') }}">
    @error('hourly_rate')
        <span class="text-danger">
            {{ $message }}
        </span>
    @enderror
</div>

@include('partials.form-actions')
