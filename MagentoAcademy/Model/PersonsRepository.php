<?php


namespace SysPerson\MagentoAcademy\Model;

class PersonsRepository implements \SysPerson\MagentoAcademy\Api\PersonsRepositoryInterface
{
    /** @var \SysPerson\MagentoAcademy\Model\ResourceModel\Persons */
    protected $resource;

    /** @var \SysPerson\MagentoAcademy\Model\PersonsFactory  */
    protected $personsFactory;

    /** @var \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface */
    protected $collectionProcessor;

    /** @var \SysPerson\MagentoAcademy\Model\ResourceModel\Persons\CollectionFactory */
    protected $collectionFactory;

    /** @var \SysPerson\MagentoAcademy\Api\Data\PersonsSearchResultsInterfaceFactory */
    protected $searchResultsFactory;

    public function __construct(
        \SysPerson\MagentoAcademy\Model\ResourceModel\Persons $resource,
        \SysPerson\MagentoAcademy\Model\PersonsFactory $personsFactory,
        \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor,
        \SysPerson\MagentoAcademy\Model\ResourceModel\Persons\CollectionFactory $collectionFactory,
        \SysPerson\MagentoAcademy\Api\Data\PersonsSearchResultsInterfaceFactory $personsSearchResultsFactory
    ) {
        $this->resource                 = $resource;
        $this->personsFactory           = $personsFactory;
        $this->collectionProcessor      = $collectionProcessor;
        $this->collectionFactory        = $collectionFactory;
        $this->searchResultsFactory     = $personsSearchResultsFactory;
    }

    /** {@inheritdoc} */
    public function getById($id)
    {
        $persons = $this->personsFactory->create();
        $this->resource->load($persons, $id);

        if (!$persons->getId()) {
            throw new \Magento\Framework\Exception\NoSuchEntityException(__('Persons with id "%1" does not exist.', $id));
        }

        return $persons;
    }

    /** {@inheritdoc} */
    public function deleteById($id)
    {
        $this->delete($this->getById($id));
    }

    /** {@inheritdoc} */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria )
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
    public function save(\SysPerson\MagentoAcademy\Api\Data\PersonsInterface $person)
    {

        try {
            $this->resource->save($person);
        } catch (\Exception $exception) {
            throw new \Magento\Framework\Exception\CouldNotSaveException(__($exception->getMessage()));
        }

        return $person;
    }

    /** {@inheritdoc} */
    public function delete(\SysPerson\MagentoAcademy\Api\Data\PersonsInterface $person)
    {
        try {
            $this->resource->delete($person);
        } catch (\Exception $exception) {
            throw new \Magento\Framework\Exception\CouldNotDeleteException(__($exception->getMessage()));
        }

        return $this;
    }
}
