<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

    // Create a new image
    $imageUrl = $this->faker->imageUrl();
    $imageData = file_get_contents($imageUrl);

    // Generate a random file name for the image
    $imageFileName = $this->faker->slug() . '.jpg';

    // Store the image file in the public directory
    $imagePath = 'image/' . $imageFileName;
    $publicPath = public_path($imagePath);
    File::put($publicPath, $imageData);

    // Create a new product with the image
    return [
        'product_name' => $this->faker->name(),
        'category_id' => Category::inRandomOrder()->first()->id,
        'short_descp_en' => $this->faker->paragraph(200),
        'selling_price' => $this->faker->randomFloat(2, 0, 10000),
        'product_image' => $imagePath,
        'product_qty' => $this->faker->randomDigit,
        'discount_price' => $this->faker->randomFloat(2, 0, 1000),
        'status' => true,
    ];
    }
}
