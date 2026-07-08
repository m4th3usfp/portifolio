<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;

class DispararCurriculo extends Command
{
    protected $signature = 'curriculo:disparar
        {--emails= : Caminho para o arquivo de emails}
        {--pdf= : Caminho para o PDF do currículo}
        {--dry-run : Apenas mostra o que seria enviado sem enviar}';

    protected $description = 'Dispara o currículo em PDF para uma lista de emails';

    public function handle(): int
    {
        $emailFile = $this->option('emails') ?? dirname(__DIR__, 4) . '/scripts/emails.txt';
        $pdfPath = $this->option('pdf') ?? dirname(__DIR__, 4) . '/curriculo-matheus-pizzinato.pdf';
        $dryRun = $this->option('dry-run');

        if (!File::exists($emailFile)) {
            $this->error("Arquivo de emails não encontrado: {$emailFile}");
            $this->info("Crie o arquivo em scripts/emails.txt com um email por linha.");
            return Command::FAILURE;
        }

        if (!File::exists($pdfPath)) {
            $this->error("PDF do currículo não encontrado: {$pdfPath}");
            $this->info("Gere o PDF primeiro com: make pdf");
            return Command::FAILURE;
        }

        $lines = File::lines($emailFile)->filter(function ($line) {
            $line = trim($line);
            return $line !== '' && !str_starts_with($line, '#');
        })->values()->toArray();

        if (empty($lines)) {
            $this->warn('Nenhum email encontrado no arquivo.');
            return Command::SUCCESS;
        }

        $emails = collect($lines)
            ->map(fn ($line) => trim($line))
            ->filter(fn ($email) => filter_var($email, FILTER_VALIDATE_EMAIL))
            ->values()
            ->toArray();

        $invalid = array_diff($lines, $emails);
        if (!empty($invalid)) {
            $this->warn('Emails inválidos ignorados:');
            foreach ($invalid as $email) {
                $this->warn("  - {$email}");
            }
        }

        if (empty($emails)) {
            $this->warn('Nenhum email válido encontrado.');
            return Command::SUCCESS;
        }

        $this->info("Enviando currículo para " . count($emails) . " empresa(s)...\n");

        if ($dryRun) {
            $this->warn("=== DRY RUN - Nenhum email será enviado de fato ===\n");
            foreach ($emails as $email) {
                $this->line("  [DRY RUN] Enviaria para: {$email}");
            }
            $this->newLine();
            $this->info("Total: " . count($emails) . " email(s)");
            return Command::SUCCESS;
        }

        $success = 0;
        $failed = 0;

        foreach ($emails as $email) {
            try {
                Mail::send('emails.curriculo', [], function ($message) use ($email, $pdfPath) {
                    $message->to($email)
                        ->subject('Currículo - Matheus Fanuchy Pizzinato (Desenvolvedor Fullstack)')
                        ->attach($pdfPath, [
                            'as' => 'curriculo-matheus-pizzinato.pdf',
                            'mime' => 'application/pdf',
                        ]);
                });

                $this->info("  ✅ Enviado para: {$email}");
                $success++;
            } catch (\Exception $e) {
                $this->error("  ❌ Falha ao enviar para {$email}: {$e->getMessage()}");
                $failed++;
            }
        }

        $this->newLine();
        $this->info("Resumo: {$success} enviado(s), {$failed} falha(s)");

        return $failed > 0 ? Command::FAILURE : Command::SUCCESS;
    }
}
