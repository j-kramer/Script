<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('sponsor.update', $article) }}">
            @csrf

            <h2 class="text-lg font-medium text-gray-900">Do you want to sponsor this article?</h2>

            <p class="mt-1 text-sm text-gray-600">{{ $article->title }}</p>

            <div class="flex items-center justify-end mt-4">
                <a href="{{ route('articles.index') }}">{{ __('Cancel') }}</a>
                <x-primary-button class="ms-4">
                    {{ __('Sponsor') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>