<?php


namespace SysPerson\MagentoAcademy\Api\Data;


interface PersonsSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Get Persons list.
     *
     * @return \SysPerson\MagentoAcademy\Api\Data\PersonsInterface[]
     */
    public function getItems();

    /**
     * Set blocks list.
     *
     * @param \SysPerson\MagentoAcademy\Api\Data\PersonsInterface[] $items
     * @return \SysPerson\MagentoAcademy\Api\Data\PersonsSearchResultsInterface
     */
    public function setItems(array $items);
}
