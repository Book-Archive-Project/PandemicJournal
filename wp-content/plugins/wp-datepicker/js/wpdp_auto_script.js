	
	

	jQuery(document).ready(function($){


		
		if($('.wpcf7-form-control.wpcf7-repeater-add').length>0){
			$('.wpcf7-form-control.wpcf7-repeater-add').on('click', function(){
				wpdp_refresh_8436(jQuery, true);
			});
		}
		
	
});
var wpdp_refresh_first_8436 = 'yes';
var wpdp_counter_8436 = 0;
var wpdp_month_array_8436 = [];
var wpdp_dateFormat = "mm/dd/yy";
var wpdp_defaultDate = "";
function wpdp_refresh_8436($, force){
				if(typeof $.datepicker!='undefined' && typeof $.datepicker.regional["en-GB"]!='undefined'){
								
				wpdp_month_array_8436 = $.datepicker.regional["en-GB"].monthNamesShort;
				
									
				}
				
		
		
				


				if($("#datepicker").length>0){
					
				$("#datepicker").attr("autocomplete", "off");
					
				//document.title = wpdp_refresh_first=='yes';
				force = true;
				if(wpdp_refresh_first_8436 == 'yes' || force){
					
					if(typeof $.datepicker!='undefined')
					$("#datepicker").datepicker( "destroy" );
					
					$("#datepicker").removeClass("hasDatepicker");
					wpdp_refresh_first_8436 = 'done';
					
				}
				$('body').on('mouseover, mousemove', function(){//#datepicker									
				if ($(this).val()!= "") {
					$(this).attr('data-default-val', $(this).val());
				}		
							
				if(wpdp_counter_8436 > 2)
				clearInterval(wpdp_intv_8436);
				
				if(!$("#datepicker").hasClass('hasDatepicker')){

				
					
				$("#datepicker").datepicker($.extend(  
					{},  // empty object  
					$.datepicker.regional[ "en-GB" ],       // Dynamically  
					{  
 					dateFormat: wpdp_dateFormat
  } // your custom options 
				)); 
				
				
				
				
				
				$("#datepicker").datepicker( "option", "dateFormat", "mm/dd/yy" );


setTimeout(function(){ 

	 $.each($("#datepicker"), function(){
		
		var expected_default = $(this).data('default');		 
	 
		if(expected_default!=''){ $(this).datepicker().datepicker('setDate', expected_default); } 
		
	});
	
}, 100);
	
				$("#datepicker").datepicker( "option", "monthNamesShort", wpdp_month_array_8436 );





                

					$.each($("#datepicker"), function(){
						if($(this).data('default-val')!= ""){
							$(this).val($(this).data('default-val'));
						}
						
					});
						
				
				}
				});
				}


				if($(".dp-1").length>0){
					
				$(".dp-1").attr("autocomplete", "off");
					
				//document.title = wpdp_refresh_first=='yes';
				force = true;
				if(wpdp_refresh_first_8436 == 'yes' || force){
					
					if(typeof $.datepicker!='undefined')
					$(".dp-1").datepicker( "destroy" );
					
					$(".dp-1").removeClass("hasDatepicker");
					wpdp_refresh_first_8436 = 'done';
					
				}
				$('body').on('mouseover, mousemove', function(){//.dp-1									
				if ($(this).val()!= "") {
					$(this).attr('data-default-val', $(this).val());
				}		
							
				if(wpdp_counter_8436 > 2)
				clearInterval(wpdp_intv_8436);
				
				if(!$(".dp-1").hasClass('hasDatepicker')){

				
					
				$(".dp-1").datepicker($.extend(  
					{},  // empty object  
					$.datepicker.regional[ "en-GB" ],       // Dynamically  
					{  
 					dateFormat: wpdp_dateFormat
  } // your custom options 
				)); 
				
				
				
				
				
				$(".dp-1").datepicker( "option", "dateFormat", "mm/dd/yy" );


setTimeout(function(){ 

	 $.each($(".dp-1"), function(){
		
		var expected_default = $(this).data('default');		 
	 
		if(expected_default!=''){ $(this).datepicker().datepicker('setDate', expected_default); } 
		
	});
	
}, 100);
	
				$(".dp-1").datepicker( "option", "monthNamesShort", wpdp_month_array_8436 );





                

					$.each($(".dp-1"), function(){
						if($(this).data('default-val')!= ""){
							$(this).val($(this).data('default-val'));
						}
						
					});
						
				
				}
				});
				}


				if($("#pick-date").length>0){
					
				$("#pick-date").attr("autocomplete", "off");
					
				//document.title = wpdp_refresh_first=='yes';
				force = true;
				if(wpdp_refresh_first_8436 == 'yes' || force){
					
					if(typeof $.datepicker!='undefined')
					$("#pick-date").datepicker( "destroy" );
					
					$("#pick-date").removeClass("hasDatepicker");
					wpdp_refresh_first_8436 = 'done';
					
				}
				$('body').on('mouseover, mousemove', function(){//#pick-date									
				if ($(this).val()!= "") {
					$(this).attr('data-default-val', $(this).val());
				}		
							
				if(wpdp_counter_8436 > 2)
				clearInterval(wpdp_intv_8436);
				
				if(!$("#pick-date").hasClass('hasDatepicker')){

				
					
				$("#pick-date").datepicker($.extend(  
					{},  // empty object  
					$.datepicker.regional[ "en-GB" ],       // Dynamically  
					{  
 					dateFormat: wpdp_dateFormat
  } // your custom options 
				)); 
				
				
				
				
				
				$("#pick-date").datepicker( "option", "dateFormat", "mm/dd/yy" );


setTimeout(function(){ 

	 $.each($("#pick-date"), function(){
		
		var expected_default = $(this).data('default');		 
	 
		if(expected_default!=''){ $(this).datepicker().datepicker('setDate', expected_default); } 
		
	});
	
}, 100);
	
				$("#pick-date").datepicker( "option", "monthNamesShort", wpdp_month_array_8436 );





                

					$.each($("#pick-date"), function(){
						if($(this).data('default-val')!= ""){
							$(this).val($(this).data('default-val'));
						}
						
					});
						
				
				}
				});
				}
		


		
		$('.ui-datepicker').addClass('notranslate');
}
	var wpdp_intv_8436 = setInterval(function(){
		wpdp_counter_8436++;
		wpdp_refresh_8436(jQuery, false);
	}, 500);

	                jQuery(document).ready(function($){

                        $("#datepicker").on('click', function(){

                            $('.ui-datepicker-div-wrapper').prop('class', 'ui-datepicker-div-wrapper wp_datepicker_option-1 ');

                        });

                        setTimeout(function () {
                                $("#datepicker").click();
                                //$("//").focusout();
                        }, 1000);



                });

                            jQuery(document).ready(function($){

                        $(".dp-1").on('click', function(){

                            $('.ui-datepicker-div-wrapper').prop('class', 'ui-datepicker-div-wrapper wp_datepicker_option-1 ');

                        });

                        setTimeout(function () {
                                $(".dp-1").click();
                                //$("//").focusout();
                        }, 1000);



                });

                            jQuery(document).ready(function($){

                        $("#pick-date").on('click', function(){

                            $('.ui-datepicker-div-wrapper').prop('class', 'ui-datepicker-div-wrapper wp_datepicker_option-1 ');

                        });

                        setTimeout(function () {
                                $("#pick-date").click();
                                //$("//").focusout();
                        }, 1000);



                });

            
    //wpdp_refresh_//(jQuery, false);
	
	    
	
	

	jQuery(document).ready(function($){


		
		if($('.wpcf7-form-control.wpcf7-repeater-add').length>0){
			$('.wpcf7-form-control.wpcf7-repeater-add').on('click', function(){
				wpdp_refresh_8447(jQuery, true);
			});
		}
		
	
});
var wpdp_refresh_first_8447 = 'yes';
var wpdp_counter_8447 = 0;
var wpdp_month_array_8447 = [];
var wpdp_dateFormat = "mm/dd/yy";
var wpdp_defaultDate = "";
function wpdp_refresh_8447($, force){
				if(typeof $.datepicker!='undefined' && typeof $.datepicker.regional["en-GB"]!='undefined'){
					
				wpdp_month_array_8447 = $.datepicker.regional["en-GB"].monthNames;
									
				}
				
		
		
				


				if($(".datepicker").length>0){
					
				$(".datepicker").attr("autocomplete", "off");
					
				//document.title = wpdp_refresh_first=='yes';
				force = true;
				if(wpdp_refresh_first_8447 == 'yes' || force){
					
					if(typeof $.datepicker!='undefined')
					$(".datepicker").datepicker( "destroy" );
					
					$(".datepicker").removeClass("hasDatepicker");
					wpdp_refresh_first_8447 = 'done';
					
				}
				$('body').on('mouseover, mousemove', function(){//.datepicker									
				if ($(this).val()!= "") {
					$(this).attr('data-default-val', $(this).val());
				}		
							
				if(wpdp_counter_8447 > 2)
				clearInterval(wpdp_intv_8447);
				
				if(!$(".datepicker").hasClass('hasDatepicker')){

				
					
				$(".datepicker").datepicker($.extend(  
					{},  // empty object  
					$.datepicker.regional[ "en-GB" ],       // Dynamically  
					{  
 					dateFormat: wpdp_dateFormat
  } // your custom options 
				)); 
				
				$(".datepicker").attr('readonly', 'readonly');
				
				
				
				
				$(".datepicker").datepicker( "option", "dateFormat", "mm/dd/yy" );


setTimeout(function(){ 

	 $.each($(".datepicker"), function(){
		
		var expected_default = $(this).data('default');		 
	 
		if(expected_default!=''){ $(this).datepicker().datepicker('setDate', expected_default); } 
		
	});
	
}, 100);
	




                

					$.each($(".datepicker"), function(){
						if($(this).data('default-val')!= ""){
							$(this).val($(this).data('default-val'));
						}
						
					});
						
				
				}
				});
				}
		


		
		$('.ui-datepicker').addClass('notranslate');
}
	var wpdp_intv_8447 = setInterval(function(){
		wpdp_counter_8447++;
		wpdp_refresh_8447(jQuery, false);
	}, 500);

	                jQuery(document).ready(function($){

                        $(".datepicker").on('click', function(){

                            $('.ui-datepicker-div-wrapper').prop('class', 'ui-datepicker-div-wrapper wp_datepicker_option-2 ll-skin-melon');

                        });

                        setTimeout(function () {
                                $(".datepicker").click();
                                //$("//").focusout();
                        }, 1000);



                });

            
    //wpdp_refresh_//(jQuery, false);
	
	    
