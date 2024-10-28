<div>
    <main class="main-content">
        <div class="container-fluid py-4">
            <h2 class="mb-4">Manage Avis</h2>
            
            <hr>

            <h3 class="mt-4">Avis List</h3>
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Avis Table</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">User </th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Destination </th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Commentaire</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Note</th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($avis) === 0)
                                        <tr>
                                            <td colspan="5" class="text-center">No reviews found.</td>
                                        </tr>
                                    @else
                                    <h3>Average Ratings of Destinations</h3>
                                    <button wire:click="downloadPdf" class="btn btn-primary">Télécharger PDF</button>
                                    <canvas id="myChart" width="400" height="200"></canvas>
                                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>   
                                    <script>
                                        console.log("zeazr")
                                        // document.addEventListener('livewire:load', function () {
                                            const ctx = document.getElementById('myChart').getContext('2d');
                                            
                                            const myChart = new Chart(ctx, {
                                                type: 'bar', // Change to 'line', 'pie', etc., if desired
                                                data: {
                                                    labels: @json($labels),
                                                    datasets: [{
                                                        label: 'Average Rating',
                                                        data: @json($averageNotes),
                                                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                                        borderColor: 'rgba(54, 162, 235, 1)',
                                                        borderWidth: 1
                                                    }]
                                                },
                                                options: {
                                                    scales: {
                                                        y: {
                                                            beginAtZero: true,
                                                            title: {
                                                                display: true,
                                                                text: 'Average Rating'
                                                            }
                                                        },
                                                        x: {
                                                            title: {
                                                                display: true,
                                                                text: 'Destinations'
                                                            }
                                                        }
                                                    }
                                                }
                                            });
                                        // });
                                    </script>
                                    
                                    @foreach($avis as $review)
                                        <tr>
                                            <td>{{ $review->user->name }}</td>
                                            <td>{{ $review->destination->nom }}</td>
                                            <td>{{ $review->commentaire }}</td>
                                            <td>{{ $review->note }}</td>
                                            {{-- <td>
                                                <button wire:click="edit({{ $review->id }})" class="btn btn-warning btn-sm">Edit</button>
                                                <button wire:click="delete({{ $review->id }})" class="btn btn-danger btn-sm">Delete</button>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                    @foreach ($destinations as $destination)
    {{-- <div class="destination">
        <h3>{{ $destination->nom }}</h3>
        <p>{{ $destination->description }}</p>
        <p>Average Rating: {{ number_format($destination->avis_avg_note, 1) ?? 'No reviews yet' }} ⭐</p>
    </div> --}}
@endforeach


                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
