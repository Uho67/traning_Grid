<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 05.07.19
 * Time: 10:19
 */

namespace SysPerson\MagentoAcademy\Controller\Adminhtml\Orders;

use SysPerson\MagentoAcademy\Controller\Adminhtml\MyBaseQuickOrder;

class Listing extends MyBaseQuickOrder
{
    const ACL_RESOURCE      = 'Sysint_MagentoAcademy::grid';
    const MENU_ITEM         = 'Sysint_MagentoAcademy::uiGrid';
    const PAGE_TITLE        = 'Persons Grid';
    const BREADCRUMB_TITLE  = 'Persons Grid';
}