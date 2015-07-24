civicrm-custom-extension
========================
CiviCRM extension that adds a custom tab on the contact view page.

# Steps Followed:
  
  1. Create extension using civix generate:module
  2. Generate a page (civicrm/custom-callback) for ajax callback using civix generate:page
  3. Add a custom tab to Contact View Page using hook_civicrm_tabs in myextension.php
  4. Add custom permission "access Custom Contribution Tab" using hook_civicrm_permission in myextension.php
  5. Use CiviCRM API in class CRM_Myextension_Page_CustomCallback to fetch contributions given the url parameters.
  6. Pass page variables to smarty template for rendering.
  7. Addition of resources and code needed to represent the fetched data in the for of a chart.


### Note: This is just a test extension. Not for production websites.

