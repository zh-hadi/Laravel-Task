<x-layout>
    <header class="bg-white shadow">
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
      <h1 class="text-3xl font-bold tracking-tight text-gray-900">Update Product</h1>
    </div>
  </header>
<div class="py-5 block">

    <a href="{{ route('products.index') }}" class="px-3 py-2  bg-blue-600 text-white float-left hover:bg-blue-500 mb-3">Back</a>
</div>
  
<div>
    <form action="{{ route('products.update', $product->id ) }}" method="post" enctype="multipart/form-data" class="w-1/2 mx-auto">
        @csrf
        @method('put')
        <div class="flex flex-col gap-2 mb-3 text-sm">
            <label for="" class="text-slate-600">Product Name</label>
            <input type="text" name="name" placeholder="" value="{{ $product->name }}" class="border rounded border-slate-500 p-2">
            @error('name')
                <small class="text-red-400">{{ $message }}</small>
            @enderror 
        </div>
        <div class="flex flex-col gap-2 mb-3 text-sm">
            <label for="" class="text-slate-600">Price</label>
            <input type="number" name="price" placeholder="" value="{{ $product->price }}" class="border rounded border-slate-500 p-2">
            @error('price')
                <small class="text-red-400">{{ $message }}</small>
            @enderror 
        </div>
        <div class="flex flex-col gap-2 mb-3 text-sm">
            <label for="" class="text-slate-600">Description</label>
            <textarea type="text" name="description" value="" class="border rounded border-slate-500 p-2 h-[100px]">{{ $product->description }}</textarea>
            @error('description')
                <small class="text-red-400">{{ $message }}</small>
            @enderror 
        </div>
        <div class="flex flex-col gap-2 mb-3 text-sm">
            <label for="" class="text-slate-600">Image</label>
            <input type="file" name="image" placeholder=""  class="border rounded border-slate-500 p-2">
            @error('image')
                <small class="text-red-400">{{ $message }}</small>
            @enderror 
        </div>
        <div>
            <input type="submit" value="Update Product" class="p-2 bg-blue-500 hover:bg-blue-400 text-white">
            
        </div>
    </form>
  
</div>


</x-layout>