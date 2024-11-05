<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        @auth
        @include('categories.partials.create-category-form')
        @endauth

        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            <h1>All Categories:</h1>
            <ul class="list-disc">
                @foreach ($categories as $category)
                <li><a href="{{ route('categories.show', $category) }}">{{ $category->name }}</a>
                    @auth
                    <button
                        x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'confirm-category-deletion-{{ $loop->index }}')">
                        <x-delete-icon />
                    </button>

                    <x-modal name="confirm-category-deletion-{{ $loop->index }}">
                        <form method="post" action="{{ route('categories.destroy', $category) }}" class="p-6">
                            @csrf
                            @method('delete')

                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Are you sure you want to delete this category?') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Once the category is deleted, all of its resources and data will be permanently deleted.') }}
                            </p>

                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close')">
                                    {{ __('Cancel') }}
                                </x-secondary-button>

                                <x-danger-button class="ms-3">
                                    {{ __('Delete Category') }}
                                </x-danger-button>
                            </div>
                        </form>
                    </x-modal>
                    @endauth
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</x-app-layout>