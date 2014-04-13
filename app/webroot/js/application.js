placeholderSupport = ("placeholder" in document.createElement("input"));

if(!placeholderSupport ){
	$('[placeholder]').focus(function() {
	  var input = $(this);
	  if (input.val() == input.attr('placeholder')) {
		input.val('');
		input.removeClass('placeholder');
	  }
	}).blur(function() {
	  var input = $(this);
	  if (input.val() == '' || input.val() == input.attr('placeholder')) {
		input.addClass('placeholder');
		input.val(input.attr('placeholder'));
	  }
	}).blur().parents('form').submit(function() {
	  $(this).find('[placeholder]').each(function() {
		var input = $(this);
		if (input.val() == input.attr('placeholder')) {
		  input.val('');
		}
	  })
	});
}

$(document).delegate('form', 'submit', function(event) {
   var form = $(this);
   var status = '<img class="loading" src="/img/loading_detail.gif" alt="Loading..." />';
   var isAjax = form.attr('isajax');
   
   if(isAjax == 'false')
   {
		return true;
   }
   
   var parent = form.parent().parent();
   
   parent.find("#ajax").append(status);
   
	$.ajax({
		type: 'POST',
		url: form.attr('action'),
		data: form.serialize(),
	   success: function(ResponseJson) {
			var json = {};
			var html = ResponseJson;
			try{
				json = $.parseJSON(ResponseJson);
			}
			catch(e)
			{
			}
			
			//check for html
			if(json.html){
				parent.html(json.html);
			}
			//check for json error message or html
			if(json.error) {
				parent.find('#msg').css("color","red").html(json.error);
			}
			else if(json.message){
				parent.find('#msg').css("color","green").html(json.message);
			}
			//else{
			//	parent.html(html);
			//}
			
			if(json.redirect)
			{
				window.location = json.redirect;
			}
			
			$('.loading').remove();
		},
		error: function(xhr, status, err){
			parent.find('#msg').css("color","red").html('An unexpected error occured. Try reloading the page.');
			
			$('.loading').remove();
		}
	})
	
	return false;
   
});

//new functions

$.fn.delay = function(time, callback){
  // Empty function:
  jQuery.fx.step.delay = function(){};
  // Return meaningless animation, (will be added to queue)
  return this.animate({delay:1}, time, callback);
}

function closeDialog(modal) {
  $('#'+modal).modal('hide');
}

function ShowSignup(logged_in, modal){
    //if(!logged_in){
     $(modal).modal({
       keyboard: !1,
       backdrop: "static"
     });    
    //}
}

function getShowDialog(element, url){
  if ($(element).is(':empty') && url){
    $(element).load(url, {noncache: new Date().getTime()}, function(){
      $(this).modal();
    });
  }
  else{
    $(element).modal();
  }
}


// show the selected page
var current_menu = "";

// $(window).bind('hashchange', function() {
 	// var changehash = window.location.hash;
	// changehash = changehash.substr(1);

 	// if(changehash!=current_menu){	
		// if($("#"+changehash).length != ""){
			// show_menu(changehash, false);
		// }
	// }
// })

function show_menu(menu)//,load_from_hash)
{
	//if(window.location.hash && load_from_hash)
	//{
		//var thehash = window.location.hash;
		//show_menu(thehash.substr(1),false);
		//return false;
	//}
	if(current_menu!=menu)
		hide_menu()
	$("#"+menu).show()
	current_menu = menu;	
	$("."+menu).addClass("selected");
	window.location.hash = '#'+menu;
}

function hide_menu()
{
	if(current_menu!='')
	{
		$("#"+current_menu).hide(); 
		$("."+current_menu).removeClass("selected");
		return true;
	}
}

function set_current(current)
{
	current_menu = current;

	if(window.location.hash){
		var currenthash = window.location.hash;
		currenthash = currenthash.substr(1);
		if($("#"+currenthash).length != ""){
			show_menu(currenthash,false);
		}
		
	}
	$("."+current_menu).addClass("selected");
}

