<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                  @if ($message = Session::get('success'))
                      <div class="alert alert-success">
                          <p>{{ $message }}</p>
                      </div>
                    @endif
                    @if ($message = Session::get('failed'))
                    <div class="alert alert-danger">
                        <p>{{ $message }}</p>
                    </div>
                  @endif
                  @if ($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif
                </div>
                <hr>
                <div class="p-6 row text-gray-900">
                    <div class="col-4">
                        <div class="card">
                          <form action="{{url('countries/new')}}" method="POST" novalidate="novalidate" autocomplete="off">
                            @csrf
                            <div class="card-header text-gray-900">
                              Add New Country
                            </div>
                            <div class="card-body">
                                <div class="mb-3 form-group">
                                    <label for="name" class="form-label block font-medium text-sm text-gray-700">Name</label>
                                    <input name="name" type="text" class="form-control border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" id="name">
                                  </div>
                                  <div class="mb-3">
                                    <label for="iso" class="form-label block font-medium text-sm text-gray-700">ISO</label>
                                    <input name="iso" type="text" class="form-control border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" id="iso">
                                  </div>
                            </div>
                            <div class="card-footer text-muted text-right">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Save
                                </button> 
                            </div>
                          </form>
                        </div>
                    </div>
                    <div class="col-8 card px-0">
                        <div class="">
                            <div class="card-header text-gray-900">
                                List of countries
                              </div>

                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                      <tr>
                                        <th scope="col">#</th>
                                        <th scope="col form-label block font-medium text-sm text-gray-700">Name</th>
                                        <th scope="col form-label block font-medium text-sm text-gray-700">ISO</th>
                                        <th scope="col form-label block font-medium text-sm text-gray-700">Edit</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @if( !empty($countries) )
                                        @foreach ($countries as $key => $country)
                                        <tr>
                                          <th scope="row">{{$key+1}}</th>
                                          <td>{{$country->name}}</td>
                                          <td>{{$country->iso}}</td>
                                          <td><button type="button" data-user-id="{{$country->user_id}}" data-name="{{$country->name}}" data-iso="{{$country->iso}}" data-id="{{$country->id}}" data-bs-toggle="modal" data-bs-target="#editModel" class="btn btn-primary edit-btn btn-sm open-edit-modal">Edit</button></td>
                                        </tr>
                                        @endforeach

                                      @endif

                                    </tbody>
                                  </table>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade edit-modal" id="editModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="{{url('countries/update/')}}"method="POST" novalidate="novalidate" autocomplete="off">
            @csrf

          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Country</h5>
            <button type="button" class="btn-close modal" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div class="card-body">
                <input type="hidden" id="countryId" name="id" value="">
                <input type="hidden" id="userId" name="user_id" value="">

                  <div class="mb-3 form-group">
                      <label for="countryName" class="form-label block font-medium text-sm text-gray-700">Name</label>
                      <input name="name" type="text" class="form-control border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" id="countryName">
                    </div>
                    <div class="mb-3">
                      <label for="countryIso" class="form-label block font-medium text-sm text-gray-700">ISO</label>
                      <input name="iso" type="text" class="form-control border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" id="countryIso">
                    </div>
              </div>
                      </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary edit-btn">Save changes</button>
            <a id="countryDelete" data-base-href="{{ url('countries/destroy')}}" href="{{ url('countries/destroy')}}" class="btn btn-danger delete-btn">Delete</a>
          </div>
        </form>
        </div>
      </div>
    </div>

</x-app-layout>