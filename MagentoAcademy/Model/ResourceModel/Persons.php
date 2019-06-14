<?php


namespace SysPerson\MagentoAcademy\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

use SysPerson\MagentoAcademy\Api\Data\PersonsInterface;

class Persons extends AbstractDb
{
    /** {@inheritdoc} */
    protected function _construct()
    {
        $this->_init(PersonsInterface::TABLE_NAME, PersonsInterface::ID_FIELD);
    }
}
