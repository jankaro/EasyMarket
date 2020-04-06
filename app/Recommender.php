<?php


namespace App;


use http\Env\Request;

class Recommender
{
    public static function updateSimilarityMatrix(){
        $products        = Product::all()->toArray();

        $productSimilarity = new ProductSimilarity($products);
        $similarityMatrix  = $productSimilarity->calculateSimilarityMatrix();
        $jsonData = json_encode($similarityMatrix);
        if (file_put_contents('storage/data/similarityMatrix.json', $jsonData)){
            return true;
        }
        return false;
    }

    public static function similarProducts($products_array, $product_id, $number_of_products){
        $productSimilarity = new ProductSimilarity($products_array);
        $similarityMatrix= json_decode(file_get_contents('storage/data/similarityMatrix.json'), true);
        $similarProducts = $productSimilarity->getProductsSortedBySimularity($product_id, $similarityMatrix);

        return  array_slice($similarProducts,0,$number_of_products);
    }


}
