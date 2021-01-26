<div>
    {{-- Popup Cookie description only gets displayed if set in config --}}
    @if(isset($cookie['description']))
        <div class="mb-3">
            @if($multiLanguageSupport)
                {{ __('sg-cookies::cookies.'.$cookie['description']) }}
            @else
                {{ $cookie['description'] }}
            @endif
        </div>
    @endif

    <div class="form-check mb-3">
        <label class="form-check-label" for="{{ $cookieName }}">
            <input type="checkbox" id="{{ $cookieName }}" name="{{ $cookieName }}" class="form-check-input sg-cookies-category-{{$categoryName}} @if(!isset($cookie['forced'])) sg-cookies-cookie @endif" value="1" @if(isset($cookie['forced'])) checked="checked" disabled="disabled" @endif>
        @if(isset($cookie['forced']))
            <input type="hidden" name="{{ $cookieName }}" value="1">
        @endif
            <span class="checkmark"></span>
            <span class="small text-muted">
                @if($multiLanguageSupport)
                    {!! __('sg-cookies::cookies.'.$cookieName) !!}
                @else
                    {{ $cookie['title'] }}
                @endif
            </span>
        </label>
    </div>

</div>
