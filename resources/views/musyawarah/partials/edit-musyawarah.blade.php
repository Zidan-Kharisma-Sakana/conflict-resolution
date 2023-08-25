<table>
    <tr>
        <td>
            <h4>Hasil Musyawarah</h4>
        </td>
        <td class="flex gap-x-1">
            <span>:</span>
            @php
                $options = collect(['sepakat', 'belum sepakat', 'reschedule']);
            @endphp
            <div>
                <ul>
                    @foreach ($options as $option)
                        <li>
                            <input required type="radio" id="{{ $option }}" name="hasil"
                                value="{{ $option }}"
                                {{ old('hasil', $musyawarah->hasil) == $option ? 'checked' : '' }}
                                {{ !empty($musyawarah->hasil) || $user->role != \App\Models\User::IS_PIALANG ? 'disabled' : '' }} />
                            <label for={{ $option }} class="capitalize">{{ $option }}</label>
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
            @if (empty($musyawarah->hasil) && $user->role == \App\Models\User::IS_PIALANG)
                {{-- show form --}}
                <div>
                    <x-form.input.text-input type="file" id="file_hasil" name="file_hasil" class="ml-1" />
                    @error('file_hasil')
                        <x-form.input-error :messages="$errors->get('file_hasil')" />
                    @enderror
                </div>
            @elseif (!empty($musyawarah->file_hasil))
                {{-- show document --}}
                <a target="_blank" rel="noopener noreferrer" href="{{ '/storage/' . $musyawarah->file_hasil }}">[Berkas
                    Hasil]</a>
            @else
                {{-- show placeholder --}}
                <span>-</span>
            @endif
        </td>
    </tr>
    <tr>
        <td>Rangkuman Musyawarah</td>
        <td>:</td>
    </tr>
</table>
<div class="grid grid-cols-1">
    <textarea {{ empty($musyawarah->hasil) ? '' : 'disabled' }} required name="rangkuman"
        class="mt-1 w-full border-gray-300 rounded-md shadow-sm max-w-4xl">{{ old('rangkuman', $musyawarah->rangkuman) }}</textarea>
    @error('rangkuman')
        <x-form.input-error class="pl-4" :messages="$errors->get('rangkuman')" />
    @enderror
    @if (empty($musyawarah->hasil))
        @if (\Carbon\Carbon::parse($musyawarah->tanggal_waktu)->isPast())
            @if ($user->role == \App\Models\User::IS_PIALANG)
                <x-primary-button class="w-fit mt-4">Save</x-primary-button>
            @endif
        @else
            <x-danger-button disabled class="w-fit mt-4">Belum Dimulai</x-danger-button>
        @endif
    @endif
</div>
