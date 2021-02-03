var width = window.innerWidth;


let hoverDropdown = gsap.timeline({
    paused: true
});

hoverDropdown.set(".dropdown", {
    display: "flex"
})
$(".hover-dropdown, .dropdown").mouseenter(function () {
    hoverDropdown.play();
}).mouseleave(function () {
    hoverDropdown.reverse();
})

let tl_busqueda = gsap.timeline({
    paused: true
});

tl_busqueda.set("#buscador_modal", {
        display: "flex"
    })
    .to(".w-0", {
        width: "100%"
    })
    .set("#icon-search .icon-nav, .icon-search .icon-nav", {
        attr: {

        }
    }, 0)

$("#icon-search, .icon-search").click(function () {
    event.preventDefault();
    tl_busqueda.play();
});

$("#close-busqueda").click(function () {
    event.preventDefault();
    tl_busqueda.reverse(-1);
});

let tl_favorito = gsap.timeline({
    paused: true
});

tl_favorito.set("#favorito_modal", {
        display: "flex"
    })
    .to(".w-0", {
        width: "100%"
    })

$("#icon-fav, .icon-fav").click(function () {
    event.preventDefault();
    tl_favorito.play();
});

$("#close-favorito").click(function () {
    event.preventDefault();
    tl_favorito.reverse(-1);
});


let bool_menu = true;
let tl_menu = gsap.timeline({
    paused: true
});

tl_menu.set("#icon-menu .icon-nav", {
    attr: {
        src: "img/icon-menu-pink.svg"
    }
});

$("#icon-menu").click(function () {
    event.preventDefault();
    if (bool_menu == true) {
        tl_menu.play();
        bool_menu = false;
    } else {
        tl_menu.reverse();
        bool_menu = true;
    }
});

let bool_menu_anim = true;
let tl_menu_anim = gsap.timeline({
    paused: true
});

tl_menu_anim.set("html,body", {
        overflow: "hidden"
    })
    .to("#menu", {
        height: "calc(100vh)",
        ease: "power3.in"
    })
    .to("#menu", {
        padding: "3rem",
        ease: "power3.in"
    }, 0)
    .set(".a-stagger", {
        display: "block"
    })
    .to(".a-stagger", {
        duration: 0.4,
        opacity: 1,
        stagger: 0.05
    });

$("#icon-menu").click(function () {
    event.preventDefault();
    if (bool_menu_anim == true) {
        tl_menu_anim.play();
        bool_menu_anim = false;
    } else {
        tl_menu_anim.reverse();
        bool_menu_anim = true;
    }
});





let bool_search_bar = true;
let tl_buscador_avanzado = gsap.timeline({
        paused: true
    })
    .set("#buscador_avanzado", {
        display: "flex"
    });

let tl_buscador_avanzado_mobile = gsap.timeline({
        paused: true
    })
    .set("#buscador_avanzado_mobile", {
        display: "flex"
    });


$("#btn_buscador_avanzado, #btn_buscador_avanzado_mobile").click(function () {
    event.preventDefault();
    if (bool_search_bar == true) {
        if (width >= 576) {
            tl_buscador_avanzado.play();
        } else {
            tl_buscador_avanzado_mobile.play();
        };
        $(".btn_buscador_avanzado_cerrar").show();
        $(".btn_buscador_avanzado_abrir").hide();
        bool_search_bar = false;
    } else {
        if (width >= 576) {
            tl_buscador_avanzado.reverse();
        } else {
            tl_buscador_avanzado_mobile.reverse();
        };
        $(".btn_buscador_avanzado_abrir").show();
        $(".btn_buscador_avanzado_cerrar").hide();
        bool_search_bar = true;
    }
});


let bool_submenu = true;
let tl_submenu = gsap.timeline({
        paused: true
    })
    .set(".submenu", {
        display: "flex"
    })
    .to(".submenu", {
        opacity: 1,
        duration: .5
    }, 0)
    .to("#menu a img", {
        rotate: "180deg",
        duration: .3
    }, 0);

$("#productos_submenu").click(function () {
    event.preventDefault();

    if (bool_submenu == true) {
        tl_submenu.play();
        bool_submenu = false;
    } else {
        tl_submenu.reverse();
        bool_submenu = true;
    }
});





