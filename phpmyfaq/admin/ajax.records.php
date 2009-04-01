<?php
/**
 * AJAX: handling of Ajax record calls
 * 
 * @package    phpMyFAQ
 * @subpackage Administration
 * @author     Anatoliy Belsky <anatoliy.belsky@mayflower.de>
 * @author     Thorsten Rinne <thorsten@phpmyfaq.de>
 * @since      2009-03-31
 * @copyright  2009 phpMyFAQ Team
 * @version    SVN: $Id$
 *
 * The contents of this file are subject to the Mozilla Public License
 * Version 1.1 (the "License"); you may not use this file except in
 * compliance with the License. You may obtain a copy of the License at
 * http://www.mozilla.org/MPL/
 *
 * Software distributed under the License is distributed on an "AS IS"
 * basis, WITHOUT WARRANTY OF ANY KIND, either express or implied. See the
 * License for the specific language governing rights and limitations
 * under the License.
 */

if (!defined('IS_VALID_PHPMYFAQ_ADMIN')) {
    header('Location: http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['SCRIPT_NAME']));
    exit();
}

$ajax_action = PMF_Filter::filterInput(INPUT_GET, 'ajaxaction', FILTER_SANITIZE_STRING);

if ('save_sticky_records' == $ajax_action && $permission['editbt']) {
    /**
     * Expected is an array of the structure:
     * array( 0 => array((int)id, (string)langugage, (int) checked)),
     * 	      1 => .....
     * )
     */
    $items = isset($_GET['items']) && is_array($_GET['items']) ? $_GET['items'] : array();
   
    $faq = new PMF_Faq();
    
    foreach($items as $item) {
        if(is_array($item) && count($item) == 3 && PMF_Init::isASupportedLanguage($item[1])) { 
            $faq->updateRecordSticky((int)$item[0], addslashes($item[1]), (int)$item[2]);
        }
    }
}

if ('delete_record' == $ajax_action && $permission['delbt']) {
	
}