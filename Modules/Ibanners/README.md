# Ibanners Module

## Special Thanks
to Nicolas Widart for AsgardCMS and his Menu Module, that was used as a foundation for the Banners Ads Module.

## Installation
You can install Banners Ads module using composer:
`composer require imagina/ibanners-module`

After the module is installed, you have to give yourself access in AsgardCMS (using Roles/Permissions). 
New Banners Ads item will appear in the Sidebar

## Usage

### Prerequisites
By default, Ibanners module is created using Bootstrap Carousel http://getbootstrap.com/javascript/#carousel
so make sure you have all prerequisites loaded for standard Bootstrap carousel (Bootstrap Carousel CSS and JS)

### Basic Usage
You can create basic Banners Ads using the AsgardCMS admin interface - you can create and name your slider
(pay attention to the **System Name** field here, it is used later for rendering), and create individual
slides. Slides can be linked to images in the Media module, or have URL pointing to external image.
They can also contain hyperlink to any page on the site, fixed URI or URL.

When the slider is created, you can render it in your template using `{!! BannerAds::render('slider_system_name') !}}`
 
### Advanced Usage

#### Use your own slider template
If you want to change rendering of your slider, use custom HTML, CSS classes, etc, you can pass a Blade template
name as a second parameter to the `render()` method, i.e.
`{!! BannerAds::render('position_system_name', 'position/my-own-banner') !}}`

Template may look like this:
```php
{-- Themes/MyTheme/views/banners/my-own-banner.blade.php --}
<div id="{{ $position->system_name }}" class="my-own-slider-class">

    @foreach($position->sbanner as $index => $banner)
        <div class="banner">
            <a href="{{ $banner->getLinkUrl() }}">
                <img src="{{ $banner->getImageUrl() }}" />
            </a>
        </div>
    @endforeach
    
</div>
```
You will have `Modules\Ibanners\Entities\Position` instance available in the `$position` variable

#### Provide your own Position instance
You can also pass a `Modules\BannerAds\Entities\Position` instance as a first parameter instead of the
slider `system_name` to render dynamically created slider.

First, create instance of your slider and add slides in your controller and pass it to the view
```php
<?php
...
// import classes needed to create your own instance
use Modules\Ibanners\Entities\Position;
use Modules\Ibanners\Entities\Banner;

class HomepageController {
    ...
    /**
     * controller method
     */
    public function displayHomepage()
    {
        // make a new Slider instance
        $bannerAds = new Position;
        $bannerAds->system_name = 'custom_slider';
        
        // create slide 1
        $banner = new Slide;
        $banner->title = 'First Slide';
        $banner->caption = 'First banner text';
        $banner->external_image_url = 'https://placeholdit.imgix.net/~text?txtsize=33&txt=Slide1&w=800&h=300';
        
        // create banner 2
        $banner2 = new Slide;
        $banner2->title = 'Second Slide';
        $banner2->caption = 'Second banner text';
        $banner2->external_image_url = 'https://placeholdit.imgix.net/~text?txtsize=33&txt=Slide2&w=800&h=300';
        
        // add banners to bannerr
        $bannerAds->banners->add($banner);
        $bannerAds->banners->add($banner2);
        
        // render view
        return View::make('homepage')
            ->with('mySlider', $bannerAds);
    }
    
```

then, inside of the `homepage.blade.php` template, you can render bannerr using `{!! BannderAds::render($myBannerAds) !!}`


## Resources

- [License](LICENSE.md)
- [Asgard Documentation](http://asgardcms.com/docs/)