@if(count($position->banners))
    <ol class="carousel-indicators">
        @foreach($position->banners as $index => $banner)
            <li data-target="#{{ $position->system_name }}" data-slide-to="{{$index}}"
                class="@if($index === 0) active @endif"></li>
        @endforeach
    </ol>
@endif