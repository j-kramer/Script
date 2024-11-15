<x-app-layout>
    <div class="max-w-2xl mx-auto p-0 sm:p-6 lg:p-8">
        <form method="GET">
            <div class="flex justify-between items-center">
                <x-input-label for="category" :value="__('Category:')" />
                <select name="category" id="category" onchange="this.form.submit();">
                    <option value="">All</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category') == $category->id)>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
            </div>
        </form>
        <x-article-list :$articles />
    </div>
    <footer class="py-16 text-center text-sm text-black">
        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
    </footer>
</x-app-layout>