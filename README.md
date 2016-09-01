This Drupal module provides a federated search experience across selected library resources.  Currently, those resources are
  (1) Library Website (Drupal, via ApacheSOLR)
  (2) LibraryGuides (SpringShare platform)
  (3) Institutional Repository (DSpace)
  (4) LibraryAnswers (SpringShare, not enabled)
  (5) Institutional Repository (DSpace, SOLR Service, not enabled)

Federated searches are launced via Ajax.  If any single service is unavailble, the other searches will be returned.

Pre-Requisites
  (1) ApacheSOLR module is in place
  (2) XSLT PHP module is enabled
  (3) SOLR client PHP module is enabled

Installation
  (1) Install modules
  (2) Activate gusuper, configure module parameter
  (3) Activate desired external services, configure module(s) parameters
  (4) Activate search module via Drupal admin
  (5) Apply custom CSS
  
Flow
  (1) User enters search
  (2) Search module is invoked
  (3) Search module returns a template listing the services to execute
  (4) Search modules invoke Drupal callbacks via Ajax
  (5) Federated search is executed and returned to the ajax callback

This code is still under development for Drupal 7.  Code has not yet been refactored for use on other sites.

You can preview the functionality at the following URL.
* http://www.library.georgetown.edu/search/gusupersearch/test%20search

***
[![Georgetown University Library IT Code Repositories](https://raw.githubusercontent.com/Georgetown-University-Libraries/georgetown-university-libraries.github.io/master/LIT-logo-small.png)Georgetown University Library IT Code Repositories](http://georgetown-university-libraries.github.io/)
