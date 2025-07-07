Write-Host "==============================================================="
Write-Host "    SISTEMA DE GESTIÓN DE PRÉSTAMOS E INVENTARIO - SGPTI"
Write-Host "           Inicialización local - CFMA SENA - Windows 11"
Write-Host "==============================================================="
Write-Host ""

# 1. Verifica si PHP está instalado
if (-not (Get-Command php -ErrorAction SilentlyContinue)) {
    Write-Host "❌ PHP no está instalado o no está en el PATH."
    Pause
    exit
}

# 2. Verifica si Composer está instalado
if (-not (Get-Command composer -ErrorAction SilentlyContinue)) {
    Write-Host "❌ Composer no está instalado o no está en el PATH."
    Pause
    exit
}

# 3. Instala dependencias PHP
Write-Host "📦 Instalando dependencias PHP con Composer..."
composer install --ignore-platform-req=ext-zip

# 4. Instala dependencias NPM
if (-not (Get-Command npm -ErrorAction SilentlyContinue)) {
    Write-Host "❌ Node.js/NPM no está instalado o no está en el PATH."
    Pause
    exit
}
Write-Host "📦 Instalando dependencias Frontend con NPM..."
npm install

# 5. Publica archivos de configuración de los paquetes
Write-Host "🛠️ Publicando archivos de configuración de paquetes..."
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --ansi
php artisan vendor:publish --provider="Spatie\Activitylog\ActivitylogServiceProvider" --tag="activitylog-config" --ansi
php artisan vendor:publish --provider="Spatie\Sitemap\SitemapServiceProvider" --ansi
php artisan vendor:publish --provider="Spatie\LaravelSeo\SeoServiceProvider" --ansi
php artisan vendor:publish --provider="Barryvdh\DomPDF\ServiceProvider" --ansi

# 6. Crea archivo .env si no existe
if (-not (Test-Path ".env")) {
    Write-Host "🔧 Copiando archivo .env.example..."
    Copy-Item ".env.example" ".env"
}

# 7. Genera clave de aplicación
Write-Host "🔐 Generando clave de aplicación (APP_KEY)..."
php artisan key:generate --ansi

# 8. Crea base de datos SQLite si no existe
if (-not (Test-Path "database\database.sqlite")) {
    Write-Host "🧱 Creando base de datos local SQLite..."
    New-Item -Path "database\database.sqlite" -ItemType File | Out-Null
}

# 9. Compila TailwindCSS y Vite en modo desarrollo
Write-Host "🎨 Compilando TailwindCSS con Vite..."
npm run dev

# 10. Limpia cachés y descubre paquetes
Write-Host "🔄 Limpiando cachés y descubriendo paquetes..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
composer dump-autoload

# Finalización
Write-Host ""
Write-Host "✅ SGPTI listo para usarse en entorno local."
Write-Host "🔗 Abre http://localhost si usas 'php artisan serve'."
Pause
