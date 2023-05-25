<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,
            UsersTableSeeder::class,
            RoleUserTableSeeder::class,
            TagCatTableSeeder::class,
            TagTableSeeder::class,
            EquipmentTableSeeder::class,
            SampleTableSeeder::class,
            ExternalSampleTableSeeder::class,
            SubstrateBatchTableSeeder::class,
            PrecursorPropertiesTableSeeder::class,
            SourceTableSeeder::class,
            GasLineTableSeeder::class,
            GasLineSourceTableSeeder::class,
            SpecialFlowTableSeeder::class,
            CvrTableSeeder::class,
            CvrStepTableSeeder::class,
            SubstrateTableSeeder::class,
            SplitTableSeeder::class,
            CleaningTableSeeder::class,
            ProcessStepTableSeeder::class,
            GasFlowTableSeeder::class,
            ProcessStepSampleTableSeeder::class,
            LocalisationTableSeeder::class,
            MaintenanceTableSeeder::class,
            EquipmentProcessStepTableSeeder::class,
            TaggableTableSeeder::class,
            DocumentTableSeeder::class,
            EquipmentGasLineTableSeeder::class,
        ]);
    }
}
