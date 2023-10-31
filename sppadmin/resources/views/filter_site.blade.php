<select name="filter" class="form-control">
    @if (Auth::user()->roles_id == '1')
        <option value="sitename" {{ request()->get('filter') == 'sitename' ? 'selected' : '' }}>
            SITENAME</option>
        <option value="region" {{ request()->get('filter') == 'region' ? 'selected' : '' }}>
            REGION</option>
        <option value="cbu" {{ request()->get('filter') == 'cbu' ? 'selected' : '' }}>
            CBU</option>
        <option value="allsn" {{ request()->get('filter') == 'allsn' ? 'selected' : '' }}>
            ALL SN</option>
        <option value="allwater" {{ request()->get('filter') == 'allwater' ? 'selected' : '' }}>
            ALL WATERS</option>
        <option value="allsnwater" {{ request()->get('filter') == 'allsnwater' ? 'selected' : '' }}>
            ALL SN & WATERS</option>
    @elseif (Auth::user()->roles_id == '2')
        <option value="sitename" {{ request()->get('filter') == 'sitename' ? 'selected' : '' }}>
            SITENAME</option>
    @elseif (Auth::user()->roles_id == '4')
        <option value="sitename" {{ request()->get('filter') == 'sitename' ? 'selected' : '' }}>
            SITENAME</option>
    @elseif (Auth::user()->roles_id == '5')
        <option value="sitename" {{ request()->get('filter') == 'sitename' ? 'selected' : '' }}>
            SITENAME</option>
        <option value="region" {{ request()->get('filter') == 'region' ? 'selected' : '' }}>
            REGION</option>
        <option value="cbu" {{ request()->get('filter') == 'cbu' ? 'selected' : '' }}>
            CBU</option>
        <option value="allsn" {{ request()->get('filter') == 'allsn' ? 'selected' : '' }}>
            ALL SN</option>
        <option value="allwater" {{ request()->get('filter') == 'allwater' ? 'selected' : '' }}>
            ALL WATERS</option>
        <option value="allsnwater" {{ request()->get('filter') == 'allsnwater' ? 'selected' : '' }}>
            ALL SN & WATERS</option>
    @elseif (Auth::user()->roles_id == '6')
        <option value="sitename" {{ request()->get('filter') == 'sitename' ? 'selected' : '' }}>
            SITENAME</option>
        <option value="region" {{ request()->get('filter') == 'region' ? 'selected' : '' }}>
            REGION</option>
        <option value="cbu" {{ request()->get('filter') == 'cbu' ? 'selected' : '' }}>
            CBU</option>
        <option value="allsn" {{ request()->get('filter') == 'allsn' ? 'selected' : '' }}>
            ALL SN</option>
        <option value="allwater" {{ request()->get('filter') == 'allwater' ? 'selected' : '' }}>
            ALL WATERS</option>
        <option value="allsnwater" {{ request()->get('filter') == 'allsnwater' ? 'selected' : '' }}>
            ALL SN & WATERS</option>
    @endif
</select>
