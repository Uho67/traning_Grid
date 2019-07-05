<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 04.07.19
 * Time: 21:43
 */

namespace SysPerson\MagentoAcademy\Model\ResourceModel;


class QuickOrders extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /** {@inheritdoc} */
    protected function _construct()
    {
        $this->_init(\SysPerson\MagentoAcademy\Api\Order\QuickOrderInterface::TABLE_NAME, \SysPerson\MagentoAcademy\Api\Order\QuickOrderInterface::ID_FIELD);
    }
}