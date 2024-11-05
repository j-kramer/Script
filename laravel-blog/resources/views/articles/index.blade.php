<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('articles.create') }}">
            <x-primary-button>{{ __('Create an Article') }}</x-primary-button>
        </a>
        <x-article-list :$articles :showUser="false" />
    </div>
</x-app-layout>