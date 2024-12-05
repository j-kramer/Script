<section class="mt-6 bg-white shadow-sm rounded-lg divide-y" id="comments">
    @foreach ($comments as $comment)
    <article x-data="{ open: @bool($errors->hasBag('update') && old('editId') == $comment->id) }" class="p-3 flex flex-row space-x-2" id="{{$comment->id}}">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
        </svg>
        <div class="flex-1">
            <div>
                @auth
                <a href="{{ route('conversations.show', $comment->user) }}">
                    <span class="text-gray-800">{{ $comment->user->name }}</span>
                </a>
                @else
                <span class="text-gray-800">{{ $comment->user->name }}</span>
                @endauth
                <small class="ml-2 text-sm text-gray-600">{{ $comment->created_at->format('j M Y, g:i a') }}</small>
                @unless ($comment->created_at->eq($comment->updated_at))
                <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                @endunless
            </div>
            <p :class="{'block': ! open, 'hidden': open}" class="mt-2 text-lg text-gray-900">{{ $comment->comment }}</p>
            @can('update', $comment)
            <form method="POST" action="{{ route('comments.update', $comment) }}" :class="{'block': open, 'hidden': ! open}">
                @csrf
                @method('patch')

                <input type="hidden" value="{{$comment->id}}"" name=" editId" />

                <!-- Comment -->
                <div class="mt-4">
                    <x-input-label for="comment" :value="__('Comment')" />
                    <x-textarea id="comment" class="block mt-1 w-full h-40" name="comment" placeholder="{{ __('What\'s on your mind?') }}" required>{{ old('comment', $comment) }}</x-textarea>
                    <x-input-error :messages="$errors->update->get('comment')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button @click="open = ! open">Cancel</button>
                    <x-primary-button class="ms-4">
                        {{ __('Save') }}
                    </x-primary-button>
                </div>
            </form>
            @endcan

        </div>
        @canany(['update', 'delete'], $comment)
        <div class="inline-flex items-center">
            @can('update', $comment)
            <button @click="open = ! open"><x-edit-icon /></button>
            @endcan
            @can('delete', $comment)
            <button
                x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'confirm-comment-deletion-{{ $loop->index }}')">
                <x-delete-icon />
            </button>

            <x-modal name="confirm-comment-deletion-{{ $loop->index }}">
                <form method="post" action="{{ route('comments.destroy', $comment) }}" class="p-6">
                    @csrf
                    @method('delete')

                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Are you sure you want to delete your comment?') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        {{ __('Once the article is deleted, all of its resources and data will be permanently deleted.') }}
                    </p>

                    <div class="mt-6 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            {{ __('Cancel') }}
                        </x-secondary-button>

                        <x-danger-button class="ms-3">
                            {{ __('Delete Comment') }}
                        </x-danger-button>
                    </div>
                </form>
            </x-modal>
            @endcan
        </div>
        @endcanany
    </article>
    @endforeach
</section>