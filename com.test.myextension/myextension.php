<?php

require_once 'myextension.civix.php';

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function myextension_civicrm_config(&$config) {
    _myextension_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @param $files array(string)
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function myextension_civicrm_xmlMenu(&$files) {
    _myextension_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function myextension_civicrm_install() {
    _myextension_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function myextension_civicrm_uninstall() {
    _myextension_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function myextension_civicrm_enable() {
    _myextension_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function myextension_civicrm_disable() {
    _myextension_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed
 *   Based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function myextension_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
    return _myextension_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function myextension_civicrm_managed(&$entities) {
    _myextension_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function myextension_civicrm_caseTypes(&$caseTypes) {
    _myextension_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function myextension_civicrm_angularModules(&$angularModules) {
    _myextension_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function myextension_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
    _myextension_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Functions below this ship commented out. Uncomment as required.
 *

  /**
 * Implements hook_civicrm_tabs().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_tabs
 *
  function myextension_civicrm_tabs(&$tabs, $contactID) {

  }

 */
function myextension_civicrm_tabs(&$tabs, $contactID) {
    if (CRM_Core_Permission::check('access Custom Contribution Tab')) {
        $url = CRM_Utils_System::url('civicrm/custom-callback', "cid=$contactID"); //,"reset=1&snippet=1&force=1&financial_type_id=2&cid=$contactID" );
        $tabs[] = array('id' => 'contributions-member-dues',
            'url' => $url,
            'title' => 'Contributions:Member Dues',
            'weight' => 100);
    }
}

/**
 * Implements hook_civicrm_permission().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_permission
 *
  function myextension_civicrm_permission(&$permissions) {

  }

 */
function myextension_civicrm_permission(&$permissions) {

    $permissions += array(
        'access Custom Contribution Tab' => array(
            ts('Access Custom Contribution Tab', array('domain' => 'com.test.myextension')),
        ),
    );
}
