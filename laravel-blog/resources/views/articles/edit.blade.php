<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('articles.update', $article) }}" enctype="multipart/form-data">
            @csrf
            @method('patch')

            <!-- Title -->
            <div>
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" placeholder="{{ __('Your article title') }}" :value="old('title', $article)" required autofocus />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <!-- Categories -->
            <div class="mt-4">
                <x-input-label for="category" :value="__('Categories')" />
                <select name="categories[]" id="category" multiple class="mt-1">
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $article->categories->contains($category) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('categories')" class="mt-2" />
            </div>

            <!-- Image -->
            <div class="mt-4">
                <x-input-label for="image" :value="__('Image')" />
                @isset($article->image_path)
                <img src="{{ asset($article->image_path) }}" alt="{{ $article->title }}" class="mt-1">
                @endisset
                <x-text-input id="image" class="block mt-1 w-full" type="file" accept=".jpeg,.png,.jpg,.svg" name="image" placeholder="{{ __('Your article image') }}" autofocus />
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </div>

            <!-- Premium -->
            <div class="mt-4">
                <label for="premium" class="items-center">
                    <input type="checkbox" id="premium" name="is_premium_content" value="true" @checked(old('is_premium_content', $article)) />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Is premium content') }}</span>
                </label>
                <x-input-error :messages="$errors->get('is_premium_content')" class="mt-2" />
            </div>

            <!-- Sponsored -->
            <div>
                <label for="sponsored" class="items-center">
                    <input type="checkbox" id="sponsored" name="is_sponsored_content" value="true" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Sponsor this content') }}</span>
                    @if ($article->sponsored_untill?->isFuture())
                    <small class="text-sm text-yellow-600"> &middot; {{ __(' this article is already sponsored') }}</small>
                    @endif
                </label>
            </div>

            <!-- Content -->
            <div class="mt-4">
                <x-input-label for="content" :value="__('Content')" />
                <x-textarea id="content" class="block mt-1 w-full h-40" name="content" placeholder="{{ __('Your article content') }}" required>{{ old('content', $article) }}</x-textarea>
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