<div id="{{$position->system_name}}" class="carousel slide" data-ride="carousel" >
    {{--@include('position.main.indicators', ['position' => $position])--}}
    <div class="carousel-inner">
        @include('ibanners::frontend.banners.banner', ['position' => $position])
    </div>
    @include('ibanners::frontend.banners.controls', ['slider' => $position])
</div>