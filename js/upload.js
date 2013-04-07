(function($)
	  {
	    var settings ={};
	  	var methods = {
					   _init : function()
						{					
						  methods._createFrame();						
						},
					  _createFrame : function()
						{
						   iframe = $("<iframe name='photoUploadIframe' id='photoUploadIframe'/>")
						   			.css({'display':'none'})
							        .bind('load',function(){
							        	
							        	var response = $('#photoUploadIframe').contents().find('body').text();
										if(response){
			    							 try{
			       								 response = $.parseJSON(response);
			       								 uploadResponse(response);
			       								}
			       								 catch(e){
											    	alert(e+ '\n'+response);
											    }
											    $('.loader').hide();	
										  }		           
							          })
							         .appendTo('body')
						
							return iframe;
						},
						_change :function()
						{						
							$('form').attr('target','photoUploadIframe').submit();
							methods._progressBar();
							
						},
				        _progressBar :function()
						{
					        $('<div class="loader">').html('&nbsp;').insertBefore('#preview');
					       
						    
						}
				}
				
		
        $.fn.fileupload = function(options)
		{
			settings = options;
			$(this).bind('change',function()
		    {
			  methods['_change'].apply();
            });	
            	
			return  methods['_init'].apply();	
				
		}
})(jQuery);
	