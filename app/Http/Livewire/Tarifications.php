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
    public $newTarification = [];

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
        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Tarification bien ajoutée"]);
    }
}