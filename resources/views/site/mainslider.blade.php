<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
   <ol class="carousel-indicators">
      @foreach ($items as $key=>$item)
         @if($key < SettingsHelper::getParram('SLIDER_COUNT'))
               <li class=" {{ ($key == 0 ? 'active' : '') }}" data-target="#carouselExampleIndicators" data-slide-to="{{$key}}"></li>
         @endif
      @endforeach
   </ol>
   <div class="carousel-inner">
      @foreach ($items as $key=>$item)
         @if($key < SettingsHelper::getParram('SLIDER_COUNT') )
               <div class="carousel-item {{ ($key == 0 ? 'active' : '') }}">
               <img class="d-block w-100" src="{{ route('locale.images.thumb',['locale'=>$locale, 'img'=>$item->thumb['id'],'width'=>1920,'height'=>600]) }}" title="{{ $item->title }}" alt="{{ $item->title }}"/>
               <div class="carousel-caption d-none d-md-block">
                  <div class="sliderBlock">

                        <a href="{{ route('locale.blog.posts.show',['slug'=>$item->slug,'locale'=>$locale]) }}" title="@lang('messages.show') {{ $item->title }}">
                           <h3 class="slidelink">
                           {{ $item->title }}
                           </h3>
                        </a>

                  </div>

                     <a class="slidelink" href="{{ route('locale.blog.posts.author',['author_id'=>$item->author->id,'locale'=>$locale]) }}" title="@lang('messages.show') {{ $item->author->name }}">
                        <b>{{ $item->author->name }}</b>
                     </a>

               </div>
            </div>
         @endif
      @endforeach
   </div>
   <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Назад</span>
   </a>
   <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Вперед</span>
   </a>
</div>

@push('scripts')
   <script src="{{asset('js/script.js')}}"></script>
@endpush

<style>
   .slidelink{
      background-color: white;
      padding: 2px 5px;
      width: max-content;
      border-radius: 10px;

       display: inline-block;
   }
   .sliderBlock{
      width: 100%;
   }


</style>

