<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoleRequestIdToCommentsTable extends Migration
{
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            if (!Schema::hasColumn('comments', 'role_request_id')) {
                $table->unsignedBigInteger('role_request_id')->nullable()->after('post_id');
            }
            if (!Schema::hasColumn('comments', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->after('role_request_id');
            }
        });
    }

    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropColumn(['role_request_id', 'user_id']);
        });
    }
}
