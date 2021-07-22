<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsersTableAddAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         $this->addAdmin();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }

    private function addAdmin() {

        \DB::table('users')->insert(
            array(
                'email' => 'admin@admin.com',
                'name' => 'admin',
                'password'=> \Hash::make('secret'),
                'role'=>'admin',
                'registered_at'=> \Carbon\Carbon::now(),
                'invitation_status'=>'accepted',
                'pin_status'=>'completed'
            )
        );
    }
}
