<div>
    <h6 class="text-xl font-medium">Identitas Pengguna</h6>
    <table>
        <tr>
            <td>Nama</td>
            <td>{{ ': ' . $user->name }}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>{{ ': ' . $user->email }}</td>
        </tr>
        <tr>
            <td>Role</td>
            <td>{{ ': ' . $user->role }}</td>
        </tr>
        <tr>
            <td>Akun Dibuat Pada</td>
            <td>{{ ': ' . \Carbon\Carbon::parse($user->created_at)->isoFormat('D MMMM Y') }}</td>
        </tr>
    </table>
    <a href="{{ route('account.edit') }}" class="underline text-blue-500">Lengkapi Profil Anda</a>
</div>
