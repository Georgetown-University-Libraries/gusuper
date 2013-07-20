<?php
// $Id$

/**
 * @file
 * Search interface for URL aliases.
 */

class ExternalRepository {
	public $abbrev = "";
	public $name = "";
	public $desc = "";
	public $purpose = "";
	public $weight = 5;

	public static $max = 5;
	public static $msgmax = "Top ^ results displayed below.";
	public static $msgmax_brief = "More Results";  //If set, overrides the longer form for more messages
	public static $msgnone = "No results found.";
	public static $msgone = "One result found.";
	public static $msgoneplus = "_ results found.";
	public static $msgunavail = "Search cannot be performed at this time.";
	public static $msgsearch = "Search _ directly for more results.";
	
	public function __construct($abbrev, $weight, $name, $desc, $purpose) {
		$this->abbrev = $abbrev;
		$this->domid = "gusearch-" . $abbrev;
		$this->cssclass = "";
		$this->name = $name;
		$this->header = $name . "";
		$this->desc = $desc;
		$this->weight = $weight;
		$this->purpose = $purpose;
	}
	
	public static function getGlobalOptions() {
		$form = array();
		$form['weight_options'] = array(
			"#type" => "value",
			"#value" => array(
				1 => 1,
				2 => 2,
				3 => 3,
				4 => 4,
				5 => 5,
				6 => 6,
				7 => 7,
				8 => 8,
				9 => 9,
				10 => 10
			),
		);
		$form['count_options'] = array(
			"#type" => "value",
			"#value" => array(
				1 => 1,
				2 => 2,
				3 => 3,
				4 => 4,
				5 => 5,
				6 => 6,
				7 => 7,
				8 => 8,
				9 => 9,
				10 => 10
			),
		);
	
		$form["global"] = array(
			"#title" => "Global Settings",
			"#type" => "fieldset",
		);

		$form['global']['gusuper_max'] = array(
			"#type" => "select",
			"#title" => t("Set the maximum number of results to return per resource"),
			"#default_value" => variable_get("gusuper_max", ExternalRepository::$max),
			"#options" => $form["count_options"]["#value"],
			"#description" => "Limit the number of items that will be displayed.  Must be less than 10.",
			"#required" => TRUE
		);
	
		$form["messages"] = array(
			"#title" => "Message Text",
			"#description" => "Text to display along with search results",
			"#type" => "fieldset",
			"#collapsible" => TRUE,
		);

		$v = "gusuper_msgmax";
		$form["messages"][$v] = array(
			"#type" => "textfield",
			"#title" => "Message: More Results Available",
			"#default_value" => variable_get($v, ExternalRepository::$msgmax),
			"#size" => 40,
			"#maxlength" => 80,
			"#description" => "This message will be displayed when more results are available than are being displayed.  Use an _ to signify the value.  Use ^ to signify the max value.",
			"#required" => TRUE
		);

		$v = "gusuper_msgmax_brief";
		$form["messages"][$v] = array(
			"#type" => "textfield",
			"#title" => "Message: More Results Brief Text",
			"#default_value" => variable_get($v, ExternalRepository::$msgmax_brief),
			"#size" => 40,
			"#maxlength" => 80,
			"#description" => "This message will be used to convey a short message indicating that more results are available.  If set, this will override the 'More Results Available' message."
		);

		$v = "gusuper_msgnone";
		$form["messages"][$v] = array(
			"#type" => "textfield",
			"#title" => "Message: No Results",
			"#default_value" => variable_get($v, ExternalRepository::$msgnone),
			"#size" => 40,
			"#maxlength" => 80,
			"#description" => "This message will be displayed when no results are found by a specific service",
			"#required" => TRUE
		);

		$v = "gusuper_msgone";
		$form["messages"][$v] = array(
			"#type" => "textfield",
			"#title" => "Message: One Result",
			"#default_value" => variable_get($v, ExternalRepository::$msgone),
			"#size" => 40,
			"#maxlength" => 80,
			"#description" => "This message will be displayed when only one result is found by a specific service",
			"#required" => TRUE
		);

		$v = "gusuper_msgoneplus";
		$form["messages"][$v] = array(
			"#type" => "textfield",
			"#title" => "Message: More Than One Results Available",
			"#default_value" => variable_get($v, ExternalRepository::$msgoneplus),
			"#size" => 40,
			"#maxlength" => 80,
			"#description" => "This message will be displayed when multiple results are available and the number of results is less than or equal to the maximum value.  Use an _ to signify the value.",
			"#required" => TRUE
		);

		$v = "gusuper_msgunavail";
		$form["messages"][$v] = array(
			"#type" => "textfield",
			"#title" => "Message: Service is Unavailable",
			"#default_value" => variable_get($v, ExternalRepository::$msgunavail),
			"#size" => 40,
			"#maxlength" => 80,
			"#description" => "This message will be displayed when an external service is unavailable for searching",
			"#required" => TRUE
		);

		$v = "gusuper_msgsearch";
		$form["messages"][$v] = array(
			"#type" => "textfield",
			"#title" => "Message: Search Service Directly",
			"#default_value" => variable_get($v, ExternalRepository::$msgsearch),
			"#size" => 40,
			"#maxlength" => 80,
			"#description" => "Text to direct user to search external service directly.  The service name will be inserted as a link where the _ is found.",
			"#required" => TRUE
		);
		return $form;	
	}
	
