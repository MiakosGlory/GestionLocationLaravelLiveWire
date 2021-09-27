<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;
use App\Models\Article;
use App\Models\Tarification;
use App\Models\TypeArticle;
use Illuminate\Validation\Rule;

class Articles extends Component
{
    protected $paginationTheme = "bootstrap";
    use WithPagination;

    public String $seach = "";
    public $newArticle = "";
    public $file;
    public $selectedTarification;

    public $editArticle = [];

    public function render()
    {
        Carbon::setlocale("fr");

        $data = [
            "articles" => Article::where("nom", "LIKE", "%{$this->seach}%")
                                                ->latest()->paginate(5),
            "typeArticle" => TypeArticle::All(),
            "tarification" => Tarification::All()
            /*"tarif_article" => Article::where("id", 
            optional($this->selectedTarification)->id)->get()*/
        ];

        return view('livewire.articles.index', $data)
        ->extends("layout.master")
        ->section("content");
    }

    public function addArticleModal()
    {
        $this->resetErrorBag();
        $this->dispatchBrowserEvent("showAddArticleModal", []);
    }

    public function closeAddArticleModal()
    {
        $this->newArticle = [];
        $this->resetErrorBag();
        $this->dispatchBrowserEvent("closeAddArticleModal", []);
    }

    public function addArticle()
    {
        $validatedData = $this->validate([
            "newArticle.nom" => ["required", Rule::unique("articles", "nom")],
            "newArticle.numeroDeSerie" => ["required", "max:6", "min:2", Rule::unique("articles", "numeroDeSerie")],
            "newArticle.estDisponible" => "required",
            "newArticle.type_article_id" => "required",
            "newArticle.image" => "image|max:3000"
        ]);

        Article::create([
            "nom" => $this->newArticle["nom"],
            "numeroDeSerie" => $this->newArticle["numeroDeSerie"],
            "image" => "https://dummyimage.com/300.png/09f/fff",
            "estDisponible" => $this->newArticle["estDisponible"],
            "type_article_id" => $this->newArticle["type_article_id"]
        ]);
        
        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Article ajouté avec succès"]);
        $this->closeAddArticleModal();
    }

    public function showDeleteArticle($id)
    {
        $this->dispatchBrowserEvent("showConfirmMessage", ["message" => ["text" => "Vous êtes sur le point de 
        supprimer cet article. Voulez-vous continuer ?",
        "title" => "Êtes vous sûr de continuer ?", 
        "type" => "warning",
        "data" => ["article_id" => $id]
        ]]);
    }

    public function deleteArticle(Article $article)
    {
        $article->delete();
        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Article supprimé avec succès"]);
    }

    public function editArticleModal(Article $article)
    {
        $this->editArticle["nom"] = $article->nom;
        $this->editArticle["numeroDeSerie"] = $article->numeroDeSerie;
        $this->editArticle["estDisponible"] = $article->estDisponible;
        $this->editArticle["type_article_id"] = $article->type_article_id;
        $this->editArticle["id"] = $article->id;

        $this->dispatchBrowserEvent("showEditArticleModal", []);
    }

    public function closeEditArticleModal()
    {
        $this->resetErrorBag();
        $this->dispatchBrowserEvent("closeEditArticleModal", []);
    }

    public function updateArticle()
    {
        $this->validate([
            "editArticle.nom" => ["required", Rule::unique("articles", 
                    "nom")->ignore($this->editArticle["id"])],
            "editArticle.estDisponible" => "required",
            "editArticle.type_article_id" => "required",
            "editArticle.numeroDeSerie" => ["required", "max:6", "min:2", 
                    Rule::unique("articles", "numeroDeSerie")->ignore($this->editArticle["id"])]
        ]);

        Article::find($this->editArticle["id"])->update([
            "nom" => $this->editArticle["nom"],
            "estDisponible" => $this->editArticle["estDisponible"],
            "numeroDeSerie" => $this->editArticle["numeroDeSerie"],
            "type_article_id" => $this->editArticle["type_article_id"]
        ]);

        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Article modifié avec succès"]);
        $this->closeEditArticleModal();
    }

    public function showModalTarification(Article $article)
    {
        $this->dispatchBrowserEvent("showModalTarification", []);
    }
}
