<?php

use App\models\Product;
use Illuminate\Database\Seeder;

class ProductstableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productsRecords = [
            ['id'=>1,'category_id'=>5,'section_id'=>1,'product_name'=>'Blue Casual T-Shirt','product_code'=>'BT001','product_color'=>'Blue',
            'product_price'=>'1500','product_discount'=>10,'product_weight'=>200,'product_video'=>'','main_image'=>'',
            'description'=>'Test Product','wash_care'=>'','fabric'=>'','pattern'=>'','sleeve'=>'','fit'=>'','occassion'=>'',
            'meta_title'=>'','meta_description'=>'','meta_keywords'=>'','is_featured'=>'No','status'=>1],


            ['id'=>2,'category_id'=>5,'section_id'=>1,'product_name'=>'Red Casual T-Shirt','product_code'=>'RT001','product_color'=>'Blue',
            'product_price'=>'2000','product_discount'=>10,'product_weight'=>200,'product_video'=>'','main_image'=>'',
            'description'=>'Test Product','wash_care'=>'','fabric'=>'','pattern'=>'','sleeve'=>'','fit'=>'','occassion'=>'',
            'meta_title'=>'','meta_description'=>'','meta_keywords'=>'','is_featured'=>'Yes','status'=>1],

        ];

        Product::insert($productsRecords);
    }
}
