<?php


namespace SysPerson\MagentoAcademy\Model\ResourceModel;


class Persons extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /** {@inheritdoc} */
    protected function _construct()
    {
        $this->_init(\SysPerson\MagentoAcademy\Api\Data\PersonsInterface::TABLE_NAME, \SysPerson\MagentoAcademy\Api\Data\PersonsInterface::ID_FIELD);
    }
}
