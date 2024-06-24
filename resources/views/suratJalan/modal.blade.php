<form action="{{ route('suratJalan.storeDetail') }}" method="post" enctype="multipart/form-data">@csrf
    <div class="modal fade" id="exampleModalSignUp" tabindex="-1" role="dialog" aria-labelledby="exampleModalSignTitle"
      aria-hidden="true" > 
      <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card card-plain">
              <div class="card-header pb-0 text-left">
                <h5 class="text-center">Surat Jalan</h5>
              </div>
              <div class="card-body pb-3" >
                <form role="form text-left">
                  <div class="input-group input-group-outline my-3">
                    <input type="text" class="form-control" id="namaBarang" placeholder="Nama Barang"  name="namaBarang">
                  </div>
                  <div class="input-group input-group-outline my-3">
                    <input type="number" class="form-control" id="jumlahBarang" placeholder="Jumlah Barang" name="jumlahBarang">
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