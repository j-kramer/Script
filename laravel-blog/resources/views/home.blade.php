<x-app-layout>
    <div class="max-w-2xl mx-auto p-0 sm:p-6 lg:p-8">
        <form method="GET">
            <!-- Searchbar -->
            <div>
                <x-text-input id="search" class="block mt-1 w-full" type="text" name="search" placeholder="Search title..." :value="old('search')" autofocus />
                <x-input-error :messages="$errors->get('search')" class="mt-2" />
            </div>

            <div class="flex justify-between items-center mt-4">
                <x-input-label for="category" :value="__('Category:')" />
                <select name="category" id="category" onchange="this.form.submit();">
                    <option value="">All</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category') == $category->id)>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
                <label for="premium" class="inline-flex items-center">
                    <input type="checkbox" id="premium" name="onlyPremium" value="true" @checked(old('onlyPremium')) onchange="this.form.submit();"/>
                    <span class="ms-2 text-sm text-gray-600">{{ __('Only premium content') }}</span>
                </label>
                <label for="sponsored" class="inline-flex items-center">
                    <input type="checkbox" id="sponsored" name="ignoreSponsored" value="true" @checked(old('ignoreSponsored')) onchange="this.form.submit();"/>
                    <span class="ms-2 text-sm text-gray-600">{{ __('Ignore sponsor status') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a href="{{ route('home') }}">{{ __('Clear') }}</a>
                <x-primary-button class="ms-4">
                    {{ __('Filter') }}
                </x-primary-button>
            </div>
        </form>
        <x-article-list :$articles />
    </div>
    <footer class="py-16 text-center text-sm text-black">
        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
    </footer>
</x-app-layout>