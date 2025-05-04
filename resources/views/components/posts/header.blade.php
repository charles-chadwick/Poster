@php
    $date_human = \Carbon\Carbon::parse($date)->diffForHumans();
@endphp
<div class="header">
    <h3 class="font-bold">{{ $user->full_name }}</h3>
    <a href="{{ $href }}"> {{ $action ?? "Posted" }}
        <time
                datetime="{{ $date }}"
                title="{{ $date }}"
        >{{ $date_human }}</time>
    </a>
</div>