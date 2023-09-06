<?php

namespace Taller\TareaTres\Controller\Api;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\HTTP\Client\Curl;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\Result\RawFactory;
use Magento\Framework\Exception\LocalizedException;

class ApiCallDetalles extends Action
{
    protected $curl;
    protected $jsonFactory;
    protected $resultRawFactory;

    public function __construct(
        Context $context,
        Curl $curl,
        JsonFactory $jsonFactory,
        RawFactory $resultRawFactory
    ) {
        parent::__construct($context);
        $this->curl = $curl;
        $this->jsonFactory = $jsonFactory;
        $this->resultRawFactory = $resultRawFactory;
    }

    public function execute()
    {
        try {
            $id = $this->getRequest()->getParam('id');
            if (!is_numeric($id)) {
                throw new LocalizedException(__('PARAMETRO INVALIDO'), null, 400);
            }
            $apiUrl = 'https://fakestoreapi.com/products/'.$id;

            $this->curl->get($apiUrl);
            $responseBody = $this->curl->getBody();
    
            $responseData = json_decode($responseBody, true);
    
            $resultJson = $this->jsonFactory->create();
            $resultJson->setData($responseData);
    
            return $resultJson;

        } catch (LocalizedException $e) {
            $errorMessage = $e->getMessage();
            $resultRaw = $this->resultRawFactory->create();
            $resultRaw->setHttpResponseCode(400);
            $resultRaw->setContents($errorMessage);
            return $resultRaw;
        }
    }
}