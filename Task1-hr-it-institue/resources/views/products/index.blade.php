<x-layout>
    
    <div class="w-full ">
        <table class="w-full border border-slate-400 p-4 text-center">
            <thead class="bg-slate-700">
                <tr class= "p-2 text-white">
                    <th>No</th>
                    <th>Product Title</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                
                <tr class="border-b border-slate-700">
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td> <img width="120" height="120" src="{{ $product->image }}" alt=""></td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-layout>