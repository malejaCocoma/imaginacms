<div class="form-group">
    <label for="target">{{ trans('ibanners::banners.form.target') }}</label>
    <select class="form-control" name="target" id="target">
        <option value="_self">{{ trans('ibanners::banners.form.same tab') }}</option>
        <option value="_blank">{{ trans('ibanners::banners.form.new tab') }}</option>
    </select>
</div>

@mediaSingle('bannerImage')

<div class="form-group{{ $errors->has("external_image_url") ? ' has-error' : '' }}">
    {!! Form::label("external_image_url", trans('ibanners::position.form.external image url')) !!}
    {!! Form::text("external_image_url", old("external_image_url"), ['class' => 'form-control', 'placeholder' => trans('ibanners::position.form.placeholder.external image url')]) !!}
    {!! $errors->first("external_image_url", '<span class="help-block">:message</span>') !!}
</div>