@foreach($posts as $post)
    <section class="post-preview card shadow" onclick='location.href="post/{{ $post->post_id }}"'>
        <div class="post-preview-header mb=1em">
            <div class="font-header post-preview-title">
                <h2>{{ $post->post_title }}</h2>
            </div>
            <small class="font-description description mt=0.7em">
                {{ $post->created_at }}
            </small>
        </div>
        
        <div class="post-preview-body">
            {{ $post->post_description }}
        </div>
    </section>
@endforeach