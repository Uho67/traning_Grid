<?php


namespace SysPerson\MagentoAcademy\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

use SysPerson\MagentoAcademy\Api\Data\PersonsInterface;
use SysPerson\MagentoAcademy\Api\PersonsRepositoryInterface;
use SysPerson\MagentoAcademy\Api\Data\PersonsSearchResultsInterfaceFactory;
use SysPerson\MagentoAcademy\Model\ResourceModel\Persons as ResourceModel;
use SysPerson\MagentoAcademy\Model\PersonsFactory;
use SysPerson\MagentoAcademy\Model\ResourceModel\Persons\CollectionFactory;

class PersonsRepository implements PersonsRepositoryInterface
{
    /** @var ResourceModel */
    protected $resource;

    /** @var PersonsFactory  */
    protected $personsFactory;

    /** @var CollectionProcessorInterface */
    protected $collectionProcessor;

    /** @var CollectionFactory */
    protected $collectionFactory;

    /** @var PersonsSearchResultsInterfaceFactory */
    protected $searchResultsFactory;

    public function __construct(
        ResourceModel $resource,
        PersonsFactory $personsFactory,
        CollectionProcessorInterface $collectionProcessor,
        CollectionFactory $collectionFactory,
        PersonsSearchResultsInterfaceFactory $personsSearchResultsFactory
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
            throw new NoSuchEntityException(__('Persons with id "%1" does not exist.', $id));
        }

        return $persons;
    }

    /** {@inheritdoc} */
    public function deleteById($id)
    {
        $this->delete($this->getById($id));
    }

    /** {@inheritdoc} */
    public function getList(SearchCriteriaInterface $searchCriteria)
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
    public function save(PersonsInterface $person)
    {
        try {
            $this->resource->save($person);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $person;
    }

    /** {@inheritdoc} */
    public function delete(PersonsInterface $person)
    {
        try {
            $this->resource->delete($person);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }

        return $this;
    }
}
