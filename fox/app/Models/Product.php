<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // имя таблицы модели можно указать явно
//    protected $table = 'my_products';
//    protected $table = 'hashtagexpress.cities'; // лезем другую базу hashtagexpress в табл сити

    // Eloquent также предполагает, что каждая таблица имеет первичный ключ с именем - id.
    // Вы можете определить свойство $primaryKey для указания другого имени.
//    protected $primaryKey = "roduct_id";
//    protected $primaryKey = "city_id"; // указываем первичный ключ (но можно и не указывать )

    // не искать поля timestamps (поля created_at и updated_at)
    //    public $timestamps = false;
}
