<?php


namespace SysPerson\MagentoAcademy\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Stdlib\DateTime;

use SysPerson\MagentoAcademy\Api\Data\PersonsInterface;
use SysPerson\MagentoAcademy\Model\ResourceModel\Persons as ResourceModel;

class Persons extends AbstractModel implements PersonsInterface, IdentityInterface
{
    /** {@inheritdoc} */
    public function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /** {@inheritdoc} */
    public function getIdentities()
    {
        return [sprintf("%s_%s", PersonsInterface::CACHE_TAG, $this->getId())];
    }

    /** {@inheritdoc} */
    public function getName()
    {
        return $this->getData(PersonsInterface::NAME_FIELD);
    }

    /** {@inheritdoc} */
    public function setName($name)
    {
        $this->setData(PersonsInterface::NAME_FIELD, $name);

        return $this;
    }

    /** {@inheritdoc} */
    public function getSurname()
    {
        return $this->getData(PersonsInterface::SURNAME_FIELD);
    }

    /** {@inheritdoc} */
    public function setSurname($Surname)
    {
        $this->setData(PersonsInterface::SURNAME_FIELD, $Surname);

        return $this;
    }

    /** {@inheritdoc} */
    public function getBirthDate()
    {
        return $this->getData(PersonsInterface::BIRTH_DATE_FIELD);
    }

    /** {@inheritdoc} */
    public function setBirthDate($statDate)
    {
        if ($statDate instanceof \DateTime) {
            $statDate = $statDate->format(DateTime::DATETIME_PHP_FORMAT);
        }

        $this->setData(PersonsInterface::BIRTH_DATE_FIELD, $statDate);

        return $this;
    }


}
