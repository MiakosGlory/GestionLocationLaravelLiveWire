<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Client;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
//use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class Clients extends Component
{
    protected $paginationTheme = "bootstrap";
    
    use WithPagination;
    
    public $currentPage = PAGE_LIST;

    public $newClient = [];
    public $editClient = [];
    public string $seach = "";

    public function render()
    {
        Carbon::setlocale("fr");

        return view('livewire.clients.index', ["clients" => Client::where("nom", 
            "LIKE", "%{$this->seach}%")->latest()->paginate(5)])
            ->extends("layout.master")
            ->section("content");
    }

    public function rules()
    {
        if($this->currentPage == PAGE_EDIT)
        {
            return ["editClient.nom" => "required|min:3",
            "editClient.prenom" => "required|min:3",
            "editClient.sexe" => "required",
            "editClient.telephone" => ["required",
                Rule::unique("clients", "telephone")->ignore($this->editClient["id"])],
            "editClient.pieceIdentite" => "required",
            "editClient.adresse" => "required",
            "editClient.pays" => "required",
            "editClient.ville" => "required",
            "editClient.nationalite" => "required",
            "editClient.lieuNaissance" => "required",
            "editClient.dateNaissance" => "required",
            "editClient.numeroPieceIdentite" => ["required", "min:4",
                Rule::unique("clients", "numeroPieceIdentite")->ignore($this->editClient["id"])]
            ];
        }

        return [
            "newClient.nom" => "required|min:3",
            "newClient.prenom" => "required|min:3",
            "newClient.sexe" => "required",
            "newClient.adresse" => "required",
            "newClient.ville" => "required",
            "newClient.pays" => "required",
            "newClient.nationalite" => "required",
            "newClient.lieuNaissance" => "required",
            "newClient.dateNaissance" => "required",
            "newClient.telephone" => ["required", "numeric", 
                Rule::unique("clients", "telephone")],
            "newClient.pieceIdentite" => "required",
            "newClient.numeroPieceIdentite" => ["required", "min:4", 
                Rule::unique("clients", "numeroPieceIdentite")]
        ];
    }

    public function getButton()
    {
        $this->resetErrorBag();
        $this->currentPage = PAGE_AJOUT;
    }

    public function goToListeClient()
    {
        $this->currentPage = PAGE_LIST;
        $this->editClient = [];
    }

    public function goToEditClient($id)
    {
        $this->editClient = Client::find($id)->toArray();
        $this->currentPage = PAGE_EDIT;
    }

    public function addClient()
    {
        $validationAttributes = $this->validate();

        Client::create($validationAttributes["newClient"]);

        $this->newClient = [];
        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Client ajouté ajouté avec succès"]);
    }

    public function confirmDelete($id)
    {
        $this->dispatchBrowserEvent("showConfirmMessage", ["message" => ["text" => "Vous êtes sur le point de 
        supprimer ce Client. Voulez-vous continuer ?",
        "title" => "Êtes vous sûr de continuer ?", 
        "type" => "warning",
        "data" => ["client_id" => $id]
        ]]);
    }

    public function deleteClient($id)
    {
        Client::destroy($id);

        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Client supprimé avec succès"]);
    }

    public function editClient()
    {
        $validationAttributes = $this->validate();

        Client::find($this->editClient["id"])->update($validationAttributes["editClient"]);

        $this->goToListeClient();
        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Client modifié avec succès"]);
    }
}
