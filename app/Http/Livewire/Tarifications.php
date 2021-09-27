<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Tarification;
use App\Models\DureeLocation;
use App\Models\Article;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class Tarifications extends Component
{
    protected $paginationTheme = "bootstrap";
    
    use WithPagination;

    public $isAddTarification = false;

    public $isEditTarification = false;
    public $newTarification = "";
    public $editTarification = "";

    public function render()
    {
        Carbon::setlocale("fr");

        $data = [
            "tarifications" => Tarification::paginate(5),
            "articles" => Article::all(),
            "dureeLocat" => DureeLocation::all()
        ];

        return view('livewire.tarifications.index', $data)
                ->extends("layout.master")
                ->section("content");
    }

    public function showTarificationForm()
    {
        if($this->isAddTarification)
        {
            $this->isAddTarification = false;
            $this->newTarification = "";
            $this->resetErrorBag();
        }
        else
        {
            $this->isAddTarification = true;
        }
    }

    public function editTarificationForm(Tarification $tarif)
    {
        if($this->isEditTarification)
        {
            $this->isEditTarification = false;
            $this->editTarification = "";
            $this->resetErrorBag();
        }
        else
        {
            /*$this->editTarification["article_id"] = $tarif->article_id;
            $this->editTarification["duree_location_id"] = $tarif->duree_locattion_id;
            $this->editTarification["prix"] = $tarif->prix;*/
            $this->isEditTarification = true;
            //$this->dispatchBrowserEvent("showEditTarificationModal", []);
        }
    }

    public function addTarification()
    {
        $this->validate([
            "newTarification.article_id" => "required",
            "newTarification.duree_location_id" => "required",
            "newTarification.prix" => "required"
        ]);

        Tarification::create([
            "prix" => $this->newTarification["prix"],
            "duree_location_id" => $this->newTarification["duree_location_id"],
            "article_id" =>  $this->newTarification["article_id"]
        ]);
        $this->showTarificationForm();
        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Tarification bien ajoutée"]);
    }

    public function updateTarification()
    {
        $this->validate([
            "editTarification.article_id" => "required",
            "editTarification.duree_location_id" => "required",
            "editTarification.prix" => "required",
        ]);

        Tarification::find($this->editTarification["id"])->update([
            "article_id" => $this->editTarification["article_id"],
            "duree_location_id" => $this->editTarification["duree_location_id"],
            "prix" => $this->editTarification["prix"]
        ]);

        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Tarificcation modifiée avec succès"]);
    }
}