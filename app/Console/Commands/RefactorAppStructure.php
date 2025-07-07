<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RegexIterator;
use Illuminate\Support\Str;
use Symfony\Component\Finder\Finder;

class RefactorAppStructure extends Command
{
    protected $signature = 'namespace:refactor';
    protected $description = 'Reorganiza la estructura de app/ y actualiza namespaces y use.';

    // Mapeo de carpetas a mover (origen => destino)
    protected $structure = [
        'Http/Controllers/Admin'      => 'AccessControl/Controllers',
        'Http/Controllers/Api'        => 'Assets/Controllers/Api',
        'Http/Controllers/Auth'       => 'AccessControl/Controllers/Auth',
        'Http/Controllers/Security'   => 'AccessControl/Controllers/Security',
        'Http/Controllers/Usuarios'   => 'Users/Controllers',
        'Http/Controllers'            => 'Http/Controllers',
        'Requests/Auth'               => 'AccessControl/Requests/Auth',
        'Requests/Api'                => 'Assets/Requests/Api',
        'Requests/Security'           => 'AccessControl/Requests/Security',
        'Requests/Usuarios'          => 'Users/Requests',
        'Requests'                    => 'Http/Requests',
        'Policies'                    => 'Shared/Policies',
        'Services/Usuarios'          => 'Users/Services',
        'Exports'                     => 'Exports/Users',
        'Imports'                     => 'Imports/Users',
    ];

    public function handle()
    {
        foreach ($this->structure as $from => $to) {
            $this->moveAndUpdateNamespaces("app/$from", "app/$to");
        }

        $this->info("✅ Reorganización y actualización de namespaces completada.");
    }

    protected function moveAndUpdateNamespaces($from, $to)
    {
        if (!is_dir($from)) {
            $this->warn("⛔ Carpeta no encontrada: $from");
            return;
        }

        if (!is_dir($to)) {
            mkdir($to, 0777, true);
        }

        $finder = new Finder();
        $finder->files()->in($from)->name('*.php');

        foreach ($finder as $file) {
            $originalPath = $file->getRealPath();
            $filename = $file->getFilename();
            $relativeFrom = Str::after($file->getPath(), $from);
            $targetDir = rtrim($to . $relativeFrom, DIRECTORY_SEPARATOR);
            $newPath = $targetDir . DIRECTORY_SEPARATOR . $filename;

            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            $code = file_get_contents($originalPath);

            // 🧠 1. Actualiza namespace del archivo
            $newNamespace = 'App\\' . str_replace(['/', '\\'], '\\', Str::after($targetDir, 'app/'));
            $code = preg_replace('/namespace\s+App\\\\[^;]+;/', "namespace $newNamespace;", $code);

            // 🧠 2. Actualiza TODOS los `use App\...;`
            $code = preg_replace_callback('/use\s+App\\\\[^\s;]+;/', function ($matches) {
                $useLine = $matches[0];
                $path = trim(Str::after($useLine, 'use '), ';');
                foreach ($this->structure as $old => $new) {
                    $oldNs = 'App\\' . str_replace('/', '\\', $old);
                    $newNs = 'App\\' . str_replace('/', '\\', $new);
                    if (Str::startsWith($path, $oldNs)) {
                        $updatedPath = str_replace($oldNs, $newNs, $path);
                        return "use $updatedPath;";
                    }
                }
                return $useLine;
            }, $code);

            // Guardar en nueva ubicación
            file_put_contents($newPath, $code);
            unlink($originalPath);

            $this->info("✅ $filename movido a $to/");
        }

        // Elimina carpeta si queda vacía
        if (is_dir($from) && count(glob("$from/*")) === 0) {
            rmdir($from);
        }
    }
}
