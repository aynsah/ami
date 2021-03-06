<div align="center" style="width: 100%;margin: 20px 0">
  <h4 class="content-title">Zakat Perdagangan</h4>
</div>
<br>
{{ Form::open(array('route' => 'zakats.payment','method' => 'get')) }}
  <div class="form-group">
    <div class="row">
      <div class="col-12">
        <label>Penghasilan (Bulan) : </label>
        <div class="input-group mb-2">
          <div class="input-group-prepend">
            <div class="input-group-text" style="font-size: .94rem">Rp</div>
          </div>
        <input type="number" class="form-control" name="" placeholder="0">
        </div>

        <label>Penghasilan Tambahan (Bulan) : </label>
        <div class="input-group mb-2">
          <div class="input-group-prepend">
            <div class="input-group-text" style="font-size: .94rem">Rp</div>
          </div>
        <input type="text" class="form-control" name="" placeholder="0">
        </div>

        <label>Pengeluaran Pokok (Bulan) : </label>
        <div class="input-group mb-2">
          <div class="input-group-prepend">
            <div class="input-group-text" style="font-size: .94rem">Rp</div>
          </div>
        <input type="text" class="form-control" name="" placeholder="0">
        </div>

        <label>Harga Beras (Kg) : </label>
        <div class="input-group mb-2">
          <div class="input-group-prepend">
            <div class="input-group-text" style="font-size: .94rem">Rp</div>
          </div>
        <input type="text" class="form-control" name="" placeholder="0">
        </div>

        <label>Nasab (Harga Beras x 552 Kg) : </label>
        <div class="input-group mb-2">
          <div class="input-group-prepend">
            <div class="input-group-text" style="font-size: .94rem">Rp</div>
          </div>
        <input type="text" class="form-control" name="" placeholder="0" disabled="true">
        </div>

        <label>Jumlah Bulan : </label>
        <div class="input-group mb-2">
          <div class="input-group-prepend">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
          </div>
        <input type="text" class="form-control" name="" placeholder="0">
        </div>
        
        <br>
        <p> Perlu Membayar Zakat? &nbsp;&nbsp; <span class="text-success" id="zakatCondition"> Ya </span></p>
      </div>
      <div class="col-12">
        @include('zakats.forms.payment-table')

        <input type="hidden" name="akad" value="zakat-perdagangan" id="zakatType">
        <input type="submit" name="" value="Bayar Zakat" class="btn main-btn btn-success single-btn text-light full-width">
      </div>
    </div> 
  </div>
{{ Form::close() }}