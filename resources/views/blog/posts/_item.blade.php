<div class="col-md-4">
    <div class="card post_item">
        <div class="card-body">

            <div class="card-img">
                <a href="{{ route('locale.blog.posts.show',['slug'=>$item->slug,'locale'=>$locale]) }}" title="@lang('messages.show') {{ $item->title }}">
                    <img src="{{$item->thumb}}"/>
                </a>
            </div>
            <div class="post_title">
                    <h6>{{ $item->title }}</h6>
            </div>

            <div class="post_categories">
                    @foreach ($item->categories as $category)
                        <a href="{{ route('locale.blog.categories.show',['slug'=>$category->slug,'locale'=>$locale]) }}" title="@lang('messages.show') {{ $category->category->title }}">
                            <span class="badge badge-info">{{ $category->category->title }}</span>
                        </a>
                    @endforeach
            </div>
            <div class="post_attr">
                <span class="post_author_img">
                    <a href="{{ route('locale.blog.posts.author',['author_id'=>$item->author->id,'locale'=>$locale]) }}" title="@lang('messages.show') {{ $item->author->name }}">
                       <img class="user_avatar" src="{{$item->author->avatar}}" title="{{ $item->author->name }}">
                    </a>
                </span>
                <span class="post_author_name">
                    <a href="{{ route('locale.blog.posts.author',['author_id'=>$item->author->id,'locale'=>$locale]) }}" title="@lang('messages.show') {{ $item->author->name }}">
                       {{ $item->author->name }}
                    </a>
                </span>
                <span class="post_date" >
                 <a href="{{ route('locale.blog.posts.date',['date'=> Carbon\Carbon::parse( $item->updated_at)->format('d-m-Y'),'locale'=>$locale]) }}" title="@lang('messages.show')">
                    {{ Carbon\Carbon::parse( $item->updated_at)->format('d-m-Y') }}
                    </a>
                </span>
                @if($auth)
                    <span class="post_edit" >
                        <a href="{{ route('locale.moderate.blog.posts.edit',['id'=>$item->id,'locale'=>$locale]) }}" title="@lang('messages.update') {{ $item->title }}">
                            <span class="oi oi-pencil"></span>
                        </a>
                    </span>
                @endif
            </div>
        </div>
    </div>
</div>

