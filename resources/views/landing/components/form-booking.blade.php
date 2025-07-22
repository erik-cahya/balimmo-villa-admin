<div class="contact__property--form__inner">
    <div class="d-flex gap-4">
        <div class="contact__property--form__input">
            <label for="first_name">First Name*</label>
            <input id="first_name" name="first_name" placeholder="Enter your name" type="text">
            @error('first_name')
                <p class="text-danger my-2">{{ $message }}</p>
            @enderror
        </div>
        <div class="contact__property--form__input">
            <label for="last_name">Last Name*</label>
            <input id="last_name" name="last_name" placeholder="Enter your name" type="text">
            @error('last_name')
                <p class="text-danger my-2">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="contact__property--form__input w-full">
        <label for="phone_number">Phone number*</label>
        <input id="phone_number" class="w-full" name="phone_number" type="tel" placeholder="+33 44 55 678" required>

        @error('phone_number')
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

    <!-- Looking For Field (Checkbox) -->
    <div class="contact__property--form__input">
        <label for="looking_for">Looking For*</label>
        <ul class="interior__amenities--check d-flex gap-4" id="looking_for">
            <li class="interior__amenities--check__list mb-0">
                <label class="interior__amenities--check__label mb-0" style="padding-left: 2.5rem;" for="villa">
                    <svg width="16" height="16" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.5 0L0 4.125V11H3.72581V8.59381C3.72581 7.64165 4.51713 6.87506 5.5 6.87506C6.48287 6.87506 7.27419 7.64165 7.27419 8.59381V11H11V4.125L5.5 0Z" fill="#063436"></path>
                    </svg>
                    Villa
                </label>
                <input value="villa" name="type_asset_villa" class="interior__amenities--check__input" id="villa" type="checkbox">
                <span class="interior__amenities--checkmark"></span>
            </li>
            <li class="interior__amenities--check__list mb-0">
                <label class="interior__amenities--check__label mb-0" style="padding-left: 2.5rem;" for="land">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                        fill="#063436" viewBox="0 0 24 24">
                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2M5 19V5h14v14z"></path>
                        <path d="M12 9h3v3h2V7h-5zM9 12H7v5h5v-2H9z"></path>
                    </svg>
                    Land
                </label>
                <input value="land" name="type_asset_land" class="interior__amenities--check__input" id="land" type="checkbox">
                <span class="interior__amenities--checkmark"></span>
            </li>
        </ul>
        @error('email')
            <p class="text-danger my-2">{{ $message }}</p>
        @enderror
    </div>

    <div class="contact__property--form__input w-full">
        <label for="budget_currency">Select Budget Currency*</label>

        <select id="budget_currency" name="budget_currency">
            <option selected disabled>Select Currency</option>
            <option value="usd">Dollar (USD)</option>
            <option value="idr">Rupiah (IDR)</option>
        </select>

        @error('budget_currency')
            <p class="text-danger my-2">{{ $message }}</p>
        @enderror
    </div>

    <!-- looking_for_villa -->
    <div id="looking_for_villa" style="display: none;">
        <div class="d-flex justify-content-center justify-items-center text-center">
            <hr class="w-100" />
            <label class="w-100">Looking For Villa</label>
            <hr class="w-100" />
        </div>
        <div class="contact__property--form__input" id="villa_budget_idr" style="display: none;">
            <label for="budget_idr">Budget IDR*</label>
            <div class="widget__price--filtering">
                <div class="price-input">
                    <input type="text" class="input-min bg-white" name="budget_idr_min_villa" id="budget_idr_min_villa" placeholder="IDR 100 000 000">
                    <div class="separator">-</div>
                    <input type="text" class="input-max bg-white" name="budget_idr_max_villa" id="budget_idr_max_villa" placeholder="IDR 50 000 000 000">
                </div>
            </div>

            @error('budget_idr')
                <p class="text-danger my-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="contact__property--form__input" id="villa_budget_usd" style="display: none;">
            <label for="budget_usd">Budget USD*</label>
            <div class="widget__price--filtering">
                <div class="price-input">
                    <input type="text" class="input-min bg-white" name="budget_usd_min_villa" id="budget_usd_min_villa" placeholder="$ 1 000">
                    <div class="separator">-</div>
                    <input type="text" class="input-max bg-white" name="budget_usd_max_villa" id="budget_usd_max_villa" placeholder="$ 100 000">
                </div>
            </div>

            @error('budget_usd')
                <p class="text-danger my-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="contact__property--form__input" id="villa_location">
            <label for="location">Location*</label>
            <select name="location">
                <option selected disabled>Property Location</option>
                @foreach ($sub_regions as $rgn)
                    <option value="{{ $rgn->name }}">{{ $rgn->name }}</option>
                @endforeach
            </select>

            @error('location')
                <p class="text-danger my-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="contact__property--form__input" id="villa_bedroom">
            <label for="villa_bedroom">Bedroom*</label>
            <div class="widget__price--filtering">
                <div class="price-input">
                    <input type="number" class="input-min bg-white" name="bedroom_min" id="bedroom_min" placeholder="Bedroom min">
                    <div class="separator">-</div>
                    <input type="number" class="input-max bg-white" name="bedroom_max" id="bedroom_max" placeholder="Bedroom max">
                </div>
            </div>

            @error('villa_bedroom')
                <p class="text-danger my-2">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <!-- looking_for_land -->
    <div id="looking_for_land" style="display: none;">
        <div class="d-flex justify-content-center justify-items-center text-center">
            <hr class="w-100" />
            <label class="w-100">Looking For Land</label>
            <hr class="w-100" />
        </div>
        <div class="contact__property--form__input" id="land_budget_idr" style="display: none;">
            <label for="budget_idr">Budget IDR*</label>
            <div class="widget__price--filtering">
                <div class="price-input">
                    <input type="text" class="input-min bg-white" name="budget_idr_min_land" id="budget_idr_min_land" placeholder="IDR 100 000 000">
                    <div class="separator">-</div>
                    <input type="text" class="input-max bg-white" name="budget_idr_max_land" id="budget_idr_max_land" placeholder="IDR 50 000 000 000">
                </div>
            </div>

            @error('budget_idr')
                <p class="text-danger my-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="contact__property--form__input" id="land_budget_usd" style="display: none;">
            <label for="budget_usd">Budget USD*</label>
            <div class="widget__price--filtering">
                <div class="price-input">
                    <input type="text" class="input-min bg-white" name="budget_usd_min_land" id="budget_usd_min_land" placeholder="$ 1 000">
                    <div class="separator">-</div>
                    <input type="text" class="input-max bg-white" name="budget_usd_max_land" id="budget_usd_max_land" placeholder="$ 100 000">
                </div>
            </div>

            @error('budget_usd')
                <p class="text-danger my-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="contact__property--form__input" id="land_location">
            <label for="location">Location*</label>
            <select name="location">
                <option selected disabled>Property Location</option>
                @foreach ($sub_regions as $rgn)
                    <option value="{{ $rgn->name }}">{{ $rgn->name }}</option>
                @endforeach
            </select>

            @error('location')
                <p class="text-danger my-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="contact__property--form__input" id="land_size">
            <label for="land_size">Land size*</label>
            <div class="widget__price--filtering">
                <div class="price-input">
                    <input type="number" class="input-min bg-white" name="land_size_min" id="land_size_min" placeholder="Land size min">
                    <div class="separator">-</div>
                    <input type="number" class="input-max bg-white" name="land_size_max" id="land_size_max" placeholder="Land size max">
                </div>
            </div>

            @error('land_size')
                <p class="text-danger my-2">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="contact__property--form__input">
        <label for="timing">Ready to buy*</label>
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
