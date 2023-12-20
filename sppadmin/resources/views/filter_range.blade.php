<form id="formkpideliery" method="get">
                                                @csrf
                                                <input type="date" name="tglawal" id="tglawal"
                                                    value="{{ request()->get('tglawal') }}">
                                                <input type="date" name="tglakhir" id="tglakhir"
                                                    value="{{ request()->get('tglakhir') }}">

                                                <button type="submit" class="btn btn-primary">Filter</button>
                                            </form>
