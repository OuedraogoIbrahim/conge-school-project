<?php

namespace App\Livewire\Dashboard;

use App\Models\DemandeConge;
use App\Models\Employe;
use App\Models\Responsable;
use App\Models\StatutDemande;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Grh extends Component
{

    public $employes;
    public $responsables;

    public $demandesAttentes;
    public $demandesAcceptees;
    public $demandesRefusees;
    public $demandesActives; // Les demandes acceptees qui sont actives

    public $statutAttente;
    public $statutAccepter;
    public $statutRefuser;


    public function mount()
    {
        $this->employes = Employe::all();
        $this->responsables = Responsable::all();

        $statuts = StatutDemande::whereIn('statut', ['demander', 'accepter', 'refuser'])
            ->get()
            ->keyBy('statut');

        $this->statutAttente = $statuts['demander'] ?? null;
        $this->statutAccepter = $statuts['accepter'] ?? null;
        $this->statutRefuser = $statuts['refuser'] ?? null;

        // Récupérer toutes les demandes en une seule requête
        $demandes = DemandeConge::whereIn('statut_demande_id', [
            $this->statutAttente?->id,
            $this->statutAccepter?->id,
            $this->statutRefuser?->id,
        ])->get();

        // Filtrer les demandes
        $this->demandesAttentes = $demandes->where('statut_demande_id', $this->statutAttente?->id);
        $this->demandesAcceptees = $demandes->where('statut_demande_id', $this->statutAccepter?->id);
        $this->demandesRefusees = $demandes->where('statut_demande_id', $this->statutRefuser?->id);
        $this->demandesActives = $this->demandesAcceptees->where('date_fin', '>=', now()->toDateString());
    }

    public function accepterDemande($id)
    {
        $demande = DemandeConge::findOrFail($id);
        $demande->update(['statut_demande_id' => $this->statutAccepter->id]);
        return redirect()->route('dashboard')->with('message', 'Demande acceptée avec succès.');
    }

    public function refuserDemande($id)
    {
        $demande = DemandeConge::findOrFail($id);
        $demande->update(['statut_demande_id' => $this->statutRefuser->id]);
        return redirect()->route('dashboard')->with('message', 'Demande refusée avec succès.');
    }

    public function render()
    {
        return view('livewire.dashboard.grh');
    }
}
