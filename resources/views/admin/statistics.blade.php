<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Platform Statistics</h2>
    </x-slot>

    <div class="min-h-screen bg-gray-100 py-6">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Card utama -->
            <div class="bg-white p-6 rounded-lg shadow-md space-y-8">

                <!-- Overall Platform Stats -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Overall Platform Stats</h3>
                    <canvas id="overallChart" class="bg-gray-50 p-4 rounded border border-gray-200"></canvas>
                </div>

                <!-- Artworks per Category -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Artworks per Category</h3>
                    <canvas id="categoryChart" class="bg-gray-50 p-4 rounded border border-gray-200"></canvas>
                </div>

            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @php
        $categoryNames = $artworksPerCategory->pluck('name');
        $artworksCounts = $artworksPerCategory->pluck('artworks_count');

        $overallLabels = ['Total Users', 'Total Artworks', 'Total Reports'];
        $overallCounts = [$totalUsers, $totalArtworks, $totalReports];
    @endphp

    <script>
        // ===== Overall Stats Chart =====
        const overallCtx = document.getElementById('overallChart').getContext('2d');
        const overallChart = new Chart(overallCtx, {
            type: 'bar',
            data: {
                labels: @json($overallLabels),
                datasets: [{
                    label: 'Count',
                    data: @json($overallCounts),
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 159, 64, 0.6)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    tooltip: { enabled: true }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        precision: 0
                    }
                }
            }
        });

        // ===== Artworks per Category Chart =====
        const categoryCtx = document.getElementById('categoryChart').getContext('2d');
        const categoryChart = new Chart(categoryCtx, {
            type: 'bar',
            data: {
                labels: @json($categoryNames),
                datasets: [{
                    label: 'Number of Artworks',
                    data: @json($artworksCounts),
                    backgroundColor: 'rgba(153, 102, 255, 0.6)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    tooltip: { enabled: true }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        precision: 0
                    }
                }
            }
        });
    </script>
</x-app-layout>
