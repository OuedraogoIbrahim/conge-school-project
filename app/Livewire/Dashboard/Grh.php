<?php

namespace App\Livewire\Dashboard;

use App\Mail\DemandeCongeMail;
use App\Mail\ResponseDemandeMail;
use App\Models\DemandeConge;
use App\Models\Employe;
use App\Models\Responsable;
use App\Models\Service;
use App\Models\StatutDemande;
use App\Notifications\DemandeCongeNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Grh extends Component
{

    public $employes;
    public $responsables;
    public $servicesSansResponsable;

    public $demandesAttentes;
    public $demandesAcceptees;
    public $demandesRefusees;
    public $demandesActives; // Les demandes acceptees qui sont actives

    public $statutAttente;
    public $statutAccepter;
    public $statutRefuser;

    // Champs de validation du formulaire
    public $id;
    public $dateDebut;
    public $dateFin;
    public $motif;
    public $typeConge;
    public $statutDemande;


    protected function rules()
    {
        return [
            'dateDebut'     => ['required', 'date', 'after_or_equal:today'],
            'dateFin'       => ['required', 'date', 'after:dateDebut'],
            'motif'         => ['required', 'string', 'min:10'],
            'typeConge'     => ['required', 'in:compensation,conge_payé,maternité,ancienneté,paternité,maladie,autre'],
            'statutDemande' => ['required', 'exists:statut_demandes,id'],
        ];
    }


    public function mount()
    {
        $this->employes = Employe::all();
        $this->responsables = Responsable::all();

        $this->servicesSansResponsable = Service::whereDoesntHave('users', function ($query) {
            $query->where('role', 'responsable');
        })->get();

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
        // $this->demandesAttentes = $demandes->where('statut_demande_id', $this->statutAttente?->id);
        $this->demandesAttentes = $demandes->where('statut_demande_id', $this->statutAttente?->id)->where('updated_at', '<=', now()->subDays(5));
        $this->demandesAcceptees = $demandes->where('statut_demande_id', $this->statutAccepter?->id);
        $this->demandesRefusees = $demandes->where('statut_demande_id', $this->statutRefuser?->id);
        $this->demandesActives = $this->demandesAcceptees->where('date_fin', '>=', now()->toDateString());
    }

    public function accepterDemande($id)
    {
        $demande = DemandeConge::findOrFail($id);
        $demande->update(['statut_demande_id' => $this->statutAccepter->id]);
        try {
            Mail::to($demande->employe->user->email)->send(new ResponseDemandeMail($demande->employe->user, $demande, 'acceptée'));
            Notification::send($demande->employe->user, new DemandeCongeNotification($demande, 'acceptée'));
            return redirect()->route('dashboard')->with('message', 'Demande acceptée avec succès.');
        } catch (\Exception $e) {
            return redirect()->route('dashboard')->with('error', 'Une erreur est survenue lors de l\'envoi du mail : ' . $e->getMessage());
        }
    }

    public function refuserDemande($id)
    {
        $demande = DemandeConge::findOrFail($id);
        $demande->update(['statut_demande_id' => $this->statutRefuser->id]);
        try {
            Mail::to($demande->employe->user->email)->send(new ResponseDemandeMail($demande->employe->user, $demande, 'refusée'));
            Notification::send($demande->employe->user, new DemandeCongeNotification($demande, 'refusée'));
            return redirect()->route('dashboard')->with('message', 'Demande refusée avec succès.');
        } catch (\Exception $e) {
            return redirect()->route('dashboard')->with('error', 'Une erreur est survenue lors de l\'envoi du mail : ' . $e->getMessage());
        }
    }

    public function modifierDemande(DemandeConge $demande)
    {
        $this->id = $demande->id;
        $this->dateDebut = $demande->date_debut;
        $this->dateFin = $demande->date_fin;
        $this->motif = $demande->motif;
        $this->typeConge = $demande->type_conge;
        $this->statutDemande = $demande->statut_demande_id;
        $this->dispatch('event-update', ['id' => $this->typeConge])->self();
    }

    public function update()
    {
        $this->validate();
        $demande = DemandeConge::query()->findOrFail($this->id);
        $demande->date_debut = $this->dateDebut;
        $demande->date_fin = $this->dateFin;
        $demande->motif = $this->motif;
        $demande->type_conge = $this->typeConge;
        $demande->statut_demande_id = $this->statutDemande;
        $demande->timestamps = false; // Desactiver temporairement la mise a jour automatique de upadted_at
        $demande->update();
        return redirect()->route('dashboard')->with('message', 'Demande absence/congé mise à jour avec succès');
    }


    public function render()
    {
        return view('livewire.dashboard.grh');
    }
}