function getAllImages(container){
 $('.slider-thumb-list').empty();
 $(container).find('img').each(function(){
  img_src = $(this).attr('src');
  item = $(this).closest('.item').attr('data-itemid');
  html = '<li data-itemid="'+item+'"><img width="90" height="90" src="'+img_src+'"></img></li>';
  width = $('.slider-thumb-list').width();
  $('.slider-thumb-list').append(html).width(width+100);
});
 $('.slider-thumb-list img').click(function(){
  var product_id = $(this).parent().attr('data-itemid');
  $('#order-modal-form').load("/orders/"+product_id + '&rand='+new Date().getTime());
});
}

function initBackAndForward() {
  var context = this;
  this.thumbs_wrapper = $('.thumbnails');
  this.scroll_forward = $('#slider-forward');
  this.scroll_back = $('#slider-back');
  var has_scrolled = 0;
  var thumbs_scroll_interval = false;

  $(this.scroll_back).add(this.scroll_forward).click(
    function() {
          // We don't want to jump the whole width, since an image
          // might be cut at the edge
          var width = 80;
          var left = parseInt(context.thumbs_wrapper.css("left").replace("px"));
          var elem_width = context.thumbs_wrapper.width() - $('.item').width();
          var scroll_width = elem_width + left;
          
          if($(this).is('#slider-forward')) {
            if(scroll_width - width >= 0)
             left -= width;
          } else {
            if(left < 0)
             left += width;
          };
          
          context.thumbs_wrapper.animate({left: left +'px'});
          
          return false;
        }
        ).css('opacity', 0.6).hover(
        function() {
          var direction = 'left';
          if($(this).is('#slider-forward')) {
            direction = 'right';
          };
          thumbs_scroll_interval = setInterval(
            function() {
              has_scrolled++;
              var width = 2
              var left = parseInt(context.thumbs_wrapper.css("left").replace("px"));
              var elem_width = context.thumbs_wrapper.width() - $('.item').width();
              var scroll_width = elem_width + left;
              
              if(direction == 'right') {
                if(scroll_width - width >= 0)
                  left -= width;
              }
              
              if(direction == 'left') {
                if(left < 0)
                    left += width;
              };
              
               context.thumbs_wrapper.css({left: left +'px'});
            },
            10
            );
          $(this).css('opacity', 1);
        },
        function() {
          has_scrolled = 0;
          clearInterval(thumbs_scroll_interval);
          $(this).css('opacity', 0.6);
        }
        );
}

var product_id = null;
var cart_url = null;
var myModal = null;

function main(url){
    
    $('.dropdown').hover(function() {
        $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn();
        }, function() {
        $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut();
    });
    
    cart_url = url;
    
}

$(document).on("click", '.addtocart', function(e){
  var parent = $(this).closest('.product-list').find('div.product-image > img');
  parent = $(this).closest('[trans]');
  product_id = parent.attr('data-itemid');
  myModal = $('#myModal');
  var html = "";
  if(product_id != null)
    $.getJSON( '/orders/info?product='+product_id, function( item, status, xhr ) {
        if(item && item.action == "multiple")
        {
          $.each(
              item.product.components,
              function(value, data){
                var img = '<img src="/files/products/'+data.images[0][0]+'" ></img>'
                var name = '<strong>'+data.product_name+'</strong>'
                html += '<label class="checkbox"><input value="'+data.component_id+'" name="component" checked="checked" type="checkbox">'+name+'</label>';
              }
          );
          
          var main_img = '/files/products/'+item.product.images[0][0]
          myModal.find(".meal .controls").html(html);
          myModal.find('.meal .customize-img img').attr("src", main_img);
          myModal.modal('show');
        }
        else if(item && item.action == "single")
        {
            $.getJSON( '/orders/add?rand='+new Date().getTime()+'&product='+product_id, function( data, status, xhr ) {
              $("#cart-sidebar").load(cart_url  + '?rand='+new Date().getTime());
            });                    
        }
    });
  e.preventDefault();
});

