This Drupal module provides a federated search experience across selected library resources.  Currently, those resources are
* Library Website (Drupal, via ApacheSOLR)
* LibraryGuides (SpringShare platform)
* Institutional Repository (DSpace)
* LibraryAnswers (SpringShare, not enabled)
* Institutional Repository (DSpace, SOLR Service, not enabled)

Federated searches are launced via Ajax.  If any single service is unavailble, the other searches will be returned.

Pre-Requisites
* ApacheSOLR module is in place
* XSLT PHP module is enabled
* SOLR client PHP module is enabled

Installation
* Install modules
* Activate gusuper, configure module parameter
* Activate desired external services, configure module(s) parameters
* Activate search module via Drupal admin
* Apply custom CSS
  
Flow
* User enters search
* Search module is invoked
* Search module returns a template listing the services to execute
* Search modules invoke Drupal callbacks via Ajax
* Federated search is executed and returned to the ajax callback

This code is still under development for Drupal 7.  Code has not yet been refactored for use on other sites.

You can preview the functionality at the following URL.
* http://www.library.georgetown.edu/search/gusupersearch/test%20search

***
[![Georgetown University Library IT Code Repositories](https://raw.githubusercontent.com/Georgetown-University-Libraries/georgetown-university-libraries.github.io/master/LIT-logo-small.png)Georgetown University Library IT Code Repositories](http://georgetown-university-libraries.github.io/)
