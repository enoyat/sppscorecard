{{-- =========================
        FILTER
    ========================== --}}

<form method="GET" class="d-flex align-items-end gap-2">
    <div>
        <label>Filter by </label>
    </div>
    <div>

        <select class="form-select" name="filterby">
            <option value="CBU" {{ request('filterby') == 'CBU' ? 'selected' : '' }}>
                CBU
            </option>
            <option value="Region" {{ request('filterby') == 'Region' ? 'selected' : '' }}>
                Region
            </option>
            <option value="Site" {{ request('filterby') == 'Site' ? 'selected' : '' }}>
                Site
            </option>
        </select>
    </div>

    <div>
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-search"></i> Filter
        </button>
    </div>

</form>