$(document).on("click", ".btn-customize-order", function(a){
      var data = [];
      
      myModal.find('input[name=component]:checked').each(function(){
            var component_id = $(this).val();
            data.push({name:"component", value: component_id});
      });
      
      var d = myModal.find('input[name=drink]:checked').val();
      var s = myModal.find('input[name=side]:checked').val();
      
      data.push({name:"d", value:d});
      data.push({name:"s", value:s});
      
      if(data.length > 0)
      {
          $.getJSON( '/orders/add?rand='+new Date().getTime()+'&product='+product_id+'&'+$.param(data), function( data, status, xhr ) {
              data = [];
              html = "";
            myModal.modal('hide');
            $("#cart-sidebar").load(cart_url + '?rand='+new Date().getTime());
          });
      }
      
    a.preventDefault();
});
    
$(document).on('click', '.page-menu p', function(event) {
    pageMenu($(event.target).attr('href'));
});
  
  
$(document).on("click", '.thumbnail', function(){
    if( $(this).hasClass("remove") )
    {
        $(this).removeClass("remove");   
    }
    else{
        $(this).addClass("remove");   
    }
});

function cartValues(value, type)
{
	var total = $('.total-value');
	var tax = $('.tax-value');
	var subtotal = $('.subtotal-value');
	var price = parseInt(value);
	var c_total = parseInt(total.html().substring(1));
	var c_subtotal = parseInt(subtotal.html().substring(1));
	
	if(price)
	{
		if(type == 'inc')
		{
			total.html('$'+(price + c_total));
			subtotal.html('$'+(price + c_subtotal));
		}
		else if(type == 'dec')
		{
			total.html('$'+(c_total - price));
			subtotal.html('$'+(c_subtotal - price));
		}
	}
	
}

function addToQty(qty, data)
{
	if(qty && data)
	{
		var json = $.parseJSON(data);
		
		if(!json)
		{
			json = data;
		}
		
		if(json.html)
		{
			qty.html(json.html);
		}
		
		if(json.price)
		{
			cartValues(json.price, json.type);
		}
	}
}

  
$(document).on("click", '.qty-inc', function(e){
  var $this = $(this);
  var parent = $this.closest('tr');
  var product_id = parent.attr('data-itemid');
  if(product_id != null)
  {
    $.getJSON( '/orders/edit?rand='+new Date().getTime()+'&product='+product_id+'&inc', function( data, status, xhr ) {
		var qty = $this.closest('td');
		
		addToQty(qty, data);
		
		//$("#cart-sidebar").load(cart_url  + '?rand='+new Date().getTime());
    });
  }
  e.preventDefault();
});

$(document).on("click", '.qty-dec', function(e){
  var $this = $(this);
  var parent = $this.closest('tr');
  var product_id = parent.attr('data-itemid');
  if(product_id != null)
  {
    $.getJSON( '/orders/edit?rand='+new Date().getTime()+'&product='+product_id+'&dec', function( data, status, xhr ) {
		var qty = $this.closest('td');
		addToQty(qty, data);
      //$("#cart-sidebar").load(cart_url  + '?rand='+new Date().getTime());
    });
  }
  e.preventDefault();
});

$(document).on("click", '.remove-item', function(e){
  var parent = $(this).closest('tr');
  var product_id = parent.attr('data-itemid');

  if(product_id != null)
    $.getJSON( '/orders/remove?rand='+new Date().getTime()+'&product='+product_id, function( data, status, xhr ) {
      $("#cart-sidebar").load(cart_url + '?rand='+new Date().getTime());
    });

  e.preventDefault();

});

