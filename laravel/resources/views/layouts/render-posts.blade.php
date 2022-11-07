@foreach($posts as $post)
    <section class="max-w-[35em] mb-5 card shadow hover:-translate-y-[.1em] transition-all" onclick='location.href="post/{{ $post->post_id }}"'>
        <div class="mb-4">
            <div class="font-header post-preview-title">
                <h2 class="font-semibold text-2xl flex items-center">{{ $post->post_title }}</h2>
            </div>
            <p class="text-sm pl-1 border-l border-gray-400">
                {{ $post->created_at }}
            </p>
        </div>
        
        <p class="text-sm">
            {{ $post->post_description }}
        </p>
    </section>
@endforeach