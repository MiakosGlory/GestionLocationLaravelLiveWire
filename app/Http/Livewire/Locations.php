<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Client;
use App\Models\User;
use App\Models\Location;
use Livewire\WithPagination;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class Locations extends Component
{
    protected $paginationTheme = "bootstrap";
    
    use WithPagination;

    public $newLocation = "";
    public $editLocation = [];

    public function render()
    {
        Carbon::setlocale("fr");

        $data = [
            "locations" => Location::paginate(5),                         
            "clients" => Client::all(),
            "users" => User::all()
        ];

        return view('livewire.locations.index', $data)
        ->extends("layout.master")
        ->section("content");
    }

    public function addLocationModal()
    {
        $this->resetErrorBag();
        $this->dispatchBrowserEvent("showAddLocationModal", []);
    }

    public function addLocation()
    {
        $this->validate([
            "newLocation.dateDebut" => "required",
            "newLocation.dateFin" => "required",
            "newLocation.user_id" => "required",
            "newLocation.client_id" => "required"
        ]);

        Location::create([
            "dateDebut" => $this->newLocation["dateDebut"],
            "dateFin" => $this->newLocation["dateFin"],
            "client_id" => $this->newLocation["client_id"],
            "user_id" => $this->newLocation["user_id"]
        ]);

        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Location bien ajoutée"]);
        $this->closeAddLocationModal();
    }

    public function closeAddLocationModal()
    {
        $this->newLocation = [];
        $this->resetErrorBag();
        $this->dispatchBrowserEvent("closeAddLocationModal", []);
    }
}
