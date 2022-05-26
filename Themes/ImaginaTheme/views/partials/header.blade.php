<header id="headerContent" class="sticky-top bg-white">
    <div class="container-fluid py-1 px-lg-5">
        <div class="row align-items-center justify-content-center">
            <div id="logo-header" class="col-8 col-md-4 col-lg-2">
                <x-isite::logo name="logo1" imgClasses="header-logo-1"/>
            </div>
            <div class="col-3 col-md-4 col-lg-8 d-flex justify-content-start justify-content-md-center justify-content-lg-end order-1 order-md-2 order-lg-1">
                @include('partials.navigation')
            </div>
            <div class="col-9 col-md-4 col-lg-2 d-flex justify-content-around justify-content-lg-start align-items-center order-2 order-md-1 order-lg-2">
                <div id="search-header" class="mr-lg-4 order-1 order-lg-0 mx-1">@livewire('isearch::search', [
                    "layout" => "search-layout-1"
                    ])
                </div>
                <x-isite::button buttonClasses="btn-donation rounded-pill"
                                 href="" label="DONA AQUÍ" sizeLabel="16"
                                 withLabel="true"/>
            </div>
        </div>
    </div>
</header>
