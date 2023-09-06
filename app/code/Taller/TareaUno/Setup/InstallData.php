<?php
namespace Taller\TareaUno\Setup;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
class InstallData implements InstallDataInterface
{
	protected $_postFactory;
	public function __construct(\Taller\TareaUno\Model\ContactoFactory $contactoFactory)
	{
		$this->contactoFactory = $contactoFactory;
	}
	public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
	{
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