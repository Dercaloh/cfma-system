<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Sembrador maestro del sistema SGPTI.
     * Ordenado por dependencias y estructura modular.
     */
    public function run(): void
    {
        // 🔐 FASE 1: Seguridad y Accesos
        $this->call([
            RolesTableSeeder::class,
            PermissionsTableSeeder::class,
            RolePermissionTableSeeder::class,
            UsersTableSeeder::class,
        ]);

        // 🏛️ FASE 2: Organización y Catálogos Institucionales
        $this->call([
            LocationsTableSeeder::class,
            DepartmentsTableSeeder::class,
            BranchesTableSeeder::class,
            PositionsTableSeeder::class,
            ProxyTypesTableSeeder::class,
            ProgramsTableSeeder::class,
        ]);

        // 💻 FASE 3: Inventario de Activos TIC
        $this->call([
            AssetTypesTableSeeder::class,
            AssetsTableSeeder::class,
        ]);

        // 🔄 FASE 4: Préstamos y Flujo de Gestión
        $this->call([
            LoanStatusesTableSeeder::class,
            LoansTableSeeder::class,
            LoanDetailsTableSeeder::class,
            LoanApprovalsTableSeeder::class,
            SignaturesTableSeeder::class,
        ]);

        // 🧾 FASE 5: Soporte Documental y Portería
        $this->call([
            GateLogsTableSeeder::class,
            ExitPassesTableSeeder::class,
        ]);

        // 📋 FASE 6: Auditoría Interna
        $this->call([
            AuditLogsTableSeeder::class,
        ]);
    }
}
