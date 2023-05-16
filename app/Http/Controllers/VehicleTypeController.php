<?php

namespace App\Http\Controllers;

use App\Models\VehicleType;
use Illuminate\Contracts\View\View;
use App\Http\Requests\VehicleTypeFormRequest;
use Illuminate\Http\RedirectResponse;

class VehicleTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $vehicleTypes = VehicleType::query()
            ->orderBy('id', 'ASC')
            ->paginate(10);

        $columns = [
            'name',
            'hourly_rate',
            'created_at'
        ];

        $route = 'vehicle-types';

        return view('vehicle-types.index', compact('vehicleTypes', 'columns', 'route'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $vehicle_type = new VehicleType();

        $route = 'vehicle-types';

        return view('vehicle-types.create', compact('vehicle_type', 'route'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\VehicleTypeFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VehicleTypeFormRequest $request): RedirectResponse
    {
        VehicleType::query()->create($request->all());

        return redirect()->route('vehicle-types.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VehicleType $vehicle_type
     * @return \Illuminate\Http\Response
     */
    public function show(VehicleType $vehicle_type): View
    {
        return view('vehicle-types.show', compact('vehicle_type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VehicleType $vehicle_type
     * @return \Illuminate\Http\Response
     */
    public function edit(VehicleType $vehicle_type): View
    {
        $route = 'vehicle-types';

        return view('vehicle-types.edit', compact('vehicle_type', 'route'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\VehicleTypeFormRequest  $request
     * @param  \App\Models\VehicleType  $vehicle_type
     * @return \Illuminate\Http\Response
     */
    public function update(VehicleTypeFormRequest $request, VehicleType $vehicle_type): RedirectResponse
    {
        $vehicle_type->update($request->all());

        return redirect()->route('vehicle-types.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VehicleType  $vehicle_type
     * @return \Illuminate\Http\Response
     */
    public function destroy(VehicleType $vehicle_type): RedirectResponse
    {
        $vehicle_type->delete();

        return redirect()->route('vehicle-types.index');
    }
}
