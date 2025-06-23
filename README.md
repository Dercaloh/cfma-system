# 📦 Sistema de Gestión de Préstamos e Inventario de Activos de TI – CFMA

<p align="center">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="360" alt="Laravel Logo">
</p>

<p align="center">
    <strong>CFMA - SENA | Laravel 10 | PHP 8.x | MySQL/MariaDB | XAMPP</strong><br>
    Sistema modular, seguro y escalable para gestionar activos de TI, préstamos, seguimiento documental y trazabilidad en el Centro de Formación Minero Ambiental del SENA.
</p>

---

## 🧩 Características Principales

- 🔐 Acceso autenticado por roles (`administrador`, `subdirector`, `supervisor`, `instructor`, `portería`)
- 🖥️ Inventario de activos con soporte para documentos asociados
- 🔄 Flujo completo de préstamos: solicitud, aprobación, entrega y devolución
- 📎 Gestión documental con relaciones polimórficas
- 📬 Alertas de vencimiento y bitácora de auditoría conforme a ISO 27001
- 📊 Reportes exportables (PDF/Excel) con filtros avanzados

---

## 🛠️ Tecnologías

- [Laravel 10.x](https://laravel.com)
- [PHP 8.x](https://www.php.net/)
- [MySQL/MariaDB](https://www.mysql.com/)
- [XAMPP](https://www.apachefriends.org/)
- [Laravel Breeze](https://laravel.com/docs/starter-kits#breeze)
- [Bootstrap 5.3](https://getbootstrap.com/)
- [Dompdf](https://github.com/barryvdh/laravel-dompdf)
- [Maatwebsite Excel](https://laravel-excel.com/)
- [Spatie Laravel Permission (opcional)](https://spatie.be/docs/laravel-permission/)

---

## 🚀 Instalación Local

### Requisitos

- Windows 11
- XAMPP (Apache en puerto 8080)
- Composer
- Node.js + npm
- Git
- VS Code

### Pasos

```bash
git clone https://github.com/dercaloh/cfma-system.git
cd cfma-system

composer install
cp .env.example .env
php artisan key:generate

php artisan migrate --seed

npm install
npm run dev
```

Configura `.env`:

```dotenv
APP_NAME=CFMA
APP_URL=http://cfma.local:8080
DB_DATABASE=cfma_db
DB_USERNAME=root
DB_PASSWORD=
```

Agrega al archivo `hosts`:

```
127.0.0.1 cfma.local
```

---

## 🔐 Accesos Iniciales

| Rol           | Usuario                | Contraseña |
|---------------|------------------------|------------|
| Administrador | admin@cfma.local       | admin123   |
| Subdirector   | sub@cfma.local         | sub123     |
| Instructor    | instructor@cfma.local  | inst123    |

> Estas cuentas son cargadas vía seeders. Puedes modificarlas desde el panel administrativo.

---

## 📚 Documentación

- `docs/instalacion.md`: Guía técnica paso a paso
- `docs/manual-usuario.pdf`: Manual para usuarios finales
- `docs/esquema-bd.pdf`: Diagrama entidad-relación (base de datos)

---

## 📜 Licencia

Este software es de uso interno del **Centro de Formación Minero Ambiental del SENA**  
Distribuido bajo licencia [MIT](https://opensource.org/licenses/MIT).

---

## ✉️ Contacto

> Desarrollado por Harold A. Cordero Solera  
> Contacto: [ingharoldcordero@gmail.com](mailto:ingharoldcordero@gmail.com)
