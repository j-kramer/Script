@props(['articles'])

<div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
    @foreach ($articles as $article)
    <article class="flex flex-row space-x-2">
        @isset($article->image_path)
        <div class="shrink-0">
            <img class="h-full w-32 object-cover" src="{{ asset($article->image_path) }}" alt="{{ $article->title }}">
        </div>
        @endisset
        <div class="p-6 flex-1">
            <a href="{{ route('articles.show', $article) }}">
                <h1 class="text-lg text-gray-900">{{ $article->title }}</h1>
            </a>
            @include('articles.partials.article-info')
        </div>
        @canany(['update', 'delete'], $article)
        <div class="inline-flex items-center">
            @can('update', $article)
            <a href="{{ route('articles.edit', $article) }}"><x-edit-icon /></a>
            @endcan
            @can('delete', $article)
            <button
                x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'confirm-article-deletion-{{ $loop->index }}')">
                <x-delete-icon />
            </button>

            <x-modal name="confirm-article-deletion-{{ $loop->index }}">
                <form method="post" action="{{ route('articles.destroy', $article) }}" class="p-6">
                    @csrf
                    @method('delete')

                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Are you sure you want to delete your article?') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        {{ __('Once the article is deleted, all of its resources and data will be permanently deleted.') }}
                    </p>

                    <div class="mt-6 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            {{ __('Cancel') }}
                        </x-secondary-button>

                        <x-danger-button class="ms-3">
                            {{ __('Delete Article') }}
                        </x-danger-button>
                    </div>
                </form>
            </x-modal>
            @endcan
        </div>
        @endcanany
    </article>
    @endforeach
</div>
{{ $articles->links() }}