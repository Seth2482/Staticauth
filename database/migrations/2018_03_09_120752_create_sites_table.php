<?php

use App\Site;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('status')->default(Site::STATUS_UNCOMMIT);
            $table->text('url');
            $table->unsignedInteger('project_id')->index();
            $table->timestamp('expire_at')->nullable();
            $table->json('extra')->default("{}");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sites');
    }
}
