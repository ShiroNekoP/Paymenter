<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('config_options', function (Blueprint $table) {
            // For number type: min and max values for the range
            $table->decimal('min_value', 20, 4)->nullable()->after('upgradable');
            $table->decimal('max_value', 20, 4)->nullable()->after('min_value');
            $table->decimal('step', 20, 4)->nullable()->after('max_value');
            
            // Formula for calculating the final environment variable value
            // e.g., "4096+{x}*1024" where {x} is the user input
            $table->string('env_variable_formula')->nullable()->after('step');
            
            // Price per unit for number type
            // e.g., 8 for $8 per unit
            $table->decimal('price_per_unit', 20, 4)->nullable()->after('env_variable_formula');
            
            // Setup fee per unit for number type
            $table->decimal('setup_fee_per_unit', 20, 4)->nullable()->after('price_per_unit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('config_options', function (Blueprint $table) {
            $table->dropColumn([
                'min_value',
                'max_value',
                'step',
                'env_variable_formula',
                'price_per_unit',
                'setup_fee_per_unit',
            ]);
        });
    }
};
