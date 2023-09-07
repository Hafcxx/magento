<?php
namespace Taller\TareaDos\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Taller\TareaDos\Model\Tarjeta;
use Magento\Framework\Controller\ResultFactory;

class Save extends Action
{
    protected $tarjeta;

    public function __construct(
        Context $context,
        Tarjeta $tarjeta
    ) {
        parent::__construct($context);
        $this->Tarjeta = $tarjeta;
    }

    public function execute()
    {
        if ($this->getRequest()->isPost()) {
            /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
            $resultRedirect = $this->resultRedirectFactory->create();
            try {
                $data = $this->getRequest()->getPostValue();
                
                /*
               
                */
                if (!is_numeric($data['numero'])) {
                    throw new \Exception('El número de tarjeta es invalido');
                }        

                if (!empty($data)) {
                    $this->Tarjeta->setData($data);
                    $this->Tarjeta->save();
                    
                    $this->messageManager->addSuccessMessage(__('Tarjeta guardada correctamente'));
                    $result = $this->resultFactory->create(ResultFactory::TYPE_JSON);
                    $result->setData(['error'=> false,
                    'mensaje'=>'Tarjeta guardada']);
                    
                    return $result;
                    //return $resultRedirect->setPath('*/*');
                }
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('Error: '.$e->getMessage()));
                $result = $this->resultFactory->create(ResultFactory::TYPE_JSON);
                $result->setData(['error'=> false,
                    'mensaje' =>'Tarjeta guardada']);
                    
                    return $result;
                //return $resultRedirect->setPath('*/*');
            }
        }
    }
}