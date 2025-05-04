@extends("app", ["title" => "Posts!"])
@section("content")
    <nav class="px-8 md:flex md:items-center md:justify-between">
        <div class="min-w-0 flex-1">
            <h2 class="text-2xl/7 font-bold">
                Posts
            </h2>
        </div>
        <div class="mt-4 flex md:ml-4 md:mt-0">
            <a
                    href="{{ route('posts.create') }}"
            >Create Post
            </a>
        </div>
    </nav>

    <section class="p-4">
        <div class="post">
            <x-posts.header
                    :user="$post->user"
                    :href="route('posts.show', $post)"
                    :date="$post->created_at"
            />
            <x-posts.content>{{ $post->content }}</x-posts.content>
            <x-posts.footer
                    href="#comments"
                    :comments="$post->comments"
                    :reactions="$post->reactions"
            />
        </div>
    </section>

    <section class="p-4">
        <h3>Comments:</h3>
        <ul class="divide-y divide-stone-200" id="comments">
            @forelse($comments as $comment)
                <li>
                    <div class="comment">
                        <x-posts.header
                                :user="$comment->user"
                                :href="route('posts.show', $post)"
                                :date="$comment->created_at"
                        />
                        <x-posts.content>{{ $comment->content }}</x-posts.content>
                        <x-posts.footer
                                :href="route('comments.create', $post)"
                                :reactions="$comment->reactions"
                        />
                    </div>
                </li>
            @empty
            @endforelse
        </ul>
    </section>
@endsection