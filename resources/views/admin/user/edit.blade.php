<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User') }}
        </h2>
    </x-slot>
    <div class="container">
    <div class="card mt-5">
        <div class="card-body ">
            <div class="d-flex justify-content-end mb-5">
                <div class="d-inline-block dropdown">
                    <button  class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <a href="{{ route('user.index') }}">
                          Back
                        </a>
                    </button>
                </div>
              </div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-8">
                    <form class="row g-3" method="POST" action="{{ route('user.update',$user->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="col-md-6">
                            <label for="inputEmail4" class="form-label">Name</label>
                            <input type="text" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="inputEmail4" name="name" value="{{ $user->name ?? '' }}" >
                        </div>
                        <div class="col-md-6">
                            <label for="inputEmail4" class="form-label">Phone</label>
                            <input type="text" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="inputEmail4" name="phone"  value="{{ $user->phone ?? '' }}">
                        </div>
                        <div class="col-md-6">
                            <label for="inputPassword4" class="form-label">Email</label>
                            <input type="text" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="inputPassword4" name="email"  value="{{ $user->email ?? '' }}">
                        </div>
                        <div class="col-md-6">
                            <label for="inputCity" class="form-label">Password</label>
                            <input type="password" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="inputCity" name="password">
                        </div>
                        <div class="col-md-6">
                            <input type="file" class="cursor-pointer bg-transparent border-2 border-transparent-500   font-bold py-2 px-4 rounded" id="inputCity" name="image">
                            @if($user->image)
                             <img src="{{ asset('storage/'.$user->image) }}" width="100" height="100" class="rouded">
                            @endif
                        </div>
                        <div class="col-12">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
          
        </div>
    </div>
</div>

</x-app-layout>