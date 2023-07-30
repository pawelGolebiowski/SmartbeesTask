<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

class Version20230725152020 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $table = $schema->getTable('shipping_method');
        $table->addColumn('related_payment_methods_ids', 'json', ['notnull' => false]);
    }
}