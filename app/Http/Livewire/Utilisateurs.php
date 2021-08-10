<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;


class Utilisateurs extends Component
{
    protected $paginationTheme = "bootstrap";
    
    use WithPagination;
    
    public $currentPage = PAGE_LIST;

    public $newUser = [];
    public $editUser = [];

    public string $seach = "";

    public function render()
    {
        return view('livewire.utilisateurs.index', [
                "users" => User::where("nom", "LIKE", "%{$this->seach}%")
                    ->latest()->paginate(5)
                ])
                ->extends("layout.master")
                ->section("content");
    }

    /*public function reseachUser()
    {
        return view('livewire.utilisateurs.index', [
                "users" => User::where("nom", "LIKE", "%{$this->seach}%")->get()
                ])
                ->extends("layout.master")
                ->section("content");
    }*/

    public function rules()
    {
        if($this->currentPage == PAGE_EDIT)
        {
            return ["editUser.nom" => "required|min:3",
            "editUser.prenom" => "required|min:3",
            "editUser.sexe" => "required",
            "editUser.telephone" => ["required",
                Rule::unique("users", "telephone")->ignore($this->editUser["id"])],
            "editUser.email" => ["required", "email", 
                Rule::unique("users", "email")->ignore($this->editUser["id"])],
            "editUser.pieceIdentite" => "required",
            "editUser.numeroPieceIdentite" => ["required",
                Rule::unique("users", "numeroPieceIdentite")->ignore($this->editUser["id"])]
            ];
        }

        return [
            "newUser.nom" => "required|min:3",
            "newUser.prenom" => "required|min:3",
            "newUser.sexe" => "required",
            "newUser.telephone" => ["required", "numeric", Rule::unique("users", "telephone")],
            "newUser.email" => ["required", "email", Rule::unique("users", "email")],
            "newUser.pieceIdentite" => "required",
            "newUser.numeroPieceIdentite" => ["required", Rule::unique("users", "numeroPieceIdentite")]
        ];
    }

    public function getButton()
    {
        $this->currentPage = PAGE_AJOUT;
    }

    public function goToListeUser()
    {
        $this->currentPage = PAGE_LIST;
        $this->editUser = [];
    }

    public function goToEditUser($id)
    {
        $this->editUser = User::find($id)->toArray();
        $this->currentPage = PAGE_EDIT;
    }

    public function addUser()
    {
        $validationAttributes = $this->validate();
        $validationAttributes["newUser"]["password"] = "password";
        $validationAttributes["newUser"]["photo"] = "https://placeholder.com/200x250";

        User::create($validationAttributes["newUser"]);

        $this->newUser = [];

        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Opération réussie"]);
    }

    public function editUser()
    {
        $validationAttributes = $this->validate();

        User::find($this->editUser["id"])->update($validationAttributes["editUser"]);

        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Opération réussie"]);
    }

    public function confirmDelete($id)
    {
        $this->dispatchBrowserEvent("showConfirmMessage", ["message" => ["text" => "Vous êtes sur le point de 
        supprimer un utilisateur. Voulez-vous continuer ?",
        "title" => "Êtes vous sûr de continuer ?", 
        "type" => "warning",
        "data" => ["user_id" => $id]
        ]]);
    }

    public function deleteUser($id)
    {
        User::destroy($id);

        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Suppression réussie"]);
    }

    public function passwordReset()
    {
        User::find($this->editUser["id"])->update(["password" => Hash::make(DEFAULT_PWD)]);

        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Mot de passe rénitialisé"]);
    }

    public function confirmPwdReset()
    {
        $this->dispatchBrowserEvent("showConfirmMessage", ["message" => ["text" => "Vous êtes sur le point de 
        rénitialiser le password. Voulez-vous continuer ?",
        "title" => "Êtes vous sûr de continuer ?", 
        "type" => "warning",
        ]]);
    }
}
