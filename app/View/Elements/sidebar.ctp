<style>
	div.enter_todo {
		/*margin: 20px 50px;
		height:25px;
		width:100%;*/
		padding: 7px 20px;
		background: #eee;
		border:1px solid #aaa;
	}
	
	div.todo_list {
		/*margin: 10px 50px;*/				
	}
	
	div.todo_list > div.todo {
		background: #eeeeff;
		/*min-width:350px;
		max-width:600px;*/
		min-height:25px;	
		padding-top:2px;	
		margin-top:1px;
	}
	
	div.todo_list > div.todo > div {
		float:left;		
	}
	
	div.todo_list > div.todo > div.todo_description {
		margin-left:5px;
	}
	
	div.todo_list div.checked {
		text-decoration: line-through;
		background: #eee;
	}
</style>
<script type="text/javascript">  
  $(document).ready(function() { 
	  $(".box_main").show();        
	  $('#menu ul').hide();        
	  $('#menu li a').click(function() { $(this).next().slideToggle('easing');});
	  $('#box_link').toggle(
				function() {            
					$('.box_main').animate({  width: "auto" }, 700, 
						function() {                
							$('.box_main').hide();                
							$('#box_img').attr("src", "/img/qm.png");            
						}
					);        
				},  
				function() {            
					$('.box_main').show( function() { 
											$('.box_main').animate({  width: "300"}, 700);            
											}
										);                
											
					$('#box_img').attr("src", "/img/close.png");        
				}
			); 

		$('#add_todo').click( function() {
			var todoDescription = $('#todo_description').val();
			if(todoDescription.trim() != "")
			{
				$('.todo_list').prepend('<div class="todo">'
					+ '<div>'
						+ '<input type="checkbox" class="check_todo" name="check_todo"/>'
					+ '</div>'
					+ '<div class="todo_description">'
						+ todoDescription
					+ '</div>'
				+ '</div>');
				
				$('#todo_form')[0].reset();
				
				$('.check_todo').unbind('click');
				$('.check_todo').click( function() {
					var todo = $(this).parent().parent().children('.todo_description');
					console.log(todo);
					todo.toggleClass('checked');
				});
			
			}
			return false;		
		}); 			
  });
</script>
<div class="box_wrap">
	<div class="box_main">
		<ul id="menu">		
			<li>	
				<a href="#">
					<img class="big-illustration-pusher" src="/img/clipboard.png"/>
					<span>Todo List</span>
				</a>
				<ul>                
					<div class="content">
						<div class="enter_todo">
						  <form id="todo_form" action="/todos" method="POST">
							<input id="todo_description" name="todo_description" size="55" type="text" />
							<input id="add_todo" type="submit" value="Add" />
						  </form>
						</div>
						<div class="todo_list">
						</div>						
					</div>	      
				</ul>	  
			</li>		
			<!--<li> 
				<a href="#">
					<img src="/img/mail.png"/>
					<span>Contact Us</span>
				</a>	
				<ul>				
					<div class="content">
					  <form id="form1" name="form1" method="post" action="">
						  <label>				    
						  Name<br />				    
							<input type="text" name="textfield" id="textfield" />				   
						  <br />				    
						  Email				    
						  <br />                  
						  </label>				  
						  <label>				    
							<input type="text" name="textfield2" id="textfield2" />			        
						  <br />			        
						  Message			        
						  <br />			        
							<textarea name="textarea" id="textarea" cols="20" rows="3"></textarea>			       
						  <br />				  
						  </label>				  
						  <label>				    
							<input type="submit" name="button" id="button" value="Submit" />			      
						  </label>              
					  </form>				
					</div>            
				</ul>			
			  <ul>
				<div class="content">  <p><strong>This is some about text.</strong></p> </p></div>
			  </ul>	  
		  </li>-->	
		</ul>
	</div>        
	<div class="box_button">    
	  <a style="display:block;" href="#" id="box_link">    
		<img id="box_img" src="/img/close.png" width="50" height="50" border="0" />    
	  </a>    
	</div>
 </div>