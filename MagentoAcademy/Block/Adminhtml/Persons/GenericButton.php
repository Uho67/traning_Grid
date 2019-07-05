<?php


namespace SysPerson\MagentoAcademy\Block\Adminhtml\Persons;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\NoSuchEntityException;

use SysPerson\MagentoAcademy\Api\PersonsRepositoryInterface;

class GenericButton
{

    protected $context;

    /** @var PersonsRepositoryInterface */
    protected $repository;

    public function __construct(
        Context $context,
        PersonsRepositoryInterface $repository
    ) {
        $this->context      = $context;
        $this->repository   = $repository;
    }

    /**
     * Return Person ID
     *
     * @return int|null
     */
    public function getPersonId()
    {
        try {
            return $this->repository->getById(
                $this->context->getRequest()->getParam('id')
            )->getId();
        } catch (NoSuchEntityException $e) {
        }
        return null;
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}