	function getDefaultOptions(&$form) {
		$form['weight_options'] = array(
			"#type" => "value",
			"#value" => array(
				1 => 1,
				2 => 2,
				3 => 3,
				4 => 4,
				5 => 5,
				6 => 6,
				7 => 7,
				8 => 8,
				9 => 9,
				10 => 10
			),
		);
		$form['count_options'] = array(
			"#type" => "value",
			"#value" => array(
				1 => 1,
				2 => 2,
				3 => 3,
				4 => 4,
				5 => 5,
				6 => 6,
				7 => 7,
				8 => 8,
				9 => 9,
				10 => 10
			),
		);
		$form[$this->getVarBase()] = array(
			"#title" => $this->name,
			"#description" => $this->desc,
			"#type" => "fieldset",
			"#collapsible" => TRUE,
		);

		$v = $this->getVarName("cssclass");
		$form[$this->getVarBase()][$v] = array(
			"#type" => "textfield",
			"#title" => $this->name . t(" css class"),
			"#default_value" => variable_get($v, $this->cssclass),
			"#size" => 40,
			"#maxlength" => 80,
			"#description" => 'CSS Class for ' . $this->name
		);

		$v = $this->getVarName("name");
		$form[$this->getVarBase()][$v] = array(
			"#type" => "textfield",
			"#title" => $this->name . t(" label name"),
			"#default_value" => variable_get($v, $this->name),
			"#size" => 40,
			"#maxlength" => 80,
			"#description" => 'Service name for ' . $this->name,
			"#required" => TRUE
		);

		$v = $this->getVarName("header");
		$form[$this->getVarBase()][$v] = array(
			"#type" => "textfield",
			"#title" => $this->name . t(" header"),
			"#default_value" => variable_get($v, $this->header),
			"#size" => 40,
			"#maxlength" => 80,
			"#description" => 'Header for ' . $this->name,
			"#required" => TRUE
		);

		$v = $this->getVarName("weight");
		$form[$this->getVarBase()][$v] = array(
			"#type" => "select",
			"#title" => $this->name . t(" weight"),
			"#default_value" => variable_get($v, $this->weight),
			"#options" => $form["weight_options"]["#value"],
			"#description" => 'Display order for ' . $this->name,
			"#required" => TRUE
		);

		$v = $this->getVarName("purpose");
		$form[$this->getVarBase()][$v] = array(
			"#type" => "textfield",
			"#title" => $this->name . t(" purpose"),
			"#default_value" => variable_get($v, $this->purpose),
			"#description" => 'Description of the purpose/contents of ' . $this->name
		);
	}
	
