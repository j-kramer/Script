<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('comments.update', $comment) }}">
            @csrf
            @method('patch')

            <!-- Comment -->
            <div class="mt-4">
                <x-input-label for="comment" :value="__('Comment')" />
                <x-textarea id="comment" class="block mt-1 w-full h-40" name="comment" placeholder="{{ __('What\'s on your mind?') }}" required>{{ old('comment', $comment) }}</x-textarea>
                <x-input-error :messages="$errors->get('comment')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a href="{{ route('comments.show', $comment) }}">{{ __('Cancel') }}</a>
                <x-primary-button class="ms-4">
                    {{ __('Save') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>