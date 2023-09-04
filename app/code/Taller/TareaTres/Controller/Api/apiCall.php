<?php

namespace Taller\TareaTres\Controller\Api;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\HTTP\Client\Curl;
use Magento\Framework\Controller\Result\JsonFactory;

class ApiCall extends Action
{
    /**
     * @var Curl
     */
    protected $curl;

    /**
     * @var JsonFactory
     */
    protected $jsonFactory;

    public function __construct(
        Context $context,
        Curl $curl,
        JsonFactory $jsonFactory
    ) {
        parent::__construct($context);
        $this->curl = $curl;
        $this->jsonFactory = $jsonFactory;
    }

    public function execute()
    {
        $apiUrl = 'https://fakestoreapi.com/products/';

        $this->curl->get($apiUrl);
        $responseBody = $this->curl->getBody();

        $responseData = json_decode($responseBody, true);

        $resultJson = $this->jsonFactory->create();
        $resultJson->setData($responseData);

        return $resultJson;
    }
}