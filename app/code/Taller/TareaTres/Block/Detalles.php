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
		try {
            $id = $this->request->getParam('id');
            if (!is_numeric($id)) {
                throw new \Exception('Parametro invalido: id debe ser un valor numerico');
            }

			$apiUrl = 'https://fakestoreapi.com/products/'.$id;

			$this->httpClient->get($apiUrl);
			
			$responseBody = $this->httpClient->getBody();
			$responseObject = json_decode($responseBody);
	
			return $responseObject;
        } catch (\Exception $e) {

            return $e->getMessage();
        }

	}

}