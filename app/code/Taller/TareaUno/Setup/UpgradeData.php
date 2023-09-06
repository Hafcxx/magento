<?php
namespace Taller\TareaUno\Setup;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
class UpgradeData implements UpgradeDataInterface
{
	protected $_postFactory;
	public function __construct(\Taller\TareaUno\Model\ContactoFactory $contactoFactory)
	{
		$this->contactoFactory = $contactoFactory;
	}
	public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
	{
		if (version_compare($context->getVersion(), '1.5.0', '<')) {
			$data = [
				'nombre_completo' => "Manuel Rodriguez",
				'correo' => "manuel@outloook.com",
				'telefono' => "983006300",
				'funcion' => "Guerrillero",
				
			];
			$post = $this->contactoFactory->create();
			$post->addData($data)->save();
		}
		
	}
}