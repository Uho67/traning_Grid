<?php


namespace SysPerson\MagentoAcademy\Model;


class Persons extends \Magento\Framework\Model\AbstractModel implements \SysPerson\MagentoAcademy\Api\Data\PersonsInterface, \Magento\Framework\DataObject\IdentityInterface
{
    /** {@inheritdoc} */
    public function _construct()
    {
        $this->_init(\SysPerson\MagentoAcademy\Model\ResourceModel\Persons::class);
    }

    /** {@inheritdoc} */
    public function getIdentities()
    {
        return [sprintf("%s_%s", \SysPerson\MagentoAcademy\Api\Data\PersonsInterface::CACHE_TAG, $this->getId())];
    }

    /** {@inheritdoc} */
    public function getName()
    {
        return $this->getData(\SysPerson\MagentoAcademy\Api\Data\PersonsInterface::NAME_FIELD);
    }

    /** {@inheritdoc} */
    public function setName($name)
    {
        $this->setData(\SysPerson\MagentoAcademy\Api\Data\PersonsInterface::NAME_FIELD, $name);

        return $this;
    }

    /** {@inheritdoc} */
    public function getSurname()
    {
        return $this->getData(\SysPerson\MagentoAcademy\Api\Data\PersonsInterface::SURNAME_FIELD);
    }

    /** {@inheritdoc} */
    public function setSurname($Surname)
    {
        $this->setData(\SysPerson\MagentoAcademy\Api\Data\PersonsInterface::SURNAME_FIELD, $Surname);

        return $this;
    }

    /** {@inheritdoc} */
    public function getBirthDate()
    {
        return $this->getData(\SysPerson\MagentoAcademy\Api\Data\PersonsInterface::BIRTH_DATE_FIELD);
    }

    /** {@inheritdoc} */
    public function setBirthDate($statDate)
    {
        if ($statDate instanceof \Magento\Framework\Stdlib\DateTime) {
            $statDate = $statDate->format(\Magento\Framework\Stdlib\DateTime::DATETIME_PHP_FORMAT);
        }

        $this->setData(\SysPerson\MagentoAcademy\Api\Data\PersonsInterface::BIRTH_DATE_FIELD, $statDate);

        return $this;
    }


}
