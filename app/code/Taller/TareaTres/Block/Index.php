<?php
namespace Taller\TareaTres\Block;
use Magento\Framework\HTTP\Client\Curl;
use Magento\Framework\App\Request\Http;

class Index extends \Magento\Framework\View\Element\Template
{
	protected $httpClient;
	protected $request;

	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		Http $request,
		array $data = [],
		Curl $httpClient
	)
	{
		$this->request = $request;
		$this->httpClient = $httpClient;
		parent::__construct($context, $data);

	}

	public function getApiResponse()
	{
		$apiUrl = 'https://fakestoreapi.com/products';

		$this->httpClient->get($apiUrl);
		
		$responseBody = $this->httpClient->getBody();
		$responseObject = json_decode($responseBody);

		return $responseObject;
	}

}