<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 04.07.19
 * Time: 23:48
 */

namespace SysPerson\MagentoAcademy\Model;


class QuickOrdersRepository implements \SysPerson\MagentoAcademy\Api\QuickOrdersRepositoryInterface
{
    /** @var \SysPerson\MagentoAcademy\Model\ResourceModel\QuickOrders */
    protected $resource;

    /** @var \SysPerson\MagentoAcademy\Model\QuickOrdersFactory  */
    protected $ordersFactory;

    /** @var \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface */
    protected $collectionProcessor;

    /** @var \SysPerson\MagentoAcademy\Model\ResourceModel\QuickOrders\CollectionFactory */
    protected $collectionFactory;

    /** @var \SysPerson\MagentoAcademy\Api\Order\QuickOrderSearchResultsInterfaceFactory */
    protected $searchResultsFactory;

    public function __construct(
        \SysPerson\MagentoAcademy\Model\ResourceModel\QuickOrders $resource,
        \SysPerson\MagentoAcademy\Model\QuickOrdersFactory $ordersFactory,
        \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor,
        \SysPerson\MagentoAcademy\Model\ResourceModel\QuickOrders\CollectionFactory $collectionFactory,
        \SysPerson\MagentoAcademy\Api\Order\QuickOrderSearchResultsInterfaceFactory $ordersSearchResultsFactory
    ) {
        $this->resource                 = $resource;
        $this->ordersFactory           = $ordersFactory;
        $this->collectionProcessor      = $collectionProcessor;
        $this->collectionFactory        = $collectionFactory;
        $this->searchResultsFactory     = $ordersSearchResultsFactory;
    }
    /** {@inheritdoc} */
    public function getById($id)
    {
        $orders = $this->ordersFactory->create();
        $this->resource->load($orders, $id);

        if (!$orders->getId()) {
            throw new \Magento\Framework\Exception\NoSuchEntityException(__('orders with id "%1" does not exist.', $id));
        }

        return $orders;
    }

    /** {@inheritdoc} */
    public function deleteById($id)
    {
        $this->delete($this->getById($id));
    }

    /** {@inheritdoc} */
    public function delete(\SysPerson\MagentoAcademy\Api\Order\QuickOrderInterface $order)
    {
        try {
            $this->resource->delete($order);
        } catch (\Exception $exception) {
            throw new \Magento\Framework\Exception\CouldNotDeleteException(__($exception->getMessage()));
        }

        return $this;
    }




    /** {@inheritdoc} */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->collectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    /** {@inheritdoc} */
    public function save(\SysPerson\MagentoAcademy\Api\Order\QuickOrderInterface $order)
    {
        try {
            $this->resource->save($order);
        } catch (\Exception $exception) {
            throw new \Magento\Framework\Exception\CouldNotSaveException(__($exception->getMessage()));
        }

        return $order;
    }
}