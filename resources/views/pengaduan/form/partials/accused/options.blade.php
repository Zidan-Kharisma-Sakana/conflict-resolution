<option value="" disabled selected>Not Selected</option>
<option value="komisaris" {{ old($key) == 'komisaris' ? 'selected' : '' }}>
    Direktur/Komisaris</option>
<option value="kacab" {{ old($key) == 'kacab' ? 'selected' : '' }}>
    Kepala Cabang
</option>
<option value="wpb" {{ old($key) == 'wpb' ? 'selected' : '' }}>
    Wakil Pialang Berjangka</option>
<option value="lainnya" {{ old($key) == 'lainnya' ? 'selected' : '' }}>
    Lainnya/Karyawan
</option>
