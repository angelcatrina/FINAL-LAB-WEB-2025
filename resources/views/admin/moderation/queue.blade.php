<x-app-layout>
    {{-- Header bawaan dihapus sepenuhnya --}}

    <div class="py-6 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">
                Daftar Laporan Moderasi
            </h1>

            <div class="bg-gray-300 p-6 rounded-2xl shadow-xl overflow-x-auto">

                <table class="min-w-full table-auto border-collapse border border-gray-700 text-gray-900">
                    <thead class="bg-gray-700 text-gray-100">
                        <tr>
                            <th class="px-4 py-2 border">ID</th>
                            <th class="px-4 py-2 border">Reporter</th>
                            <th class="px-4 py-2 border">Jenis Laporan</th>
                            <th class="px-4 py-2 border">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @foreach($reports as $report)
                        <tr class="hover:bg-gray-700">
                            <td class="px-4 py-2 border text-center">{{ $report->id }}</td>
                            <td class="px-4 py-2 border">{{ $report->reporter->name }}</td>
                            <td class="px-4 py-2 border">
                                <span class="px-2 py-1 rounded 
                                    @if($report->reason === 'SARA') bg-red-600 text-white
                                    @elseif($report->reason === 'Plagiat') bg-yellow-600 text-white
                                    @elseif($report->reason === 'Konten Tidak Pantas') bg-blue-600 text-white
                                    @else bg-gray-600 text-white @endif
                                ">
                                    {{ $report->reason }}
                                </span>
                            </td>
                            <td class="px-4 py-2 border">
                                <div class="flex gap-2 justify-center">
                                    <form action="{{ route('admin.moderation.dismiss', $report) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-3 py-1 rounded bg-yellow-500 text-white hover:bg-yellow-600 transition">
                                            Dismiss
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.moderation.takeDown', $report) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-3 py-1 rounded bg-red-600 text-white hover:bg-red-700 transition">
                                            Take Down
                                        </button>
                                    </form>

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
