<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;
use App\Models\Article;
use App\Models\Tarification;
use App\Models\ArticlePropriete;
use App\Models\TypeArticle;
use Intervention\Image\Facades\Image;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class Articles extends Component
{
    protected $paginationTheme = "bootstrap";
    
    use WithPagination, WithFileUploads;

    public String $seach = "";
    public $newArticle = "";
    public $file;
    public $filtreType = "", $filtreStatut = "";
    public $selectedTarification;
    public $addImage = "";
    public $inputFile = 0;
    
    public $proprieteArticle = [];

    public $editArticle = [];

    public function render()
    {
        Carbon::setlocale("fr");

        $articleQuery = Article::query();

        if($this->seach != "")
        {
            $articleQuery->where("nom", "LIKE", "%{$this->seach}%")
                         ->Orwhere("numeroDeSerie", "LIKE", "%{$this->seach}%");
        }

        if($this->filtreType != "")
        {
            $articleQuery->where("type_article_id", "LIKE", $this->filtreType);
        }

        if($this->filtreStatut != "")
        {
            $articleQuery->where("estDisponible", "LIKE", $this->filtreStatut);
        }
        $data = [
            "articles" => $articleQuery->latest()->paginate(5),
            "typeArticle" => TypeArticle::OrderBy("nom", "ASC")->get(),
            "tarification" => Tarification::All()
        ];

        return view('livewire.articles.index', $data)
        ->extends("layout.master")
        ->section("content");
    }

    public function addArticleModal()
    {
        $this->newArticle = [];
        $this->addImage = null;
        $this->resetErrorBag();
        $this->inputFile++;
        $this->dispatchBrowserEvent("showAddArticleModal", []);
    }

    public function closeAddArticleModal()
    {
        $this->dispatchBrowserEvent("closeAddArticleModal", []);
    }

    public function addArticle()
    {
        $this->validate([
            "newArticle.nom" => "required",
            "newArticle.numeroDeSerie" => ["required", "max:6", "min:2", Rule::unique("articles", "numeroDeSerie")],
            "newArticle.estDisponible" => "required",
            "newArticle.type_article_id" => "required",
            "addImage" => "image|max:10240" // 10MB
        ]);

        $propIds = [];

        foreach ($this->proprieteArticle?: [] as $prop)
        {
            $val = "newArticle.prop.".$prop->nom;
            $propIds[$prop->nom] = $prop->id;

            if($prop->estObligatoire == 1)
            {
                $validateName[$val] = "required";
                $message["$val.required"] = "La propriété ".$prop->nom." est obligatoire";
            }
            else
            {
                $validateName[$val] = "nullable";
            }
        }

        $valider = $this->validate($validateName, $message);

        if($this->addImage != " ")
        {
            $image_path = $this->addImage->store("photosArticle", "public");
            $notre_img = Image::make(public_path("storage/".$image_path))->fit(200, 200);
            $notre_img->save();
        }

        $articleDonnee = Article::create([
            "nom" => $this->newArticle["nom"],
            "numeroDeSerie" => $this->newArticle["numeroDeSerie"],
            "image" => $image_path,
            "estDisponible" => $this->newArticle["estDisponible"],
            "type_article_id" => $this->newArticle["type_article_id"]
        ]);

        foreach($valider["newArticle"]["prop"]?: [] as $key => $props)
        {
            ArticlePropriete::create([
                "article_id" => $articleDonnee->id,
                "propriete_article_id" => $propIds[$key],
                "valeur" => $props
            ]);
        }
        
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

    public function updated($propriete)
    {
        if($propriete == "newArticle.type_article_id")
        {
            $this->proprieteArticle = TypeArticle::find($this->newArticle["type_article_id"])->proprieteArticles;
            //dump($this->proprieteArticle);
        }
    }

    protected function cleanupOldUploads()
    {
        $storage = Storage::disk("local");

        foreach($storage->allFiles("livewire-tmp") as $pathFileName)
        {
            if(!$storage->exists($pathFileName)) continue;

            $fiveSecondDelete = now()->subSeconds(5)->timestamp;

            if($fiveSecondDelete > $storage->lastModified($pathFileName))
            {
                $storage->delete($pathFileName);
            }
        }
    }
}
