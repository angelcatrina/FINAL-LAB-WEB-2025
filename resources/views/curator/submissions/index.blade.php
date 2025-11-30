<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 text-center font-sans">
            🎨 Manage Submissions & Select Winners
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-100 min-h-screen flex justify-center">
        <div class="max-w-5xl w-full px-4">

            {{-- Pesan sukses --}}
            @if(session('success'))
                <div class="mb-6 p-3 bg-green-100 text-green-800 rounded-lg shadow border border-green-200 text-center font-sans">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Group submissions berdasarkan challenge --}}
            @forelse($submissions->groupBy('challenge_id') as $challengeId => $challengeSubmissions)
                @php
                    $challenge = $challengeSubmissions->first()->challenge;
                @endphp

                <!-- CARD CHALLENGE DIPUSATKAN -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-8 mb-12 mx-auto">

                    {{-- Judul challenge --}}
                    <h3 class="text-2xl font-bold text-gray-900 text-center mb-4 font-sans">
                        🏆 Challenge: {{ $challenge->title }}
                    </h3>

                    <div class="text-center text-gray-700 mb-6 font-sans">
                        <p><strong>Rules:</strong> {{ $challenge->rules }}</p>
                        <p><strong>Waktu:</strong>
                            {{ \Carbon\Carbon::parse($challenge->start_date)->format('d M Y') }}
                            — {{ \Carbon\Carbon::parse($challenge->end_date)->format('d M Y') }}
                        </p>
                    </div>

                    {{-- Grid semua submissions --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-8">
                        @foreach($challengeSubmissions as $submission)
                            @php
                                $badgeColor = 'bg-gray-600 text-white';
                                if($submission->winner_position == '1st') $badgeColor = 'bg-yellow-400 text-black';
                                elseif($submission->winner_position == '2nd') $badgeColor = 'bg-gray-300 text-black';
                                elseif($submission->winner_position == '3rd') $badgeColor = 'bg-amber-700 text-white';
                            @endphp

                            <div class="bg-gray-200 rounded-xl shadow-md border border-gray-300 overflow-hidden transition hover:shadow-lg hover:-translate-y-1 duration-300">

                                <div class="relative">
                                    {{-- Thumbnail --}}
                                    <img src="{{ asset('storage/' . $submission->artwork->file_path) }}"
                                         alt="{{ $submission->artwork->title }}"
                                         class="w-full h-48 object-cover border-b border-gray-300">

                                    {{-- Badge juara --}}
                                    @if($submission->is_winner)
                                        <span class="absolute top-2 left-2 px-3 py-1 rounded-full text-xs font-bold shadow {{ $badgeColor }}">
                                            Juara {{ $submission->winner_position }}
                                        </span>
                                    @endif
                                </div>

                                <div class="p-4">
                                    {{-- Judul artwork --}}
                                    <h4 class="font-semibold text-gray-900 text-md truncate font-sans"
                                        title="{{ $submission->artwork->title }}">
                                        {{ $submission->artwork->title }}
                                    </h4>

                                    {{-- Nama peserta --}}
                                    <p class="text-gray-800 text-sm mt-1 font-sans">
                                        {{ $submission->artwork->user->name }}
                                    </p>

                                    {{-- Form set juara --}}
                                    <form method="POST"
                                          action="{{ route('curator.submissions.set_winner', $submission) }}"
                                          class="mt-4 flex gap-2 items-center font-sans">
                                        @csrf

                                        <input type="number" name="winner_position"
                                               class="border border-gray-300 bg-gray-50 rounded px-2 py-1 w-20 focus:ring-1 focus:ring-blue-400 font-sans"
                                               placeholder="Posisi" required>

                                        <button type="submit"
                                                class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded shadow-sm transition font-sans">
                                            Set
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Tombol umumkan --}}
                    <div class="text-center">
                        @if(!$challenge->is_announced)
                            <form action="{{ route('curator.challenges.announce', $challenge) }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg shadow font-sans">
                                    📢 Umumkan Pemenang
                                </button>
                            </form>
                        @else
                            <p class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded border border-blue-200 font-sans">
                                ✔ Pemenang sudah diumumkan
                            </p>
                        @endif
                    </div>

                </div>
                <!-- END CARD -->

            @empty
                <p class="text-center text-gray-500 mt-20 text-lg font-sans">
                    Belum ada submission untuk challenge apapun.
                </p>
            @endforelse

        </div>
    </div>
</x-app-layout>
