<div class="owner-block border rounded p-3 mb-1 position-relative" data-index="{{ $index }}">
    <button type="button" class="btn-close position-absolute top-0 end-0 m-2" onclick="removeOwner(this)" aria-label="Close"></button>

    <input type="hidden" name="owners[{{ $index }}][id]" value="{{ $owner->id ?? '' }}">

    <h5 class="text-dark fw-semibold">
        <i class="ri-user-line"></i> Owner {{ $index + 1 }}
    </h5>
    <hr>
    <div class="row">
        <x-form-input className="col-lg-6" type="text" name="owners[{{ $index }}][first_name]" label="First Name" value="{{ $owner->first_name ?? '' }}" />
        <x-form-input className="col-lg-6" type="text" name="owners[{{ $index }}][last_name]" label="Last Name" value="{{ $owner->last_name ?? '' }}" />
        <x-form-input className="col-lg-6" type="number" name="owners[{{ $index }}][phone_number]" label="Phone Number" value="{{ $owner->phone ?? '' }}" />
        <x-form-input className="col-lg-6" type="text" name="owners[{{ $index }}][email]" label="Email" value="{{ $owner->email ?? '' }}" />
    </div>
</div>
