<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Category</th>
            <th scope="col">Description</th>
            <th scope="col">Gallery</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $key => $product)
            <tr>
                <th>{{ $product->id }}</th>
                <td>{{ $product->name }}</td>
                <td> {{ $product->price }}</td>
                <td> {{ $product->category }}</td>
                <td> {{ $product->description }}</td>
                <td> {{ $product->gallery }}</td>


                <td>
                    <a href="" class="btn btn-primary update_product_form" data-bs-toggle="modal"
                        data-bs-target="#updateModal" data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                        data-price="{{ $product->price }}"data-category="{{ $product->category }}"
                        data-description="{{ $product->description }}" data-gallery="{{ $product->gallery }}">
                        <i class="las la-edit"></i>
                    </a>
                    <a href="" class="btn btn-danger delete_product" data-id="{{ $product->id }}"> <i
                            class="las la-times"></i></a>
                </td>
            </tr>
        @endforeach

    </tbody>
</table>
{!! $products->links('pagination::bootstrap-4') !!}
