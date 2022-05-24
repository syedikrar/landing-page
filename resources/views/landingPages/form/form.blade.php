@if($form->sections->count())
<h3 class="form-title">{{$form->title}}</h3>
    <form class="justify-content-center " method="POST" action="{{route('submit_landing_form',$form->id)}}">
        @if($queryParams)
            @foreach($queryParams as $key => $value)
            
                <input type="hidden" name="params[{{$key}}]" value={{$value}}>
            @endforeach
        @endif
        @csrf
        {{-- <input type="hidden" name="click_id" value=""> --}}

        @foreach($form->sections as $section)
            @if(!$section->hide_title)
                <h5 class="my-3">{{$section->title}}</h5>
            @endif
            @foreach($section->fields as $field)
                @if($field->type=="hidden")
                    <input type="hidden" name="{{$field->attribute_name}}" value="{{$field->default_value}}">
                @endif
                @if($field->type=="text")
                    <div class="form-group mr-md-2 mb-3 mb-md-0 mt-2">
                        @if(!$field->hide_label)
                        <label for="{{$field->label}}">{{$field->label}}</label>
                        @endif
                        <input type="text" @if($field->required) required @endif
                         name="{{$field->attribute_name}}" class="form-control"
                          placeholder="{{$field->placeholder}}">
                    </div>
                @endif

                @if($field->type=="select")
                    <div class="form-group mr-md-2 mb-3 mb-md-0 mt-2">
                        @if(!$field->hide_label)
                        <label for="{{$field->label}}">{{$field->label}}</label>
                        @endif
                        <select class="form-select form-control"
                        @if($field->required) required @endif
                         name="{{$field->attribute_name}}">
                            <option selected>{{$field->placeholder}}</option>
                            @foreach($field->options as $option)
                                <option value="{{$option->value}}">{{$option->value}}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                @if($field->type=="checkbox")
                <div class="form-group mr-md-2 mb-3 mb-md-0 mt-2">
                    @if(!$field->hide_label)
                    <label for="{{$field->label}}">{{$field->label}}<br></label>
                    @endif
                    @foreach($field->options as $option)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input"  @if($field->required) required @endif
                         type="checkbox" name="{{$field->attribute_name}}[]"
                          value="{{$option->value}}" id="{{$option->value}}">
                        <label class="form-check-label" for="{{$option->value}}">
                            {{$option->value}}
                        </label>
                    </div>
                    @endforeach
                </div>
                @endif
                @if($field->type=="radio")
                <div class="form-group mr-md-2 mb-3 mb-md-0 mt-2">
                    @if(!$field->hide_label)
                    <label for="{{$field->label}}">{{$field->label}}<br></label>
                    @endif
                    @foreach($field->options as $option)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio"  @if($field->required) required @endif
                        name="{{$field->attribute_name}}" id="{{$option->value}}" value="{{$option->value}}">
                        <label class="form-check-label" for="{{$option->value}}">{{$option->value}}</label>
                    </div>
                    @endforeach
                </div>
                @endif
                @if($field->type=="date")
                <div class="form-group mr-md-2 mb-3 mb-md-0 mt-2">
                    @if(!$field->hide_label)
                    <label for="{{$field->label}}">{{$field->label}}</label>
                    @endif
                    <input type="text"  @if($field->required) required @endif
                     onfocus="(this.type='date')" name="{{$field->attribute_name}}" 
                     class="form-control" placeholder="{{$field->placeholder}}">
                </div>
            @endif
            @endforeach
    
        @endforeach
        <button type="submit" class="btn btn-primary btn-submit mb-3 mb-md-0 mt-3" style=" @if($form->btn_bg_color) background-color:{{$form->btn_bg_color}}!important; @endif @if($form->btn_color) color:{{$form->btn_color}}!important; @endif">{{$form->btn_text ?? 'Submit'}}</button>
    </form>
    @else
        <h4>Once you create the form it will be shown here</h4>
    @endif

