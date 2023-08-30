<?php
namespace Taller\TareaUno\Model;
class Contacto extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
	const CACHE_TAG = 'taller_tareauno_contacto';
	protected $_cacheTag = 'taller_tareauno_contacto';
	protected $_eventPrefix = 'taller_tareauno_contacto';
	protected function _construct()
	{
		$this->_init('Taller\TareaUno\Model\ResourceModel\Post');
	}
	public function getIdentities()
	{
		return [self::CACHE_TAG . '_' . $this->getId()];
	}
	public function getDefaultValues()
	{
		$values = [];
		return $values;
	}
}