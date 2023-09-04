<?php
namespace Taller\TareaTres\Block;
use Magento\Framework\HTTP\Client\Curl;
use Magento\Framework\App\Request\Http;

class Detalles extends \Magento\Framework\View\Element\Template
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
		$id = $this->request->getParam('id');
		$apiUrl = 'https://fakestoreapi.com/products/'.$id;

		$this->httpClient->get($apiUrl);
		
		$responseBody = $this->httpClient->getBody();
		$responseObject = json_decode($responseBody);

		return $responseObject;
	}

}