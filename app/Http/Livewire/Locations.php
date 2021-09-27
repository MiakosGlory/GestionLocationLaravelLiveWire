<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Client;
use App\Models\User;
use App\Models\Location;
use App\Models\StatutLocation;
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
            "users" => User::all(),
            "statut_location" => StatutLocation::all()
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
            "newLocation.client_id" => "required",
            "newLocation.statut_location_id" => "required"
        ]);

        Location::create([
            "dateDebut" => $this->newLocation["dateDebut"],
            "dateFin" => $this->newLocation["dateFin"],
            "client_id" => $this->newLocation["client_id"],
            "user_id" => $this->newLocation["user_id"],
            "statut_location_id" => $this->newLocation["statut_location_id"]
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

    public function showDeleteLocation($id)
    {
        $this->dispatchBrowserEvent("showConfirmMessage", ["message" => ["text" => "Vous êtes sur le point de 
        supprimer cette loccation. Voulez-vous continuer ?",
        "title" => "Êtes vous sûr de continuer ?", 
        "type" => "warning",
        "data" => ["location_id" => $id]
        ]]);
    }
    public function deleteLocation(Location $location)
    {
        $location->delete();
        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Location supprimée avec succès"]);
    }

    public function editLocationModal(Location $location)
    {
        $this->editLocation["dateDebut"] = $location->dateDebut;
        $this->editLocation["dateFin"] = $location->dateFin;
        $this->editLocation["client_id"] = $location->client_id;
        $this->editLocation["user_id"] = $location->user_id;
        $this->editLocation["statut_location_id"] = $location->statut_location_id;
        $this->editLocation["id"] = $location->id;

        $this->dispatchBrowserEvent("showEditLocationModal", []);
    }

    public function updateLocation()
    {
        $this->validate([
            "editLocation.dateDebut" => "required",
            "editLocation.dateFin" => "required",
            "editLocation.client_id" => "required",
            "editLocation.user_id" => "required",
            "editLocation.statut_location_id" => "required"
        ]);

        Location::find($this->editLocation["id"])->update([
            "dateDebut" => $this->editLocation["dateDebut"],
            "dateFin" => $this->editLocation["dateFin"],
            "user_id" => $this->editLocation["user_id"],
            "client_id" => $this->editLocation["client_id"],
            "statut_location_id" => $this->editLocation["statut_location_id"]
        ]);

        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Loccation modifié avec succès"]);
        $this->closeEditLocationModal();
    }

    public function closeEditLocationModal()
    {
        $this->resetErrorBag();
        $this->dispatchBrowserEvent("closeEditLocationModal", []);
    }
}
