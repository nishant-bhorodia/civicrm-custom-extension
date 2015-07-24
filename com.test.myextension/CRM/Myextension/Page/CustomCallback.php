<?php

require_once 'CRM/Core/Page.php';

class CRM_Myextension_Page_CustomCallback extends CRM_Core_Page {

    function run() {

        CRM_Utils_System::setTitle(ts('CustomCallback'));

        $this->assign('cid', CRM_Utils_Array::value('cid', $_GET, '0'));
        $this->assign('total', self::_getTotalContributionAmount());

        parent::run();

    }

    /**
     * Fetch contributions using CiviCRM API
     * 
     * @return array
     */
    private static function _getContributionByFinancialType() {

        $cid = CRM_Utils_Array::value('cid', $_GET, '0');

        $startDate = CRM_Utils_Array::value('start-date', $_GET, '0');
        $endDate = CRM_Utils_Array::value('end-date', $_GET, '0');

        $params = array(
            'sequential' => 1,
            'return' => array("net_amount", "receive_date", "currency"),
            'financial_type_id' => "Member Dues",
            'contact_id' => $cid,
        );

        if ($startDate != 0 && $endDate != 0) {
            $params['receive_date'] = array(
                'BETWEEN' => array(
                    $startDate,
                    $endDate
                )
            );
        }

        // Use of CiviCRM API for future compatibility
        $result = civicrm_api3('Contribution', 'get', $params);

        return $result['values'];
    }

    
    /**
     * Calculate total amount based on Contributions fetched by
     * _getContributionByFinancialType();
     * 
     * @return integer
     */
    private function _getTotalContributionAmount() {

        $contributions = self::_getContributionByFinancialType();
        $total = 0;

        foreach ($contributions as $contribution) {
            $total += $contribution['net_amount'];
        }

        return $total;
    }

    /**
     * Function to return all contributions in JSON format (for ajax calls)
     * 
     * Can also be acheived by using CiviCRM Javascript API
     */
    public static function getAllContributions() {
        $contributions = self::_getContributionByFinancialType();
        $total = 0;

        foreach ($contributions as $contribution) {
            $total += $contribution['net_amount'];
        }

        echo json_encode($contributions);
        CRM_Utils_System::civiExit();
    }

}
