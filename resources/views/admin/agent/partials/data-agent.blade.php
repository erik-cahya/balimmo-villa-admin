@foreach ($data_agent as $agent)
    <tr class="{{ Auth::user()->id === $agent->id ? 'table-active' : '' }}">

        <td>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="customCheck2">
                <label class="form-check-label" for="customCheck2">&nbsp;</label>
            </div>
        </td>
        <td class="text-dark fw-medium">#{{ $agent->reference_code }}</td>

        <td>
            <div class="d-flex align-items-center gap-2">
                <div>
                    <img src="{{ asset('admin') }}{{ $agent->profile == null ? '/assets/images/users/avatar-1.jpg' : '/profile-image/' . $agent->reference_code . '/' . $agent->profile }}" alt="" class="avatar-sm rounded-circle">
                </div>
                <div>
                    <a href="#!" class="text-dark fw-medium fs-15">{{ $agent->name }}</a>
                </div>
            </div>

        </td>
        <td>{{ $agent->email }}</td>
        <td>{{ $agent->phone_number }}</td>
        <td><a href="{{ route('agent.properties', strtolower($agent->reference_code)) }}">{{ $agent->properties_count }} Property</a></td>
        {{-- <td ><span class="badge badge-soft-secondary me-1">{{ $agent->reference_code }}</span></td> --}}
        <td class="text-capitalize"><span class="badge {{ $agent->role === 'master' ? 'bg-danger' : 'bg-primary' }} fs-11 text-white">{{ $agent->role }}</span></td>
        <td class="text-capitalize"><span class="badge {{ $agent->status === 1 ? 'bg-success' : 'bg-danger' }} fs-11 text-white">{{ $agent->status === 1 ? 'Active' : 'Deactive' }}</span></td>
        <td>{{ \Carbon\Carbon::parse($agent->created_at)->format('d F, Y') }}</td>

        <td>
            <div class="d-flex gap-2">
                <a href="#!" class="btn btn-light btn-sm"><iconify-icon icon="solar:eye-broken" class="fs-18 align-middle"></iconify-icon></a>
                <a href="#!" class="btn btn-soft-primary btn-sm"><iconify-icon icon="solar:pen-2-broken" class="fs-18 align-middle"></iconify-icon></a>

                @if (Auth::user()->id !== $agent->id)
                    {{-- <a href="#!" class="btn btn-soft-danger btn-sm"><iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="align-middle fs-18"></iconify-icon></a> --}}
                    {{-- Delete Button --}}
                    <input type="hidden" class="propertyId" value="{{ $agent->id }}">
                    <button type="button" class="btn btn-soft-danger btn-sm deleteButton" data-nama="{{ $agent->name }}"><iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="fs-18 align-middle"></iconify-icon></button>
                    {{-- /. Delete Button --}}
                @endif

            </div>
        </td>
    </tr>
@endforeach
