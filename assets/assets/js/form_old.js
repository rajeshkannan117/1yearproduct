(function(w,d,$){
	$(d).ready(function(){
		var rowid = 1;
		var form_rows = 1;
		var colid = 1;
		var comptField = 1;
		var dialog;
		var todrag = $("#basic li span,#group li span,#advanced li span");
		var pages = $("#pages");
		var cols = $(".connected"); 
		todrag.draggable({
		  containment : "#container",
	      helper: "clone",
      	  start:function(){
      	  	//$(this).addClass('addField');
      	  	var dragstart = '<li class="rows uk-width-1-1" id="rows_'+rowid+'"><ul id="rows_'+rowid+'" class="connected"></ul></li>';
  	      	$(dragstart).droppable( droppable ).appendTo(pages);
  	      	rowid++;

      	   },
      	   drag:function(event,ui){
      	   		$(ui.helper).width(125),$(ui.helper).addClass("addField"),$(ui.helper).find("p").show()
      	   	},zIndex:999,
      	   stop:function(){
      	   	$(this).removeClass('addField');
      	   }

   		});
		pages.children(':first').droppable(droppable);
		var droppable ={
			//activeClass: 'dragHover',
			//hoverClass: 'split',
			drop: function( event, ui) {
				var type = ui.draggable.attr("value");
				var row_id = $(event.target).attr('id');
				var collength = common.countcollength(row_id);
				if(type !== undefined){
					if(collength <= 3){
	            		html = $('#config_'+type).html();
	            		/* Set individual required field as unique id */
	            		reg = new RegExp("(text_check)", "g");
            			html = html.replace(reg, 'text_check_'+comptField);
            			/* Set individual edits field as unique id */
            			reg = new RegExp("(edits)", "g");
            			html = html.replace(reg, 'edits_'+comptField);
            			/* Set individual options as field as unique id */
            			reg = new RegExp("(choices)", "g");
            			html = html.replace(reg, 'choices_'+comptField);
            			reg = new RegExp("(open_options)", "g");
            			html = html.replace(reg, 'open_options_'+comptField);
	            		var append_div = '<li class="columns uk-width-1-'+collength+'" id="columns_'+collength+'"><div class="cols uk-width-1-'+form_rows+' '+type+'_'+colid+'"><div class="uk-panel config_'+type+' portlet">'+html+'</div></div></li>'; 
	            		$('ul#'+row_id).append(append_div);
	            		common.auto_update_text();
	            		if(type === 'radio' || type === 'checkbox' || type === 'select'){
	            			dialog = popup_initialize('choices_'+comptField,this,type);
	            			common.options_open(type,type+'_'+colid,'choices_'+comptField,dialog);
	            			common.open_dialog(type,type+'_'+colid,'choices_'+comptField,'open_options_'+comptField,dialog);
	            		}
	            		colid++;
	            		var rows = $('.rows');
	            		/* Remove li has zero columns */
	            		rows.each(function(){
	            			var length = $('ul.connected',this).find('li.columns').size();
	            			if(length === 0){
	            				$(this).remove();
	            			}else{
		            			$id = $('ul.connected',this).attr('id');
		            			if($id !== undefined){
		            				//console.log($id);
		            			}
	            		    }
	            		});
	            		/* Resize the column width based upon its size */
	            		$('.resize').each(function(){
	            			var length = $('ul.connected',this).find('li.columns').size();
		        			if(length <= 3){
			        			var width ='uk-width-1-'+length;
			        			var columns = $('.columns');
			        			$('.columns',this).each(function(){
			        				$(this).removeClass().addClass(width).addClass('columns').css('width','');
			        			});
		        		    }
		        		    $(this).removeClass('resize');
	            		});
	            		if($("#"+row_id).hasClass("dropover")){
							$("#"+row_id).removeClass('dropover');
						}
						if($("#"+row_id).find('.columns').hasClass("dropovers")){
							$("#"+row_id).removeClass('dropovers');
						}
	            	}	
	            	else{
	            		return false;
	            	}
            	}
            	comptField++;
			},
			over :function(event,ui){
				var rowid = $(event.target).attr('id');
				var colcount = $('#'+rowid).find('.columns').length;
				if(colcount === 1){
					width = 100/2+'%';
					$('#'+rowid).find('.columns').css('width',width);
					//$('#'+rowid)
				}else if(colcount === 2){
					width = 100/3+'%';
					$('#'+rowid).find('.columns').css('width',width);
					//$('#'+rowid)
				}
				var rows = $('.rows');
        		rows.each(function(){
        			if($(this).hasClass('dropover')){
        				$(this).removeClass('dropover');
        			}
        			if($(this).find('.test')){
        				$(this).find('.test').remove();
        			}
        		});
				var over_id = $('li.columns','ul#'+rowid).last().attr('id');
				if(over_id != undefined){
					$('#'+rowid+' li#'+over_id).after('<div class="test">adf</div>');
				}
				//console.log("Over "+rowid+" Count "+colcount);
					
        		$('#'+rowid).addClass('dropover resize');
        		$('#'+rowid).find('.columns').addClass('dropovers');
			},
		}
		$(d).on("mouseout",".title_labels" ,function () {
            var txt = $(this).val();
            current = $(this).parent().parent();
            var type = $(current).find('.required').data('type');
            console.log(type);
            var input = '<b class="info">Click text to edit</b>';
            if(type != 'select' && type != 'radio' & type != 'checkbox'){
            	//input = '<br/><input type="'+type+'" />'; 
            }
            $(this).replaceWith("<label class='title_label'>"+txt+"</label>"+input);
        });
        $(d).on("click",'.edit_field',function(){
        	//UIkit.modal.prompt('Name:','', function(val){ Console.log(val) });
        });
        $(d).on("mouseover",".columns",function(){
        	var id = $(this).find('.action').attr('id');
        	$('#'+id).show();
        	$(this).addClass('hover');
        });
	    $(d).on("mouseout",".columns",function(){
        	var id = $(this).find('.action').attr('id');
        	$('#'+id).hide();
        	$(this).removeClass('hover');
	    });
	    $(d).on('click','.required',function(){
	    	var type = $(this).data('type');
	    	if(type === 'select' || type === 'radio' || type === 'checkbox'){
	    		grandparent = $(this).parent().parent().parent();	
	    	}else{
	    		grandparent = $(this).parent().parent();
	    	}
	    	if($(this).is(':checked')){
	    		$(grandparent).find('.title_label').append('<span class="req">*</span>');
	    	}else{
	    		$(grandparent).find('span.req').remove();
	    	}
	    });
	    $(d).on('click','.delete_field',function(){
	    	grand_parent = $(this).parent().parent().parent().parent().parent().parent().parent().attr('id');
	    	parent = $(this).parent().parent().parent().parent().parent().parent().attr('id');
	    	UIkit.modal.confirm('Are you sure, you want to delete this row?', 
                function(){
                	//$("#"+parent).slideUp('fast',function(){	
                		console.log(parent);
                    	$("ul#"+grand_parent+" #"+parent).remove();
                   	//});
                   	var length = $('ul#'+grand_parent).find('.columns').size();
        			if(length <= 3 && length != 0){
	        			var width ='uk-width-1-'+length;
	        			var columns = $('.columns');
	        			$('ul#'+grand_parent+' .columns').each(function(){
	        				//$(this).
	        				$(this).removeClass().addClass(width).addClass('columns',400,'easeInBack');
	        			});
        		    }else if(length == 0){
        		    	$('ul#'+grand_parent).parent().remove();
        		    }
            });
	    	
	    });
		function popup_initialize(popupid,current,type){
			var dialog = $(current).find('#'+popupid).dialog({
		      title: type+" Options",
		      height: "auto",
		      width: "auto",
		      modal: true,
		      buttons: {
		      	"ok" :function(){
		      		switch(type){
		      			case 'select':
		      				var select = '<select id="'+popupid+'">';
				      		var html = '';
				      		$('#'+popupid).find('.select_label').each(function(){
				      			html += '<option><span class="title_value" data-optionid="0">'+$(this).val()+'</option></option>';
				      		})
				      		select += html;
				      		select +='</select>';
		      				break;
		      			case 'radio':
		      				var select = '';
				      		$('#'+popupid).find('.select_label').each(function(){
				      			select += '<input type="radio"/><span class="title_value" data-optionid="0">'+$(this).val()+'</span>';
				      		})
		      				break;
		      			case 'checkbox':
		      				var select = '';
				      		$('#'+popupid).find('.select_label').each(function(){
				      			select += '<input type="checkbox"/><span class="title_value" data-optionid="0">'+$(this).val()+'</span>';
				      		})
		      				break;	
		      		}
		      		$(current).find('.select').empty().append(select);
		      		$(this).dialog( "close" );
		      	},
		        Cancel: function() {
		          $(this).dialog( "close" );
		        }
		      },
			});
			return dialog;
		}
		var common = {
			countcollength :function(rowid){	
				var colcount = $('#'+rowid).find('div.cols').size();
				//console.log(colcount+" Column "+" in "+rowid);
				return ++colcount;
			},
			auto_update_text:function(){
		        $(d).on("click",'label.title_label', function () {
		            var current = $(this).parent().parent();
		            
		            var txt = $(this).text();
		            $(".title_label",current).replaceWith('<input class="title_labels" value="'+txt+'"/>');
		            $(".info",current).remove();
		        });
        	},
        	open_dialog:function(type,selectedid,popupid,optionid,dialog){
        		$('.'+optionid).click(function(){
        			dialog.dialog( "open" );
        		});
        	},
        	options_open:function(type,selectedid,popupid,dialog){
        		console.log(selectedid);
        		//$('.'+selectedid).click(function(){
        			//console.log('clicked');
				   // dialog.dialog( "open" );
	        		var max_fields      = 10; //maximum input boxes allowed
	    			var wrapper         = $("element"); //Fields wrapper
	    			var add_button      = $(".add_field_button"); //Add button ID
	    			var x = 1;
				    $(add_button).on("click",function(e){ //on add input button click
				    	 //initlal text box count
				        e.preventDefault();
				        if(x < max_fields){ //max input box allowed
				            x++; //text box increment
				            $(wrapper).append('<p><br/><input type="text" name="mytext[]" class="select_label"/><a href="#" class="remove_field ui-button-icon ui-icon ui-icon-closethick"></a></p>'); //add input box
				        }else{
				        	$(wrapper).prepend('Limited only for trial version');
				        }
				        return false;
				    });
				    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
				        e.preventDefault();
				        $(this).parent('p').remove(); 

				        x--;
				    });
				    return false;
			   // });
        	},
        	options_close:function(type,selectedid,popupid,dialog){
        		$(d).on('click','.options_cancel',function(){
        			console.log('here');
        		});
        	}
        }
	});
}(window,document,window.jQuery));