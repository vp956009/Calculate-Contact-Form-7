jQuery(document).ready(function() {
	if ( jQuery( ".wpcf7-form" ).length ) {

		occostcf7_customradiobtn();
		occostcf7_formulas();


		jQuery("body").on("change",".wpcf7 input,.wpcf7 select",function(e){
			occostcf7_formulas();
		})



		jQuery("input[type='number']").bind('keyup', function () {
		  	occostcf7_formulas();
		})



		jQuery("input[type='text']").bind('keyup', function () {
		  	occostcf7_formulas();
		})



		function occostcf7_customradiobtn(){
			jQuery("form.wpcf7-form input").each(function (index) { 
	       		if( jQuery(this).attr("type") == "radio" || jQuery(this).attr("type") == "checkbox" ) {
	       			var inputval = jQuery(this).attr("value");

	       			if(inputval.indexOf("--") != -1){
		       			jQuery(this).val('');
		       			jQuery(this).parent().find('span.wpcf7-list-item-label').text('Required Pro Version for add Custom Label');  
	       			}
	       		}
	       	})
			jQuery("form.wpcf7-form select option").each(function (index) {
		       	if(jQuery(this).attr("type") === undefined) {
		       		var selectval = jQuery(this).attr("value");
		       		if(selectval.indexOf("--") != -1){
			       		jQuery(this).attr("value",'');
			       		jQuery(this).text('Required Pro Version for add Custom Label');
		       		}		
		       	}
	       	})  
		}


		function occostcf7_formulas(){
		   	var total = 0;
	       	var match;
	       	var reg =[]; 

	      	jQuery("form.wpcf7-form input").each(function () { 
	       		if( jQuery(this).attr("type") == "checkbox" || jQuery(this).attr("type") == "radio"  ) {
	       			var name = jQuery(this).attr("name").replace("[]", "");
	       			reg.push(name);
	       			//alert($(this).attr("name"));
	       		}else{
	       			reg.push(jQuery(this).attr("name"));
	       		}
	       	})

	       	jQuery("form.wpcf7-form select").each(function () {
	       		var name_select = jQuery(this).attr("name").replace("[]", "");
	       		reg.push(name_select);
	       	})

	       	reg = costcf7duplicates_type(reg);
	       	var all_tag = new RegExp( reg.join("|"));
	       	jQuery( ".occf7cal-total" ).each(function( index ) {
	       		var precision = jQuery(this).attr("precision");
	       		var prefix = jQuery(this).attr("prefix");
	       		var eq = jQuery(this).data('formulas');
	       		var type = '';
	       		if(eq != '' || eq.length != 0){
					while ( match = all_tag.exec( eq ) ){
						var perfact_match = costcf7wordInString(eq,match[0]);
						if(perfact_match != false){
							var type = jQuery("input[name="+match[0]+"]").attr("type");
							if( type === undefined ) {
								var type = jQuery("input[name='"+match[0]+"[]']").attr("type");
							}
							//console.log(type);
							if( type =="checkbox" ){
								var vl = 0;
								jQuery("input[name='"+match[0]+"[]']:checked").each(function () {
									var attr = jQuery(this).attr('price');
									//console.log(attr);
									if (typeof attr !== typeof undefined && attr !== false) {
										vl += new Number(attr);
									} else {
										vl += new Number(jQuery(this).val());
									}
								});
							}else if( type == "radio"){
								var attr = jQuery("input[name='"+match[0]+"']:checked").attr('price');
								if (typeof attr !== typeof undefined && attr !== false) {
									var vl = attr;
								} else {
									 var vl = jQuery("input[name='"+match[0]+"']:checked").val();
								}
							}else if( type === undefined ){
								var check_select = jQuery("select[name="+match[0]+"]").val();
								//console.log('--'+check_select+'--')
								if(check_select === undefined){
									var vl = 0;
									jQuery("select[name='"+match[0]+"[]'] option:selected").each(function () {
										var attr = jQuery(this).attr('price');
										if (typeof attr !== typeof undefined && attr !== false) {
											vl += new Number(attr);
										} else {
											vl += new Number(jQuery(this).val());
										}
									});
								} else {
									var vl = 0;
									jQuery("select[name="+match[0]+"] option:selected").each(function () {
										var attr = jQuery(this).attr('price');
										if (typeof attr !== typeof undefined && attr !== false) {
											vl += new Number(attr);
										} else {
											vl += new Number(jQuery(this).val());
										}
									});
								}
							}else{
								var attr = jQuery("input[name="+match[0]+"]").attr('price');
								if (typeof attr !== typeof undefined && attr !== false) {
								    var vl = attr;
								} else {
									var vl = jQuery("input[name="+match[0]+"]").val();	
								}
							}
							if(!jQuery.isNumeric(vl)){
								vl = 0;
								//alert("value must be numeric");
							}
						}else{
						 	var error = 1;
						}
						eq = eq.replace( match[0], vl );
						nueq = '';
						neq = eq;
						var neqf = '';
						if(eq.indexOf("sqrt") != -1){
							var neweq = eq.split(" ");
							for(var i = 0; i < neweq.length; i++){
								if(neweq[i].indexOf("sqrt") != -1){
								   var sqrt = neweq[i].match("sqrt((.*))");
								   var sqrtd = sqrt[1].replace(/[()]/g,'')
								   var sqrtroot = Math.sqrt(parseInt(sqrtd));
								   neq = neq.replace( sqrt[1], sqrtroot );
								}     
						     }
						     nueq = neq.split("sqrt").join('');
						}
						if(nueq === ''){
							neqf = eq;
						} else {
						 	neqf = nueq;
						}
					}
	       		}else{
	       			alert("Please Enter Formula in Calculator");
	       			return false;
	       		}
	       		if(error == 1){
	       			alert("Please Enter Valid Formula in Calculator");
	       			return false;
	       		}
				try{
					var fresult = ''; 
				    var r = eval( neqf ); // Evaluate the final equation
				    if( precision != undefined ) {
				      	fresult = r.toFixed(precision);
					} else {
						fresult = r;
					}

					total = fresult;
					//console.log('--'+total);

				}
				catch(e)
				{
					alert( "Error:" + neqf );
				}

				if(index === 0){
					if( prefix != undefined ) {
						jQuery(this).val(prefix + total);
					}else{
						jQuery(this).val(total);
					}
				} else {
					jQuery(this).val('Required Pro Version for add Custom Label');
				}
			});
		}
	}
	
	jQuery(".costcf7caloc_slider_div").each(function() {
     	var step=jQuery(this).attr("step");
	    var min=jQuery(this).attr("min");
	    var max=jQuery(this).attr("max");
	    var istep = parseInt(step);
	    var imin = parseInt(min);
	    var imax = parseInt(max);
	    var prefixx=jQuery(this).attr("prefix");
	    var prefixpos=jQuery(this).attr("prefixpos");
	    var color=jQuery(this).attr("color");
	    var caltoltip=jQuery(this).attr("caltoltip");
	    
	    var current_attr = jQuery(this);
	    if(caltoltip == "top"){
	    	var costcf7tooltip = jQuery('<div id="ctooltip" class="costcf7top"/>').css({
		        top: -35,
		    })
	    }
	    if(caltoltip == "right"){
	    	var costcf7tooltip = jQuery('<div id="ctooltip" class="costcf7right"/>').css({ 
		        left: 35			    
		    })
	    }
	    if(caltoltip == "bottom"){
	    	var costcf7tooltip = jQuery('<div id="ctooltip" class="costcf7bottom"/>').css({
		        bottom: -35
		    })
	    }
	    if(caltoltip == "left"){
	    	var costcf7tooltip = jQuery('<div id="ctooltip" class="costcf7left"/>').css({
		        right: 35
		    })
	    }
	    
	    

	    if(prefixx == null){
	    	prefix = " ";
	    }else{
	    	prefix = prefixx;
	    }

	    if(prefixpos == "left") {
	        costcf7tooltip.text(prefix + min);
	    }else {  
	        costcf7tooltip.text(min + prefix);        
	    }
	

	    jQuery(this).slider({
	        step:istep,
	        min:imin,
	        max:imax,
	        values: imin,
	        create: attachSlider,
	        slide: function( event, ui ) {
	        	current_attr.find(".costcf7caloc_slider").val(ui.value);
	        	
	        	occostcf7_formulas();
	        	var clr = jQuery(this).attr("color");
	        	var pre = jQuery(this).attr("prefix");
	        	if(pre == null){
			    	prefix = " ";
			    }else{
			    	prefix = pre;
			    }
	        	

		    	if(prefixpos == "left"){
	                current_attr.find("#ctooltip").text(prefix  + ui.value);  
	            }else {
	               current_attr.find("#ctooltip").text(ui.value + prefix);
	            }

			   	current_attr.find(".ui-state-default").css("background-color",clr); 
	        }        
		}).find(".ui-slider-handle").append(costcf7tooltip).hover(function() {
	    	costcf7tooltip.show()
	    })
	    function attachSlider() {
	        jQuery(this).find(".ui-slider-handle").css("background-color",color);
	    }
	});
	
	

	function costcf7duplicates_type(arr) {
	    var obj = {};
	    var ret_arr = [];
	    for (var i = 0; i < arr.length; i++) {
	        obj[arr[i]] = true;
	    }
	    //console.log(obj);
	    for (var key in obj) {
	    	if("_wpcf7" == key || "_wpcf7_version" == key  || "_wpcf7_locale" == key  || "_wpcf7_unit_tag" == key || "_wpnonce" == key || "undefined" == key  || "_wpcf7_container_post" == key || "_wpcf7_nonce" == key  ){

	    	}else {
	    		ret_arr.push(key);
	    	}
	    }
	    return ret_arr;
	}


	function costcf7wordInString(s, word){
	  return new RegExp( '\\b' + word + '\\b', 'i').test(s);
	}

});