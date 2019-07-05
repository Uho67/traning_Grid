<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 28.06.19
 * Time: 21:05
 */

namespace SysPerson\MagentoAcademy\Model\Atribute\Frontend;

use Magento\Eav\Model\Entity\Attribute\Frontend\AbstractFrontend;

class TestCountryAttribute extends AbstractFrontend
{
    public function getValue(\Magento\Framework\DataObject $object)
    {
        $value = $object->getData($this->getAttribute()->getAttributeCode());
        return "<b>$value</b>>";
    }
}
