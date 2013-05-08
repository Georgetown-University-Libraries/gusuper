//if (Drupal.jsEnabled){
	jQuery(document).ready(function(){
		jQuery("#search-form").parent().find("ol.search-results").replaceWith("<div class='box'/>");
		jQuery("#search-form").parent().find("div.box").load("/gusuper/combotemplate", null, cbSearch);
	});	
//}

var cbSearch = function(responseText, textStatus, xhr) {
	jQuery("dl.search-results").append(jQuery(responseText));
	var query = escape(jQuery("#edit-keys").val());
	if (jQuery("#gusearch-libsite").is("*")) {
		jQuery("#gusearch-libsite").load("/gusuper/libsite/" + query, null, cb);			
	}
	if (jQuery("#gusearch-libguideapi").is("*")) {
		jQuery("#gusearch-libguideapi").load("/gusuper/libguideapi/" + query, null, cb);			
	}
	if (jQuery("#gusearch-dspacehtml").is("*")) {
		jQuery("#gusearch-dspacehtml").load("/gusuper/dspacehtml/" + query, null, cb);
	}
	if (jQuery("#gusearch-dspacesolr").is("*")) {
		jQuery("#gusearch-dspacesolr").load("/gusuper/dspacesolr/" + query, null, cb);
	}
	if (jQuery("#gusearch-libanswer").is("*")) {
		jQuery("#gusearch-libanswer").load("/gusuper/libanswer/" + query, null, cb);
	}
}


var cb = function(responseText, textStatus, xhr) {
	if (textStatus == "error") {
		jQuery(this).html("<div class='combo-summary'>Search request cannot be submitted at this time.</div>");
	}
	if (responseText == "") {
		jQuery(this).html("<div class='combo-summary'>Search request cannot be submitted at this time.</div>");
	}
}
