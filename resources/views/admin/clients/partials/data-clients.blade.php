 @foreach ($data_client as $client)
     <tr>
         <td>{{ $loop->iteration }}</td>
         <td>
             <div class="d-flex align-items-center gap-2">
                 <div>
                     <img src="{{ asset('admin') }}/assets/images/users/default.jpg" alt="" class="avatar-sm rounded-circle">
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
                 <a href="#!" class="btn btn-soft-primary btn-sm"><iconify-icon icon="solar:pen-2-broken" class="fs-18 align-middle"></iconify-icon></a>
                 <a href="#!" class="btn btn-soft-danger btn-sm"><iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="fs-18 align-middle"></iconify-icon></a>
             </div>
         </td>
     </tr>
 @endforeach
