<?php
namespace Taller\TareaUno\Model\ResourceModel;
class Contacto extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
	
	public function __construct(
		\Magento\Framework\Model\ResourceModel\Db\Context $context
	)
	{
		parent::__construct($context);
	}
	
	protected function _construct()
	{
		$this->_init('contactos', 'id');
	}
	
}