<div class="modal-body">
  @if(count($position->banners)>2)
    @include('ibanners::frontend.banners.banner_ads')
  @else
    <div class="row">
      <div class="col-xs-12">
        @if( $banner->code_ads)
          {!! $banner->code_ads !!}
        @else
          {!! $banner->custom_html??''!!}
          <a href="{{$banner->url}}" target="_blank">
            @if(strpos($banner->getImageUrl(),'youtube.com'))
              <iframe width="100%" height="250" src="{{$banner->getImageUrl()}}?autoplay=1&mute=1" frameborder='0'
                      allowfullscreen></iframe>
            @elseif(strpos($banner->getImageUrl(),'.mp4'))
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
              @if($banner->getImageUrl())
                <img src="{{$banner->getImageUrl()}}" alt="{{ $banner->title }}"
                     class="img-responsive center-block">
              @endif
            @endif
          </a>
        @endif
      </div>
    </div>
  @endif
</div>

