<div class="contact-page page-{{$page->id}}" data-icontenttype="page" data-icontentid="{{$page->id}}">
    <div class="container my-4">
        <div class="row">
            <div class="cil-12 col-md-6">
                <h3 class="title-page py-2"> {!!$page->body!!}</h3>
                <x-iforms::form id="2"/>
            </div>
            <div class="col-12 col-md-6 d-flex justify-content-center align-items-center">
                @if (!empty($page->files[0]->path))
                    <div class="bg-img">
                        <x-media::single-image :isMedia="true" :mediaFiles="$page->mediaFiles()"/>
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>
