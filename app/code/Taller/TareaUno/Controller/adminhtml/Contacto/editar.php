<?php
namespace Taller\TareaUno\Controller\Adminhtml\Contacto;
use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;

class Editar extends \Magento\Backend\App\Action
{
    protected $_coreRegistry;
    
    public function __construct(
        Context $context,
        Registry $registry 
    ) {
        parent::__construct($context);
        $this->_coreRegistry = $registry; 
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $model = $this->_objectManager->create('Taller\TareaUno\Model\Contacto');

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This record no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }

        $data = $this->_objectManager->get('Magento\Backend\Model\Session')->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }

        $this->_coreRegistry->register('contacto', $model);

        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend(__('Editar'));

        return $resultPage;
    }
}