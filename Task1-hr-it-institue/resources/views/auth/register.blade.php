<x-guest>
    <div class="w-2/5 mx-auto  mt-[80px] shadow-lg border p-5">
        <h2 class="text-3xl text-center text-slate-500 font-semibold mb-5">Register Form</h2>

        <form action="{{ route('registerPost') }}" method="post" class="space-y-4">
            @csrf
            <div class="flex flex-col gap-2 mb-3 text-sm">
                <label for="" class="text-slate-600 text-md">Username</label>
                <input type="text" name="name" placeholder="" value="{{ old('name') }}" class="border rounded border-slate-500 p-2">
                @error('name')
                    <small class="text-red-400">{{ $message }}</small>
                @enderror 
            </div>
            <div class="flex flex-col gap-2 mb-3 text-sm">
                <label for="" class="text-slate-600 text-md">Email</label>
                <input type="email" name="email" placeholder="" value="{{ old('name') }}" class="border rounded border-slate-500 p-2">
                @error('name')
                    <small class="text-red-400">{{ $message }}</small>
                @enderror 
            </div>
            <div class="flex flex-col gap-2 mb-3 text-sm">
                <label for="" class="text-slate-600 text-md">Address</label>
                <input type="text" name="address" placeholder="" value="{{ old('name') }}" class="border rounded border-slate-500 p-2">
                @error('name')
                    <small class="text-red-400">{{ $message }}</small>
                @enderror 
            </div>
            <div class="flex flex-col gap-2 mb-3 text-sm">
                <label for="" class="text-slate-600 text-md">Password</label>
                <input type="password" name="password" placeholder="" value="{{ old('name') }}" class="border rounded border-slate-500 p-2">
                @error('password')
                    <small class="text-red-400">{{ $message }}</small>
                @enderror 
            </div>
            <div class="flex flex-col gap-2 mb-3 text-sm">
                <label for="" class="text-slate-600 text-md">Confirm Password</label>
                <input type="password" name="password_confirmation" placeholder="" value="{{ old('name') }}" class="border rounded border-slate-500 p-2">
                @error('password_confirmation')
                    <small class="text-red-400">{{ $message }}</small>
                @enderror 
            </div>
            <div class="flex justify-between mt-10">
                <a href="{{ route('login') }}" class="text-blue-600 underline">Already Account</a>
                <input type="submit" value="Register" class="border px-5 py-2 rounded">
            </div>
        </form>
    </div>
</x-guest>