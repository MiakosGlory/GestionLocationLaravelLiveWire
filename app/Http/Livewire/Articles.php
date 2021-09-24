<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;
use App\Models\Article;
use App\Models\TypeArticle;
use Illuminate\Validation\Rule;

class Articles extends Component
{
    protected $paginationTheme = "bootstrap";
    use WithPagination;

    public String $seach = "";
    public $newArticle = "";
    public $path_image;

    public function render()
    {
        Carbon::setlocale("fr");

        $data = [
            "articles" => Article::where("nom", "LIKE", "%{$this->seach}%")
                                                ->latest()->paginate(5),
            "typeArticle" => TypeArticle::All()
        ];

        return view('livewire.articles.index', $data)
        ->extends("layout.master")
        ->section("content");
    }

    public function addArticleModal()
    {
        $this->dispatchBrowserEvent("showAddArticleModal", []);
    }

    public function closeAddArticleModal()
    {
        $this->dispatchBrowserEvent("closeAddArticleModal", []);
    }

    public function addArticle()
    {
        $this->validate([
            "newArticle.nom" => ["required", Rule::unique("articles", "nom")],
            "newArticle.numeroDeSerie" => ["required", "max:6", "min:2", Rule::unique("articles", "numeroDeSerie")],
            "newArticle.estDisponible" => "required",
            "newArticle.type_article_id" => "required"
        ]);

        if(file("image"))
        {
            $path_image = $this->path_image->storage("public");

            Article::create([
                "nom" => $this->newArticle["nom"],
                "numeroDeSerie" => $this->newArticle["numeroDeSerie"],
                "image" => $path_image,
                "estDisponible" => $this->newArticle["estDisponible"],
                "type_article_id" => $this->newArticle["type_article_id"]
            ]);
        }
        else
        {
            Article::create([
                "nom" => $this->newArticle["nom"],
                "numeroDeSerie" => $this->newArticle["numeroDeSerie"],
                "image" => " ",
                "estDisponible" => $this->newArticle["estDisponible"],
                "type_article_id" => $this->newArticle["type_article_id"]
            ]);
        }
        
        $this->newArticle = [];
        $this->resetErrorBag();
        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Ajout réussie"]);
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
}
