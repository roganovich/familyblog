<div class="col-md-4 post_item">
    <div class="card">
        <div class="card-body">
            <div class="card-img">
                <a href="{{ route('locale.blog.categories.show',['slug'=>$item->slug,'locale'=>$locale]) }}" title="@lang('messages.show') {{ $item->title }}">
                    <img src="{{ route('locale.images.thumb',['locale'=>$locale, 'img'=>$item->thumb['id'],'width'=>300,'height'=>200]) }}" title="{{ $item->title }}" alt="{{ $item->title }}" class="img-fluid"/>
                </a>
            </div>
            <div>
                <a href="{{ route('locale.blog.categories.show',['slug'=>$item->slug,'locale'=>$locale]) }}" title="@lang('messages.show')">
                    <span>{{ $item->title }}</span>
                </a>
            </div>

            <div>
                <span>{{ $item->author_id }}</span>
            </div>
            <div>
                <span>{{ $item->updated_at }}</span>
            </div>
            @if($auth)
                <div class="post_edit">
                    <a href="{{ route('locale.moderate.blog.categories.edit',['id'=>$item->id,'locale'=>$locale]) }}" title="@lang('messages.update') {{ $item->title }}">
                        <span class="oi oi-pencil"></span>
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

