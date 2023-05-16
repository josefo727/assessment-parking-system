<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Requests\VehicleFormRequest;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $vehicles = Vehicle::query()
            ->join('customers', 'customer_id', 'customers.id')
            ->join('vehicle_types', 'vehicle_type_id', 'vehicle_types.id')
            ->orderBy('vehicles.id', 'DESC')
            ->select('vehicles.*', 'customers.name AS customer', 'vehicle_types.name AS type')
            ->paginate(10);

        $columns = [
            'plate',
            'type',
            'customer',
            'created_at'
        ];

        $route = 'vehicles';

        return view('vehicles.index', compact('vehicles', 'columns', 'route'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $vehicle = new Vehicle();

        $customers = Customer::query()->select('id', 'name')->get();

        $vehicleTypes = VehicleType::query()->select('id', 'name')->get();

        $route = 'vehicles';

        return view('vehicles.create', compact('vehicle', 'customers', 'vehicleTypes', 'route'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\VehicleFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VehicleFormRequest $request): RedirectResponse
    {
        Vehicle::query()->create($request->all());

        return redirect()->route('vehicles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicle $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle): View
    {
        return view('vehicles.show', compact('vehicle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicle $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle): View
    {
        $route = 'vehicles';

        $customers = Customer::query()->select('id', 'name')->get();

        $vehicleTypes = VehicleType::query()->select('id', 'name')->get();

        return view('vehicles.edit', compact('vehicle', 'customers', 'vehicleTypes', 'route'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\VehicleFormRequest  $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(VehicleFormRequest $request, Vehicle $vehicle): RedirectResponse
    {
        $vehicle->update($request->all());

        return redirect()->route('vehicles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle): RedirectResponse
    {
        $vehicle->delete();

        return redirect()->route('vehicles.index');
    }

}
