<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 23.06.19
 * Time: 1:15
 */

namespace SysPerson\MagentoAcademy\Model\Sourse;


class Yesnonear implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 1, 'label' => __('Yes')],
            ['value' => 0, 'label' => __('No')],
            ['value' => 2, 'label' => __('Near')]
        ];
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return [0 => __('No'), 1 => __('Yes'),2=>__('Near')];
    }
}

