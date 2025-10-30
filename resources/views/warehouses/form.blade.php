<div class="form-group">
    <label>Name</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $warehouse->name ?? '') }}" required>
</div>

<div class="form-group">
    <label>Location</label>
    <input type="text" name="location" class="form-control" value="{{ old('location', $warehouse->location ?? '') }}">
</div>

<div class="form-group">
    <label>Lease Start</label>
    <input type="date" name="lease_start_date" class="form-control" value="{{ old('lease_start_date', $warehouse->lease_start_date ?? '') }}">
</div>

<div class="form-group">
    <label>Lease End</label>
    <input type="date" name="lease_end_date" class="form-control" value="{{ old('lease_end_date', $warehouse->lease_end_date ?? '') }}">
</div>

<div class="form-group">
    <label>Rent Amount</label>
    <input type="number" step="0.01" name="rent_amount" class="form-control" value="{{ old('rent_amount', $warehouse->rent_amount ?? '') }}">
</div>
