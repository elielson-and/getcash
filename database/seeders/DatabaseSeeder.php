<?php

use App\Models\Loan;
use App\Models\LoanStatus;
use App\Models\User;
use App\Models\Status;
use App\Models\Wallet;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Criação de usuários específicos
        $this->createUsers();

        // Criação de status
        $this->createStatuses(['Pendente', 'Em análise', 'Aprovado', 'Revogado']);
        $this->createLoanStatuses(['Aguardando aprovação', 'Vigente', 'Quitado', 'Cancelado']);
        $this->createLoan();
    }

    /**
     * Cria usuários específicos.
     */
    private function createUsers(): void
    {
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'admin' => true,
        ]);

        $userClient = User::factory()->create([
            'name' => 'Client User',
            'email' => 'client@example.com',
        ]);

        // Associa uma wallet ao usuário padrão
        Wallet::factory()->create([
            'user_id' => $userClient->id,
        ]);
    }



    /**
     * Cria uma lista de status.
     *
     * @param array $statuses Nomes dos status a serem criados.
     */
    private function createStatuses(array $statuses): void
    {
        foreach ($statuses as $status) {
            Status::factory()->create(['name' => $status]);
        }
    }

    /**
     * Cria uma lista de status.
     *
     * @param array $statuses Nomes dos status a serem criados.
     */
    private function createLoanStatuses(array $statuses): void
    {
        foreach ($statuses as $status) {
            LoanStatus::factory()->create(['name' => $status]);
        }
    }


    private function createLoan(): void
    {
        Loan::factory()->create([
            'value' => 20,
            'user_id' => 2,
            'installment_amount' => 1,
            'current_installment' => 1,
            'installment_value' => 10,
            'loan_status_id' => 2
        ]);
    }
}
