<footer class="section-footer">
    <div class="container-fluid footer-up">
        <div class="container">
         <div class="row py-md-4">
              <div class="col-12 col-md-12 col-lg-5 p-1 d-flex justify-content-center align-items-center">
              <x-isite::logo name="logo1" imgClasses="header-logo-1"/>
              </div>
              <div class="col-12 col-md-6 m-0 col-lg-3">
                <div class="title-slider-donacion text-white mt-lg-0 my-2">
                  {{trans('icustom::common.title-menu-footer')}}
                </div>
              @menu("menu-footer")
              </div>

              <div class="contact col-12 col-md-6 col-lg-4 py-4 py-md-0">
                <div class="title-slider-donacion text-white mt-lg-0 my-2">
                  {{trans('icustom::common.title-second-menu-footer')}}
                </div>
                <x-isite::contact.phones/>
                <x-isite::contact.emails/>
                <x-isite::contact.addresses/>
              </div>
        </div>
        </div>
    </div>
    <div class="footer-down container-fluid py-1">
        <div class="container">
        <div class="row align-items-center text-center text-md-left">
            <div class="col-12 col-md-7">
                <p class="m-0 text-white">Copyright © {{date("Y")}} Todos Los Derechos Reservados</p>
            </div>
            <div class="col-12 col-md-5 text-center text-md-right">
                <x-isite::social/>
            </div>
        </div>
        </div>
    </div>
</footer>
