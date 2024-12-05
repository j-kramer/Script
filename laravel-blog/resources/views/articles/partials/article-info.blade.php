@if($article->user->id != Auth::id())
@auth
<a href="{{ route('conversations.show', $article->user) }}">
    <small class="mr-2">By {{ $article->user->name }}</small>
</a>
@else
<small class="mr-2">By {{ $article->user->name }}</small>
@endauth
@endif
<small class="text-sm text-gray-600">{{ $article->created_at->format('j M Y, g:i a') }}</small>
@unless ($article->created_at->eq($article->updated_at))
<small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
@endunless
@if ($article->sponsored_untill?->isFuture())
<small class="text-sm text-yellow-600"> &middot; {{ __('sponsored') }}</small>
@endif
@if ($article->is_premium_content)
<small class="text-sm text-red-600"> &middot; {{ __('premium') }}</small>
@endif
<br />
@if ($article->categories->isNotEmpty())
<small>
    Categories: @foreach ($article->categories as $category)
    <a href="{{ route('categories.show', $category) }}">{{ $category->name }}</a>
    @endforeach
</small>
<br />
@endif
@isset($comments)
<small class="text-sm text-gray-600"> {{ $comments->count() }} Comments</small>
@else
<small class="text-sm text-gray-600"> {{ $article->comments_count }} Comments</small>
@endisset