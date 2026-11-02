@csrf
<label for="vendor_profile_id">Vendor</label>
<select name="vendor_profile_id" id="vendor_profile_id" data-rule="required" data-label="Vendor">
    <option value="">-- choose vendor --</option>
    @foreach($vendors as $v)
        <option value="{{ $v->id }}" {{ old('vendor_profile_id', $experience->vendor_profile_id ?? '') == $v->id ? 'selected' : '' }}>{{ $v->name }}</option>
    @endforeach
</select>

<label for="name">Experience Name</label>
<input type="text" id="name" name="name" value="{{ old('name', $experience->name ?? '') }}" data-rule="required" data-label="Name">

<label for="location">Location</label>
<input type="text" id="location" name="location" value="{{ old('location', $experience->location ?? '') }}" data-rule="required" data-label="Location">

<label for="category">Category</label>
<select name="category" id="category" data-rule="required" data-label="Category">
    <option value="">-- choose category --</option>
    @foreach($categories as $cat)
        <option value="{{ $cat }}" {{ old('category', $experience->category ?? '') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
    @endforeach
</select>

<label for="description">Description</label>
<textarea id="description" name="description" rows="3" data-rule="required" data-label="Description">{{ old('description', $experience->description ?? '') }}</textarea>

<label for="menu">Menu</label>
<input type="text" id="menu" name="menu" value="{{ old('menu', $experience->menu ?? '') }}">

<label for="price">Price (RM)</label>
<input type="text" id="price" name="price" value="{{ old('price', $experience->price ?? '') }}" data-rule="required|price" data-label="Price">

<label for="status">Status</label>
<select name="status" id="status" data-rule="required" data-label="Status">
    <option value="active" {{ old('status', $experience->status ?? 'active') == 'active' ? 'selected' : '' }}>Active</option>
    <option value="inactive" {{ old('status', $experience->status ?? '') == 'inactive' ? 'selected' : '' }}>Inactive</option>
</select>
<br>
<button type="submit" class="btn">Save</button>
<a href="{{ route('experiences.index') }}" class="btn btn-grey">Cancel</a>
