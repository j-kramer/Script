<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">

        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y max-h-96 overflow-y-auto">
            @foreach ($messages->reverse() as $dm)
            <article class="p-3 flex flex-row space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                <div class="flex-1">
                    <div>
                        <span class="text-gray-800">{{ $dm->sender_id == Auth::id() ? Auth::user()->name : $other->name }}</span>
                           <small class="ml-2 text-sm text-gray-600">{{ $dm->created_at->format('j M Y, g:i a') }}</small>
                    </div>
                    <p class="mt-2 text-lg text-gray-900">{{ $dm->message }}</p>
                </div>
            </article>
            @endforeach
        </div>
        <form method="POST" action="{{ route('conversations.store', $other) }}">
            @csrf

            <!-- Message -->
            <div class="mt-4">
                <x-textarea id="message" class="block mt-1 w-full h-40" name="message" placeholder="{{ __('What\'s on your mind?') }}" required>{{ old('message') }}</x-textarea>
                <x-input-error :messages="$errors->store->get('message')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ms-4">
                    {{ __('Send') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>