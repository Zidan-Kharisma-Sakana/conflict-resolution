<table>
    <tr>
        <td>
            <h4>Hasil Musyawarah</h4>
        </td>
        <td class="flex gap-x-1">
            <span>:</span>
            @php
                $options = collect([\App\Models\Complaint\Musyawarah::HASIL_SEPAKAT, \App\Models\Complaint\Musyawarah::HASIL_BELUM_SEPAKAT, \App\Models\Complaint\Musyawarah::HASIL_RESCHEDULE]);
                $inPast = \Carbon\Carbon::parse($mediasi->tanggal_waktu)->isPast();
                $isBursa = $user->role == \App\Models\User::IS_BURSA;
                $hasilIsSet = !empty($mediasi->hasil);
            @endphp
            <div>
                <ul>
                    @foreach ($options as $option)
                        <li>
                            <input required type="radio" id="{{ str_replace(' ', '_', $option) }}" name="hasil"
                                value="{{ $option }}"
                                {{ old('hasil', $mediasi->hasil) == $option ? 'checked' : '' }}
                                {{ $hasilIsSet || !$isBursa || !$inPast ? 'disabled' : '' }} />
                            <label for={{ str_replace(' ', '_', $option) }}
                                class="capitalize">{{ strtolower($option) }}</label>
                        </li>
                    @endforeach
                </ul>
            </div>
        </td>
    </tr>
    <tr>
        <td>File Hasil (Opsional)</td>
        <td class="flex gap-x-1">
            <span>:</span>
            @if (empty($mediasi->hasil) && $user->role == \App\Models\User::IS_BURSA)
                {{-- show form --}}
                <div>
                    <x-form.input.text-input type="file" id="file_hasil" name="file_hasil" class="ml-1" />
                    @error('file_hasil')
                        <x-form.input-error :messages="$errors->get('file_hasil')" />
                    @enderror
                </div>
            @elseif (!empty($mediasi->file_hasil))
                {{-- show document --}}
                <a target="_blank" rel="noopener noreferrer" href="{{ '/storage/' . $mediasi->file_hasil }}">[Berkas
                    Hasil]</a>
            @else
                {{-- show placeholder --}}
                <span>-</span>
            @endif
        </td>
    </tr>
    <tr>
        <td>Rangkuman Mediasi</td>
        <td>:</td>
    </tr>
</table>
<div class="grid grid-cols-1">
    <textarea {{ !empty($mediasi->hasil) || !$inPast ? 'disabled' : '' }} required name="rangkuman"
        class="mt-1 w-full border-gray-300 rounded-md shadow-sm max-w-4xl">{{ old('rangkuman', $mediasi->rangkuman) }}</textarea>
    @error('rangkuman')
        <x-form.input-error class="pl-4" :messages="$errors->get('rangkuman')" />
    @enderror
    @if (!$hasilIsSet)
        @if ($inPast && $isBursa)
            <x-primary-button class="w-fit mt-4">Save</x-primary-button>
        @else
            <x-danger-button disabled class="w-fit mt-4">Belum Dimulai</x-danger-button>
        @endif
    @endif
</div>
