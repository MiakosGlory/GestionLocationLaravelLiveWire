<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\TypeArticle;
use App\Models\ProprieteArticle;
use Livewire\WithPagination;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class TypeArticleComp extends Component
{
    protected $paginationTheme = "bootstrap";
    use WithPagination;

    public $isAddTypeArticle = false;
    public $newTypeArticle = "";
    public string $seach = "";
    public $newValue = "";
    public $listeProprieteTypeArticle = [];
    public $selectedTypeArticle;

    public $editPropTypeArticle = [];

    public function render()
    {
        Carbon::setlocale("fr");

        $data = [
            "type_article" => TypeArticle::where("nom", "LIKE", "%{$this->seach}%")
                                                ->latest()->paginate(5),
                                                
            "proprieteTypeArticle" => ProprieteArticle::where("type_article_id", 
                                   optional($this->selectedTypeArticle)->id)->get()
        ];

        return view('livewire.typearticle.index', $data)
        ->extends("layout.master")
        ->section("content");
    }

    public function showTypeArticleForm()
    {
        if($this->isAddTypeArticle)
        {
            $this->isAddTypeArticle = false;
            $this->newTypeArticle = "";
            $this->resetErrorBag();
        }
        else
        {
            $this->isAddTypeArticle = true;
        }
    }

    public function addTypeArticle()
    {
        $validate = $this->validate([
            "newTypeArticle" => "required|max:50|unique:type_articles,nom"
        ]);

        TypeArticle::create(["nom" => $validate["newTypeArticle"]]);

        $this->showTypeArticleForm();

        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Ajout réussie"]);
    }

    public function editTypeArticle(TypeArticle $typeArt)
    {
        //$typeArt = TypeArticle::find($id);

        $this->dispatchBrowserEvent("showEditTypeArticleForm", ["typearticle" => $typeArt]);
    }

    public function updateTypeArticle(TypeArticle $typeArt, $valueFromJs)
    {
        $this->newValue = $valueFromJs;
        $validate = $this->validate([
            "newValue" => ["required", "max:20", Rule::unique("type_articles", 
            "nom")->ignore($typeArt->id)]
        ]);
        
        $typeArt->update(["nom" => $validate["newValue"]]);

        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Modification réussie"]);
    }

    public function confirmDelete($id)
    {
        $this->dispatchBrowserEvent("showConfirmMessage", ["message" => ["text" => "Vous êtes sur le point de 
        supprimer un type article. Voulez-vous continuer ?",
        "title" => "Êtes vous sûr de continuer ?", 
        "type" => "warning",
        "data" => ["typearticle_id" => $id]
        ]]);
    }

    public function deleteTypeArticle(TypeArticle $type)
    {
        $type->delete();
        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Suppression réussie"]);
    }

    public function showModalProp(TypeArticle $type)
    {
        $this->selectedTypeArticle = $type;
        $this->dispatchBrowserEvent("showModal", []);
    }

    public function closeModal()
    {
        $this->dispatchBrowserEvent("closeModal", []);
    }

    public function addPropTypeArticle()
    {
        $this->validate([
            "listeProprieteTypeArticle.nom" => ["required", Rule::unique("propriete_articles", 
                    "nom")->where("type_article_id", $this->selectedTypeArticle->id)],
            "listeProprieteTypeArticle.estObligatoire" => "required"
        ]);

        ProprieteArticle::create([
            "nom" => $this->listeProprieteTypeArticle["nom"],
            "estObligatoire" => $this->listeProprieteTypeArticle["estObligatoire"],
            "type_article_id" => $this->selectedTypeArticle->id
        ]);

        $this->listeProprieteTypeArticle = [];
        $this->resetErrorBag();
        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Ajout réussie"]);
    }

    public function showDeletePropArticle($id)
    {
        $this->dispatchBrowserEvent("showConfirmMessage", ["message" => ["text" => "Vous êtes sur le point de 
        supprimer une propriété d'un type article. Voulez-vous continuer ?",
        "title" => "Êtes vous sûr de continuer ?", 
        "type" => "warning",
        "data" => ["propriete_id" => $id]
        ]]);
    }

    public function deleteProprieteTypeArticle(ProprieteArticle $prop)
    {
        $prop->delete();
        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Suppression réussie"]);
    }

    public function editPropTypeArticle(ProprieteArticle $prop)
    {
        $this->editPropTypeArticle["nom"] = $prop->nom;
        $this->editPropTypeArticle["estObligatoire"] = $prop->nom;
        $this->editPropTypeArticle["id"] = $prop->id;

        $this->dispatchBrowserEvent("showEditModal", []);
    }

    public function updatePropTypeArticle()
    {
        $this->validate([
            "editPropTypeArticle.nom" => ["required", Rule::unique("propriete_articles", 
                    "nom")->ignore($this->editPropTypeArticle["id"])],
            "editPropTypeArticle.estObligatoire" => "required"
        ]);

        ProprieteArticle::find($this->editPropTypeArticle["id"])->update([
            "nom" => $this->editPropTypeArticle["nom"],
            "estObligatoire" => $this->editPropTypeArticle["estObligatoire"]
        ]);

       

        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Modification réussie"]);
        $this->closeEditPropModal();
    }

    public function closeEditPropModal()
    {
        $this->editPropTypeArticle = [];
        $this->resetErrorBag();
        $this->dispatchBrowserEvent("closeEditPropModal", []);
    }
}
