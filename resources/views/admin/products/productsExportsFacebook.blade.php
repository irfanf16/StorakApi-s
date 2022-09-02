<table>
    <thead>
    <tr>
        <th>id</th>
        <th>title</th>
        <th>description</th>
        <th>link</th>
        <th>image link</th>
        <th>condition</th>
        <th>availability</th>
        <th>price</th>
        <th>brand</th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
        <tr>
            <td>{{$product['id']}}</td>
            <td>{{$product['title']}}</td>
            <td>
                @if ( preg_match("/<[^<]+>/",$product['description'],$m) != 0)
{{--                    {!!  $product['description'] !!}--}}
                    {{ $product['description'] }}

                @else
                    {{ $product['description'] }}
                @endif
            </td>
            <td>{{$product['link']}}</td>
            <td>{{$product['image_link']}}</td>
            <td>{{$product['condition']}}</td>
            <td>{{$product['availability']}}</td>
            <td>{{$product['price']}}</td>
            <td>{{$product['brand']}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
