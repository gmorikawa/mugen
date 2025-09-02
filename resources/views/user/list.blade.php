<x-layout.app>
    <x-container.stack>
        <div class="flex flex-col">
            <x-button.link href="/users/create">
                Add
            </x-button.link>
        </div>
        <table class="border-collapse border border-gray-400 w-full border-spacing-1">
            <thead>
                <tr>
                    <th class="border border-gray-300 p-2 text-left">Username</th>
                    <th class="border border-gray-300 p-2 text-left">Email</th>
                    <th class="border border-gray-300 p-2 text-left">Role</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td class="border border-gray-300 p-2">{{ $user->username }}</td>
                    <td class="border border-gray-300 p-2">{{ $user->email }}</td>
                    <td class="border border-gray-300 p-2">{{ $user->role }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </x-container.stack>
</x-layout.app>