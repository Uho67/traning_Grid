<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 04.07.19
 * Time: 23:53
 */

namespace SysPerson\MagentoAcademy\Api;

interface QuickOrdersRepositoryInterface
{
    /**
     * @param int $id
     * @return \SysPerson\MagentoAcademy\Api\Order\QuickOrderInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($id);

    /**
     * @param int $id
     * @return \SysPerson\MagentoAcademy\Api\QuickOrdersRepositoryInterface
     */
    public function deleteById($id);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \SysPerson\MagentoAcademy\Api\Order\QuickOrderSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * @param \SysPerson\MagentoAcademy\Api\Order\QuickOrderInterface $order
     * @return \SysPerson\MagentoAcademy\Api\Order\QuickOrderInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(\SysPerson\MagentoAcademy\Api\Order\QuickOrderInterface $order);

    /**
     * @param \SysPerson\MagentoAcademy\Api\Order\QuickOrderInterface $order
     * @return \SysPerson\MagentoAcademy\Api\QuickOrdersRepositoryInterface
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(\SysPerson\MagentoAcademy\Api\Order\QuickOrderInterface $order);
}