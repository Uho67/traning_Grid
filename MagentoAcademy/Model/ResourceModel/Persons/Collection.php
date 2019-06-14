<?php


namespace SysPerson\MagentoAcademy\Model\ResourceModel\Persons;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

use SysPerson\MagentoAcademy\Model\Persons as Model;
use SysPerson\MagentoAcademy\Model\ResourceModel\Persons as ResourceModel;

class Collection extends AbstractCollection
{
    /** {@inheritdoc} */
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
