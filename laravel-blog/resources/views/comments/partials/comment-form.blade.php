<form method="POST" action="{{ route('articles.comments.store', $article) }}">
    @csrf

    <!-- Comment -->
    <div class="mt-4">
        <x-input-label for="comment" :value="__('Comment')" />
        <x-textarea id="comment" class="block mt-1 w-full h-40" name="comment" placeholder="{{ __('What\'s on your mind?') }}" required>{{ old('comment') }}</x-textarea>
        <x-input-error :messages="$errors->store->get('comment')" class="mt-2" />
    </div>

    <div class="flex items-center justify-end mt-4">
        <x-primary-button class="ms-4">
            {{ __('Save') }}
        </x-primary-button>
    </div>
</form>