document.addEventListener("DOMContentLoaded", function (event) {
    let controller = new ScrollMagic.Controller();


    if (width >= 768) {
        var tl_header = gsap.timeline()
            .to("header", {
                duration: 0.2,
                y: "-68px",
                boxShadow: "0px 3px 6px 0px rgba(0,0,0,0.16)"
            })
            .to("#header", {
                duration: 0.2,
                marginTop: "-68px"
            }, 0);
    } else {
        var tl_header = gsap.timeline()
            .to("header", {
                duration: 0.2,
                boxShadow: "0px 3px 6px 0px rgba(0,0,0,0.16)"
            });
    };

    let escena_header = new ScrollMagic.Scene({
            triggerElement: "body",
            triggerHook: 0,
            offset: "1px"
        })
        .setTween(tl_header)
        .addTo(controller);


    var tl_home = gsap.timeline()
        .from("#home", {
            duration: 0.5,
            y: "100px",
            opacity: 0
        })

    let escena_home = new ScrollMagic.Scene({
            triggerElement: "body",
            triggerHook: 1,
            reverse: false
        })
        .setTween(tl_home)
        .addTo(controller);

    var tl_categorias = gsap.timeline()
        .from("#categorias", {
            duration: 0.5,
            y: "100px",
            opacity: 0
        })

    let escena_categorias = new ScrollMagic.Scene({
            triggerElement: "#categorias",
            triggerHook: 0.7,
            reverse: false
        })
        .setTween(tl_categorias)
        .addTo(controller);

    var tl_CIN = gsap.timeline()
        .from("#CIN", {
            duration: 0.5,
            y: "100px",
            opacity: 0
        })

    let escena_CIN = new ScrollMagic.Scene({
            triggerElement: "#CIN",
            triggerHook: 0.7,
            reverse: false
        })
        .setTween(tl_CIN)
        .addTo(controller);

    var tl_porque = gsap.timeline()
        .from("#porque", {
            duration: 0.5,
            y: "100px",
            opacity: 0
        })

    let escena_porque = new ScrollMagic.Scene({
            triggerElement: "#porque",
            triggerHook: 0.7,
            reverse: false
        })
        .setTween(tl_porque)
        .addTo(controller);

    var tl_historia = gsap.timeline()
        .from("#historia", {
            duration: 0.5,
            y: "100px",
            opacity: 0
        })

    let escena_historia = new ScrollMagic.Scene({
            triggerElement: "#historia",
            triggerHook: 0.7,
            reverse: false
        })
        .setTween(tl_historia)
        .addTo(controller);

    var tl_aplicaciones = gsap.timeline()
        .from("#aplicaciones", {
            duration: 0.5,
            y: "100px",
            opacity: 0
        })

    let escena_aplicaciones = new ScrollMagic.Scene({
            triggerElement: "#aplicaciones",
            triggerHook: 0.7,
            reverse: false
        })
        .setTween(tl_aplicaciones)
        .addTo(controller);

    var tl_button_footer = gsap.timeline()
        .to(".btn-fixed", {
            duration: 0.3,
            opacity: 0
        })
        .set(".btn-fixed", {
            visibility: "hidden"
        }, 0.3);

    let escena_button_footer = new ScrollMagic.Scene({
            triggerElement: "footer",
            triggerHook: 1
        })
        .setTween(tl_button_footer)
        .addTo(controller);
});




var parent = $('#CIN');
var w = parent.width();
var n = $(".CINchild").length;
var logo = $(".CINcontent").length;
var ow = w - ((n - 1) * 100);
var cw = 100;

$(window).on('resize', function () {
    w = parent.width();
    n = $(".CINchild").length; // Div count
    var logo = $(".CINcontent").length;
    ow = w - ((n - 1) * 100);

    $('.CINchild.open').each(function () {
        $(this).css('width', ow);
    });
});

$(".CINchild").on('click', function () {
    event.preventDefault();
    test($(this));
});

function test(el) {
    $this = el;
    gsap.to($this, 1, {
        width: ow,
        ease: Power3.easeInOut
    });

    gsap.to($this.siblings(), 1, {
        width: cw,
        ease: Power3.easeInOut
    });
    $this.addClass('open');
    $this.siblings().removeClass('open');
}

function out() {
    gsap.to($(".CINchild"), 0.3, {
        width: 100 / n + '%',
        ease: Power3.easeOut
    });
}


$(".CINchild").each(function () {
    let CINchild = gsap.timeline({
        paused: true
    });

    let bool = true;
    let CIN = $(this);
    let cinta = $(CIN).find('.CINcontent');
    let logo = $(cinta).find('img');

    CINchild.to(cinta, {
            duration: 0.3,
            width: "100%",
            ease: Power3.easeOut
        })
        .from(logo, {
            duration: 0.3,
            opacity: 0,
            x: "-30px",
            ease: Power3.easeOut
        })
    $(this).mouseenter(function () {
        CINchild.play();
    }).mouseleave(function () {
        if (bool == true) {
            CINchild.reverse();
        }
    });

    $(this).click(function () {
        bool = false;
    });
});
