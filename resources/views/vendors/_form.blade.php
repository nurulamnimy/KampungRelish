@csrf
<label for="name">Vendor Name</label>
<input type="text" id="name" name="name" value="{{ old('name', $vendor->name ?? '') }}" data-rule="required" data-label="Name">

<label for="phone">Phone</label>
<input type="text" id="phone" name="phone" value="{{ old('phone', $vendor->phone ?? '') }}" data-rule="required|digits" data-label="Phone">

<label for="location">Location</label>
<input type="text" id="location" name="location" value="{{ old('location', $vendor->location ?? '') }}" data-rule="required" data-label="Location">

<label for="description">Description</label>
<textarea id="description" name="description" rows="3">{{ old('description', $vendor->description ?? '') }}</textarea>

<label for="status">Status</label>
<select name="status" id="status">
    <option value="active" {{ old('status', $vendor->status ?? 'active') == 'active' ? 'selected' : '' }}>Active</option>
    <option value="inactive" {{ old('status', $vendor->status ?? '') == 'inactive' ? 'selected' : '' }}>Inactive</option>
</select>
<br>
<button type="submit" class="btn">Save</button>
<a href="{{ route('vendors.index') }}" class="btn btn-grey">Cancel</a>
