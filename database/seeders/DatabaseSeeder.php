<?php

namespace Database\Seeders;

use App\Models\FacilityRequest;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $sampleRequests = [
            [
                'facility_name' => 'Legazpi City Jail',
                'region' => 'Region V - Albay',
                'contact_name' => 'JO1 Marco Reyes',
                'position' => 'Jail Officer',
                'contact_number' => '09171234567',
                'email' => 'legazpi.jail@bjmp.gov.ph',
                'message' => 'Interested in piloting VTrack for our main gate.',
                'status' => 'pending',
            ],
            [
                'facility_name' => 'Naga City Jail',
                'region' => 'Region V - Camarines Sur',
                'contact_name' => 'JO2 Liza Fernandez',
                'position' => 'Records Officer',
                'contact_number' => '09182345678',
                'email' => 'naga.jail@bjmp.gov.ph',
                'message' => 'Would like a demo before the next quarter.',
                'status' => 'contacted',
            ],
            [
                'facility_name' => 'Sorsogon District Jail',
                'region' => 'Region V - Sorsogon',
                'contact_name' => 'SJO1 Paolo Santos',
                'position' => 'Jail Warden',
                'contact_number' => '09193456789',
                'email' => 'sorsogon.jail@bjmp.gov.ph',
                'message' => null,
                'status' => 'approved',
            ],
            [
                'facility_name' => 'Masbate City Jail',
                'region' => 'Region V - Masbate',
                'contact_name' => 'JO1 Karen Villamor',
                'position' => 'Administrative Officer',
                'contact_number' => '09204567890',
                'email' => 'masbate.jail@bjmp.gov.ph',
                'message' => 'Budget approval still pending on our end.',
                'status' => 'declined',
            ],
        ];

        foreach ($sampleRequests as $request) {
            FacilityRequest::create($request);
        }
    }
}
