@foreach($position->banners as $index => $banner)
  @if($banner->active)
    <div class="carousel-item {{$index==0?'active':''}}">
      @if(isset($banner->code_ads)&& !empty($banner->code_ads))
        <div class="ibanner-code">
          {!! $banner->code_ads !!}
        </div>
      @else
        <a href="{{$banner->url}}" target="_blank">
          @if(strpos($banner->getImageUrl(),'youtube.com'))
            <iframe width="100%" height="450" src="{{$banner->getImageUrl()}}?autoplay=1&mute=1" frameborder='0'
                    allowfullscreen></iframe>
          @elseif(strpos($banner->getImageUrl(),'.mp4'))
                <?php $rnd = str_random('4'); ?>
            <video muted autoplay loop id="ban_vf_{{$rnd}}_{{$banner->id}}">
              <source src="{{$banner->getImageUrl()}}" type="video/mp4"/>
            </video>

            @push('scripts')

              <script>
                  jQuery(document).ready(function ($) {
                      document.getElementById('ban_vf_{{$rnd}}_{{$banner->id}}').play();
                  });
              </script>

            @endpush
          @else
            <img src="{{$banner->getImageUrl()}}" alt="{{ $banner->title }}"
                 class="img-responsive center-block">
          @endif
        </a>
      @endif
    </div>
  @endif
@endforeach