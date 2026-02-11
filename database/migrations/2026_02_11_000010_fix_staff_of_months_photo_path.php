<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('staff_of_months')) {
            return;
        }

        // If photo_path doesn't exist, create it
        if (!Schema::hasColumn('staff_of_months', 'photo_path')) {
            Schema::table('staff_of_months', function (Blueprint $table) {
                $table->string('photo_path')->nullable()->after('photo_link');
            });

            // If foto_path exists, copy its data to photo_path then drop foto_path
            if (Schema::hasColumn('staff_of_months', 'foto_path')) {
                // Copy values from foto_path to photo_path
                DB::table('staff_of_months')->whereNotNull('foto_path')->update(['photo_path' => DB::raw('foto_path')]);

                // Drop the old column
                Schema::table('staff_of_months', function (Blueprint $table) {
                    $table->dropColumn('foto_path');
                });
            }
        }
    }

    public function down()
    {
        if (!Schema::hasTable('staff_of_months')) {
            return;
        }

        // Restore foto_path (safest reverse: create foto_path and copy data back)
        if (!Schema::hasColumn('staff_of_months', 'foto_path')) {
            Schema::table('staff_of_months', function (Blueprint $table) {
                $table->string('foto_path')->nullable()->after('photo_link');
            });

            if (Schema::hasColumn('staff_of_months', 'photo_path')) {
                DB::table('staff_of_months')->whereNotNull('photo_path')->update(['foto_path' => DB::raw('photo_path')]);
                Schema::table('staff_of_months', function (Blueprint $table) {
                    $table->dropColumn('photo_path');
                });
            }
        }
    }
};
