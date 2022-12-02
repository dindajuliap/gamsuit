<div id="row">
  <div id="col">
    <div class="col-lg-6 col-md-7 col-sm-9 mx-auto">
      <h1><b>Ayo main GamSuit!</b></h1>
      <p id="desc">Tulis nama di bawah ini untuk mulai bermain</p>

      <form method="post" action="">
        <div class="row mx-0">
          <input type="text" autocomplete="off" placeholder="Masukkan nama Anda" class="form-control" name="nama_pemain" id="input">
          <button type="submit" class="btn" id="mulai">Mulai <i class="fa fa-arrow-right ml-2 text-md"></i></button>
        </div>
        <small class="form-text text-danger mt-2"><?= form_error('nama_pemain') ?></small>
      </form>
    </div>
  </div>
</div>

<style>
  html, body{ height: 100%; width: 100%; background: black }
  h1{ color: mediumseagreen }
  #desc{ color: silver; margin-top: -3px }
  #input{ border: 1px solid silver; padding: 27px 20px; background: none; width: 85%; border-radius: 0px; color: white }
  #mulai{ border: 1px solid silver; color: white; background: mediumseagreen; width: 15%; border-radius: 0px }
  #row{ width: 100%; height: 100%; display: table }
  #col{ width: 100%; display: table-cell; vertical-align: middle }
  #input:enabled{ background: none; color: silver; box-shadow: none }
  #input::-webkit-input-placeholder{ color: silver }
  #input:-moz-input-placeholder{ color: silver }

  @media only screen and (max-width: 1024px){
    #input{ width: 78% }
    #mulai{ width: 22% }
  }
</style>
