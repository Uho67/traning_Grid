<?php



namespace SysPerson\MagentoAcademy\Controller\Adminhtml\Persons;

use SysPerson\MagentoAcademy\Api\Data\PersonsInterface;
use SysPerson\MagentoAcademy\Controller\Adminhtml\Persons as BaseAction;

class Save extends BaseAction
{
    /** {@inheritdoc} */
    public function execute()
    {
        $isPost = $this->getRequest()->isPost();

        if ($isPost) {
            $model = $this->getModel();
            $formData = $this->getRequest()->getParam('person');

            if (empty($formData)) {
                $formData = $this->getRequest()->getParams();
            }

            if(!empty($formData[PersonsInterface::ID_FIELD])) {
                $id = $formData[PersonsInterface::ID_FIELD];
                $model = $this->repository->getById($id);
            } else {
                unset($formData[PersonsInterface::ID_FIELD]);
            }

            $model->setData($formData);

            try {
                $model = $this->repository->save($model);
                $this->messageManager->addSuccessMessage(__('Person has been saved.'));
                if ($this->getRequest()->getParam('back')) {
                    return $this->_redirect('*/*/edit', ['id' => $model->getId(), '_current' => true]);
                }

                return $this->redirectToGrid();
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
                $this->messageManager->addErrorMessage(__('Lesson doesn\'t save' ));
            }

            $this->_getSession()->setFormData($formData);

            return (!empty($model->getId())) ?
                $this->_redirect('*/*/edit', ['id' => $model->getId()])
                : $this->_redirect('*/*/uicreate');
        }

        return $this->doRefererRedirect();
    }
}
