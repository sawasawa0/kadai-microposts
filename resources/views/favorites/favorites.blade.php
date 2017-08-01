<ul class="media-list">
    @foreach ($favorites as $favorite)
    <?php $user = $favorite->user; ?>
        <li class="media">
                <div class="media-left">
                    <img class="media-object img-rounded" src="{{ Gravatar::src($user->email, 50) }}" alt="">
                </div>
            <div class="media-body">
                <div>
                    {!! link_to_route('users.show', $user->name, ['id' => $user->id]) !!} <span class="text-muted">posted at {{ $favorite->created_at }}</span>
                </div>
                <div>
                    <p>{!! ($favorite->content) !!}</p>
                </div>
              
            </div>
        </li>
    @endforeach
</ul>