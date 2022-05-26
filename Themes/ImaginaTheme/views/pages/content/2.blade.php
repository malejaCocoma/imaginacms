<div class="page-content page-{{$page->id}}" data-icontenttype="page" data-icontentid="{{$page->id}}">
    @include('partials.main-breadcrumb')
    <div class="container my-5 content-page">
        <h3 class="title-page py-2">{{$page->title}}</h3>
        <div class="col-12 my-4">
            @if (!empty($page->files[0]->path))
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="bg-img">
                            <x-media::single-image :isMedia="true" :mediaFiles="$page->mediaFiles()"/>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="col-12">
            {!!$page->body!!}
        </div>
    </div>
</div>
