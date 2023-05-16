<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class VehicleTypeFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $vehicleTypeId = $this->route('vehicle_type');

        return [
            'name' => ['required', 'string', 'max:32', Rule::unique('vehicle_types')->ignore($vehicleTypeId)],
            'hourly_rate' => ['required', 'numeric', 'between:0.01,100.00'],
        ];
    }
}
