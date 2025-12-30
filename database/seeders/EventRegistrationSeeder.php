<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\User;
use Illuminate\Database\Seeder;

class EventRegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = Event::all();
        $users = User::where('role_id', 2)->get(); // Mahasiswa only
        $admins = User::where('role_id', 1)->get(); // Admin untuk reviewer

        if ($events->isEmpty() || $users->isEmpty()) {
            $this->command->warn('⚠ No events or users found. Please run EventSeeder and UserSeeder first.');
            return;
        }

        $admin = $admins->first();
        $statuses = ['pending', 'approved', 'rejected'];
        $reasons = [
            'Saya tertarik mengikuti event ini untuk menambah wawasan.',
            'Ingin belajar lebih banyak tentang topik yang dibahas.',
            'Event ini sangat relevan dengan jurusan saya.',
            'Saya ingin mengembangkan skill di bidang ini.',
            'Tertarik untuk networking dengan sesama mahasiswa.',
        ];

        $adminNotes = [
            'Disetujui. Selamat bergabung!',
            'Approved. Mohon hadir tepat waktu.',
            'Terima kasih sudah mendaftar. Approved.',
            'Ditolak karena kuota sudah penuh.',
            'Maaf, event ini khusus untuk jurusan tertentu.',
            'Rejected: Tidak memenuhi persyaratan.',
        ];

        $registrations = [];

        // Create sample registrations
        foreach ($events->take(5) as $event) {
            $registeredUsers = collect();
            
            // Each event gets 3-5 registrations
            $registrationCount = rand(3, 5);
            
            for ($i = 0; $i < $registrationCount; $i++) {
                // Get a user that hasn't registered for this event yet
                $availableUsers = $users->reject(function ($user) use ($registeredUsers) {
                    return $registeredUsers->contains($user->id);
                });

                if ($availableUsers->isEmpty()) {
                    break;
                }

                $user = $availableUsers->random();
                $registeredUsers->push($user->id);
                $status = $statuses[array_rand($statuses)];

                $registration = [
                    'event_id' => $event->id,
                    'user_id' => $user->id,
                    'status' => $status,
                    'reason' => $reasons[array_rand($reasons)],
                    'registered_at' => now()->subDays(rand(1, 10)),
                    'reviewed_by' => null,
                    'reviewed_at' => null,
                    'admin_notes' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                // Add review details if not pending
                if ($status !== 'pending') {
                    $registration['reviewed_by'] = $admin->id;
                    $registration['reviewed_at'] = now()->subDays(rand(0, 5));
                    $registration['admin_notes'] = $adminNotes[array_rand($adminNotes)];
                }

                $registrations[] = $registration;
            }
        }

        EventRegistration::insert($registrations);

        $this->command->info('✓ Created ' . count($registrations) . ' event registrations');
    }
}
