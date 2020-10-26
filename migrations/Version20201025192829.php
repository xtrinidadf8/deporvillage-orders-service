<?php

declare(strict_types=1);

namespace Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;

final class Version20201025192829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create Client Table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE public.clients (id UUID NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX clients_id_idx ON public.clients (id)');
        $this->addSql('CREATE INDEX clients_email_idx ON public.clients (email)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE public.clients');
    }
}
