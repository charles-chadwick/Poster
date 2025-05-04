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
            </a> }}
        </div>
    </nav>

    <section class="p-4">
        <ul class="divide-y divide-stone-200">
            @forelse($posts as $post)
                <li>
                    <div class="post">
                        <x-posts.header
                                :user="$post->user"
                        />
                        <x-posts.details
                                :href="route('posts.show', $post)"
                                :date="$post->created_at"
                        />
                        <x-posts.content>{{ $post->content }}</x-posts.content>
                        <x-posts.footer
                                :href="route('posts.show', $post)"
                                :reactions="$post->reactions"
                                :comments="$post->comments"
                        />
                    </div>
                </li>
            @empty
            @endforelse
        </ul>
    </section>
@endsection