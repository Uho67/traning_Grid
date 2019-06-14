<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace SysPerson\MagentoAcademy\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;

use SysPerson\MagentoAcademy\Api\Data\PersonsInterface;
use SysPerson\MagentoAcademy\Api\Data\PersonsSearchResultsInterface;

interface PersonsRepositoryInterface
{
    /**
     * @param int $id
     * @return PersonsInterface
     * @throws NoSuchEntityException
     */
    public function getById($id);

    /**
     * @param int $id
     * @return PersonsRepositoryInterface
     */
    public function deleteById($id);

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return PersonsSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * @param PersonsInterface $lessons
     * @return PersonsInterface
     * @throws CouldNotSaveException
     */
    public function save(PersonsInterface $lessons);

    /**
     * @param PersonsInterface $lessons
     * @return PersonsRepositoryInterface
     * @throws CouldNotDeleteException
     */
    public function delete(PersonsInterface $lessons);
}
