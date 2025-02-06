<?php

namespace App\Livewire\Dashboard;

use App\Mail\ResponseDemandeMail;
use App\Models\DemandeConge;
use App\Models\Employe;
use App\Models\Responsable as ModelsResponsable;
use App\Models\StatutDemande;
use App\Models\User;
use App\Notifications\DemandeCongeNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class Responsable extends Component
{

    public $user;
    public $service;

    public $employes;

    public $demandesAttentes;
    public $demandesAcceptees;
    public $demandesRefusees;
    public $demandesActives; // Les demandes acceptees qui sont actives

    public $statutAttente;
    public $statutAccepter;
    public $statutRefuser;


    public function mount()
    {
        $this->user = Auth::user();
        $this->service = $this->user->service;
        $this->employes = $this->service->users()->where('role', 'employe')->get();

        $statuts = StatutDemande::whereIn('statut', ['demander', 'accepter', 'refuser'])
            ->get()
            ->keyBy('statut');

        $this->statutAttente = $statuts['demander'] ?? null;
        $this->statutAccepter = $statuts['accepter'] ?? null;
        $this->statutRefuser = $statuts['refuser'] ?? null;

        // Récupérer toutes les demandes en une seule requête
        $demandes = DemandeConge::query()
            ->whereHas('employe.user', function ($query) {
                $query->where('service_id', $this->service->id);
            })
            ->whereIn('statut_demande_id', [
                optional($this->statutAttente)->id,
                optional($this->statutAccepter)->id,
                optional($this->statutRefuser)->id,
            ])
            ->with('employe.user')
            ->get();

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

    public function render()
    {
        return view('livewire.dashboard.responsable');
    }
}
