<form method="POST" action="{{ route('categories.store') }}">
    @csrf

    <x-input-label for="name" :value="__('Add a new Category')" />
    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" placeholder="{{ __('Your new category') }}" :value="old('name')" required autofocus />
    <x-input-error :messages="$errors->get('category')" class="mt-2" />
    <x-primary-button class="mt-4">{{ __('Add') }}</x-primary-button>
</form>