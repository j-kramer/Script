<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('articles.create') }}">
            <x-primary-button>{{ __('Create an Article') }}</x-primary-button>
        </a>
        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            @foreach ($articles as $article)
            <article class="p-6 flex flex-row space-x-2">
                <div class="flex-1">
                        <a href="{{ route('articles.show', $article) }}"><h1 class="text-lg text-gray-900">{{ $article->title }}</h1>
                        </a>
                        <small class="ml-2 text-sm text-gray-600">{{ $article->created_at->format('j M Y, g:i a') }}</small>
                        @unless ($article->created_at->eq($article->updated_at))
                        <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                        @endunless
                </div>
                @if ($article->user->is(auth()->user()))
                <div class="inline-flex items-center">
                    <a href="{{ route('articles.edit', $article) }}"><x-edit-icon /></a>
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
                </div>
                @endif
            </article>
            @endforeach
        </div>
    </div>
</x-app-layout>