<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Reservation Management</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/soft-ui-dashboard.css?v=1" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
</head>
<body class="g-sidenav-show bg-gray-100">
@include('layouts.navbars.auth.sidebar')
@include('layouts.navbars.auth.nav')

<div class="my-4 mx-4">
    <!-- Button to open the create reservation modal -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createReservationModal">Add Reservation</button>

    <div class="card">
        <div class="card-header pb-0 px-3">
            <h6 class="mb-0">List of Reservations</h6>
        </div>
        <div class="card-body pt-4 p-3">
            <div style="max-height: 500px; overflow-y: auto;">
                <ul class="list-group">
                    @foreach ($reservations as $reservation)
                    <li class="list-group-item border-0 d-flex flex-column p-4 mb-2 bg-gray-100 border-radius-lg">
                        <h6 class="mb-3 text-center" style="color: #ff6347;">{{ $reservation->titre }}</h6>
                        <span class="text-md">Itinerary: <span class="text-dark font-weight-bold">{{ $reservation->itineraire->titre }}</span></span>
                        <span class="text-md">Accommodation: <span class="text-dark font-weight-bold">{{ $reservation->hebergement->nom }}</span></span>
                        <span class="text-md">Transport: <span class="text-dark font-weight-bold">{{ $reservation->transport->nom_trans }}</span></span>
                        <span class="text-md">User: <span class="text-dark font-weight-bold">{{ $reservation->user->name }}</span></span>

                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link text-danger text-gradient mb-0">
                                    <i class="far fa-trash-alt me-2"></i>Delete
                                </button>
                            </form>
                            <button type="button" class="btn btn-link text-dark mb-0" data-bs-toggle="modal" data-bs-target="#updateReservationModal{{ $reservation->id }}">
                                <i class="fas fa-pencil-alt me-2"></i>Edit
                            </button>
                        </div>
                    </li>

                    <!-- Edit Reservation Modal -->
                    <div class="modal fade" id="updateReservationModal{{ $reservation->id }}" tabindex="-1" aria-labelledby="updateReservationModalLabel{{ $reservation->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('reservations.update', $reservation->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Reservation</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <label>Itinerary</label>
                                        <select class="form-select" name="itineraire_id">
                                            @foreach ($itineraires as $itineraire)
                                            <option value="{{ $itineraire->id }}" {{ $reservation->itineraire_id == $itineraire->id ? 'selected' : '' }}>{{ $itineraire->titre }}</option>
                                            @endforeach
                                        </select>
                                        <label class="mt-3">Accommodation</label>
                                        <select class="form-select" name="hebergement_id">
                                            @foreach ($hebergements as $hebergement)
                                            <option value="{{ $hebergement->id }}" {{ $reservation->hebergement_id == $hebergement->id ? 'selected' : '' }}>{{ $hebergement->nom }}</option>
                                            @endforeach
                                        </select>
                                        <label class="mt-3">Transport</label>
                                        <select class="form-select" name="transport_id">
                                            @foreach ($transports as $transport)
                                            <option value="{{ $transport->id }}" {{ $reservation->transport_id == $transport->id ? 'selected' : '' }}>{{ $transport->nom_trans }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update Reservation</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Create Reservation Modal -->
<div class="modal fade" id="createReservationModal" tabindex="-1" aria-labelledby="createReservationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('reservations.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Reservation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label>Itinerary</label>
                    <select class="form-select" name="itineraire_id" required>
                        @foreach ($itineraires as $itineraire)
                        <option value="{{ $itineraire->id }}">{{ $itineraire->titre }}</option>
                        @endforeach
                    </select>
                    <label class="mt-3">Accommodation</label>
                    <select class="form-select" name="hebergement_id" required>
                        @foreach ($hebergements as $hebergement)
                        <option value="{{ $hebergement->id }}">{{ $hebergement->nom }}</option>
                        @endforeach
                    </select>
                    <label class="mt-3">Transport</label>
                    <select class="form-select" name="transport_id" required>
                        @foreach ($transports as $transport)
                        <option value="{{ $transport->id }}">{{ $transport->nom_trans }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Reservation</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Core JS Files -->
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
</body>
</html>
