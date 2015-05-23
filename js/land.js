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

    $('.b-video').fadeIn(500);

    $("select[name='1']").change(function(){
        var mark = $("select[name='1'] option:selected").val();
        $("select[name='2'],select[name='3']").empty();
        $("select[name='3']").append('<option value="" disabled selected>Двигатель</option>');
        $("select[name='"+mark+"'] option").clone().appendTo("select[name='2']");
    });

    $("select[name='2']").change(function(){
        var model = $("select[name='2'] option:selected").val();
        $("select[name='3']").empty();
        $("select[name='"+model+"'] option").clone().appendTo("select[name='3']");

    });
    var select = $("select[name='1']").attr("data-brand");
        if(select!='') {
        for (var i = 0; i < $("select[name='1'] option").length; i++) {
            if(select.toLowerCase() == $("select[name='1'] option").eq(i).text().toLowerCase()) {
                $("select[name='1'] option").eq(i).prop("selected",true);    
                $("select[name='1']").change();
            } 
        }
    }
             
    
});






