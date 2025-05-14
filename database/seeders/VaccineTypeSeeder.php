<?php

namespace Database\Seeders;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VaccineTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vaccineTypes = [
            [
                'name' => 'Rabies',
                'category' => 'Required by law',
                'description' => 'Prevents rabies virus infection. Required by law in most areas and jurisdictions. Certificate required after vaccination.',
                'for_species' => 'Dog,Cat',
                'minimum_age_days' => 90, // 3 months
                'default_validity_period' => 365 * 3, // 3 years validity
                'requires_booster' => false,
                'booster_waiting_period' => null,
                'default_administration_route' => 'SubQ',
                'common_manufacturers' => 'IMRAB,Nobivac,Defensor',
                'default_cost' => 25.00,
                'is_required_by_law' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'DHPP',
                'category' => 'Core',
                'description' => 'Core vaccine for all dogs. Protects against Distemper, Hepatitis, Parainfluenza, and Parvovirus.',
                'for_species' => 'Dog',
                'minimum_age_days' => 42, // 6 weeks
                'default_validity_period' => 365, // 1 year validity
                'requires_booster' => true,
                'booster_waiting_period' => 21, // 3 weeks for booster
                'default_administration_route' => 'SubQ',
                'common_manufacturers' => 'Nobivac,Vanguard,Duramune',
                'default_cost' => 35.00,
                'is_required_by_law' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'FVRCP',
                'category' => 'Core',
                'description' => 'Core vaccine for all cats. Protects against Feline Viral Rhinotracheitis, Calicivirus, and Panleukopenia.',
                'for_species' => 'Cat',
                'minimum_age_days' => 42, // 6 weeks
                'default_validity_period' => 365, // 1 year validity
                'requires_booster' => true,
                'booster_waiting_period' => 21, // 3 weeks for booster
                'default_administration_route' => 'SubQ',
                'common_manufacturers' => 'Nobivac,Felocell,PureVax',
                'default_cost' => 32.00,
                'is_required_by_law' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Bordetella',
                'category' => 'Non-core',
                'description' => 'Prevents kennel cough (Bordetella bronchiseptica). Recommended for dogs in boarding, daycare, or other social environments.',
                'for_species' => 'Dog',
                'minimum_age_days' => 56, // 8 weeks
                'default_validity_period' => 365, // 1 year validity
                'requires_booster' => false,
                'booster_waiting_period' => null,
                'default_administration_route' => 'Intranasal',
                'common_manufacturers' => 'Bronchi-Shield,Nobivac KC,Vanguard',
                'default_cost' => 20.00,
                'is_required_by_law' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Leptospirosis',
                'category' => 'Non-core',
                'description' => 'Protects against Leptospira bacteria. Recommended for dogs with outdoor exposure or in areas with wildlife.',
                'for_species' => 'Dog',
                'minimum_age_days' => 56, // 8 weeks
                'default_validity_period' => 365, // 1 year validity
                'requires_booster' => true,
                'booster_waiting_period' => 21, // 3 weeks for booster
                'default_administration_route' => 'SubQ',
                'common_manufacturers' => 'Nobivac,Vanguard,Recombitek',
                'default_cost' => 22.00,
                'is_required_by_law' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'FeLV',
                'category' => 'Non-core',
                'description' => 'Feline Leukemia Virus vaccine. Recommended for outdoor cats or those with exposure to other cats.',
                'for_species' => 'Cat',
                'minimum_age_days' => 56, // 8 weeks
                'default_validity_period' => 365, // 1 year validity
                'requires_booster' => true,
                'booster_waiting_period' => 21, // 3 weeks for booster
                'default_administration_route' => 'SubQ',
                'common_manufacturers' => 'PureVax,Nobivac,Felocell',
                'default_cost' => 28.00,
                'is_required_by_law' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Lyme Disease',
                'category' => 'Non-core',
                'description' => 'Protects against Borrelia burgdorferi (Lyme disease). Recommended for dogs in areas with high tick prevalence.',
                'for_species' => 'Dog',
                'minimum_age_days' => 56, // 8 weeks
                'default_validity_period' => 365, // 1 year validity
                'requires_booster' => true,
                'booster_waiting_period' => 21, // 3 weeks for booster
                'default_administration_route' => 'SubQ',
                'common_manufacturers' => 'Nobivac,Vanguard,Recombitek',
                'default_cost' => 30.00,
                'is_required_by_law' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'FIV',
                'category' => 'Non-core',
                'description' => 'Feline Immunodeficiency Virus vaccine. Recommended for outdoor cats with high risk of fighting with other cats.',
                'for_species' => 'Cat',
                'minimum_age_days' => 56, // 8 weeks
                'default_validity_period' => 365, // 1 year validity
                'requires_booster' => true,
                'booster_waiting_period' => 21, // 3 weeks for booster
                'default_administration_route' => 'SubQ',
                'common_manufacturers' => 'Fel-O-Vax,PureVax',
                'default_cost' => 35.00,
                'is_required_by_law' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Canine Influenza',
                'category' => 'Non-core',
                'description' => 'Protects against H3N8 and H3N2 canine influenza virus. Recommended for dogs in social settings or areas with outbreaks.',
                'for_species' => 'Dog',
                'minimum_age_days' => 56, // 8 weeks
                'default_validity_period' => 365, // 1 year validity
                'requires_booster' => true,
                'booster_waiting_period' => 21, // 3 weeks for booster
                'default_administration_route' => 'SubQ',
                'common_manufacturers' => 'Nobivac,Vanguard,Merck',
                'default_cost' => 32.00,
                'is_required_by_law' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Canine Coronavirus',
                'category' => 'Non-core',
                'description' => 'Protects against canine enteric coronavirus. Optional vaccine, discuss with veterinarian if needed.',
                'for_species' => 'Dog',
                'minimum_age_days' => 42, // 6 weeks
                'default_validity_period' => 365, // 1 year validity
                'requires_booster' => true,
                'booster_waiting_period' => 21, // 3 weeks for booster
                'default_administration_route' => 'SubQ',
                'common_manufacturers' => 'Nobivac,Vanguard,Merial',
                'default_cost' => 26.00,
                'is_required_by_law' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];
        
        // Insert the vaccine types into the database
        DB::table('vaccine_types')->insert($vaccineTypes);
        
        $this->command->info('Inserted ' . count($vaccineTypes) . ' vaccine types');
    }
}
