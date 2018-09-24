@if (count($replies))

<ul class="list-group">
    @foreach ($replies as $reply)
        <li class="list-group-item">
            <a href="{{ route('topics.show', $reply->topic) }}">
                {{ $reply->topic->title }}
            </a>

            <div class="reply-content" style="margin: 6px 0;">
                {!! $reply->content !!}
            </div>

            <div class="meta">
                <span class="glyphicon glyphicon-time" aria-hidden="true"></span> replied at {{ $reply->created_at->diffForHumans() }}
            </div>
        </li>
    @endforeach
</ul>

@else
   <div class="empty-block">No Data ~_~ </div>
@endif

{{-- 分页 --}}
{!! $replies->appends(Request::except('page'))->render() !!}