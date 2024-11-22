<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $article->title }}
        </h2>
        @include('articles.partials.article-info')
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @isset($article->image_path)
                <img src="{{ asset($article->image_path) }}" alt="{{ $article->title }}">
                @endisset
                <div class="p-6 text-gray-900">
                    {{ $article->content }}
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        @auth
        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('articles.comments.create', $article) }}">
            <x-primary-button>{{ __('Comment') }}</x-primary-button>
        </a>
        @endauth

        @include('comments.partials.comment-list')
    </div>
</x-app-layout>