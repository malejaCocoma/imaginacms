<div class='form-group{{ $errors->has("{$lang}[title]") ? ' has-error' : '' }}'>
    {!! Form::label("{$lang}[title]", trans('ibanners::position.form.title')) !!}
    {!! Form::text("{$lang}[title]", old("{$lang}[title]"), ['class' => 'form-control', 'placeholder' => trans('ibanners::position.form.title'), 'autofocus']) !!}
    {!! $errors->first("{$lang}[title]", '<span class="help-block">:message</span>') !!}
</div>
<div class='form-group{{ $errors->has("{$lang}[code_ads]") ? ' has-error' : '' }}'>
    {!! Form::label("{$lang}[code_ads]", trans('ibanners::position.form.code_ads')) !!}
    {!! Form::textarea("{$lang}[code_ads]", old("{$lang}[code_ads]"), [ 'rows' => 3,'class' => 'form-control', 'placeholder' => trans('ibanners::position.form.code_ads'), 'autofocus']) !!}
    {!! $errors->first("{$lang}[code_ads]", '<span class="help-block">:message</span>') !!}
</div>
<div class="form-group">
    {!! Form::label("{$lang}[uri]", trans('ibanners::position.form.uri')) !!}
    <div class='input-group{{ $errors->has("{$lang}[uri]") ? ' has-error' : '' }}'>
        <span class="input-group-addon">/{{ $lang }}/</span>
        {!! Form::text("{$lang}[uri]", old("{$lang}[uri]"), ['class' => 'form-control', 'placeholder' => trans('ibanners::position.form.uri')]) !!}
        {!! $errors->first("{$lang}[uri]", '<span class="help-block">:message</span>') !!}
    </div>
</div>
<div class="form-group{{ $errors->has("{$lang}[url]") ? ' has-error' : '' }}">
    {!! Form::label("{$lang}[url]", trans('ibanners::position.form.url')) !!}
    {!! Form::text("{$lang}[url]", old("{$lang}[url]"), ['class' => 'form-control', 'placeholder' => trans('ibanners::position.form.url')]) !!}
    {!! $errors->first("{$lang}[url]", '<span class="help-block">:message</span>') !!}
</div>

<div class="checkbox">
    <label for="{{$lang}}[active]">
        <input id="{{$lang}}[active]"
                name="{{$lang}}[active]"
                type="checkbox"
                class="flat-blue"
                value="1" />
        {{ trans('ibanners::position.form.active') }}
    </label>
</div>

<div class="form-group{{ $errors->has("{$lang}[custom_html]") ? ' has-error' : '' }}">
    {!! Form::label("{$lang}[custom_html]", trans('ibanners::banners.form.custom html')) !!}
    {!! Form::textarea("{$lang}[custom_html]", old("{$lang}[custom_html]"), ['class' => 'form-control ckeditor', 'placeholder' => trans('ibanners::banners.form.custom html')]) !!}
    {!! $errors->first("{$lang}[custom_html]", '<span class="help-block">:message</span>') !!}
</div>
