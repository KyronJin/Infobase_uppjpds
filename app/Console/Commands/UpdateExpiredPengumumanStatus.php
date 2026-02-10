<?php

namespace App\Console\Commands;

use App\Models\Pengumuman;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateExpiredPengumumanStatus extends Command
{
    protected $signature = 'pengumuman:update-expired-status';

    protected $description = 'Otomatis ubah status pengumuman yang sudah expired menjadi inactive';

    public function handle()
    {
        $now = now();
        
        // Update semua pengumuman yang sudah melewati valid_until menjadi inactive
        $updated = Pengumuman::where('status', 'active')
            ->where('valid_until', '<', $now)
            ->whereNotNull('valid_until')
            ->update(['status' => 'inactive']);

        $this->info("✓ {$updated} pengumuman telah diubah status menjadi inactive");
    }
}
