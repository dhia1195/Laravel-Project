<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Metas -->
    @if (env('IS_DEMO'))
        <x-demo-metas></x-demo-metas>
    @endif
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        Soft UI Dashboard by Creative Tim
    </title>
    <!-- Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1" rel="stylesheet" />
    @livewireStyles

</head>
<body class="g-sidenav-show bg-gray-100">

@include('layouts.navbars.auth.sidebar')
@include('layouts.navbars.auth.nav')
@include('components.plugins.fixed-plugin')



    <div class="my-4 mx-4">
    <div class="my-4 mx-4">
    <!-- Button to open the create reclamation modal -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createReclamationModal">
        Add Reclamation
    </button>
        <div class="card">
                    <div class="card-header pb-0 px-3">
                        <h6 class="mb-0">Liste des réclamations</h6>
                    </div>
                    <div class="card-body pt-4 p-3">
                        <div style="max-height: 500px; overflow-y: auto;">
                        <ul class="list-group">
                        <!-- Loop through the reclamations and display them -->
                        @foreach ($reclamations as $reclamation)
                        <li class="list-group-item border-0 d-flex flex-column p-4 mb-2 bg-gray-100 border-radius-lg">
                                
                                <!-- Title centered -->
                                <div class="d-flex flex-column">
                                        <!-- Titre as Company Name -->
                                        <h6 class="mb-3 text-center text-md" style="color: #ff6347;">{{ $reclamation->titre }}</h6>
                                </div>

                                <span class="text-md">Nom: 
                                        <span class="text-dark ms-2 font-weight-bold">
                                                {{ $reclamation->user->name }} <!-- Display user's name -->
                                        </span>
                                </span>
                                
                                <!-- Description and Buttons side by side -->
                                <div class="d-flex justify-content-between align-items-center">
                                        <!-- Description with larger text -->
                                        <span class="text-md">Description: 
                                                <span class="text-dark ms-2 font-weight-bold">
                                                        {{ $reclamation->description }}
                                                </span>
                                        </span>
                                        
                                        <!-- Buttons -->
                                        <div >
                                                <form action="{{ route('reclamations.destroy', $reclamation->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-link text-danger text-gradient mb-0">
                                                                <i class="far fa-trash-alt me-2"></i>Delete
                                                        </button>
                                                </form>
                                                <button type="button" class="btn btn-link text-dark mb-0" data-bs-toggle="modal" data-bs-target="#updateReclamationModal{{ $reclamation->id }}">
                                                        <i class="fas fa-pencil-alt me-2" aria-hidden="true"></i>Edit
                                                </button>
                                        </div>
                                </div>
                                <div class="d-flex justify-content-between mt-4 mb-1">
                                        <!-- Date Created on the left -->
                                        <span class="text-xs">Date de création: 
                                        <span class="text-dark ms-2 font-weight-bold">
                                                @if ($reclamation->created_at)
                                                {{ $reclamation->created_at->format('Y-m-d') }}
                                                @else
                                                N/A
                                                @endif
                                        </span>
                                        </span>

                                        <span class="text-xs">Date de modification: 
                                                <span class="text-dark ms-2 font-weight-bold">
                                                        @if ($reclamation->updated_at)
                                                        {{ $reclamation->updated_at->format('Y-m-d') }}
                                                        @else
                                                        N/A
                                                        @endif
                                                </span>
                                        </span>
                                </div>
                                </li>

                                <div class="modal fade" id="updateReclamationModal{{ $reclamation->id }}" tabindex="-1" aria-labelledby="updateReclamationModalLabel{{ $reclamation->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                        <h5 class="modal-title" id="updateReclamationModalLabel{{ $reclamation->id }}">Update Reclamation</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                        <form action="{{ route('reclamations.update', $reclamation->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                                <label for="titre" class="form-label">Title</label>
                                                                <input type="text" class="form-control" name="titre" value="{{ $reclamation->titre }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                                <label for="description" class="form-label">Description</label>
                                                                <textarea class="form-control" name="description" required>{{ $reclamation->description }}</textarea>
                                                        </div>
                                                        <!-- Add other fields as necessary -->
                                                        <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Update Reclamation</button>
                                                        </div>
                                                        </form>
                                                </div>
                                                </div>
                                        </div>
                                        </div>


                        @endforeach
                        </ul>
                        </div>
                    </div>
                </div>
    </div>

    <!-- Create Reclamation Modal -->
        <div class="modal fade" id="createReclamationModal" tabindex="-1" aria-labelledby="createReclamationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title" id="createReclamationModalLabel">Add New Reclamation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <form action="{{ route('reclamations.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                                <label for="titre" class="form-label">Title</label>
                                <input type="text" class="form-control" name="titre" required>
                        </div>
                        <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" name="description" required></textarea>
                        </div>
                        <!-- Add other fields as necessary -->
                        <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add Reclamation</button>
                        </div>
                        </form>
                </div>
                </div>
        </div>
        </div>


    <!--   Core JS Files   -->
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="assets/js/soft-ui-dashboard.js"></script>
    @livewireScripts
</body>

</html>

