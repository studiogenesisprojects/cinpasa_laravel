<style>
#sgcookies {
    position: fixed;
    bottom: 0px;
    background: #252525bf;
    z-index: 999;
    width: 100%;
    padding: 15px;
}

#sgcookies p {
    text-align: left;
    padding: 0px;
    font-size: 13px;
    color: #FFF;
    margin-bottom: 0px;
}

#cookiesettings p {
    font-size: 13px;
}

#cookies p a {
    color: #263f58;
    font-weight: bold;
}

#cookiesettings { 
    position: fixed;
    justify-content: center;
    align-items: center;
    align-content: center;
    padding: 20px;
    z-index: 9996;
    flex-wrap: wrap;
    background-color: #FFF;
    border-radius: 6px;
    color: #555;
    display: none;
    width: 95%;
    max-height: 80%;
    max-width: 1024px;
    left: 50%;
    top: 50%;
    transform: translate(-50%,-50%);
}

.cookiebg {
    position: fixed;
    width: 100%;
    height: 100%;
    background: #000;
    z-index: 9994;
    top: 0px;
    opacity: 0.5;
    display: none;
}

.btn-cookie {
    color: #000;
    font-size: .85rem;
    text-shadow: 0px 0px;
    font-weight: normal;
}

.card-header-cookie {
    font-size: .65rem;
    padding: 0.25rem 3px;
}

#butcookies .btn, .btnformcookies {
    font-size: .90rem;
}

.cookiecont {
    max-height: 300px;
    overflow-y: scroll;
    border: 1px dashed #CCC;
    padding: 10px;
}

@media (max-width: 767px) {
    #cookiesettings {
        max-height: 95%;
        overflow-y: scroll;
    }

    .cookiecont {
        max-height: 100%;
        overflow-y: auto;
    }
}

@media (max-width: 991px) {
    #sgcookies p,  #cookiesettings p {
        font-size: 12px;
    }
}
</style>
<div id="sgcookies">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-sm-12">
            <div class="row">
                <div class="col-lg-12">
                    <p class="mb-2">
                        @if($multiLanguageSupport)
                            {{__('sg-cookies::cookies.bannerText')}}
                        @else
                            {{ $config['bannerText'] }}
                        @endif
                        <a href="{{ $multiLanguageSupport ? __('sg-cookies::cookies.bannerLink') : $config['bannerLink']}}">{{ $multiLanguageSupport ? __('sg-cookies::cookies.bannerLinkText') : $config['bannerLinkText']}}</a></p>
                </div>
            </div>
            <div id="butcookies" class="row text-center">
                <div class="col-12 col-sm-4">
                    <button type="button" id="fastokcookies" class="btn btn-primary btn-block btn-sm mb-2" data-cookiel="sg-cookies-cookie">{{ $multiLanguageSupport ? __('sg-cookies::cookies.buttonOk') : $config['buttonOk']}}</button>
                </div>
                <div class="col-12 col-sm-4">
                    {{-- <button type="button" id="kocookies" class="btn btn-danger btn-block btn-sm mb-2" onclick="euCookieConsentUnsetCheckboxesByClassName('sg-cookies-cookie');">{{ $multiLanguageSupport ? __('sg-cookies::cookies.buttonKo') : $config['buttonKo']}}</button>--}}
                </div>
                <div class="col-12 col-sm-4">
                    <button type="button" id="configcookies" class="btn btn-default btn-block btn-sm mb-2">{{ $multiLanguageSupport ? __('sg-cookies::cookies.buttonConfig') : $config['buttonConfig']}}</button>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Popup Container --}}
<div id="cookiesettings" style="{{ config('sg-cookies.popup_style') }}" class="{{ config('sg-cookies.popup_classes') }}">
    <div class="row">
        {{-- Popup Title gets displayed if its set in the config --}}
        <div class="col-12">
        @if(isset($config['title']))
                <h5>
                        {{-- Popup MultiLanguageSupport defines if the Text is written from the lang file or directly form the Config. --}}
                        @if($multiLanguageSupport)
                            {{ __('sg-cookies::cookies.'.$config['title']) }}
                        @else
                            {{ $config['title'] }}
                        @endif
                </h5>
        @endif
        {{-- Popup Description --}}
        @if(isset($config['description']))
                <p>
                @if($multiLanguageSupport)
                    {{ __('sg-cookies::cookies.'.$config['description']) }}
                @else
                    {{ $config['description'] }}
                @endif
                </p>
        @endif
        {{-- Popup Description --}}
        @if(isset($config['description2']))
                <p>
                @if($multiLanguageSupport)
                    {{ __('sg-cookies::cookies.'.$config['description2']) }}
                @else
                    {{ $config['description2'] }}
                @endif
                </p>
        @endif
        </div>

        <div class="col-12">
            {{-- Popup Form which renders the Cateries and inside of them the single Cookies --}}
            <form id="cookiesCheck" action="{{ config('sg-cookies.route') }}" method="POST">
                <div class="cookiecont col-12 mt-3">
                    <div id="accordion">
                        <div class="card">

                            @foreach($config['categories'] as $categoryName => $category)
                                @include('sg-cookies::category')
                            @endforeach

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-right mt-1">
                        <p class="mb-2"><span class="small text-muted">{{__('sg-cookies::cookies.lastRevision')}}: {{ config('sg-cookies.last_revision_cookies') }}</span></p>
                        @if(config('sg-cookies.acceptAllButton'))
                            <button type="button" 
                                    id="okcookies" 
                                    class="btn btn-success btn-sm btnformcookies"
                                    data-cookiel="sg-cookies-cookie">
                                @if($multiLanguageSupport)
                                    {{__('sg-cookies::cookies.acceptAllButton')}}
                                @else
                                    {{ $config['acceptAllButton'] }}
                                @endif
                            </button>
                        @endif
                        <button id="savecookies" type="submit" class="ml-3 btn btn-default btn-sm btnformcookies">
                            @if($multiLanguageSupport)
                                {{__('sg-cookies::cookies.save')}}
                            @else
                                {{ $config['saveButton'] }}
                            @endif
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="cookiebg"></div>
<script>
    var popupCookie = "{{ config('sg-cookies.popup_classes') }}";
    function euCookieConsentSetCheckboxesByClassName(classname) {
        checkboxes = document.getElementsByClassName(classname);
        for (i = 0; i < checkboxes.length; i++) {
            checkboxes[i].setAttribute('checked', 'checked');
            checkboxes[i].checked = true;
        }
    }

    /*function euCookieConsentUnsetCheckboxesByClassName(classname) {
        checkboxes = document.getElementsByClassName(classname);
        for (i = 0; i < checkboxes.length; i++) {
            checkboxes[i].removeAttribute('checked');
            checkboxes[i].checked = false;
        }
    }*/

    $('#configcookies').on('click', function() {
        $('.'+popupCookie).fadeIn();
        $('.cookiebg').show();
    });

    $('#fastokcookies, #okcookies').on('click', function() {
        var classname = $(this).data('cookiel');
        euCookieConsentSetCheckboxesByClassName(classname);
        document.getElementById("cookiesCheck").submit();
    });
</script>