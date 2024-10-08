<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('articles.update', $article) }}">
            @csrf
            @method('patch')

            <!-- Title -->
            <div>
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" placeholder="{{ __('Your article title') }}" :value="old('title', $article->title)" required autofocus />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <!-- Content -->
            <div class="mt-4">
                <x-input-label for="content" :value="__('Content')" />
                <x-textarea id="content" class="block mt-1 w-full h-40" name="content" placeholder="{{ __('Your article content') }}" required>{{ old('content', $article->content) }}</x-textarea>
                <x-input-error :messages="$errors->get('content')" class="mt-2" />
            </div>
            
            <div class="flex items-center justify-end mt-4">
                <a href="{{ route('articles.index') }}">{{ __('Cancel') }}</a>
                <x-primary-button class="ms-4">
                    {{ __('Save') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>