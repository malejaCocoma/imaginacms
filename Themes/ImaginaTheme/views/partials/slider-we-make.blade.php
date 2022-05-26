<div class="section-slider-home">
    <div class="container">
        <div class="row justify-content-end ">
            <div class="col-12  my-5">
                <x-slider::slider.owl
                        id="sliderhome"
                        height="425px"
                        :margin="0"
                        layout="slider-owl-layout-4"
                        :orderClasses="['photo' => 'order-1', 'content' => 'order-0']"
                        :nav="true"/>
            </div>
        </div>
    </div>
</div>
