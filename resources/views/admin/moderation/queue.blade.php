<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Moderation Queue</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-6 rounded-lg shadow-lg">

                <table class="min-w-full table-auto border-collapse border border-gray-200">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="px-4 py-2 border">ID</th>
                            <th class="px-4 py-2 border">Reporter</th>
                            <th class="px-4 py-2 border">Jenis Laporan</th>

                            <th class="px-4 py-2 border">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($reports as $report)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border text-center">{{ $report->id }}</td>
                            <td class="px-4 py-2 border">{{ $report->reporter->name }}</td>
                            <td class="px-4 py-2 border">
                                <span class="px-2 py-1 rounded 
                                    @if($report->reason === 'SARA') bg-red-200 text-red-800
                                    @elseif($report->reason === 'Plagiat') bg-yellow-200 text-yellow-800
                                    @elseif($report->reason === 'Konten Tidak Pantas') bg-blue-200 text-blue-800
                                    @else bg-gray-200 text-gray-800 @endif
                                ">
                                    {{ $report->reason }}
                                </span>
                            </td>
                            
                            </td>
                           <td class="px-4 py-2 border">
    <div class="flex gap-2 justify-center">

        <!-- Tombol Dismiss -->
        <form action="{{ route('admin.moderation.dismiss', $report) }}" method="POST">
            @csrf
            <button type="submit" class="px-3 py-1 rounded bg-yellow-400 text-white hover:bg-yellow-500 transition">
                Dismiss
            </button>
        </form>

        <!-- Tombol Take Down -->
        <form action="{{ route('admin.moderation.takeDown', $report) }}" method="POST">
            @csrf
            <button type="submit" class="px-3 py-1 rounded bg-red-600 text-white hover:bg-red-700 transition">
                Take Down
            </button>
        </form>

        <!-- Tombol Detail -->
        <a href="{{ route('admin.moderation.detail', $report) }}" 
           class="px-3 py-1 rounded bg-blue-600 text-white hover:bg-blue-700 transition">
           Detail
        </a>

    </div>
</td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>

                @if($reports->isEmpty())
                    <div class="mt-4 p-3 bg-blue-100 text-blue-800 rounded text-center">
                        Tidak ada laporan yang perlu dimoderasi saat ini.
                    </div>
                @endif

            </div>

        </div>
    </div>
</x-app-layout>
