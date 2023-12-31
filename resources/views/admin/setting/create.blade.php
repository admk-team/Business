<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Change Logo') }}
        </h2>
    </x-slot>
    <div class="container">
    <div class="card mt-5">
        <div class="card-body ">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8">
                    <form class="row g-3" method="POST" action="{{ route('change-logo') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-6">
                            <input type="file" class="cursor-pointer bg-transparent border-2 border-transparent-500   font-bold py-2 px-4 rounded" id="inputCity" name="image">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Create
                            </button>
                        </div>
                    </form>
                </div>
            </div>
          
        </div>
    </div>
</div>

</x-app-layout>