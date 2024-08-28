<select class="form-select mb-2" data-control="select2" data-hide-search="true" data-placeholder="Select an option"
    id="city_id" required>
    <option></option>
    @foreach ($cities as $city)
    <option value="{{$city->id}}" selected="selected">{{$city->name}}</option>
    @endforeach
</select>
