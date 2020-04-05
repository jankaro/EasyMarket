
@foreach($products as $product)
    <li>{{$product['product_title']}} Similarity= {{round(($product['similarity'])*100,2)}}%</li>
    @endforeach
