$(function() {
	/*
	number of fieldsets
	*/
	var form = '#setupProfile_form';
	var fieldsetCount = $(form).children().length;
	
	/*
	current position of fieldset / navigation link
	*/
	var current 	= 1;
    
	/*
	sum and save the widths of each one of the fieldsets
	set the final sum as the total width of the steps element
	*/
	var stepsWidth	= 0;
    	var widths = new Array();
	$('#steps .step').each(function(i){
        	var $step = $(this);
		widths[i] = stepsWidth;
        	stepsWidth += $step.width();
    	});
	$('#steps').width(stepsWidth);
	
	/*
	to avoid problems in IE, focus the first input of the form
	*/
	$(form).children(':first').find(':input:first').focus();	
	
	/*
	show formElems
	*/
	$(form).children().show();

	/*
	when clicking on a navigation link 
	the form slides to the corresponding fieldset
	*/
	$('#navigation a').bind('click',function(e){
	var $this = $(this);
	var prev = current;
	$this.closest('ul').find('li').removeClass('selected');
		$this.parent().addClass('selected');

	window.location.hash = $this.attr('href');
	/*
	we store the position of the link
	in the current variable	
	*/
	current = $this.parent().index() + 1;
	/*
	animate / slide to the next or to the corresponding
	fieldset. The order of the links in the navigation
	is the order of the fieldsets.
	Also, after sliding, we trigger the focus on the first 
	input element of the new fieldset
	If we clicked on the last link (confirmation), then we validate
	all the fieldsets, otherwise we validate the previous one
	before the form slided
	*/
		$('#steps').stop().animate({
			marginLeft: '-' + widths[current-1] + 'px'
		 },5,function(){
		if(current == fieldsetCount)
			validateSteps();
		else
			validateStep(prev);
		$(form).children(':nth-child('+ parseInt(current) +')').find(':input:first').focus();
	});
		e.preventDefault();
	});

	/*
	get window hash
	*/
	if(window.location.hash) {
 		var hash = window.location.hash;

		hash = hash.substr(1);

		var navhash = $('#navigation a[href="#'+hash+'"]');

		current = navhash.parent().index() + 1;

		navhash.closest('ul').find('li').removeClass('selected');

		navhash.parent().addClass('selected');

       		$('#steps').stop().animate({
        	    marginLeft: '-' + widths[current-1] + 'px'
        	},5,function(){
			$(form).children(':nth-child('+ parseInt(current) +')').find(':input:first').focus();
		});

 		if(hash!=current){	
			if($("#"+hash).length != ""){
				//show_menu(changehash, false);
			}
		}
	}
	
	/*
	clicking on the tab (on the last input of each fieldset), makes the form
	slide to the next step
	*/
	$(form + ' > fieldset').each(function(){
		var $fieldset = $(this);
		$fieldset.children(':last').find(':input').keydown(function(e){
			if (e.which == 9){
				$('#navigation li:nth-child(' + (parseInt(current)+1) + ') a').click();
				/* force the blur for validation */
				$(this).blur();
				e.preventDefault();
			}
		});
	});

	/* htmlescape */

	function htmlEscape(string) {
		return string.replace(/&/g,'&amp;').replace(/>/g,'&gt;').replace(/</g,'&lt;').replace(/"/g,'&quot;');
	}



	/*
	Image Overlay
	*/

/* 	$("a.imageOverlay").bind("click", function(e){
		//$("#delete").hide();
		$("#upload form").show();
                $('#overlayImages').hide();
		openOverlay("upload");
	}); */
	
	/*
	 remove image on click	
	*/

/* 	$("img[id^='img']").bind("click", function(e){
	    var id = $(this).siblings().val();
	    var index = parseInt($(this).attr('id').replace('img',''));
	    var img = $(this).attr('src');
	    if($("#delete").length > 0){
		//only change img src
		$("#delete img").attr('src', img);
		$("#delete").find("button.delete").attr('index', index);

	    }
	    else{
	    	displayimage(images);
		$("#upload").append('<div id="delete" class="left" style="width:200px;height:230px;"><img style="width:200px;height:150px;" src='+img+'></img><div><button class="delete" index='+index+' value='+id+' onClick="return false;">delete</button></div><label>Tag</label><input class="short" type="text" name="tag"/></div>');
	    }
	    openOverlay("upload");
	    $("#upload form").hide();
	    $("#delete").show();
            $('#overlayImages').show();
	}); */


	function displayimage(images){
		$('#upload').append('<div id="overlayImages" class="right clearfix" style="margin:10px;width:200px;height:300px;overflow-y:auto;"><button onClick="return false;">delete</button></div>');
		for(var im = 0; im < images.length; im++){
		  if(images[im] != null){
		    $('#overlayImages').append('<div><img class="image" src='+images[im].pathThumb+' title='+images[im].title+' id="img'+im+'" style="width:80px;height:80px"></img><input type="checkbox" value='+im+'/></div>');
		   }
		}
	}


	/*
	delete button
	*/

/* 	$("button.delete").live("click", function(){
	   var value = $(this).val();
	   var i = $(this).attr('index');
	   var crumb = $(form).children().find('input[name="crumb"]').val();
	   var _id = $(form).children().find('input[name="_id"]').val();
	   value = value.replace('/property/image/', '');

	   $.post("/property/image", { id: value, property:_id , index:[i],crumb: crumb}, function(data) {
		 if(data.changed){
		       $('#images').children().find('#img'+i).parent().hide();
		 }
	   });

	   var src = $('#images').find('#img'+i).parent().siblings(':visible')[0] || '';

	   if(src !== ''){
           	//image src
	   	$(this).closest('div').siblings('img').attr('src', $(src).children('img').attr('src'));
	   	//index src
	   	var index = parseInt($(src).children('img').attr('id').replace('img',''));
           	$(this).attr('index', index);
	   }
	   //window.location.href = window.location.href.replace(/#.*$/, '#photos');
	  // window.location.reload();
	}); */

	/*
	upload button
	*/
/* 	$("button.upload").show();

	$("button.upload").bind("click", function(){

		if($(this).closest('form').find('input[type="file"]').val() == ''){
			return false; 
		}else{

			$.post($(form).attr('action'), $(form).serialize(), function(data) {
				return false;
			});
		}		 
	}); */

	/*
	clone element when clone is clicked
	*/

	var regex = /^(.*)(\d)+$/i;
	var cloneIndex = ".clonedInner";
	var labelId = '';

/* 	$("button.clone").live("click", function(){
	    if($(cloneIndex).length > 0)
    	    $(cloneIndex).first()
		.clone()
        	.appendTo('#clone')
	     	.show()
        	.attr("id", $(cloneIndex).length)
        	.find("*").each(function() {
            	var label = $("#" + ($(cloneIndex).length) ).children().find('label[for='+this.id+']') || "";
            	var match = label.text().match(regex) || [];
            	if (match.length == 3) {
		  correct($(cloneIndex).length,this.id);
		  labelId =  this.id;
            	}
    	     });
	   //if($(cloneIndex).is(':hidden')){
		//$(cloneIndex+':hidden').remove();
	   //}
	});

	$("button.remove").live("click", function(){
	   if($(cloneIndex).length === 1){
	   	//$(this).parents(cloneIndex).hide();
	   }
	   else{
	   	$(this).parents(cloneIndex).remove();
		correct($(cloneIndex).length,labelId);
	   }	
	}); */

	/** update **/

	function correct(i,id){
	  if(i){
	   var label = $(cloneIndex).last();
	   for(e = 0; e<i; e++){
             var match = label.children().find('label[for='+id+']').text().match(regex) || [];
             if (match.length == 3) {
              	var labelNew = label.children().find('label[for='+id+']').text().replace(match[2],eval(i-e));
		label.children().find('label[for='+id+']').html(labelNew);
             }
	     label = label.prev();
	   }
	  }
	}


	/*
	validates errors on all the fieldsets
	records if the Form has errors in $(form).data()
	*/
	function validateSteps(){
		var FormErrors = false;
		for(var i = 1; i < fieldsetCount; ++i){
			var error = validateStep(i);
			if(error == -1)
				FormErrors = true;
		}
		$(form).data('errors',FormErrors);

		if(FormErrors === true){
			$('#finishButton').css({'background-color':'#d8d8d8','cursor':'auto'});
		}else{
		  $('#finishButton').css({'background-color':'#4797ED', 'cursor':'pointer'});
		}	
	}
	
	/*
	validates one fieldset
	and returns -1 if errors found, or 1 if not
	*/
	function validateStep(step){
		if(step == fieldsetCount) return;
		
		var error = 1;
		var hasError = false;
		$(form).children(':nth-child('+ parseInt(step) +')').find(':input:not(button)').each(function(){
			var $this = $(this);
			var valueLength = jQuery.trim($this.val()).length;
			
			if(valueLength == ''){
				hasError = true;
				$this.css('background-color','#FFEDEF');
			}
			else
				$this.css('background-color','#FFFFFF');	
		});
		var $link = $('#navigation li:nth-child(' + parseInt(step) + ') a');
		$link.parent().find('.error,.checked').remove();
		
		var valclass = 'checked';
		if(hasError){
			error = -1;
			valclass = 'error';
		}

		$('<span class="'+valclass+'"></span>').insertAfter($link);
		
		return error;
	}
	
	/*
	if there are errors don't allow the user to submit
	*/
	$('#finishButton').bind('click',function(){
		if($(form).data('errors')){
			return false;
		}	
	});
});
