<nav class="bg-gray-800">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center justify-between">
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <img class="h-8 w-8" src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
          </div>
          <div class="hidden md:block">
            <div class="ml-10 flex items-baseline space-x-4">
              <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
              <a href="{{ route('home') }}" class="{{ request()->is('/') ? 'rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium' }}" aria-current="page">Home</a>
              <a href="{{ route('products.index') }}" class="{{ request()->is('products*') ? 'rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium' }}">Products</a>

             
            </div>
          </div>
        </div>
        <div class="hidden md:block">
          <div class="ml-4 flex items-center md:ml-6">
            
              <a href="{{ route('logout') }}" class="text-slate bg-white px-3 py-2">Logout</a>
        
            </div>
          </div>
        </div>
  
      </div>
    </div>

  
  </nav>