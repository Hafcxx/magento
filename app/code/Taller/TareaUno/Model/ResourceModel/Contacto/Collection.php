<?php
namespace Taller\TareaUno\Model\ResourceModel\Contacto;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'id';
	protected $_eventPrefix = 'taller_tareauno_contacto_collection';
	protected $_eventObject = 'contacto_collection';
	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Taller\TareaUno\Model\Contacto', 'Taller\TareaUno\Model\ResourceModel\Contacto');
	}
}