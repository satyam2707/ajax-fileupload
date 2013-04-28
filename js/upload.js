/*
 * @jQuery Plugin: Upload file by ajax(using iframe)
 * @Version : 1.0
 * @Author  : Satyam Kumawat 
 * @Created : April 2013
 * choose which one suits your project best!
 *
 */

(function($){
   var defaults =  {frameId   :'photoUploadIframe',
 					multiple  : false ,
 					onComplete  : null,
 					beforeSend  : true ,/* set false to disable*/ 
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

							if($(this).attr('type') =='file'){
								$(this).bind('change',methods.change);
							}else{
								$(this).bind('click',methods.submit);
							}
							
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
					* Handle file upload on change event of file (if plugin is applied to the file element)
					*/
			        change : function(){
				  
						$(this).closest('form').attr('action', $(this).data('settings').formAction).attr('target',$(this).data('settings').frameId).submit();
						methods.beforeSend(this);
						
				   },
				   /*
					* Handle file upload on submit button click (if plugin is applied to the submit element)
					*/
				   submit : function(){
						
					   methods.beforeSend(this);
					   $(this).closest('form').attr('action', $(this).data('settings').formAction).attr('target',$(this).data('settings').frameId).submit();
					   return false;
				   },
				    /*
					* create the iframe of each file input element
					* @params : object element
					*/
		           createFrame :function(element){
				       
					   iframe = $("<iframe name='"+ $(element).data('settings').frameId + "' id='"+$(element).data('settings').frameId+"'/>")
						   			.css({'display':'none'})
							        .bind('load',function(){
							        	var response = $('#'+ $(element).data('settings').frameId).contents().find('body').text();
										if(response){
			    							 try{
			       								 response = $.parseJSON(response);
			       								
			       								 if($.isFunction($(element).data('settings').onComplete)){
			       									$(element).data('settings').onComplete.call(element,response);
			       								 }else{
			       									 $.error('onComplete call back not found.Please view example scripts')
			       									 return false;
			       								 }
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
			     beforeSend: function(element){
	  				
			    	 if($(element).data('settings').beforeSend){
			    		 if($.isFunction($(element).data('settings').beforeSend)){
			    			 $(element).data('settings').beforeSend.call();
			    		 }else{
				       		 $('<div class="loader">').html('&nbsp;').insertAfter(element); 
			    		 }
			    	 }
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
	   		    	
			  		$('#'+e).contents().find('body').html('');			
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
	