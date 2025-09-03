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
                    <th class="border border-gray-300 p-2 text-left">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td class="border border-gray-300 p-2">{{ $user->username }}</td>
                    <td class="border border-gray-300 p-2">{{ $user->email }}</td>
                    <td class="border border-gray-300 p-2">{{ $user->role }}</td>
                    <td class="border border-gray-300 p-2">
                        <div class="flex flex-row gap-2">
                            <x-button.link href="/users/{{ $user->id }}/update">Update</x-button.outlined>
                            <x-button.link href="/users/{{ $user->id }}/remove">Remove</x-button.action>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </x-container.stack>
</x-layout.app>