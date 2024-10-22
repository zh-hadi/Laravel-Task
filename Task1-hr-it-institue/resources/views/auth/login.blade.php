<x-guest>
    <div class="w-1/3 mx-auto  mt-[200px] shadow-lg border p-5">
        <h2 class="text-3xl text-center text-slate-500 font-semibold mb-5">Login Form</h2>
        <form action="{{ route('loginPost') }}" method="post" class="space-y-4">
            @csrf
            <div class="flex flex-col gap-2 mb-3 text-sm">
                <label for="" class="text-slate-600 text-md">Email address</label>
                <input type="text" name="email" placeholder="" value="{{ old('name') }}" class="border rounded border-slate-500 p-2">
                @error('name')
                    <small class="text-red-400">{{ $message }}</small>
                @enderror 
                @error('error')
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
            <div class="flex justify-between ">
                <a href="{{ route('register') }}" class="text-blue-500 underline">Create Account</a>
                <input type="submit" value="Login" class="border px-5 py-2 rounded">
            </div>
        </form>
    </div>
</x-guest>