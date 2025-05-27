<div>
    {{-- The whole world belongs to you. --}}
    <x-input-label for="country" value="Country"/>
    <select wire:model.live="country" id="country">
        <option value="" selected disabled>Select Country</option>
        @forelse($countries as $country)
            <option value="{{$country->id}}">{{$country->name}} ({{$country->iso2}})</option>
        @empty
            <option value="">No Countries</option>
        @endforelse

    </select>

    <x-input-label for="state" value="State"/>
    <select wire:model.live="state" name="state" id="state">
        <option value="">Select Country & State</option>

    @forelse($states as $state)
            <option value="{{$state->id}}">{{$state->name}}</option>
        @empty
            <option value="">No States</option>
        @endforelse

    </select>

    <x-input-label for="city" value="City"/>
    <select id="city" name="state">
        <option value="">Select Country & State</option>
    @forelse($cities as $city)
            <option value="{{$city->id}}">{{$city->name}}</option>
        @empty
            <option value="">No Cities</option>
        @endforelse

    </select>
</div>
