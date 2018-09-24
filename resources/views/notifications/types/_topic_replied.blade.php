<div class="media">
        <div class="avatar pull-left">
            <a href="{{ route('users.show', $notification->data['user_id']) }}">
            <img class="media-object img-thumbnail" alt="{{ $notification->data['user_name'] }}" src="{{ $notification->data['user_avatar'] }}"  style="width:48px;height:48px;"/>
            </a>
        </div>
    
        <div class="infos">
            <div class="media-heading">
                <a href="{{ route('users.show', $notification->data['user_id']) }}">{{ $notification->data['user_name'] }}</a>
                make comment to
                <a href="{{ $notification->data['topic_link'] }}">{{ $notification->data['topic_title'] }}</a>
    
                {{-- 回复删除按钮 --}}
                
            </div>
            <div class="reply-content">
                {!! $notification->data['reply_content'] !!}
            </div>
        </div>
    </div>
    <hr>