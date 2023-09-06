<?php
namespace Taller\TareaTres\Controller\Index;
class Detalles extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;
	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory)
	{
		$this->_pageFactory = $pageFactory;
		return parent::__construct($context);
	}
	public function execute()
	{	
		/** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

		try {
            $id = $this->getRequest()->getParam('id');
            if (!is_numeric($id)) {
                throw new \Exception('Id no es númerico');
            }

            return $this->_pageFactory->create();
        } catch (\Exception $e) {
            $this->messageManager->addException($e, __('Parametro invalido:  Id debe ser un valor numérico'));
			return $resultRedirect->setPath('*/*');
        }

	}
}