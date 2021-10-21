<?php

use Illuminate\Database\Seeder;
use App\Models\Products_Attribute;

class Products_AttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productAttributesRecords = [
            ['id' => 1 , 'product_id'=>1 ,'size' =>'Small', 'price'=>1200,'stock'=>10,'sku'=>'B1003-S', 'status'=>1],
            ['id' => 2 , 'product_id'=>1 ,'size' =>'Meduim', 'price'=>1300,'stock'=>20,'sku'=>'B1003-M', 'status'=>1],
            ['id' => 3 , 'product_id'=>1 ,'size' =>'Large', 'price'=>1500,'stock'=>30,'sku'=>'B1003-L','status'=>1]
        ];


        Products_Attribute::insert($productAttributesRecords);
    }
}
