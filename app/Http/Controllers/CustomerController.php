<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerFormRequest;
use App\Models\Customer;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $customers = Customer::query()
            ->orderBy('id', 'desc')
            ->paginate(10);

        $columns = [
            'name',
            'email',
            'mobile',
            'created_at'
        ];

        $route = 'customers';

        return view('customers.index', compact('customers', 'columns', 'route'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $customer = new Customer();

        $route = 'customers';

        return view('customers.create', compact('customer', 'route'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CustomerFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerFormRequest $request): RedirectResponse
    {
        Customer::query()->create($request->all());

        return redirect()->route('customers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer): View
    {
        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer): View
    {
        $route = 'customers';

        return view('customers.edit', compact('customer', 'route'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CustomerFormRequest  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerFormRequest $request, Customer $customer): RedirectResponse
    {
        $customer->update($request->all());

        return redirect()->route('customers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer): RedirectResponse
    {
        $customer->delete();

        return redirect()->route('customers.index');
    }
}
