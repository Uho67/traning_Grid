<?php


namespace SysPerson\MagentoAcademy\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface PersonsSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get Persons list.
     *
     * @return PersonsInterface[]
     */
    public function getItems();

    /**
     * Set blocks list.
     *
     * @param PersonsInterface[] $items
     * @return PersonsSearchResultsInterface
     */
    public function setItems(array $items);
}
