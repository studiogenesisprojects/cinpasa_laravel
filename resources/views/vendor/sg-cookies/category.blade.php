    @if(isset($category['cookies']))
    
    <div class="card-header card-header-cookie" id="heading{{$categoryName}}">
      <div class="mb-0">
        <button type="button" class="text-left btn btn-link btn-block btn-cookie" data-toggle="collapse" data-target="#collapse{{$categoryName}}" aria-expanded="true" aria-controls="collapse{{$categoryName}}"><i class="fas fa-chevron-down"></i> 
            @if($multiLanguageSupport)
                {{ __('sg-cookies::cookies.'.$categoryName) }}
            @else
                {{ $category['title'] }}
            @endif
        </button>
      </div>
    </div>

    <div id="collapse{{$categoryName}}" class="collapse" aria-labelledby="heading{{$categoryName}}" data-parent="#accordion">
      <div class="card-body">
            {{-- Popup Category description only if its set in the config --}}
            @if(isset($category['description']))
            <p class="mb-3">
                @if($multiLanguageSupport)
                    {{ __('sg-cookies::cookies.'.$category['description']) }}
                @else
                    {{ $category['description'] }}
                @endif
            </p>
            @endif


        {{-- Popup Category iteration through the single cookies defined in the config --}}
        @foreach($category['cookies'] as $cookieName => $cookie)
            @include('sg-cookies::cookie')
        @endforeach
      </div>
    </div>

    @endif