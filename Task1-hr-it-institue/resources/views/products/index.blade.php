<x-layout>
    <header class="bg-white shadow">
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
      <h1 class="text-3xl font-bold tracking-tight text-gray-900">Product Page</h1>
    </div>
  </header>

    <a href="{{ route('products.create') }}" class="px-3 py-2 bg-blue-600 text-white float-right hover:bg-blue-500 mb-3">Add Product</a>
    
    <div class="w-full ">
        <table class="w-full border border-slate-400 p-4 text-center">
            <thead class="bg-slate-700">
                <tr class= "p-2 text-white">
                    <th>No</th>
                    <th>Product Title</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                
                <tr class="border-b border-slate-700">
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td> <img width="120" height="120" src="storage/{{ $product->image }}" alt=""></td>
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}" class="px-3 py-2 rounded bg-blue-500 text-white hover:bg-blue-400">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('products.destroy', $product->id ) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit"  class="px-3 py-2 rounded bg-red-500 text-white hover:bg-red-400">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-layout>