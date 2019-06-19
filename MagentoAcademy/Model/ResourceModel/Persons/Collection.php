<?php


namespace SysPerson\MagentoAcademy\Model\ResourceModel\Persons;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /** {@inheritdoc} */
    protected function _construct()
    {
        $this->_init(\SysPerson\MagentoAcademy\Model\Persons::class, \SysPerson\MagentoAcademy\Model\ResourceModel\Persons::class);
    }
}
