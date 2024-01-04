<div class="upload_wrapper">

    <div class="upload-btn-wrapper">
        <button class="btn-upl ">@lang('Exclude phone/mobile phone numbers from file')</button>
        <input type="file" class="excludes" name="filters[exclude]" />
    </div>

    <div class="upload-btn-wrapper">
        <a href="/storage/excludes-example.csv" download="excludes-example.csv" class="btn-upl">@lang('Download an example file')</a>
    </div>
{{--    <div class="upload-btn-wrapper">--}}
{{--        <button class="btn-upl ">@lang('Exclude social security numbers from file')</button>--}}
{{--        <input type="file" name="myfile" />--}}
{{--    </div>--}}

</div>

@if($order->exclude)
    <div class="tab_list_wrapper">
        <ul class="tab_list">
            <li class="tab_list_item">
                <input class="styled-checkbox filters" type="checkbox" name="filters[excluding]" value="1" checked>
                <label for="styled-checkbox" class="category_sub_title">
                    <span> <i class="fas fa-angle-down"></i>{{ __('Exclude :number phone numbers', ['number' => count($order->exclude)]) }}</span>
                </label>
            </li>
        </ul>
    </div>
@endif
