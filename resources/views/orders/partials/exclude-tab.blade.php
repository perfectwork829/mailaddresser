<div class="upload_wrapper">
    <div class="form-group">
        <div class="col-md-12 upload-btn-wrapper">
            <a href="javascript:;" class="btn btn-lg sale-primary-color btn-upl">
                <i class="fa fa-cloud-download"></i> @lang('Exclude phone/mobile phone numbers from file')
            </a> 
            <input type="file" class="excludes" name="filters[exclude]" />       
        </div>
    </div>															
    <div class="form-group">
        <div class="col-md-12">
            <a href="excludes-example.csv" download="excludes-example.csv" class="btn btn-lg sale-primary-color">
                <i class="fa fa-cloud-download"></i> @lang('Download an example file')
            </a>
        </div>
    </div>
</div>

@if($order->exclude)
    <div class="note note-info">                        
        <h4>{{ __('Exclude :number phone numbers', ['number' => count($order->exclude)]) }}</h4>
    </div>
@endif

