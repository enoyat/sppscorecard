<form action="{{ route('beritaacara.update',$beritaacara->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                        @endif

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> Ada kesalahan data, silahkan dicek kembali<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        @csrf
                        <div class="col-lg-6">
                            <div>
                            <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Sitename Pengirim</label>
                                    <input class="form-control" type="hidden" value="{{ $beritaacara->pengirim }}" name="pengirim"
                                        id="pengirim" readonly>{{ $beritaacara->getpengirim->namasitename }}

                                </div>
                               
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Site Name Penerima</label>
                                    <input class="form-control" type="hidden" value="{{ $beritaacara->penerima }}" name="penerima"
                                        id="pengirim" readonly>{{ $beritaacara->getpenerima->namasitename }}


                                </div>
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Tanggal Upload</label>
                                    {{ $beritaacara->tanggal }}


                                </div>
                                <div class="mb-3">
                                    
                                    <img
                        src="{{ asset('assets/inventory/'.$beritaacara->filename) }}" width="100">
                                </div>
                               
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary w-md">Submit</button>

                                </div>

                            </div>
                        </div>

                        
                    </div>
                </form>