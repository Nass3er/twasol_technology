<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AddLocale extends Command
{
    // protected $signature = 'add:locale';
    protected $signature = 'add:locale {file=adminlte}';
    protected $description = 'Add a new translation key to en/ar landingpage.php without altering existing formatting';

    public function handle()
    {
        $key = $this->ask('Enter the translation key (e.g., futurePlans)');
        $enValue = $this->ask('Enter the English translation');
        $arValue = $this->ask('Enter the Arabic translation');

        $baseLangPath = base_path('lang/vendor/adminlte');
        $langs = ['en' => $enValue, 'ar' => $arValue];

        foreach ($langs as $lang => $value) {
            // $filePath = "{$baseLangPath}/{$lang}/landingpage.php";
            $file = $this->argument('file');
            $filePath = "{$baseLangPath}/{$lang}/{$file}.php";
            
            // Ensure file and directory exist
            if (!is_dir(dirname($filePath))) {
                mkdir(dirname($filePath), 0755, true);
            }
            if (!file_exists($filePath)) {
                file_put_contents($filePath, "<?php\n\nreturn [\n];\n");
            }

            // Read file contents
            $lines = file($filePath, FILE_IGNORE_NEW_LINES);
            $keyExists = false;

            // Check if key already exists
            foreach ($lines as $line) {
                if (preg_match('/[\'"]' . preg_quote($key, '/') . '[\'"]\s*=>/', $line)) {
                    $this->warn("⚠️ Key '{$key}' already exists in {$lang}/landingpage.php. Skipping.");
                    $keyExists = true;
                    break;
                }
            }

            if ($keyExists) continue;

            // Insert new line before the closing ];
            $newLine = "    '{$key}' => '{$value}',";

            $inserted = false;
            foreach ($lines as $i => $line) {
                if (trim($line) === ');') {
                    array_splice($lines, $i, 0, $newLine);
                    $inserted = true;
                    break;
                }
            }

            if (!$inserted) {
                $this->error("❌ Could not find closing bracket in {$lang}/landingpage.php.");
                continue;
            }

            // Write back
            file_put_contents($filePath, implode(PHP_EOL, $lines) . PHP_EOL);
            $this->info("✅ Added '{$key}' to {$lang}/landingpage.php.");
        }
    }
}
