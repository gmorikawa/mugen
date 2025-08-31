<x-layout.app>
<table class="border-collapse border border-gray-400 w-full border-spacing-1">
    <thead>
        <tr>
            <th class="border border-gray-300 p-2">Username</th>
            <th class="border border-gray-300 p-2">Email</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($users as $user)
        <tr>
            <td class="border border-gray-300 p-2">{{ $user->username }}</td>
            <td class="border border-gray-300 p-2">{{ $user->email }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</x-layout.app>