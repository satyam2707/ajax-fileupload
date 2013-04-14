/*
 * @jQuery Plugin: Upload file by ajax(using iframe)
 * @Version : 1.0
 * @Author  : Satyam Kumawat 
 * @Created : April 2013
 * choose which one suits your project best!
 *
 */

(function($){
   var defaults =  {'frameId'   :'photoUploadIframe',
 					'frameName' :'photoUploadIframe',
 					'multiple'  : false ,
 					'callBack'  :'response'
                   };
                   
   var methods = {
  				   /*
  				    * like a constructor call once plugin is initialized
  				    */
				   init : function(src,options){	
						element = this;
						return this.each(function(i,e){	
							defaults.formAction = src;
							settings =  methods.saveOptions(element,options)
							$(this).bind('change',methods.change);
							methods.createFrame(element);
						  });
					},
				   /*
					* save settings in element data
					* @params : object element,object settings
					*/
					saveOptions : function(element,options){
	    				settings = $.extend({},defaults,options || {});		
						element.data('settings',settings);	
						
						if(settings.multiple){
							$(element).attr('multiple','multiple');
						}
						return settings;		    	
					},
				   /*
					* Handle file upload on change event of file
					*
					*/
			        change : function(){
				  
						$(this).closest('form').attr('action', $(this).data('settings').formAction).attr('target',$(this).data('settings').frameId).submit();
						methods.progressBar();
				   },
				    /*
					* create the iframe of each file input element
					* @params : object element
					*/
		           createFrame :function(element){
				       
					   iframe = $("<iframe name='"+ $(element).data('settings').frameName + "' id='"+$(element).data('settings').frameId+"'/>")
						   			.css({'display':'none'})
							        .bind('load',function(){
							        	var response = $('#'+ $(element).data('settings').frameId).contents().find('body').text();
										if(response){
			    							 try{
			       								 response = $.parseJSON(response);
			       								 
			       								 uploadResponse(response);
			       								 methods.clearFrame($(element).data('settings').frameId);
			       								  
			       								}
			       								 catch(e){
											    	alert(e+ '\n'+response);
											    }
											    $('.loader').hide();	
										  }		           
							          })
							         .appendTo('body');
			     },
			    /*
				* create the iframe of each file input element
				* @params : object element
				*/
	  			progressBar: function(){
	  				
	  				$('.loader').remove();
		       		 $('<div class="loader">').html('&nbsp;').insertBefore('#preview'); 
				},
			   /*
			    * clear the target of the form
			    * @params : id of the form{$('#formid').fileupload('clearTarget')}
			    */
				clearTarget: function(){
					$(this).removeAttr('target');
			    },
			   /*
			    * clear the iframe after getting the response
			    */
	   		    clearFrame : function(e){
	   		    	
			  		//$('#'+e).contents().find('body').html('');			
				}
		
		
}
				
	
    $.fn.fileupload = function(method)
	{  
        if(methods[method]){
        	return methods[method].apply(this,Array.prototype.slice.call(arguments,1));   	
        }else{	
             if(typeof method == 'string'){
				return  methods.init.apply(this,arguments);
			}else{
				 if(typeof method == 'object'){
				 	alert("Please follow the below standard to apply this plugin \n $('#file').fileupload('upload.php',{'frameId':'frame','frameName':'frame'});");
			    }else
			    {
			    	alert( 'Method ' +  method + ' does not exist in  jQuery.fileupload' );
			    }
			}
		}	
			
	}
})(jQuery);
	