<h1>!!!!!!!!!!!!HI!!!!!!!!!!</h1>

<?php

    echo "<pre>";
    print_r($products);
//    var_dump($products);
    var_dump($cities);

    foreach ($products as $product) {
        echo $product->name." ".$product->price."<br>";
    }

    foreach ($cities as $city) {
        echo $city->city_id." ".$city->city_name."<br>";
    }

//foreach ($find as $product) {
//    echo $product->name." ".$product->price."<br>";
////    var_dump($product);
//}


    var_dump($find);
echo $find->name." ".$find->price."<br>";

$faker = Faker\Factory::create('ru_RU');

// generate data by accessing properties
echo $faker->name."<br>";
// 'Lucy Cechtelar';
echo $faker->address."<br>";
// "426 Jordy Lodge
// Cartwrightshire, SC 88120-6700"
echo $faker->text."<br>";
echo $faker->macAddress."<br>";
