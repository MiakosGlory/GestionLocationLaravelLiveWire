<?php

namespace App\Http\Livewire;

use DB;
use Livewire\Component;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
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

    public $listeRolePermission = [];

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

        //Fonction RolePermission
        $this->setRolePermission();
    }

    public function setRolePermission()
    {
        $this->listeRolePermission["roles"] = [];
        $this->listeRolePermission["permissions"] = [];

        $showUs = function($value)
        {
            return $value["id"];
        };

        $roles = array_map($showUs, User::find( $this->editUser["id"])->roles->toArray());
        $permissions = array_map($showUs, User::find($this->editUser["id"])->permissions->toArray());

        foreach(Role::all() as $role)
        {
            if(in_array($role->id, $roles))
            {
                array_push($this->listeRolePermission["roles"], ["role_id" => $role->id, 
                "role_nom" => $role->nom,"active" => true]);
            }
            else
            {
                array_push($this->listeRolePermission["roles"], ["role_id" => $role->id, 
                "role_nom" => $role->nom,"active" => false]);
            }
        }
        ////// PERMISSIONS //////////
        foreach(Permission::all() as $permission)
        {
            if(in_array($permission->id, $permissions))
            {
                array_push($this->listeRolePermission["permissions"], ["permission_id" => $permission->id, 
                "permission_nom" => $permission->nom,"active" => true]);
            }
            else
            {
                array_push($this->listeRolePermission["permissions"], ["permission_id" => $permission->id, 
                "permission_nom" => $permission->nom,"active" => false]);
            }
        }
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

    ///
    public function updateRolePermission()
    {
        DB::table("user_role")->where("user_id", $this->editUser["id"])->delete();
        DB::table("user_permission")->where("user_id", $this->editUser["id"])->delete();

        foreach($this->listeRolePermission["roles"] as $role)
        {
            if($role["active"])
            {
                User::find($this->editUser["id"])->roles()->attach($role["role_id"]);
            }
        }

        foreach($this->listeRolePermission["permissions"] as $permission)
        {
            if($permission["active"])
            {
                User::find($this->editUser["id"])->permissions()->attach($permission["permission_id"]);
            }
        }

        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Bien modifié"]);
    }
}