	function getConfigMenu($mname, $items) {
		$items['admin/config/search/' . $mname] = array(
    		"title" => t("GU Super Search Settings: " . $this->name),
    		"description" => t("GU Super Search Settings"),
    		"page callback" => "drupal_get_form",
    		"page arguments" => array($mname . '_admin_settings'),
    		'access arguments' => array("administer gusuper settings"),
	    	'type' => MENU_NORMAL_ITEM,
  		);

		return $items;
	}
	
	function getVarName($name) {
		return $this->getVarBase() . '_' . $name;
	}
	
	function getVarValue($name, $def) {
		return variable_get($this->getVarName($name), $def);
	}
	
	function getVarBase() {return "gusuper_" . $this->abbrev;}

	function getAdditionalParams(&$form) {
		return array();
	}
	
	function getSearchUiUrl() {
		return "";
	}

    function getCountString($str, $count, $max) {
    	return str_replace("^", $max, str_replace("_", $count, $str));
    }

    function getLinkString($str, $url) {
    	$a = "<a href='$url'>$this->name</a>";
    	return str_replace("_", $a, $str);
    }

	function generateResultHeader($count, $query) {
		$max = variable_get("gusuper_max", ExternalRepository::$max);
		$brief = variable_get("gusuper_msgmax_brief", ExternalRepository::$msgmax_brief);
		$url = $this->getSearchUiUrl() . $query; 
  
		if ($count < 0) {
			$tstr = variable_get("gusuper_msgunavail", ExternalRepository::$msgunavail);
		} else if (($count == 0) || (!is_numeric($count))) {
			$tstr = variable_get("gusuper_msgnone", ExternalRepository::$msgnone);
  		} else if ($count > $max) {
  			if (!empty($brief)) {
  			  return "<a href='$url'>$brief</a>";	
  			}
    		$tstr = $this->getCountString(variable_get("gusuper_msgmax", ExternalRepository::$msgmax), $count, $max);
    		
  		} else if ($count == 1) {
    		$tstr = $this->getCountString(variable_get("gusuper_msgone", ExternalRepository::$msgone), $count, $max);
  		} else  {
  			if (!empty($brief)) {
  			  return "<a href='$url'>$brief</a>";	
  			}
    		$tstr = $this->getCountString(variable_get("gusuper_msgoneplus", ExternalRepository::$msgoneplus), $count, $max);
  		}
  		return $tstr . " " . $this->getLinkString(variable_get("gusuper_msgsearch", ExternalRepository::$msgsearch), $url);
	}
}

class XslRepository extends ExternalRepository {
	public $searchurl;
	public $dispurl;
	public $xsl;
	
	public function __construct($abbrev, $weight, $name, $desc, $purpose) {
		parent::__construct($abbrev, $weight, $name, $desc, $purpose);
	}
	
	function getAdditionalParams(&$form) {
		$v = $this->getVarName("searchurl");
		$form[$this->getVarBase()][$v] = array(
			"#type" => "textfield",
			"#title" => $this->name . t(" search URL"),
			"#default_value" => variable_get($v, $this->searchurl),
			"#size" => 100,
			"#maxlength" => 200,
			"#description" => "The following URL will be queried for search results.  Note, search terms will be appended to this string.",
			"#required" => TRUE
		);

		$v = $this->getVarName("dispurl");
		$form[$this->getVarBase()][$v] = array(
			"#type" => "textfield",
			"#title" => $this->name . t(" display URL prefix"),
			"#default_value" => variable_get($v, $this->dispurl),
			"#size" => 100,
			"#maxlength" => 200,
			"#description" => "Base URL for linking to search result items",
		);

		$v = $this->getVarName("xsl");
		$form[$this->getVarBase()][$v] = array(
			"#type" => "textfield",
			"#title" => $this->name . t(" stylesheet name"),
			"#default_value" => variable_get($v, $this->xsl),
			"#size" => 100,
			"#maxlength" => 200,
			"#description" => "Stylesheet to format search results to standard display.  In general, this value should not be modified",
			"#required" => TRUE
		);
	}
	
