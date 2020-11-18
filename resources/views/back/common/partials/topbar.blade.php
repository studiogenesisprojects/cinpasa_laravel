<!--------------------
START - Top Bar
-------------------->
<div class="top-bar color-scheme-transparent">
    <!--------------------
    START - Top Menu Controls
    -------------------->
    <div class="top-menu-controls">

        <!--------------------
        START - User avatar and menu in secondary top menu
        -------------------->
        <div class="logged-user-w">
            <div class="logged-user-i">
                <div class="avatar-w"><img alt="" src="{{asset('back/images/avatar-user-profile-no-photo.png')}}"></div>
                <div class="logged-user-menu color-style-bright">
                    <div class="logged-user-avatar-info">
                        <div class="avatar-w"><img alt="" src="{{asset('back/images/avatar-user-profile-no-photo.png')}}"></div>
                        <div class="logged-user-info-w">
                            <div class="logged-user-name">{{auth()->user()->name}}</div>
                            <div class="logged-user-role">{{auth()->user()->role->name}}</div>
                        </div>
                    </div>
                    <div class="bg-icon"><i class="os-icon os-icon-wallet-loaded"></i></div>
                    <ul>
                        <li><a href="{{route('logout')}}"><i class="os-icon os-icon-signs-11"></i><span>Salir</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--------------------
        END - User avatar and menu in secondary top menu
        -------------------->
    </div>
    <!--------------------
    END - Top Menu Controls
    -------------------->
</div>
<!--------------------
END - Top Bar
-------------------->
