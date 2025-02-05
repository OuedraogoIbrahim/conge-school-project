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
            <div class="card card-border-shadow-secondary h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-4">
                            <span class="avatar-initial rounded bg-label-secondary">
                                <i class='ti ti-calendar ti-28px'></i>
                            </span>
                        </div>
                        <h4 class="mb-0">{{ $demandesPlannifiees->count() }}</h4>
                    </div>
                    <p class="mb-1">Total</p>
                    <p class="mb-0">
                        <span class="text-heading fw-medium me-2">Demandes plannifiées</span>
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

        <div class="col-md-12">
            <div
                class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-6 mb-md-0 mt-n6 mt-md-0">

                <div class="dt-buttons btn-group flex-wrap">
                    <button class="btn btn-secondary add-new btn-primary waves-effect waves-light mb-4" tabindex="0"
                        aria-controls="DataTables_Table_0" type="button" data-bs-toggle="modal"
                        data-bs-target="#demande-create"><span><i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span
                                class="d-none d-sm-inline-block">Créer une demande</span></span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Demandes -->
    <div class="col-lg-12">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div class="card-title mb-0">
                    <h5 class="mb-1">Demandes</h5>
                    <p class="card-subtitle">Suivi des demandes</p>
                </div>
                <div class="dropdown">
                    <button class="btn btn-text-secondary rounded-pill text-muted border-0 p-2 me-n1" type="button"
                        id="demandesTabs" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="ti ti-dots-vertical ti-md text-muted"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="demandesTabs">
                        <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                        <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                        <a class="dropdown-item" href="javascript:void(0);">Share</a>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="nav-align-top">
                    <ul class="nav nav-tabs nav-fill rounded-0 timeline-indicator-advanced" role="tablist">
                        <li class="nav-item">
                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-justified-demander" aria-controls="navs-justified-demander"
                                aria-selected="true">Demandées</button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-justified-plannifier" aria-controls="navs-justified-plannifier"
                                aria-selected="false">Plannifiées</button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-justified-accepter" aria-controls="navs-justified-accepter"
                                aria-selected="false">Acceptées</button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-justified-refuser" aria-controls="navs-justified-refuser"
                                aria-selected="false">Rejetées</button>
                        </li>
                    </ul>
                    <div class="tab-content border-0 mx-1">
                        <!-- Tab 1: Demander -->
                        <div class="tab-pane fade show active" id="navs-justified-demander" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
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
                                        @forelse ($demandesAttentes as $d)
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
                                                <td class="pt-4">
                                                    <span class="badge bg-label-warning">{{ $d->type_conge }}</span>
                                                </td>
                                                <td class="pt-4">
                                                    <div class="dropdown">
                                                        <button
                                                            class="btn btn-text-secondary rounded-pill text-muted border-0 p-2 me-n1"
                                                            type="button" id="coursActions{{ $d->id }}"
                                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <i class="ti ti-dots-vertical ti-md text-muted"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <button wire:click='markAsDone("{{ $d->id }}")'
                                                                class="dropdown-item" href="javascrip();">On
                                                                verra</button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center pt-4">
                                                    <p class="text-muted">Aucune demande en attente pour le moment.</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Tab 2: Plannifier -->
                        <div class="tab-pane fade" id="navs-justified-plannifier" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
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
                                        @forelse ($demandesPlannifiees as $dp)
                                            <tr>
                                                <td class="pt-4">
                                                    {{ $dp->employe->user->nom . ' ' . $dp->employe->user->prenom }}
                                                </td>
                                                <td class="pt-4">
                                                    {{ \Carbon\Carbon::parse($dp->date_debut)->translatedFormat('d M Y') }}
                                                </td>
                                                <td class="pt-4">
                                                    {{ \Carbon\Carbon::parse($dp->date_fin)->translatedFormat('d M Y') }}
                                                </td>
                                                <td class="pt-4">{{ $dp->motif }}</td>

                                                <td class="pt-4"><span
                                                        class="badge bg-label-warning">{{ $dp->type_conge }}</span>
                                                </td>
                                                <td class="pt-4">
                                                    <div class="dropdown">
                                                        <button
                                                            class="btn btn-text-secondary rounded-pill text-muted border-0 p-2 me-n1"
                                                            type="button" id="coursActions{{ $dp->id }}"
                                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <i class="ti ti-dots-vertical ti-md text-muted"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <button wire:click='changerStatut("{{ $dp->id }}")'
                                                                class="dropdown-item" href="javascrip();">
                                                                Changer le statut à "demandée"
                                                            </button>
                                                            <button tabindex="0" aria-controls="DataTables_Table_0"
                                                                type="button" data-bs-toggle="modal"
                                                                data-bs-target="#demande-update"
                                                                wire:click='modifierDemande("{{ $dp->id }}")'
                                                                class="dropdown-item" href="javascrip();">
                                                                Modifier la demande
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center pt-4">
                                                    <p class="text-muted">Aucune demande en attente pour le moment.</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Tab 3: Accepter -->
                        <div class="tab-pane fade" id="navs-justified-accepter" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>EMPLOYé</th>
                                            <th>DATE Début</th>
                                            <th>DATE FIN</th>
                                            <th>MOTIF</th>
                                            <th>TYPE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($demandesAcceptees as $da)
                                            <tr>
                                            <tr>
                                                <td class="pt-4">
                                                    {{ $da->employe->user->nom . ' ' . $da->employe->user->prenom }}
                                                </td>
                                                <td class="pt-4">
                                                    {{ \Carbon\Carbon::parse($da->date_debut)->translatedFormat('d M Y') }}
                                                </td>
                                                <td class="pt-4">
                                                    {{ \Carbon\Carbon::parse($da->date_fin)->translatedFormat('d M Y') }}
                                                </td>
                                                <td class="pt-4">{{ $da->motif }}</td>

                                                <td class="pt-4"><span
                                                        class="badge bg-label-warning">{{ $da->type_conge }}</span>
                                                </td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center pt-4">
                                                    <p class="text-muted">Aucune demande en attente pour le moment.</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Tab 4: Refuser -->
                        <div class="tab-pane fade" id="navs-justified-refuser" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>EMPLOYé</th>
                                            <th>DATE Début</th>
                                            <th>DATE FIN</th>
                                            <th>MOTIF</th>
                                            <th>TYPE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($demandesRefusees as $dr)
                                            <tr>
                                                <td class="pt-4">
                                                    {{ $dr->employe->user->nom . ' ' . $dr->employe->user->prenom }}
                                                </td>
                                                <td class="pt-4">
                                                    {{ \Carbon\Carbon::parse($dr->date_debut)->translatedFormat('d M Y') }}
                                                </td>
                                                <td class="pt-4">
                                                    {{ \Carbon\Carbon::parse($dr->date_fin)->translatedFormat('d M Y') }}
                                                </td>
                                                <td class="pt-4">{{ $dr->motif }}</td>

                                                <td class="pt-4"><span
                                                        class="badge bg-label-warning">{{ $dr->type_conge }}</span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center pt-4">
                                                    <p class="text-muted">Aucune demande en attente pour le moment.</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Demandes -->


    <div class="row">
        <!-- Vehicles overview -->
        <div class="col-xxl-6">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Vehicles Overview</h5>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-text-secondary rounded-pill text-muted border-0 p-2 me-n1"
                            type="button" id="vehiclesOverview" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="ti ti-dots-vertical ti-md text-muted"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="vehiclesOverview">
                            <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                            <a class="dropdown-item" href="javascript:void(0);">Share</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-none d-lg-flex vehicles-progress-labels mb-6">
                        <div class="vehicles-progress-label on-the-way-text" style="width: 39.7%;">On the way</div>
                        <div class="vehicles-progress-label unloading-text" style="width: 28.3%;">Unloading</div>
                        <div class="vehicles-progress-label loading-text" style="width: 17.4%;">Loading</div>
                        <div class="vehicles-progress-label waiting-text text-nowrap" style="width: 14.6%;">Waiting
                        </div>
                    </div>
                    <div class="vehicles-overview-progress progress rounded-3 mb-6" style="height: 46px;">
                        <div class="progress-bar fw-medium text-start bg-lighter text-dark px-4 rounded-0"
                            role="progressbar" style="width: 39.7%" aria-valuenow="39.7" aria-valuemin="0"
                            aria-valuemax="100">39.7%</div>
                        <div class="progress-bar fw-medium text-start bg-primary px-4" role="progressbar"
                            style="width: 28.3%" aria-valuenow="28.3" aria-valuemin="0" aria-valuemax="100">28.3%
                        </div>
                        <div class="progress-bar fw-medium text-start text-bg-info px-2 px-sm-4" role="progressbar"
                            style="width: 17.4%" aria-valuenow="17.4" aria-valuemin="0" aria-valuemax="100">17.4%
                        </div>
                        <div class="progress-bar fw-medium text-start snackbar text-paper px-1 px-sm-3 rounded-0 px-lg-4"
                            role="progressbar" style="width: 14.6%" aria-valuenow="14.6" aria-valuemin="0"
                            aria-valuemax="100">14.6%</div>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table">
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td class="w-50 ps-0">
                                        <div class="d-flex justify-content-start align-items-center">
                                            <div class="me-2">
                                                <i class='ti ti-car ti-lg text-heading'></i>
                                            </div>
                                            <h6 class="mb-0 fw-normal">On the way</h6>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0 text-nowrap">
                                        <h6 class="mb-0">2hr 10min</h6>
                                    </td>
                                    <td class="text-end pe-0">
                                        <span>39.7%</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-50 ps-0">
                                        <div class="d-flex justify-content-start align-items-center">
                                            <div class="me-2">
                                                <i class='ti ti-circle-arrow-down ti-lg text-heading'></i>
                                            </div>
                                            <h6 class="mb-0 fw-normal">Unloading</h6>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0 text-nowrap">
                                        <h6 class="mb-0">3hr 15min</h6>
                                    </td>
                                    <td class="text-end pe-0">
                                        <span>28.3%</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-50 ps-0">
                                        <div class="d-flex justify-content-start align-items-center">
                                            <div class="me-2">
                                                <i class='ti ti-circle-arrow-up ti-lg text-heading'></i>
                                            </div>
                                            <h6 class="mb-0 fw-normal">Loading</h6>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0 text-nowrap">
                                        <h6 class="mb-0">1hr 24min</h6>
                                    </td>
                                    <td class="text-end pe-0">
                                        <span>17.4%</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-50 ps-0">
                                        <div class="d-flex justify-content-start align-items-center">
                                            <div class="me-2">
                                                <i class='ti ti-clock ti-lg text-heading'></i>
                                            </div>
                                            <h6 class="mb-0 fw-normal">Waiting</h6>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0 text-nowrap">
                                        <h6 class="mb-0">5hr 19min</h6>
                                    </td>
                                    <td class="text-end pe-0">
                                        <span>14.6%</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Vehicles overview -->
        <!-- Shipment statistics-->
        <div class="col-xxl-6 col-lg-7">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="card-title mb-0">
                        <h5 class="mb-1">Shipment statistics</h5>
                        <p class="card-subtitle">Total number of deliveries 23.8k</p>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-label-primary">January</button>
                        <button type="button" class="btn btn-label-primary dropdown-toggle dropdown-toggle-split"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="javascript:void(0);">January</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);">February</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);">March</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);">April</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);">May</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);">June</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);">July</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);">August</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);">September</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);">October</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);">November</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);">December</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div id="shipmentStatisticsChart"></div>
                </div>
            </div>
        </div>
        <!--/ Shipment statistics -->
        <!-- Delivery Performance -->
        <div class="col-xxl-4 col-lg-5">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="card-title mb-0">
                        <h5 class="mb-1">Delivery Performance</h5>
                        <p class="card-subtitle">12% increase in this month</p>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-text-secondary rounded-pill text-muted border-0 p-2 me-n1"
                            type="button" id="deliveryPerformance" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="ti ti-dots-vertical ti-md text-muted"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="deliveryPerformance">
                            <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                            <a class="dropdown-item" href="javascript:void(0);">Share</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="p-0 m-0">
                        <li class="d-flex mb-6">
                            <div class="avatar flex-shrink-0 me-4">
                                <span class="avatar-initial rounded bg-label-primary"><i
                                        class="ti ti-package ti-26px"></i></span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0 fw-normal">Packages in transit</h6>
                                    <small class="text-success fw-normal d-block">
                                        <i class="ti ti-chevron-up mb-1 me-1"></i>
                                        25.8%
                                    </small>
                                </div>
                                <div class="user-progress">
                                    <h6 class="text-body mb-0">10k</h6>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex mb-6">
                            <div class="avatar flex-shrink-0 me-4">
                                <span class="avatar-initial rounded bg-label-info"><i
                                        class="ti ti-truck ti-26px"></i></span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0 fw-normal">Packages out for delivery</h6>
                                    <small class="text-success fw-normal d-block">
                                        <i class="ti ti-chevron-up mb-1 me-1"></i>
                                        4.3%
                                    </small>
                                </div>
                                <div class="user-progress">
                                    <h6 class="text-body mb-0">5k</h6>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex mb-6">
                            <div class="avatar flex-shrink-0 me-4">
                                <span class="avatar-initial rounded bg-label-success"><i
                                        class="ti ti-circle-check ti-26px"></i></span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0 fw-normal">Packages delivered</h6>
                                    <small class="text-danger fw-normal d-block">
                                        <i class="ti ti-chevron-down mb-1 me-1"></i>
                                        12.5%
                                    </small>
                                </div>
                                <div class="user-progress">
                                    <h6 class="text-body mb-0">15k</h6>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex mb-6">
                            <div class="avatar flex-shrink-0 me-4">
                                <span class="avatar-initial rounded bg-label-warning"><i
                                        class="ti ti-percentage ti-26px"></i></span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0 fw-normal">Delivery success rate</h6>
                                    <small class="text-success fw-normal d-block">
                                        <i class="ti ti-chevron-up mb-1 me-1"></i>
                                        35.6%
                                    </small>
                                </div>
                                <div class="user-progress">
                                    <h6 class="text-body mb-0">95%</h6>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex mb-6">
                            <div class="avatar flex-shrink-0 me-4">
                                <span class="avatar-initial rounded bg-label-secondary"><i
                                        class="ti ti-clock ti-26px"></i></span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0 fw-normal">Average delivery time</h6>
                                    <small class="text-danger fw-normal d-block">
                                        <i class="ti ti-chevron-down mb-1 me-1"></i>
                                        2.15%
                                    </small>
                                </div>
                                <div class="user-progress">
                                    <h6 class="text-body mb-0">2.5 Days</h6>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex">
                            <div class="avatar flex-shrink-0 me-4">
                                <span class="avatar-initial rounded bg-label-danger"><i
                                        class="ti ti-users ti-26px"></i></span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0 fw-normal">Customer satisfaction</h6>
                                    <small class="text-success fw-normal d-block">
                                        <i class="ti ti-chevron-up mb-1 me-1"></i>
                                        5.7%
                                    </small>
                                </div>
                                <div class="user-progress">
                                    <h6 class="text-body mb-0">4.5/5</h6>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--/ Delivery Performance -->
        <!-- Reasons for delivery exceptions -->
        <div class="col-xxl-4 col-lg-6">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Reasons for delivery exceptions</h5>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-text-secondary rounded-pill text-muted border-0 p-2 me-n1"
                            type="button" id="deliveryExceptions" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="ti ti-dots-vertical ti-md text-muted"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="deliveryExceptions">
                            <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                            <a class="dropdown-item" href="javascript:void(0);">Share</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="deliveryExceptionsChart"></div>
                </div>
            </div>
        </div>
        <!--/ Reasons for delivery exceptions -->

        <!-- On route vehicles Table -->

        <div class="col-12 order-5">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">On route vehicles</h5>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-text-secondary rounded-pill text-muted border-0 p-2 me-n1"
                            type="button" id="routeVehicles" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="ti ti-dots-vertical ti-md text-muted"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="routeVehicles">
                            <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                            <a class="dropdown-item" href="javascript:void(0);">Share</a>
                        </div>
                    </div>
                </div>
                <div class="card-datatable table-responsive">
                    <table class="dt-route-vehicles table table-sm">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>location</th>
                                <th>starting route</th>
                                <th>ending route</th>
                                <th>warnings</th>
                                <th class="w-20">progress</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <!--/ On route vehicles Table -->
    </div>

    @include('_partials/_modals/modal-create-demande')
    @include('_partials/_modals/modal-edit-demande')

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

        $(document).ready(function() {
            $('#type_conge-md').on('change', function(e) {
                var data = $('#type_conge-md').select2("val");
                @this.set('typeConge', data);

            });
        });

        $wire.on('event-update', (demandeId) => {
            const typeConge = demandeId[0].id
            $('#type_conge-md').val(typeConge).trigger('change');
        });
    </script>
@endscript
