<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('premium.update') }}">
            @csrf
            @method('patch')

            <!-- Premium -->
            <div class="block mt-4">
                <label for="premium" class="inline-flex items-center">
                    <input type="checkbox" id="premium" name="has_premium" value="true" @checked(old('has_premium', $user)) />
                    <span class="ms-2 text-sm text-gray-600">{{ __('I want premium content') }}</span>
                </label>
                <x-input-error :messages="$errors->get('has_premium')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a href="{{ route('home') }}">{{ __('Cancel') }}</a>
                <x-primary-button class="ms-4">
                    {{ __('Save') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>