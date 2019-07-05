<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 04.07.19
 * Time: 22:05
 */

namespace SysPerson\MagentoAcademy\Model;


class QuickOrders extends \Magento\Framework\Model\AbstractModel
    implements \SysPerson\MagentoAcademy\Api\Order\QuickOrderInterface,
    \Magento\Framework\DataObject\IdentityInterface

{

    /** {@inheritdoc} */
    public function _construct()
    {
        $this->_init(\SysPerson\MagentoAcademy\Model\ResourceModel\QuickOrders::class);
    }
    /** {@inheritdoc} */
    public function getIdentities()
    {
        return [sprintf("%s_%s", \SysPerson\MagentoAcademy\Api\Order\QuickOrderInterface::CACHE_TAG, $this->getId())];
    }

    public function getName()
    {
        return $this->getData(\SysPerson\MagentoAcademy\Api\Order\QuickOrderInterface::NAME_FIELD);
    }
    public function setName($name)
    {
        $this->setData(\SysPerson\MagentoAcademy\Api\Order\QuickOrderInterface::NAME_FIELD, $name);
        return $this;
    }

    public function getSku()
    {
        return $this->getData(\SysPerson\MagentoAcademy\Api\Order\QuickOrderInterface::SKU_FIELD);
    }
    public function setSku($sku)
    {
        $this->setData(\SysPerson\MagentoAcademy\Api\Order\QuickOrderInterface::SKU_FIELD, $sku);
        return $this;
    }

    public function getEmail()
    {
        return $this->getData(\SysPerson\MagentoAcademy\Api\Order\QuickOrderInterface::EMAIL_FIELD);

    }
    public function setEmail($email)
    {
        $this->setData(\SysPerson\MagentoAcademy\Api\Order\QuickOrderInterface::EMAIL_FIELD, $email);
        return $this;
    }

    public function getPhone()
    {
        return $this->getData(\SysPerson\MagentoAcademy\Api\Order\QuickOrderInterface::PHONE_FIELD);
    }
    public function setPhone($phone)
    {
        $this->setData(\SysPerson\MagentoAcademy\Api\Order\QuickOrderInterface::PHONE_FIELD, $phone);
        return $this;
    }

    public function getStatus()
    {
        return $this->getData(\SysPerson\MagentoAcademy\Api\Order\QuickOrderInterface::STATUS_FIELD);
    }

    public function setStatus($status)
    {
        $this->setData(\SysPerson\MagentoAcademy\Api\Order\QuickOrderInterface::STATUS_FIELD, $status);
        return $this;
    }
}