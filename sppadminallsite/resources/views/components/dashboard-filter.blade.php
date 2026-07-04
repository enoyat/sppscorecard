<div class="card filter-card mb-4">

    <div class="card-body">

        <div class="row g-3 align-items-end">
            @php
                $isAdmin = Auth::check() && in_array(Auth::user()->roles_id, [1, 10]);
            @endphp


            @if ($showCBU && $isAdmin)

                <div class="col-lg-3">

                    <label class="form-label">

                        CBU

                    </label>
                    <select id="idcbu" name="idcbu" class="form-select select2">


                        <option value="">Semua CBU</option>

                        @foreach ($cbu as $item)
                            <option value="{{ $item->id }}"
                                {{ Session::get('runidcbu') == $item->id ? 'selected' : '' }}>

                                {{ $item->namasitename }}

                            </option>
                        @endforeach

                    </select>

                </div>

            @endif



            @if ($showRegion && $isAdmin)

                <div class="col-lg-3">

                    <label class="form-label">

                        Region

                    </label>

                    <select id="idregion" name="idregion" class="form-select select2">

                        <option value="">Semua Region</option>

                        @foreach ($region as $item)
                            <option value="{{ $item->id }}"
                                {{ Session::get('runidregion') == $item->id ? 'selected' : '' }}>

                                {{ $item->namasitename }}

                            </option>
                        @endforeach

                    </select>

                </div>

            @endif



            @if ($showSite)

                <div class="col-lg-3">

                    <label class="form-label">

                        Site

                    </label>

                    <select id="idsitename" name="idsitename" class="form-select select2">

                        <option value="">Semua Site</option>

                        @foreach ($sitename as $item)
                            <option value="{{ $item->id }}"
                                {{ Session::get('runidsitename') == $item->id ? 'selected' : '' }}>

                                {{ $item->namasitename }}

                            </option>
                        @endforeach

                    </select>

                </div>

            @endif




        </div>

    </div>

</div>
