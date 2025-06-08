 @foreach ($data_client as $client)
     <tr>
         <td>{{ $loop->iteration }}</td>
         <td>
             <div class="d-flex align-items-center gap-2">
                 <div>
                     <img src="{{ asset('admin') }}/assets/images/users/dummy-avatar.jpg" alt="" class="avatar-sm rounded-circle">
                 </div>
                 <div>
                     <a href="#!" class="text-dark fw-medium fs-15">{{ $client->first_name . ' ' . $client->last_name }}</a>
                 </div>
             </div>

         </td>
         <td>{{ $client->email }}</td>
         <td>{{ implode('-', str_split(preg_replace('/\D/', '', $client->phone_number), 4)) }}</td>
         <td>
             <div class="d-flex gap-2">
                 <a href="#!" class="btn btn-soft-primary btn-sm"><iconify-icon icon="solar:pen-2-broken" class="fs-18 align-middle" data-bs-toggle="modal" data-bs-target="#resetPasswordModal"></iconify-icon></a>


                 <input type="hidden" class="propertyId" value="{{ $client->id }}">
                 <button type="button" class="btn btn-soft-danger btn-sm deleteButton" data-nama="{{ $client->first_name . ' ' . $client->last_name }}"><iconify-icon icon="fe:trash" class="fs-18 align-middle"></iconify-icon></button>

             </div>
         </td>
     </tr>

     <!-- Edit Modal -->
     <div class="modal modal-lg fade" id="resetPasswordModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
         <div class="modal-dialog">
             <form action="{{ route('clients.update', $client->id) }}" method="POST">
                 @csrf
                 @method('PUT')

                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title" id="staticBackdropLabel">Edit Data Client</h5>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body">
                         <div class="row">
                             {{-- <input type="hidden" name="reference_code" value="{{ $profile->reference_code }}"> --}}
                             <x-form-input className="col-lg-6" type="text" name="first_name" label="Input First Name" value="{{ $client->first_name }}" />
                             <x-form-input className="col-lg-6" type="text" name="last_name" label="Input Last Name" value="{{ $client->last_name }}" />
                             <x-form-input className="col-lg-6" type="text" name="email" label="Input Last Name" value="{{ $client->email }}" />
                             <x-form-input className="col-lg-6" type="number" name="phone_number" label="Input Phone Number" value="{{ $client->phone_number }}" />
                         </div>
                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                         <button type="submit" class="btn btn-primary">Change Password</button>
                     </div>

                     @if ($errors->any())
                         <div class="alert alert-danger">
                             <ul class="mb-0">
                                 @foreach ($errors->all() as $message)
                                     <li>{{ $message }}</li>
                                 @endforeach
                             </ul>
                         </div>
                     @endif

             </form>
         </div>
     </div>
     <!-- /* Edit Modal -->
 @endforeach
