<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 04.07.19
 * Time: 21:35
 */

namespace SysPerson\MagentoAcademy\Api\Order;


interface QuickOrderSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Get Orsers list.
     *
     * @return \SysPerson\MagentoAcademy\Api\Order\QuickOrderInterface[]
     */
    public function getItems();

    /**
     * Set blocks list.
     *
     * @param \SysPerson\MagentoAcademy\Api\Order\QuickOrderInterface[] $items
     * @return \SysPerson\MagentoAcademy\Api\Order\QuickOrderSearchResultsInterface
     */
    public function setItems(array $items);
}