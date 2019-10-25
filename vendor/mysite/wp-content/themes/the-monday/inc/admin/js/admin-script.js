jQuery(document).ready(function($){
    /**
     * Script for switch option
     */
    $('.switch_options').each(function() {
        //This object
        var obj = $(this);

        var enb = obj.children('.switch_enable'); //cache first element, this is equal to ON
        var dsb = obj.children('.switch_disable'); //cache first element, this is equal to OFF
        var input = obj.children('input'); //cache the element where we must set the value
        var input_val = obj.children('input').val(); //cache the element where we must set the value

        /* Check selected */
        if ('disable' == input_val) {
            dsb.addClass('selected');
        }
        else if ('enable' == input_val) {
            enb.addClass('selected');
        }

        //Action on user's click(ON)
        enb.on('click', function() {
            $(dsb).removeClass('selected'); //remove "selected" from other elements in this object class(OFF)
            $(this).addClass('selected'); //add "selected" to the element which was just clicked in this object class(ON) 
            $(input).val('enable').change(); //Finally change the value to 1
        });

        //Action on user's click(OFF)
        dsb.on('click', function() {
            $(enb).removeClass('selected'); //remove "selected" from other elements in this object class(ON)
            $(this).addClass('selected'); //add "selected" to the element which was just clicked in this object class(OFF) 
            $(input).val('disable').change(); // //Finally change the value to 0
        });

    });
    
    /**
     * Script for switch option Yes/No
     */
    $('.yes_no_switch_options').each(function() {
        //This object
        var obj = $(this);

        var enb = obj.children('.switch_enable'); //cache first element, this is equal to ON
        var dsb = obj.children('.switch_disable'); //cache first element, this is equal to OFF
        var input = obj.children('input'); //cache the element where we must set the value
        var input_val = obj.children('input').val(); //cache the element where we must set the value

        /* Check selected */
        if ('no' == input_val) {
            dsb.addClass('selected');
        }
        else if ('yes' == input_val) {
            enb.addClass('selected');
        }

        //Action on user's click(ON)
        enb.on('click', function() {
            $(dsb).removeClass('selected'); //remove "selected" from other elements in this object class(OFF)
            $(this).addClass('selected'); //add "selected" to the element which was just clicked in this object class(ON) 
            $(input).val('yes').change(); //Finally change the value to 1
        });

        //Action on user's click(OFF)
        dsb.on('click', function() {
            $(enb).removeClass('selected'); //remove "selected" from other elements in this object class(ON)
            $(this).addClass('selected'); //add "selected" to the element which was just clicked in this object class(OFF) 
            $(input).val('no').change(); // //Finally change the value to 0
        });

    });
    
    /**
     * Script for image selected from radio option
     */
     $('.controls#the-monday-img-container li img').click(function(){
		$('.controls#the-monday-img-container li').each(function(){
			$(this).find('img').removeClass ('the-monday-radio-img-selected') ;
		});
		$(this).addClass ('the-monday-radio-img-selected') ;
	});
    
     $('.layout-thmub-section #the-monday-img-container li img').click(function(){
		$('.layout-thmub-section #the-monday-img-container li').each(function(){
			$(this).find('img').removeClass ('the-monday-radio-img-selected') ;
		});
		$(this).addClass ('the-monday-radio-img-selected') ;
	});
    
    /**
     * Page sidebar hide for home page
     */
    $('#page_template').on('change',function(){
       var pageValue = $(this).val();
       //alert(pageValue);
       if( pageValue == 'template-parts/template-home.php' ){
            $('#the_monday_page_sidebar_settings').hide('swing');
       } else {
            $('#the_monday_page_sidebar_settings').show('swing');
       } 
    }).change();

});