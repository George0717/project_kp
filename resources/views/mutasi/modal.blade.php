<form action="{{ route('mutasi.store') }}" method="post" enctype="multipart/form-data">@csrf
    <div class="modal fade" id="exampleModalSignUp" tabindex="-1" role="dialog" aria-labelledby="exampleModalSignTitle"
      aria-hidden="true" > 
      <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card card-plain">
              <div class="card-header pb-0 text-left">
                <h5 class="text-center">Mutasi</h5>
              </div>
              <div class="card-body pb-3" >
                <form role="form text-left">
                  <div class="input-group input-group-outline my-3">
                    <input type="text" class="form-control" id="nama_barang" placeholder="Nama Barang"  name="nama_barang">
                  </div>
                  <div class="input-group input-group-outline my-3">
                    <input type="Text" class="form-control" id="merk" placeholder="Merk" name="merk">
                  </div>
                  <div class="input-group input-group-outline my-3">
                    <label class="form-label"></label>
                    <input type="text" class="form-control" id="model" placeholder="Model" name="model">
                  </div>
                  <div class="input-group input-group-static mb-4">
                    <label for="exampleFormControlSelect1" class="ms-0">Kategori</label>
                    <select class="form-control" id="kategori">
                      <option>Baru</option>
                      <option>Mutasi</option>
                      <option>Rusak</option>
                    </select>
                  </div>
                  <div class="input-group input-group-outline my-3">
                    <label class="form-label"></label>
                    <input type="text" class="form-control" id="no_inventaris" placeholder="No Inventaris" name="no_inventaris">
                  </div>
                  <div class="input-group input-group-outline my-3">
                    <label class="form-label"></label>
                    <input type="text" class="form-control" id="keterangan" placeholder="Keterangan" name="keterangan">
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn bg-gradient-primary btn-lg btn-rounded w-100 mt-4 mb-0">Submit</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    </form>