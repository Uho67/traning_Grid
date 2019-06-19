<?php


namespace SysPerson\MagentoAcademy\Api;

interface PersonsRepositoryInterface
{
    /**
     * @param int $id
     * @return \SysPerson\MagentoAcademy\Api\Data\PersonsInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($id);

    /**
     * @param int $id
     * @return \SysPerson\MagentoAcademy\Api\PersonsRepositoryInterface
     */
    public function deleteById($id);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \SysPerson\MagentoAcademy\Api\Data\PersonsSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * @param \SysPerson\MagentoAcademy\Api\Data\PersonsInterface $lessons
     * @return \SysPerson\MagentoAcademy\Api\Data\PersonsInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(\SysPerson\MagentoAcademy\Api\Data\PersonsInterface $lessons);

    /**
     * @param \SysPerson\MagentoAcademy\Api\Data\PersonsInterface $lessons
     * @return \SysPerson\MagentoAcademy\Api\PersonsRepositoryInterface
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(\SysPerson\MagentoAcademy\Api\Data\PersonsInterface $lessons);
}
