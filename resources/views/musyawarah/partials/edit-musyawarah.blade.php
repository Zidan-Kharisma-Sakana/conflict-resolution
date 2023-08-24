<table>
    <tr>
        <td>
            <h4>Hasil Musyawarah</h4>
        </td>
        <td class="flex gap-x-1">
            <span>:</span>
            <div>
                <ul>
                    <li>
                        <input required type="radio" id="sepakat" name="hasil" value="sepakat"
                            {{ old('hasil', $musyawarah->hasil) == 'sepakat' ? 'checked' : '' }}
                            {{ empty($musyawarah->hasil) ? '' : 'disabled' }} />
                        <label for="sepakat">Bersepakat</label>
                    </li>
                    <li>
                        <input required type="radio" id="belum_sepakat" name="hasil"
                            value="belum_sepakat"{{ old('hasil', $musyawarah->hasil) == 'belum_sepakat' ? 'checked' : '' }}
                            {{ empty($musyawarah->hasil) ? '' : 'disabled' }} />
                        <label for="belum_sepakat">Belum Sepakat</label>
                    </li>
                    <li>
                        <input required type="radio" id="reschedule" name="hasil"
                            value="reschedule"{{ old('hasil', $musyawarah->hasil) == 'reschedule' ? 'checked' : '' }}
                            {{ empty($musyawarah->hasil) ? '' : 'disabled' }} />
                        <label for="reschedule">Reschedule</label>
                    </li>
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
            <x-primary-button class="w-fit mt-4">Save</x-primary-button>
        @else
            <x-danger-button disabled class="w-fit mt-4">Belum Dimulai</x-danger-button>
        @endif
    @endif
</div>
