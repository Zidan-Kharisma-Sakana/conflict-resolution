<div class="max-w-full mx-auto px-4 sm:px-8 lg:px-16 space-y-6 mt-8">
    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <header>
            <h2 class="text-xl font-medium text-gray-900">
                {{ __('Kesepakatan') }}
            </h2>
        </header>
        @if (!empty($kesepakatan))
            <table>
                <tr>
                    <td>Status</td>
                    <td>{{ ': ' . ($kesepakatan->confirmed ? ' Telah Dikonfirmasi Bappebti' : 'Menunggu Konfirmasi Bappebti') }}
                    </td>
                </tr>
                <tr>
                    <td>Dibuat Oleh</td>
                    <td>{{ ': ' . $kesepakatan->user->name }}
                    </td>
                </tr>
                <tr>
                    <td>Waktu Dibuat:</td>
                    <td>{{ ': ' . \Carbon\Carbon::parse($kesepakatan->created_at)->isoFormat('dddd, D MMMM Y HH:mm') }}
                    </td>
                </tr>
                <tr>
                    <td>File Pendukung</td>
                    <td><span>: </span>
                        @if (!empty($kesepakatan->file))
                            <a target="_blank" rel="noopener noreferrer" href="{{ '/storage/' . $kesepakatan->file }}">
                                [File Pendukung]
                            </a>
                        @else
                            <span> -</span>
                        @endif
                    </td>
                <tr>
                    <td>Hasil Kesepakatan</td>
                    <td>:</td>
                </tr>
                </tr>
            </table>
            <textarea disabled
                class="mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ $pengaduan->kesepakatan->isi }}</textarea>
        @endif

        @if ($user->role == \App\Models\User::IS_BAPPEBTI && !empty($kesepakatan))
            <form class="" action="{{ route('kesepakatan.update', $kesepakatan->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('patch')
                @if (!$kesepakatan->confirmed)
                    <x-primary-button class="mt-4">Konfirmasi</x-primary-button>
                @endif
            </form>
        @endif

        @if (empty($kesepakatan))
            <p>Belum Ada Kesepakatan Tercapai</p>
        @endif

    </div>
</div>
