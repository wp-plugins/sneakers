(function($){
    $(document).ready(function(){
        $(".cmb_id__cmb_alignment_top").hide();
        $(".cmb_id__cmb_alignment_right").hide();
	    $(".cmb_id__cmb_alignment_bottom").hide();
        $(".cmb_id__cmb_alignment_left").hide();
 
        //lets add the interactivity by adding an event listener
        $("input[name='_cmb_area_radio']").bind("change",function(){
            if ($(this).val()=="top"){
                // Top
                $(".cmb_id__cmb_alignment_top").show();
                $(".cmb_id__cmb_alignment_right").hide();
			    $(".cmb_id__cmb_alignment_bottom").hide();
				$(".cmb_id__cmb_alignment_left").hide();
            }else if ($(this).val()=="right"){
                //Right
                $(".cmb_id__cmb_alignment_top").hide();
                $(".cmb_id__cmb_alignment_right").show();
			    $(".cmb_id__cmb_alignment_bottom").hide();
				$(".cmb_id__cmb_alignment_left").hide();
            } 
			
			else if ($(this).val()=="bottom"){
                //Bottom
                $(".cmb_id__cmb_alignment_top").hide();
                $(".cmb_id__cmb_alignment_right").hide();
			    $(".cmb_id__cmb_alignment_bottom").show();
				$(".cmb_id__cmb_alignment_left").hide();
            }

			else if ($(this).val()=="left"){
                //Left
                $(".cmb_id__cmb_alignment_top").hide();
                $(".cmb_id__cmb_alignment_right").hide();
			    $(".cmb_id__cmb_alignment_bottom").hide();
				$(".cmb_id__cmb_alignment_left").show();
            }
			
			else {
                //still confused, hasn't selected any
                $(".cmb_id__cmb_alignment_top").hide();
			    $(".cmb_id__cmb_alignment_right").hide();
			    $(".cmb_id__cmb_alignment_bottom").hide();
			    $(".cmb_id__cmb_alignment_left").hide();
            }
        });
 
        //make sure that these metaboxes appear properly on edit screen
           // alert($("input[name='_cmb_area_radio']:checked").val());
		if($("input[name='_cmb_area_radio']:checked").val()=="top") //Top

			 $(".cmb_id__cmb_alignment_top").show();
       
		else if($("input[name='_cmb_area_radio']:checked").val()=="right") //Right
             $(".cmb_id__cmb_alignment_right").show();

		else if($("input[name='_cmb_area_radio']:checked").val()=="bottom")
			 $(".cmb_id__cmb_alignment_bottom").show();
		
		else if($("input[name='_cmb_area_radio']:checked").val()=="left")
			 $(".cmb_id__cmb_alignment_left").show();
    })
})(jQuery);