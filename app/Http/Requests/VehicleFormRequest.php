<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Rules\ValidVehiclePlate;
use Illuminate\Foundation\Http\FormRequest;

class VehicleFormRequest extends FormRequest
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
        $vehicleId = $this->route('vehicle');

        return [
            'customer_id' => ['required', 'integer', Rule::exists('customers', 'id')],
            'plate' => ['required', 'string', Rule::unique('vehicles')->ignore($vehicleId), new ValidVehiclePlate],
            'vehicle_type_id' => ['required', 'integer', Rule::exists('vehicle_types', 'id')],
        ];
    }
}
