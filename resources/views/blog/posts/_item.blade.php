<div class="col-md-4 post_item">
    <div class="card post_body">
        <div class="card-body">
            <div class="card-img post-img">
                <a href="{{ route('locale.blog.posts.show',['slug'=>$item->slug,'locale'=>$locale]) }}" title="@lang('messages.show') {{ $item->title }}">
                    <img src="{{ route('locale.images.thumb',['locale'=>$locale, 'img'=>$item->thumb['id'],'width'=>300,'height'=>200]) }}" title="{{ $item->title }}" alt="{{ $item->title }}" class="img-fluid"/>
                </a>
            </div>
            <div class="post_title">
                    <h6>{{ $item->title }}</h6>
            </div>

            <div class="post_categories">
                    @foreach ($item->categories as $category)
                        <a href="{{ route('locale.blog.categories.show',['slug'=>$category->category->slug,'locale'=>$locale]) }}" title="@lang('messages.show') {{ $category->category->title }}">
                            <span class="badge badge-info">{{ $category->category->title }}</span>
                        </a>
                    @endforeach
            </div>
            <div class="post_attr">
                    <a class="post_avatar_link" href="{{ route('locale.blog.posts.author',['author_id'=>$item->author->id,'locale'=>$locale]) }}" title="@lang('messages.show') {{ $item->author->name }}">
                        <div class="post_author_img" style="background-image: url('{{$item->author->avatar}}')"> </div>
                    </a>
                <div class="post_author_name">
                    <a href="{{ route('locale.blog.posts.author',['author_id'=>$item->author->id,'locale'=>$locale]) }}" title="@lang('messages.show') {{ $item->author->name }}">
                       {{ $item->author->name }}
                    </a>
                </div>
                <div class="post_date" >
                    <a href="{{ route('locale.blog.posts.date',['date'=> Carbon\Carbon::parse( $item->updated_at)->format('d-m-Y'),'locale'=>$locale]) }}" title="@lang('messages.show') {{ Carbon\Carbon::parse( $item->updated_at)->format('d-m-Y') }}">
                        {{ Carbon\Carbon::parse( $item->updated_at)->format('d-m-Y') }}
                    </a>
                </div>
                @if($auth)
                    <div class="post_edit">
                        <a href="{{ route('locale.moderate.blog.posts.edit',['id'=>$item->id,'locale'=>$locale]) }}" title="@lang('messages.update') {{ $item->title }}">
                            <span class="oi oi-pencil"></span>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

