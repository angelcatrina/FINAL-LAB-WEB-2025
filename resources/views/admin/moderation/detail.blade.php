<x-app-layout>
    {{-- Header bawaan dihapus sepenuhnya --}}

    <div class="min-h-screen bg-gray-200 py-10">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <h1 class="text-3xl font-bold text-gray-900 mb-6 text-center">
                Detail Report
            </h1>

            <div class="bg-gray-800 p-8 rounded-2xl shadow-xl space-y-6">

                <div class="p-4 bg-gray-400 rounded-lg border border-gray-600 space-y-2 text-black">
                    <p><strong>Pelapor:</strong> {{ $report->reporter->name }}</p>
                    <p><strong>Jenis Laporan:</strong> {{ $report->reason }}</p>
                    <p><strong>Tanggal Dilaporkan:</strong> {{ $report->created_at->format('d M Y H:i') }}</p>
                </div>

                <div class="p-4 bg-gray-400 rounded-lg border border-gray-600 space-y-3 text-black">
                    @if($report->reported_type === 'artwork' && $report->artwork)
                        <p class="font-semibold text-lg-mb-2">Judul Karya: {{ $report->artwork->title }}</p>
                        <img 
                            src="{{ asset('storage/' . ($report->artwork->file_path ?? 'placeholder.png')) }}" 
                            alt="{{ $report->artwork->title }}" 
                            class="w-full h-auto max-h-[300px] object-contain rounded-lg border border-gray-600"
                        >
                        <p class="mt-2 text-black">{{ $report->artwork->description }}</p>
                        <p class="text-sm text-black">Dibuat pada: {{ $report->artwork->created_at->format('d M Y H:i') }}</p>
                    @elseif($report->reported_type === 'comment' && $report->comment)
                        <p class="font-semibold text-lg">Komentar:</p>
                        <p class="text-gray-200">{{ $report->comment->content }}</p>
                        <p class="text-sm text-gray-400">Dibuat pada: {{ $report->comment->created_at->format('d M Y H:i') }}</p>
                    @else
                        <p class="text-gray-400">Konten sudah dihapus.</p>
                    @endif
                </div>

                <div class="flex justify-start">
                    <a href="{{ route('admin.moderation.queue') }}" 
                       class="px-5 py-2.5 rounded-xl bg-indigo-600 text-white hover:bg-indigo-500 shadow-md transition">
                        Kembali
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
