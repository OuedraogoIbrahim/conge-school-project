<div>

    <div class="m-5">
        @if (session()->has('message'))
            <div class="alert alert-info">
                {{ session('message') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
    </div>

    <div class="row g-6 mb-5">

        <div class="col-lg-3 col-sm-6">
            <div class="card card-border-shadow-danger h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-4">
                            <span class="avatar-initial rounded bg-label-danger"><i
                                    class='ti ti-alert-circle ti-28px'></i>
                            </span>
                        </div>
                        <h4 class="mb-0">{{ $demandesAttentes->count() }}</h4>
                    </div>
                    <p class="mb-1">Total</p>
                    <p class="mb-0">
                        <span class="text-heading fw-medium me-2">Demandes en attente</span>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="card card-border-shadow-success h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-4">
                            <span class="avatar-initial rounded bg-label-success"><i class='ti ti-check ti-28px'></i>
                            </span>
                        </div>
                        <h4 class="mb-0">{{ $demandesAcceptees->count() }}</h4>
                    </div>
                    <p class="mb-1">Total</p>
                    <p class="mb-0">
                        <span class="text-heading fw-medium me-2">Demandes acceptées</span>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="card card-border-shadow-secondary h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-4">
                            <span class="avatar-initial rounded bg-label-secondary"><i class='ti ti-x ti-28px'></i>
                            </span>
                        </div>
                        <h4 class="mb-0">{{ $demandesRefusees->count() }}</h4>
                    </div>
                    <p class="mb-1">Total</p>
                    <p class="mb-0">
                        <span class="text-heading fw-medium me-2">Demandes refusées</span>
                    </p>
                </div>
            </div>
        </div>

    </div>

    <div class="row g-6 mb-5">
        <div class="col-xl-4 col-lg-6 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h6 class="fw-normal mb-0 text-body">Total {{ $employes->count() }} utilisateurs</h6>
                    </div>
                    <div class="d-flex justify-content-between align-items-end">
                        <div class="role-heading">
                            <h5 class="mb-1">Role : Employé</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Demandes en attente --}}
    <div class="row g-6 mb-5">

        <div class="col-lg-12">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title m-0 me-2">Demandes en attente</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-borderless border-top">
                        <thead class="border-bottom">
                            <tr>
                                <th>EMPLOYé</th>
                                <th>DATE Début</th>
                                <th>DATE FIN</th>
                                <th>MOTIF</th>
                                <th>TYPE</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($demandesAttentes as $d)
                                <tr>
                                    <td class="pt-4">
                                        {{ $d->employe->user->nom . ' ' . $d->employe->user->prenom }}
                                    </td>
                                    <td class="pt-4">
                                        {{ \Carbon\Carbon::parse($d->date_debut)->translatedFormat('d M Y') }}
                                    </td>
                                    <td class="pt-4">
                                        {{ \Carbon\Carbon::parse($d->date_fin)->translatedFormat('d M Y') }}
                                    </td>
                                    <td class="pt-4">{{ $d->motif }}</td>

                                    <td class="pt-4"><span class="badge bg-label-warning">{{ $d->type_conge }}</span>
                                    </td>
                                    <td class="pt-4">
                                        <div class="dropdown">
                                            <button
                                                class="btn btn-text-secondary rounded-pill text-muted border-0 p-2 me-n1"
                                                type="button" id="coursActions{{ $d->id }}"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="ti ti-dots-vertical ti-md text-muted"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <button wire:click='accepterDemande("{{ $d->id }}")'
                                                    class="dropdown-item" href="javascrip();">Accepter la demande
                                                </button>
                                                <button wire:click='refuserDemande("{{ $d->id }}")'
                                                    class="dropdown-item" href="javascrip();">Refuser la demande
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            @if ($demandesAttentes->isEmpty())
                                <tr>
                                    <td colspan="5" class="text-center text-muted pt-4">Aucune demande en attente
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- Demandes en attente --}}

    <div class="app-logistics-fleet-sidebar col h-100" id="app-logistics-fleet-sidebar">
        <div class="card-header border-0 pt-6 pb-1 d-flex justify-content-between">
            <h5 class="mb-0 card-title">Demandes Actives</h5>
            <i class="ti ti-x ti-xs cursor-pointer close-sidebar d-md-none btn btn-sm btn-icon btn-text-secondary rounded-pill p-0"
                data-bs-toggle="sidebar" data-overlay data-target="#app-logistics-fleet-sidebar"></i>
        </div>
        <div class="card-body p-0 logistics-fleet-sidebar-body">
            <div class="accordion py-2 px-1" id="demandes" data-bs-toggle="sidebar" data-overlay
                data-target="#app-logistics-fleet-sidebar">
                @if ($demandesActives->isEmpty())
                    <div class="text-center py-4">
                        <p class="text-muted">Aucune demande de congé active.</p>
                    </div>
                @else
                    @foreach ($demandesActives as $demande)
                        @php
                            $dateDebut = Carbon\Carbon::parse($demande->date_debut);
                            $dateFin = Carbon\Carbon::parse($demande->date_fin);
                            $joursConges = $dateDebut->diffInDays($dateFin) + 1;
                        @endphp
                        <div class="accordion-item border-0 active mb-0 shadow-none" id="demande-{{ $demande->id }}">
                            <div class="accordion-header" id="demandeHeader{{ $demande->id }}">
                                <div role="button" class="accordion-button shadow-none align-items-center"
                                    data-bs-toggle="collapse" data-bs-target="#demande{{ $demande->id }}"
                                    aria-expanded="true" aria-controls="demande{{ $demande->id }}">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-wrapper">
                                            <div class="avatar me-4">
                                                <span class="avatar-initial rounded-circle bg-label-secondary">
                                                    <i class="ti ti-user ti-lg"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <span class="d-flex flex-column gap-1">
                                            <span class="text-heading">{{ $demande->employe->user->nom }}
                                                {{ $demande->employe->user->prenom }}</span>
                                            <span class="text-body">{{ $demande->employe->poste }}</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div id="demande{{ $demande->id }}" class="accordion-collapse collapse"
                                data-bs-parent="#demandes">
                                <div class="accordion-body pt-4 pb-0">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h6 class="fw-normal mb-1">Détails du Congé</h6>
                                        <p class="text-body mb-1">{{ $joursConges }} jours de congés</p>
                                    </div>
                                    <ul class="timeline ps-4 mt-6">
                                        <li class="timeline-item ps-6 pb-3 border-left-dashed">
                                            <span
                                                class="timeline-indicator-advanced timeline-indicator-success border-0 shadow-none">
                                                <i class='ti ti-calendar'></i>
                                            </span>
                                            <div class="timeline-event ps-0 pb-0">
                                                <div class="timeline-header">
                                                    <small class="text-success text-uppercase">Début</small>
                                                </div>
                                                <h6 class="my-50">
                                                    {{ Carbon\Carbon::parse($demande->date_debut)->translatedFormat('d M Y') }}
                                                </h6>
                                            </div>
                                        </li>
                                        <li class="timeline-item ps-6 pb-3 border-left-dashed">
                                            <span
                                                class="timeline-indicator-advanced timeline-indicator-danger border-0 shadow-none">
                                                <i class='ti ti-calendar'></i>
                                            </span>
                                            <div class="timeline-event ps-0 pb-0">
                                                <div class="timeline-header">
                                                    <small class="text-danger text-uppercase">Fin</small>
                                                </div>
                                                <h6 class="my-50">
                                                    {{ Carbon\Carbon::parse($demande->date_fin)->translatedFormat('d M Y') }}
                                                </h6>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <div
        wire:loading.class="position-fixed top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center">
        <div wire:loading class="sk-chase sk-primary">
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
        </div>
    </div>

</div>
</div>


@script
    <script>
        @if (session('message'))
            Swal.fire({
                icon: 'success',
                title: 'Succès',
                text: '{{ session('message') }}',
                timer: 5000,
                timerProgressBar: true,
                showConfirmButton: false,
                position: 'center',
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: '{{ session('error') }}',
                timer: 5000,
                timerProgressBar: true,
                showConfirmButton: false,
                position: 'center',
            });
        @endif
    </script>
@endscript
