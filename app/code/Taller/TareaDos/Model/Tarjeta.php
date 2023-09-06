<?php
namespace Taller\TareaDos\Model;
class Tarjeta extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
	const CACHE_TAG = 'taller_tareados_tarjeta';
	protected $_cacheTag = 'taller_tareados_tarjeta';
	protected $_eventPrefix = 'taller_tareados_tarjeta';
	protected function _construct()
	{
		$this->_init('Taller\TareaDos\Model\ResourceModel\Tarjeta');
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