@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/logo-long.png'))) }}"
                style="height: 120px;" alt="{{ $slot }}">
        </a>
    </td>
</tr>