	function getSearchUiUrl() {
		return $this->getVarValue("searchurl", $this->searchurl);
	}
	
	function performSearch($query = null) {
  		$name = $this->getVarValue("name", $this->name);
  		$header = $this->getVarValue("header", $this->header);
  		$purpose = $this->getVarValue("purpose", $this->purpose);
  		
	  	try{
			$xsl = new DOMDocument();
    		$xsl->load($this->getVarValue("xsl", $this->xsl));

	    	$qurl = $this->getVarValue("searchurl", $this->searchurl) . $query;
	    	$url = $this->getSearchUiUrl();
	    	$xml = new DOMDocument();
    		@$xml->loadHTMLFile($qurl);
    		
    		print "<h2 class='gusearch'>$header</h2>";
    		print "<div class='gupurpose'>$purpose</div>";
    		
			if ($xml->documentElement == null) {
        		print "<div class='combo-summary'>" . variable_get("gusuper_msgunavail", ExternalRepository::$msgunavail) . "</div>";
			} else {
    			$proc = new XSLTProcessor();
    			$proc->importStylesheet($xsl);
    			$proc->setParameter("","prefix",$this->getVarValue("dispurl", $this->dispurl));
    			$proc->setParameter("","url",$url);
    			$proc->setParameter("","label","$name");
    			$proc->setParameter("","max",variable_get("gusuper_max", ExternalRepository::$max));
    			$proc->setParameter("","msgnone",variable_get("gusuper_msgnone", ExternalRepository::$msgnone));
    			$proc->setParameter("","msgone",variable_get("gusuper_msgone", ExternalRepository::$msgone));
    			$proc->setParameter("","msgoneplus",variable_get("gusuper_msgoneplus", ExternalRepository::$msgoneplus));
    			$proc->setParameter("","msgmax",variable_get("gusuper_msgmax", ExternalRepository::$msgmax));
    			$proc->setParameter("","msgmax_brief",variable_get("gusuper_msgmax_brief", ExternalRepository::$msgmax_brief));
    			$proc->setParameter("","msgsearch",variable_get("gusuper_msgsearch", ExternalRepository::$msgsearch));
    			$proc->setParameter("","query",$query);
    			$res = $proc->transformToDoc($xml);
    
    			print $res->saveHTML();
			}
    		exit();
  		} catch(Exception $e) {
  			print "<div class='combo-summary'>" . variable_get("gusuper_msgunavail", ExternalRepository::$msgunavail) . "</div>";
  			exit();  	
  		}
	}
}

class ApiXslRepository extends XslRepository {
	public $searchuiurl;
	
	public function __construct($abbrev, $weight, $name, $desc, $purpose) {
		parent::__construct($abbrev, $weight, $name, $desc, $purpose);
	}
	
	function getSearchUiUrl() {
		return $this->getVarValue("searchuiurl", $this->searchuiurl);
	}
	
	function getAdditionalParams(&$form) {
		parent::getAdditionalParams($form);
		
		$v = $this->getVarName("searchuiurl");
		$form[$this->getVarBase()][$v] = array(
			"#type" => "textfield",
			"#title" => $this->name . t(" user-friendly search URL prefix"),
			"#default_value" => variable_get($v, $this->searchuiurl),
			"#size" => 100,
			"#maxlength" => 200,
			"#description" => "Link that will be presented to the user to display more search results.  Search terms will be appended to this string.  This may be the same as the search URL.  If an API is used to perform the initial search, this value should be set to a user-friendly URL.",
			"#required" => TRUE
		);
	}
}

