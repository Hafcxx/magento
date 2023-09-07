<?php
namespace Taller\TareaDos\Setup;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
class UpgradeSchema implements UpgradeSchemaInterface
{
	public function upgrade( SchemaSetupInterface $setup, ModuleContextInterface $context ) {
		$installer = $setup;
		$installer->startSetup();
		if(true) {
			if (!$installer->tableExists('tarjetas')) {
				$table = $installer->getConnection()->newTable(
					$installer->getTable('tarjetas')
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
						'numero',
						\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
						null,
						['nullable => false'],
						'Número'
					)
					->addColumn(
						'nombre',
						\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
						255,
						['nullable => false'],
						'Nombre'
					)
					->addColumn(
						'vencimiento',
						\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
						255,
						['nullable => false'],
						'Vencimiento'
					)
					->addColumn(
						'cvv',
						\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
						null,
						['nullable => false'],
						'Cvv'
					)
					
					->setComment('Tabla de Tarjetas');
					$installer->getConnection()->createTable($table);
					$installer->getConnection()->addIndex(
					$installer->getTable('tarjetas'),
					$setup->getIdxName(
						$installer->getTable('tarjetas'),
						['numero','nombre','vencimiento','cvv'],
						\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
					),
					['numero','nombre','vencimiento','cvv'],
					\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
				);
			}else{
				/*
				$tableName = $setup->getTable('tarjetas');

				$setup->getConnection()->addColumn(
					$tableName,
					'cvv',
					[
						'type' => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
						'nullable' => true,
						'comment' => 'Cvv'
					]
				);
				*/
			}
		}
		$installer->endSetup();
	}
}