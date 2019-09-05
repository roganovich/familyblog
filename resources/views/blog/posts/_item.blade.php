<div class="col-md-4">
    <div class="card post_item">
        <div class="card-body">
            <div>
                 <a href="{{ route('locale.blog.posts.show',['slug'=>$item->slug,'locale'=>$locale]) }}" title="@lang('messages.show')">
                    <h2>{{ $item->title }}</h2>
                 </a>
            </div>
            <div class="post_html">
                {!! $item->intro_html !!}
            </div>
            <div class="post_categories">
                    @foreach ($item->categories as $category)
                        <a href="{{ route('locale.blog.categories.show',['slug'=>$category->category->slug,'locale'=>$locale]) }}" title="@lang('messages.show')">
                            <span class="badge badge-info">{{ $category->category->title }}</span>
                        </a>
                    @endforeach
            </div>
            <div class="post_attr">
                <span class="post_author">
                        <a href="{{ route('locale.blog.posts.author',['author_id'=>$item->author->id,'locale'=>$locale]) }}" title="@lang('messages.show')">
                            {{ $item->author->name }}
                        </a>
                </span>
                <span class="post_date" >
                     <a href="{{ route('locale.blog.posts.date',['date'=> Carbon\Carbon::parse( $item->updated_at)->format('d-m-Y'),'locale'=>$locale]) }}" title="@lang('messages.show')">
                        {{ Carbon\Carbon::parse( $item->updated_at)->format('d-m-Y') }}
                    </a>
                </span>
            </div>
        </div>
    </div>
</div>