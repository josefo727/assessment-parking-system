<div class="form-group">
    <label for="name">{{ __('name') }}</label>
    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $customer->name ?? '') }}">
    @error('name')
        <span class="text-danger">
            {{ $message }}
        </span>
    @enderror
</div>

<div class="form-group mt-2">
    <label for="email">{{ __('email') }}</label>
    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $customer->email ?? '') }}">
    @error('email')
        <span class="text-danger">
            {{ $message }}
        </span>
    @enderror
</div>

<div class="form-group mt-2">
    <label for="mobile">{{ __('mobile') }}</label>
    <input type="text" name="mobile" id="mobile" class="form-control" value="{{ old('mobile', $customer->mobile ?? '') }}">
    @error('mobile')
        <span class="text-danger">
            {{ $message }}
        </span>
    @enderror
</div>

@include('partials.form-actions')

