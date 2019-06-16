<?php


namespace SyPersont\MagentoAcademy\Controller\Adminhtml\Persons;

use Magento\Framework\Exception\NoSuchEntityException;

use SysPerson\MagentoAcademy\Api\Data\PersonsInterface;
use SysPerson\MagentoAcademy\Controller\Adminhtml\Persons as BaseAction;

class Edit extends BaseAction
{
    const ACL_RESOURCE      = 'SysPerson_MagentoAcademy::edit';
    const MENU_ITEM         = 'SysPerson_MagentoAcademy::edit';
    const PAGE_TITLE        = 'Edit Person';
    const BREADCRUMB_TITLE  = 'Edit Person';

    /** {@inheritdoc} */
    public function execute()
    {
        $id = $this->getRequest()->getParam(static::QUERY_PARAM_ID);

        if (!empty($id)) {
            try {
                $model = $this->repository->getById($id);
            } catch (NoSuchEntityException $exception) {
                $this->logger->error($exception->getMessage());
                $this->messageManager->addErrorMessage(__('Entity with id %1 not found', $id));
                return $this->redirectToGrid();
            }

        } else {
            $this->logger->error(
                sprintf("Require parameter `%s` is missing", static::QUERY_PARAM_ID)
            );
            $this->messageManager->addErrorMessage("Person not found");
            return $this->redirectToGrid();
        }

        $data = $this->_session->getFormData(true);

        if (!empty($data)) {
            $model->setData($data);
        }

        $this->registry->register(PersonsInterface::REGISTRY_KEY, $model);

        return parent::execute();
    }
}
