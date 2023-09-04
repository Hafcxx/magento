<?php
namespace Taller\TareaUno\Setup;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
class UpgradeSchema implements UpgradeSchemaInterface
{
	public function upgrade( SchemaSetupInterface $setup, ModuleContextInterface $context ) {
		$installer = $setup;
		$installer->startSetup();
		if(version_compare($context->getVersion(), '1.4.0', '<')) {
			if (!$installer->tableExists('contactos')) {
				$table = $installer->getConnection()->newTable(
					$installer->getTable('contactos')
				)
					->addColumn(
						'id',
						\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
						null,
						[
							'identity' => true,
							'nullable' => false,
							'primary'  => true,
							'unsigned' => true,
						],
						'ID'
					)
					->addColumn(
						'nombre_completo',
						\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
						255,
						['nullable => false'],
						'Nombre Completo'
					)
					->addColumn(
						'correo',
						\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
						255,
						['nullable => false'],
						'Correo'
					)
					->addColumn(
						'telefono',
						\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
						255,
						['nullable => false'],
						'Teléfono'
					)
					->addColumn(
						'funcion',
						\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
						255,
						['nullable => false'],
						'Función'
					)
					
					->setComment('Tabla de Contactos');
					$installer->getConnection()->createTable($table);
					$installer->getConnection()->addIndex(
					$installer->getTable('contactos'),
					$setup->getIdxName(
						$installer->getTable('contactos'),
						['nombre_completo','correo','telefono','funcion'],
						\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
					),
					['nombre_completo','correo','telefono','funcion'],
					\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
				);
			}else{
				/*
				$tableName = $setup->getTable('contactos');

				$setup->getConnection()->addColumn(
					$tableName,
					'telefono',
					[
						'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
						'nullable' => true,
						'comment' => 'Teléfono'
					]
				);

				$setup->getConnection()->addColumn(
					$tableName,
					'funcion',
					[
						'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
						'nullable' => true,
						'comment' => 'Función'
					]
				);
				*/
			}
		}
		$installer->endSetup();
	}
}