<?php
namespace Taller\TareaUno\Controller\Adminhtml\Contacto;
class Nuevo extends \Magento\Backend\App\Action
{
	protected $resultPageFactory = false;
	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory
	)
	{
		parent::__construct($context);
		$this->resultPageFactory = $resultPageFactory;
	}
	
	public function execute()
	{
		$resultPage = $this->resultPageFactory->create();
		$resultPage->getConfig()->getTitle()->prepend((__('Nuevo Contacto')));

		return $resultPage;
	}
}