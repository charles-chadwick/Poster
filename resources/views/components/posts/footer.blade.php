@props([
	"reactions",
	"comments" => null,
	"href" => null
])
<div class="footer">
    @if($comments !== null)
        <a href="{{ $href }}">{{ $comments->count() }} Comments</a> |
    @endif
    {{ $reactions->count() }} Reactions
</div>