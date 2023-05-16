<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class DataTable extends Component
{
    public $columns;
    public $columnNames;
    protected $data;
    public $route;

    /**
     * @param mixed $data
     * @param mixed $columns
     * @param mixed $columnNames
     * @param mixed $route
     * @return void
     */
    public function mount($data, $columns, $route): void
    {
        $this->data = $data;
        $this->columns = $columns;
        $this->route = $route;
    }
    /**
     * @return View|Factory
     */
    public function render(): View
    {
        return view('livewire.data-table', [
            'data' => $this->data,
        ]);
    }

}
