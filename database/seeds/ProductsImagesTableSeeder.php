<?php

use App\Models\Products_Image;
use Illuminate\Database\Seeder;

class ProductsImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $ProductImageRecord = [
           ['id'=>1, 'product_id'=>1,'image'=>'1634687336.jpg','status'=>1]
       ];
       Products_Image::insert($ProductImageRecord);
    }
}
