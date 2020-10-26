<?php

declare(strict_types=1);

namespace Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201026050016 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create Orders';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE public.orders (id UUID NOT NULL, client_id UUID DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_AFC189CE19EB6921 ON public.orders (client_id)');
        $this->addSql('CREATE INDEX orders_id_idx ON public.orders (id)');
        $this->addSql('ALTER TABLE public.orders ADD CONSTRAINT FK_AFC189CE19EB6921 FOREIGN KEY (client_id) REFERENCES public.clients (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE public.orders DROP CONSTRAINT FK_AFC189CE19EB6921');
        $this->addSql('DROP TABLE public.orders');
    }
}
