<div class="form-group clearfix sex-option">																																
    <div class="col-md-8">        
        <div class="btn-group btn-group-justified" data-toggle="buttons">
            <label class="btn blue active">                
                <input type="radio" name="filters[gender]" id="man" class="hidden filters" value="M" {{ $order->gender == 'M' ? 'checked' : '' }}/>
                <i class="fa fa-male mr-1" aria-hidden="true"></i> @lang('Man') 
            </label>
            <label class="btn blue">                
                <input type="radio" name="filters[gender]" id="woman" class="hidden filters" value="K" {{ $order->gender == 'K' ? 'checked' : '' }}/>
                <i class="fa fa-female mr-1" aria-hidden="true"></i> @lang('Woman') 
            </label>
            <label class="btn blue">                
                <input type="radio" name="filters[gender]" id="both" class="hidden filters" value="0" {{ $order->gender == '0' ? 'checked' : '' }}/>
                <i class="fa fa-users mr-1"></i> @lang('Both') 
            </label>
        </div>
    </div>    
</div>