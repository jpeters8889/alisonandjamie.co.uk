<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitations', function (Blueprint $table) {
            $table->unsignedInteger('id')->primary();
            $table->string('name');
            $table->unsignedTinyInteger('limit')->default(2);
            $table->boolean('ceremony')->default(false);
            $table->boolean('afternoon')->default(false);
            $table->boolean('evening')->default(true);
            $table->timestamps();
        });
    }
}
