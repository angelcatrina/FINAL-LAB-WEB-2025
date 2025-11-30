<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Detail Report #{{ $report->id }}</h2>
    </x-slot>

    <div class="min-h-screen bg-gray-100 py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

          
            <div class="bg-white p-6 rounded-lg shadow-md space-y-6">

        
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200 space-y-1">
                    <p><strong>Pelapor:</strong> {{ $report->reporter->name }}</p>
                    <p><strong>Jenis Laporan:</strong> {{ $report->reason }}</p>
                    <p><strong>Tanggal Dilaporkan:</strong> {{ $report->created_at->format('d M Y H:i') }}</p>
                </div>

              
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200 space-y-3">
                    @if($report->reported_type === 'artwork' && $report->artwork)
                        <p class="font-semibold text-gray-800 mb-2">Judul Karya: {{ $report->artwork->title }}</p>
                        <img 
                            src="{{ asset('storage/' . ($report->artwork->file_path ?? 'placeholder.png')) }}" 
                            alt="{{ $report->artwork->title }}" 
                            class="w-full h-auto max-h-[250px] object-contain rounded-lg border"
                        >
                        <p class="text-gray-700 mt-2">{{ $report->artwork->description }}</p>
                        <p class="text-sm text-gray-500">Dibuat pada: {{ $report->artwork->created_at->format('d M Y H:i') }}</p>
                    @elseif($report->reported_type === 'comment' && $report->comment)
                        <p class="font-semibold text-gray-800">Komentar:</p>
                        <p class="text-gray-700">{{ $report->comment->content }}</p>
                        <p class="text-sm text-gray-500">Dibuat pada: {{ $report->comment->created_at->format('d M Y H:i') }}</p>
                    @else
                        <p class="text-gray-500">Konten sudah dihapus.</p>
                    @endif
                </div>

             
                <div class="flex justify-start">
                    <a href="{{ route('admin.moderation.queue') }}" 
                       class="px-4 py-2 rounded bg-gray-600 text-white hover:bg-gray-700 transition">
                        Kembali
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
