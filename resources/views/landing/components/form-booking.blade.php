<div class="contact__property--form__inner">

    <div class="contact__property--form__input">
        <label for="first_name">Your Name*</label>
        <div class="row p-0">
            <div class="col-md-6">

                <input id="first_name" name="first_name" placeholder="Enter your first name" type="text">
            </div>
            <div class="col-md-6">

                <input id="last_name" name="last_name" placeholder="Enter your last name" type="text">
            </div>
        </div>
        @error('first_name')
            <p class="text-danger my-2">{{ $message }}</p>
        @enderror
    </div>

    <div class="contact__property--form__input">
        <label for="phone_number">Phone number*</label>
        <input id="phone_number" name="phone_number" placeholder="Enter your number" type="tel">
        @error('name')
            <p class="text-danger my-2">{{ $message }}</p>
        @enderror
    </div>

    <div class="contact__property--form__input">
        <label for="email">Email*</label>
        <input id="email" name="email" placeholder="Enter your email" type="text">
        @error('email')
            <p class="text-danger my-2">{{ $message }}</p>
        @enderror
    </div>

    <div class="contact__property--form__input">
        <label for="type_asset">Type Asset*</label>

        <div class="advance__search--items">
            <select class="advance__search--select" id="type_asset" name="type_asset">
                <option selected disabled>Select Asset</option>
                <option value="villa">Villa</option>
                <option value="land">Lands</option>
            </select>
        </div>

        @error('type_asset')
            <p class="text-danger my-2">{{ $message }}</p>
        @enderror
    </div>

    <div id="number_bedroom">
        <div class="contact__property--form__input">
            <label for="bedroom_min">Bedroom Min*</label>
            <input id="bedroom_min" name="bedroom_min" placeholder="Enter Your Minimal Bedroom" type="number">
            @error('bedroom_min')
                <p class="text-danger my-2">{{ $message }}</p>
            @enderror
        </div>
        <div class="contact__property--form__input">
            <label for="bedroom_max">Bedroom Max*</label>
            <input id="bedroom_max" name="bedroom_max" placeholder="Enter Your Maximal Bedroom" type="number">
            @error('bedroom_max')
                <p class="text-danger my-2">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div id="number_land_size">
        <div class="contact__property--form__input">
            <label for="land_size_min">Land Size Min*</label>
            <input id="land_size_min" name="land_size_min" placeholder="Enter Your Minimal Land Size (meter)" type="number">
            @error('land_size_min')
                <p class="text-danger my-2">{{ $message }}</p>
            @enderror
        </div>
        <div class="contact__property--form__input">
            <label for="land_size_max">Land Size Max*</label>
            <input id="land_size_max" name="land_size_max" placeholder="Enter Your Maximum Land Size (meter)" type="number">
            @error('land_size_max')
                <p class="text-danger my-2">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="contact__property--form__input">
        <label for="budget_currency">Budget Currency*</label>

        <div class="advance__search--items">
            <select class="advance__search--select" id="budget_currency" name="budget_currency">
                <option selected disabled>Select Currency</option>
                <option value="usd">Dollar (USD)</option>
                <option value="idr">Rupiah (IDR)</option>
            </select>
        </div>

        @error('budget_currency')
            <p class="text-danger my-2">{{ $message }}</p>
        @enderror
    </div>
    
    <div id="budget_idr">

        <div class="contact__property--form__input">
            <label for="minimum_budget_idr">Minimum Budget IDR*</label>
            <input id="minimum_budget_idr" name="minimum_budget_idr" placeholder="Enter Minimum Budget (IDR)" type="text">

            @error('minimum_budget_idr')
                <p class="text-danger my-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="contact__property--form__input">
            <label for="maximum_budget_idr">Maximum Budget IDR*</label>
            <input id="maximum_budget_idr" name="maximum_budget_idr" placeholder="Enter Maximum Budget (IDR)" type="text">

            @error('maximum_budget_idr')
                <p class="text-danger my-2">{{ $message }}</p>
            @enderror
        </div>
    </div>

    
    <div id="budget_usd">
        <div class="contact__property--form__input">
            <label for="minimum_budget_usd">Minimum Budget USD*</label>
            <input id="minimum_budget_usd" name="minimum_budget_usd" placeholder="$ Enter your minimum budget" type="text">

            @error('minimum_budget_usd')
                <p class="text-danger my-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="contact__property--form__input">
            <label for="maximum_budget_usd">Maximum Budget USD*</label>
            <input id="maximum_budget_usd" name="maximum_budget_usd" placeholder="$ Enter your maximum budget" type="text">

            @error('maximum_budget_usd')
                <p class="text-danger my-2">{{ $message }}</p>
            @enderror
        </div>
    </div>



    <div class="contact__property--form__input">
        <label for="location">Location*</label>

        <div class="advance__search--items">
            <select class="advance__search--select" name="location">
                <option selected disabled>Property Location</option>
                @foreach ($sub_regions as $rgn)
                    <option value="{{ $rgn->name }}">{{ $rgn->name }}</option>
                @endforeach
            </select>
        </div>

        @error('location')
            <p class="text-danger my-2">{{ $message }}</p>
        @enderror
    </div>

    <div class="contact__property--form__input">
        <label for="timing">Estimated Buy*</label>
        <input id="timing" name="timing" placeholder="Timing" type="text">

        @error('timing')
            <p class="text-danger my-2">{{ $message }}</p>
        @enderror
    </div>
    <div class="contact__property--form__input">
        <label for="email">Message</label>
        <textarea id="text" name="message" placeholder="Enter your message"></textarea>

        @error('message')
            <p class="text-danger my-2">{{ $message }}</p>
        @enderror
    </div>
    <button class="contact__property--btn solid__btn" type="submit">Send message</button>
</div>