$(document).on("click", '.btn-checkout', function(e){
  if($(".cart-items .table tbody").html().trim() != '')
    $("#payment-modal").load("/payment"  + '?rand='+new Date().getTime(), function(){
        $(this).modal();
    });
    
  e.preventDefault();
});



function getMoreItems( container, page, prod_type, onComplete ){

      // Check to see if there is any existing AJAX call
      // from the list data. If there is, we want to return
      // out of this method - no reason to overload the
      // server with extraneous requests.
      if (container.data( "xhr" )){
        
      // Let the active AJAX request complete.
      return;

    }

      // Get a reference to the loader.
      var loader = $( "#loader" );

      // Update the text of the loader to denote AJAX
      // activity as the list items are retreived.
      loader.html('<img src="/static/img/bar_loading.gif"></img>');

      // Launch AJAX request for next set of results and
      // store the resultant XHR request with the container.
      container.data(
        "xhr",
        $.ajax({
          type: "get",
          url: '/products?page='+page+'&partial=1&catype='+prod_type,
          dataType: "json",
          success: function( response ){
                  // Append the response.
                  appendItems( container, response );
                  n +=1;
                },
                complete: function(response){
                  // Update the loader to denote no
                  // AJAX activity.
                  loader.find('img').remove();

                  // Remove the stored AJAX request. This
                  // will allow subsequent AJAX requests
                  // to execute.
                  container.removeData( "xhr" );

                  // Call the onComplete callback.
                  onComplete(response);
                }
              })
        );
    }


// I append the given list items to the given list.
function appendItems( container, items ){
      // Create an array to hold our HTML buffer - this will
      // be faster than creating individual DOM elements and
      // appending them piece-wise.
      var htmlBuffer = '';
      
      var media = '';
      var info = '';
      var img = '';
      var product_name = '';
      var product_price = '';
      var product_list = '';
      var addBtn = '';
      
      var htmlarray = '';

      // Loop over the array to create each LI element.
      $.each(
        items,
        function(value, data){


            //container.delay(100).queue(function(n) {

                  // Append the LI markup to the buffer.
                  
                  img = '<div class="product-image"><img  alt="" src="/files/products/'+data['images']+'" /></div>';
                  addBtn = '<div class="addtocart"><a class="btn-add-to-cart" href="#">ADD TO CART</a></div>';
                  product_name = '<p class="product-title">'+data['product_name']+'</p>';
                  product_price = '<p class="under-price"><b>$'+data['price']+'</b></p>'
                  info = '<div class="product-details">'+ addBtn+'</div>';
                  
                  product_list = '<div class="product-list">'+img+info+product_name+product_price+'</div>';
                  
                  
                  htmlBuffer = '<li trans="active" class="" data-itemid="'+ data['id'] +'" style="float:left;">' + product_list+'</li>';		  

                  
                  htmlarray += htmlBuffer;
                  //htmlBuffer = $(htmlBuffer)
                  
                  //htmlBuffer.imagesLoaded(function(){
                  //      container//.masonry({
                         //   itemSelector : '.item'
                        //})
                  //      .append(htmlBuffer)
                        //.masonry('appended', htmlBuffer, true)
                  //  })
                  //n();
            //});

}
);

htmlarray = $(htmlarray)

container.delay(100).queue(function(d) {
  container.append(htmlarray).css("height", "auto");

  d();
});
}

var n = 1;
var contentHeight = 841;

function scroll(limit, offset, prod_type){

  var pageHeight = document.documentElement.clientHeight;
  var scrollPosition;

  if(navigator.appName == "Microsoft Internet Explorer")
    scrollPosition = document.documentElement.scrollTop;
  else
    scrollPosition = window.pageYOffset;
  if((contentHeight - pageHeight - scrollPosition) < 10){
    if(n <=limit-offset){
      contentHeight += 441;
      getMoreItems($('.infinite-scrolling'), n+offset, prod_type,function(data){
                    //getAllImages('.infinite-scrolling');
                  } );

    }
  }
}