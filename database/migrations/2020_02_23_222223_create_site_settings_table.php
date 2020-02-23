<?php

use App\SiteSetting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('name');
            $table->string('value');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });

        $site_settings = [
            ['name' => 'SITE_TITLE', 'value' => 'Open Org Chart'],
            ['name' => 'SITE_COLOR', 'value' => '#363636'],
        ];

        foreach ($site_settings as $site_setting) {
            SiteSetting::create($site_setting);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_settings');
    }
}
