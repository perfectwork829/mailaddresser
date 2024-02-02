<div class="form-group last">    
    <div class="col-md-2"><label class="control-label col-md-1 para-color text-left">@lang('From'):</label></div>
    <div class="col-md-6">      
        <div id="spinner4">
            <div class="input-group">
                <div class="spinner-buttons input-group-btn">
                    <button type="button" class="btn spinner-up blue filters">
                    <i class="fa fa-plus"></i>
                    </button>
                </div>                
                <input type="number" class="spinner-input form-control input-md form-control filters" name="filters[age][from]" id="age_from" value="{{ $order->age? $order->age['from']:'' }}"/>
                <div class="spinner-buttons input-group-btn filters">
                    <button type="button" class="btn spinner-down red filters">
                    <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
        </div>        
    </div>    
</div>
<div class="form-group last">    
    <div class="col-md-2"><label class="control-label col-md-1 para-color text-left">@lang('To'):</label></div>
    <div class="col-md-6">
        <div id="spinner3">
            <div class="input-group">
                <div class="spinner-buttons input-group-btn">
                    <button type="button" class="btn spinner-up blue filters">
                    <i class="fa fa-plus"></i>
                    </button>
                </div>                
                <input type="number" class="form-control spinner-input form-control input-md filters" name="filters[age][to]" id="age_to" value="{{ $order->age? $order->age['to']: '' }}"/>
                <div class="spinner-buttons input-group-btn">
                    <button type="button" class="btn spinner-down red filters">
                    <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
        </div>       
    </div>    
</div>
<div class="note note-info age_validation">      
</div>