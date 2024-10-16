<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('articles.update', $article) }}" enctype="multipart/form-data">
            @csrf
            @method('patch')

            <!-- Title -->
            <div>
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" placeholder="{{ __('Your article title') }}" :value="old('title', $article->title)" required autofocus />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <!-- Categories -->
            <div>
                <x-input-label for="category" :value="__('Categories')" />
                <select name="categories[]" id="category" multiple>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $article->categories->contains($category) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('categories')" class="mt-2" />
            </div>

            <!-- Image -->
            <div>
                <x-input-label for="image" :value="__('Image')" />
                @isset($article->image_path)
                <img src="{{ asset($article->image_path) }}" alt="{{ $article->title }}">
                @endisset
                <x-text-input id="image" class="block mt-1 w-full" type="file" accept=".jpeg,.png,.jpg,.svg" name="image" placeholder="{{ __('Your article image') }}" autofocus />
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
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