<div class="breadcrumb-section border-bottom border-top" id="main-breadcrumb">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 rounded-0">
                <li class="breadcrumb-item">
                    <a class="text-primary" href="{{url('/')}}">Inicio</a>
                </li>
                @if(isset($page))
                    <li class="breadcrumb-item active text-gray-color arrow-right" aria-current="page">
                        {{$page->title}}
                    </li>
                @elseif(isset($post))
                    <li class="breadcrumb-item active text-gray-color arrow-right" aria-current="page">
                        {{$category->title}}
                    </li>
                    <li class="breadcrumb-item active text-gray-color arrow-right" aria-current="page">
                        {{$post->title}}
                    </li>
                @endif
            </ol>
        </nav>
    </div>
</div>