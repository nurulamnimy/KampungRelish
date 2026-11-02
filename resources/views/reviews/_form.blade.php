@csrf
<label for="rating">Rating (1 to 5)</label>
<select name="rating" id="rating" data-rule="required" data-label="Rating">
    <option value="">-- choose --</option>
    @for($i = 5; $i >= 1; $i--)
        <option value="{{ $i }}" {{ old('rating', $review->rating ?? '') == $i ? 'selected' : '' }}>{{ $i }}</option>
    @endfor
</select>

<label for="comment">Comment</label>
<textarea id="comment" name="comment" rows="4" data-rule="required" data-label="Comment">{{ old('comment', $review->comment ?? '') }}</textarea>
<br>
<button type="submit" class="btn">Save Review</button>
