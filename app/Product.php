<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['id','name','category_id', 'price'];
    const UPLOADING_PATH = 'backend/uploads/product_images';

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::deleted(function($product){
           $product->images->each(function($image){
               if(file_exists($image->path)) {
                   unlink($image->path);
               }
               $image->delete();

           });
        });
    }

    public function category()
    {
        return $this->belongsTo(Product::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function getPriceAsCurrencyAttribute()
    {
        return number_format( $this->price,2);
    }

    public static function saveNewProduct(array $data = [])
    {
        $product = self::create($data);

        if(array_key_exists('images', $data))
        {
            $images = array_shift($data);
            foreach ( $images as $image) {
                $image_path = time().$image->getClientOriginalName();
                $path = $image->storeAs(self::UPLOADING_PATH,$image_path, 'product_images');
                $product->images()->create(['path' => url($path)]);
            }
        }
        return $product;
    }

    public static function updateExistsProduct(int $id, array $data = [])
    {
        $product = self::findOrFail($id);
        $product->update($data);
        if(array_key_exists('images', $data))
        {
            $images = array_shift($data);
            foreach ( $images as $image) {
                $image_path = time().$image->getClientOriginalName();
                $path = $image->storeAs(self::UPLOADING_PATH,$image_path, 'product_images');
                $product->images()->create(['path' => url($path)]);
            }
        }
        return $product;
    }


}
