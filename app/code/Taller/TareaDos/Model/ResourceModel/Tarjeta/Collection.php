<?php
namespace Taller\TareaDos\Model\ResourceModel\Tarjeta;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'id';
	protected $_eventPrefix = 'taller_tareados_tarjeta_collection';
	protected $_eventObject = 'tarjeta_collection';
	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Taller\TareaDos\Model\Tarjeta', 'Taller\TareaDos\Model\ResourceModel\Tarjeta');
	}
}