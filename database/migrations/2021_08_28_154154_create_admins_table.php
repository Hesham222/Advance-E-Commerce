<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('type');
            $table->string('mobile');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('image');
            $table->integer('status');
            $table->rememberToken();
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
        Schema::dropIfExists('admins');
    }
}
// <?php

// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// class CreateSectionsTable extends Migration
// {
//     /**
//      * Run the migrations.
//      *
//      * @return void
//      */
//     public function up()
//     {
//         Schema::create('sections', function (Blueprint $table) {
//             $table->id();
//             $table->string('name');
//             $table->tinyInteger('status');
//             $table->timestamps();
//         });
//     }

//     /**
//      * Reverse the migrations.
//      *
//      * @return void
//      */
//     public function down()
//     {
//         Schema::dropIfExists('sections');
//     }
// }

// <?php

// use Illuminate\Database\Seeder;
// use App\Models\Section;
// class SectionsTableSeeder extends Seeder
// {
//     /**
//      * Run the database seeds.
//      *
//      * @return void
//      */
//     public function run()
//     {
//        $sectionsRecords = [
//            ['id'=>1 , "name" => 'Men', 'status' => 1],
//            ['id'=>2 , "name" => 'Women', 'status' => 1],
//            ['id'=>3 , "name" => 'Kids', 'status' => 1],
//        ];

//        Section::insert($sectionsRecords);
//     }
// }

