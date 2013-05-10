/**
 * @file
 * Triggers individual searches via ajax.  If any component search is unavailable, other searches will still return values.
 */

//See http://drupal.org/node/1446420 for an explanation of this construct
//See http://www.adequatelygood.com/JavaScript-Module-Pattern-In-Depth.html for more explanation of the wrapper

(function ($) {
  $(document).ready(function(){
	$("#search-form").parent().find("ol.search-results").replaceWith("<div class='box'/>");
	$("#search-form").parent().find("div.box").load("/gusuper/combotemplate", null, cbSearch);
  });	

  var cbSearch = function(responseText, textStatus, xhr) {
	$("dl.search-results").append($(responseText));
	var query = escape($("#edit-keys").val());
	if ($("#gusearch-libsite").is("*")) {
		$("#gusearch-libsite").load("/gusuper/libsite/" + query, null, cb);			
	}
	if ($("#gusearch-libguideapi").is("*")) {
		$("#gusearch-libguideapi").load("/gusuper/libguideapi/" + query, null, cb);			
	}
	if ($("#gusearch-dspacehtml").is("*")) {
		$("#gusearch-dspacehtml").load("/gusuper/dspacehtml/" + query, null, cb);
	}
	if ($("#gusearch-dspacesolr").is("*")) {
		$("#gusearch-dspacesolr").load("/gusuper/dspacesolr/" + query, null, cb);
	}
	if ($("#gusearch-libanswer").is("*")) {
		$("#gusearch-libanswer").load("/gusuper/libanswer/" + query, null, cb);
	}
  }


  var cb = function(responseText, textStatus, xhr) {
	if (textStatus == "error") {
		$(this).html("<div class='combo-summary'>Search request cannot be submitted at this time.</div>");
	}
	if (responseText == "") {
		$(this).html("<div class='combo-summary'>Search request cannot be submitted at this time.</div>");
	}
  }
}(jQuery));
