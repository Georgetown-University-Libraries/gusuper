//if (Drupal.jsEnabled){
	jQuery(document).ready(function(){
		var sf = jQuery("#search-form");
		var path = sf.attr("action").replace("/search/gusuper","/gusuper") + "/combotemplate";
		sf.parent().find("ol.search-results").replaceWith("<div class='box'/>");
		sf.parent().find("div.box").load(path, null, cbSearch);
	});	
//}

var cbSearch = function(responseText, textStatus, xhr) {
	var sf = jQuery("#search-form");
	var path = sf.attr("action").replace("/search/gusuper","/gusuper");
	jQuery("dl.search-results").append(jQuery(responseText));
	var query = escape(jQuery("#edit-keys").val());
	if (jQuery("#gusearch-libsite").is("*")) {
		jQuery("#gusearch-libsite").load(path + "/libsite/" + query, null, cb);			
	}
	if (jQuery("#gusearch-libguideapi").is("*")) {
		jQuery("#gusearch-libguideapi").load(path + "/libguideapi/" + query, null, cb);			
	}
	if (jQuery("#gusearch-dspacehtml").is("*")) {
		jQuery("#gusearch-dspacehtml").load(path + "/dspacehtml/" + query, null, cb);
	}
	if (jQuery("#gusearch-dspacesolr").is("*")) {
		jQuery("#gusearch-dspacesolr").load(path + "/dspacesolr/" + query, null, cb);
	}
	if (jQuery("#gusearch-libanswer").is("*")) {
		jQuery("#gusearch-libanswer").load(path + "/libanswer/" + query, null, cb);
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
