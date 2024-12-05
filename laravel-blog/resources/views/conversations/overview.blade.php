<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">

        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y p-2">
            <h1>All conversations</h1>
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th class="text-left">Username</th>
                        <th class="text-center">#Unread messages</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($conversations as $id => $data)
                    <tr>
                        <td><a href="{{ route('conversations.show', $id) }}">{{ $data['name'] }}</a></td>
                        <td class="text-center">{{ $data['unread'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y p-2">
            <h1>Who do you want to start a conversation with?</h1>
            <ul class="list-disc pl-3">
                @foreach ($users as $user)
                <li><a href="{{ route('conversations.show', $user) }}">{{ $user->name }}</a>
                </li>
                @endforeach
            </ul>
        </div>
        {{ $users->links() }}
    </div>
</x-app-layout>