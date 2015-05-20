$(document).ready(function(){	

    function resize(){
       if( typeof( window.innerWidth ) == 'number' ) {
            myWidth = window.innerWidth;
            myHeight = window.innerHeight;
        } else if( document.documentElement && ( document.documentElement.clientWidth || 
        document.documentElement.clientHeight ) ) {
            myWidth = document.documentElement.clientWidth;
            myHeight = document.documentElement.clientHeight;
        } else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
            myWidth = document.body.clientWidth;
            myHeight = document.body.clientHeight;
        }
        myWidth = ( myWidth < 1630 )?1630:myWidth;
        myHeight = myWidth/16*9;
        $(".b-video").css({
            "width" : myWidth,
            "height" : myHeight
        });
    }
    $(window).resize(resize);
    resize();

    var Cars = {
    "alfa_romeo" : {
        "156" : ["1.6i (120)","1.8i (144)"],
        '159': ["2.2i JTS (185)"]
        },
    "chevrolet" : {
        "Avalanche" : ["5.3i (294)","5.3i (320)","8.1i (329)"],
        'Aveo': ["1.2i (72)","1.2i (84)","1.4i (101)","1.4i (83)","1.4i (94)","1.6i (106)","II 1.6i (115)"],
        "Blazer": ["4.3i V6 (193)"],
        'Camaro': ["3.6i (323)","3.6i (328)","3.8i V6 (193)","5.7i V8 (279)","5.7i V8 SS (329)","5.7i V8 Z28 (288)","5.7i V8 Z28 (310)","5.7i V8 Z28 (314)","V 3.6i V6 (312)","V 6.2i V8 (426)","V 6.2i V8 (400)"],
        'Captiva': ["2.4i (167)","2.4i 16V (136)","3.0i (249)","3.0i (258)","3.2i V6 (230)"],
        'Cavalier': ["2.2i (117)","2.2i (122)","2.2i 16V EcoTec (141)","2.4i 16V (152)"],
        'Cobalt': ["2.0i 16V SS (205)","2.2i 16V SS (147)","2.4i 16V SS (174)","I 2.2i (147)","II 1.5i (105)"],
        'Colorado': ["2.8i (175)","2.9i (185)","3.5i (220)","3.7i (242)","5.3i V8 (300)"],
        'Corvette' : ['5.7i V8 16V (345)','5.7i V8 16V (349)','5.7i V8 16V (355)','5.7i V8 16V Z06 (411)','5.7i V8 16V Z06 (390)','6.0i V8 (405)','6.2i V8 32V (437)','7.0i V8 (513)','ZR1 6.2i V8 32V (620)'],
        'Cruze' : ['1.6i (109)','1.6i (113)','1.6i (124)','1.8i (141)','2.0i 24V (143)','2.5i 24V (154)'],
        'Equinox' : ['2.4i (182)','3.0i V6 (264)','3.4i V6 (185)'],
        'Evanda' : ['2.0i (131)'],
        'Express' : ['II 4.3i (200)','II 5.3i (294)','II 6.0i (324)'],
        'HHR' : ['2.2i 16V (141)','2.4i 16V (175)'],
        'Impala' : ['3.4i V6 (182)','3.5i V6 (212)','3.8i V6 (203)','3.8i V6 SS (243)','3.9i V6 (245)','5.3i V8 SS (307)'],
        'Lacetti' : ['1.4i 16V (94)','1.6i 16V (109)','1.8i 16V (122)'],
        'Lanos' : ['1.5i (86)'],
        'Lumina' : ['3.1i V6 (162)','3.4i V6 (213)'],
        'Malibu' : ['2.2i 16V (147)','2.4i (169)','2.4i 16V (152)','3.1i V6 (152)','3.1i V6 (173)','3.5i V6 12V (203)','3.6i V6 (256)','3.9i V6 SS (243)','1.4i 16V (94)','1.6i 16V (109)','1.8i 16V (122)'],
        'Optra' : ['2.0i (126)'],
        'Orlando' : ['1.8i (141)'],
        'Spark' : ['Matiz III 1.0i (67)'],
        'SSR' : ['5.3i V8 (300)','6.0i V8 (390)'],
        'Suburban' : ['5.3i V8 (288)','5.3i V8 (300)','5.3i V8 (324)','5.7i V8 (200)','5.7i V8 (210)','5.7i V8 (250)','6.0i V8 (359)','6.0i V8 (340)','6.0i V8 (324)','6.0i V8 (304)','7.4i V8 (230)','7.4i V8 (290)','8.1i V8 (329)','8.1i V8 (344)'],
        'Tahoe' : ['4.8i V8 (278)','4.8i V8 (290)','5.3i V8 (273)','5.3i V8 (288)','5.3i V8 (300)','5.3i V8 (324)','5.7i V8 (258)','5.7i V8 (254)','5.7i V8 (200)','6.0i V8 (305)'],
        'Trailblazer' : ['4.2i (273)','4.2i (279)','4.2i (295)','5.3i V8 (288)','5.3i V8 (294)','5.3i V8 (304)','6.0i V8 (400)','II 3.6i (239)']
        },
    "ford" : {
        'C-Max' : ["I 1.8i MT (125)","I 2.0i AT (145)","II 1.6i (125)","I 1.6i 16V (103)","I 1.6i 16V Ti-VCT (115)","I 1.8i 16V (125)","I 2.0i 16V (145)"],
        'Cougar' : ["2.0i (131)","2.5i (170)","2.5i (205)"],
        'Edge' : ["3.5i (288)"],
        'Escape' : ["I 3.0i (203)","II 2.3i (145)","II 2.5i (171)","II 3.0i (240)","III 2.5i (168)"],
        'Expedition' : ["II 5.4i (269)"],
        'Explorer' : ["IV 4.0i V6 (212)","IV 4.6i V8 (295)","Sport 3.5i (365)","V 3.5i V6 (249)","V 3.5i V6 (294)"],
        'F-150' : ["5.4i (310)","5.4i (300)"],
        'Fiesta' : ["II 1.25i 16V (75)","II 1.3i (50)","II 1.3i (60)","II 1.4i 16V (90)","II 1.6i 16V Sport (103)","III 1.2i 16V (75)","III 1.3i (68)","III 1.3i (58)","III 1.4i 16V (80)","III 1.6i 16V (100)","III 2.0i 16V ST (150)","IV 1.25i (60)","IV 1.25i (82)","IV 1.4i (71)","IV 1.4i (96)","IV 1.6i Ti-VCT (120)"],
        'Focus' : ["I 1.4i 16V (75)","I 1.6i 16V (100)","I 1.6i Duratec 8V (98)","I 1.8i 16V (115)","I 2.0i 16V (131)","I 2.0i 16V RS (215)","I 2.0i 16V ST170 (172)","II 1.4i Duratec 16V (80)","II 1.6i Duratec 16V (100)","II 1.6i Duratec Ti-VCR 16V (115)","II 1.8i 16V (125)","II 2.0i 16V (145)","II 2.0i Duratec 16V (145)","III 1.6i (125)","III 1.6i (105)","III 2.0i (150)","USA 2.0i 16V SVT (172)","USA 2.0i 16V ZX3 (131)","USA 2.0i LX (111)","USA 2.3i 16V ST (153)","USA 2.3i 16V ZXW (147)"],
        'Fusion' : ["1.2i 16V (75)","1.4i Duratec 16V (80)","1.6i Duratec 16V (100)","USA 2.3i 16V (162)","USA 3.0i V6 24V (212)","II 2.0i (145)","II 2.3i (161)"],
        'Kuga' : ["II 2.5i (150)"],
        'Maverick' : ["2.0i 16V (124)","2.3i 16V AWD (150)","2.4 i GLS (118)","2.4i 12V (124)","3.0i 4WD (203)","3.0i V6 24V AWD (197)"],
        'Mondeo' : ["1.6i (120)","I 1.6i 16V (90)","I 1.6i 16V (88)","I 1.8i 16V (112)","I 2.0i 16V (136)","I 2.5i 24V (170)","II 1.6i 16V (95)","II 1.8i 16V (115)","II 2.0i (130)","II 2.5i V6 (170)","III 1.8i (110)","III 1.8i (125)","III 1.8SCi (130)","III 2.0i (146)","III 2.5i (170)","III 3.0i V6 (204)","III 3.0i V6 (226)","IV 1.6i 16V (110)","IV 1.6i 16V (125)","IV 2.0i 16V (145)","IV 2.3i 16V (160)","IV 2.5i 20V (220)"],
        'Mustang' : ["IV 3.8i V6 (147)","IV 3.8i V6 (190)","IV 3.8i V6 GT (152)","IV 4.6i V8 32V Cobra (324)","IV 4.6i V8 32V Cobra R (395)","IV 4.6i V8 GT (215)","IV 4.6i V8 GT (263)","IV 4.6i V8 GT (288)","V 3.7i V6 (305)","V 4.0i V6 (205)","V 4.0i V6 12V (212)","V 4.6i V8 GT (304)","V 5.0i V8 (412)","V 5.0i V8 (444)","V 5.4i V8 (550)"],
        'S-Max' : ["2.0i 16V (145)","2.3i (161)"],
        'Transit' : ["2.0 CDi (100)"]
        }
    };
    // console.log(Models);
    var brand,model;
    $("select[name='1']").change(function(){
        brand = $("select[name='1'] option:selected").val();
        $.each(Cars, function( brand_key, brand_value ) {
            if(brand_key == brand) {
                $("select[name='2'],select[name='3']").empty();
                $("select[name='2']").append('<option value="" disabled selected>Модель</option>');
                $("select[name='3']").append('<option value="" disabled selected>Двигатель</option>');
                $.each(Cars[brand], function( model_key, model_arr ) {
                    $("select[name='2']").append('<option value="'+model_key+'">'+model_key+'</option>');
                });
            }
        });
    });

    $("select[name='2']").change(function(){
        model = $("select[name='2'] option:selected").val();
        $("select[name='3']").empty();
        $("select[name='3']").append('<option value="" disabled selected>Двигатель</option>');
        $.each(Cars[brand][model], function( model_key, model_arr ) {
            $("select[name='3']").append('<option value="'+model_arr+'">'+model_arr+'</option>');
        });

    });
        // var select = $("select[name='1']").attr("data-brand");
        // $("select[name='1'] option[value='"+select+"']").prop("selected",true);    
        // $("select[name='1']").change();          
    
});






