<?php

namespace App\Http\Livewire;

use App\Models\Record;
use App\Models\Vehicle;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Register extends Component
{

    public Collection $vehicles;
    public $records = [];
    public int $selectedVehicleId;
    public bool $canRecordIncome = false;
    public $search = '';

    public function mount(): void
    {
        $this->setVehicles();
    }
    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.register');
    }

    public function setVehicles(): void
    {
        $this->vehicles = Vehicle::with(['customer', 'vehicleType'])
            ->filterByCustomerOrByPlate($this->search)
            ->get();
    }

    public function updatedSearch(): void
    {
        $this->setVehicles();
    }
    /**
     * @param mixed $id
     */
    public function selectVehicle($id): void
    {
        $this->selectedVehicleId = $id;
        $this->records = Record::query()
             ->where('vehicle_id', $id)
             ->where(function($query) {
                 $query->whereDate('entry_at', now())
                     ->orWhereDate('exit_at', now())
                     ->orWhereNull('exit_at');
             })
             ->get();

        $this->canRecordIncome = !Record::query()
             ->where('vehicle_id', $id)
            ->whereNull('exit_at')
            ->exists();
    }

    public function recordIncome(): void
    {
        Record::query()
            ->create([
                'vehicle_id' => $this->selectedVehicleId,
                'entry_at' => now()
            ]);

        $this->selectVehicle($this->selectedVehicleId);
    }

    public function recordOutflow(int $id): void
    {
        Record::query()
            ->findOrFail($id)
            ->recordOutput();

        $this->selectVehicle($this->selectedVehicleId);
    }

}
