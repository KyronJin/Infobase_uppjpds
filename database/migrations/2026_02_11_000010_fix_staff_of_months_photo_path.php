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

        // Ensure photo_path exists
        if (!Schema::hasColumn('staff_of_months', 'photo_path')) {
            Schema::table('staff_of_months', function (Blueprint $table) {
                $table->string('photo_path')->nullable()->after('photo_link');
            });
        }

        // If old foto_path exists, merge data and drop old column
        if (Schema::hasColumn('staff_of_months', 'foto_path')) {
            DB::table('staff_of_months')
                ->whereNotNull('foto_path')
                ->where(function ($query) {
                    $query->whereNull('photo_path')->orWhere('photo_path', '');
                })
                ->update(['photo_path' => DB::raw('foto_path')]);

            Schema::table('staff_of_months', function (Blueprint $table) {
                $table->dropColumn('foto_path');
            });
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
                if (Schema::hasColumn('staff_of_months', 'photo_path')) {
                    Schema::table('staff_of_months', function (Blueprint $table) {
                        $table->dropColumn('photo_path');
                    });
                }
            }
        }
    }
};
