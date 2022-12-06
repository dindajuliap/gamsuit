<div id="row">
  <div id="col">
    <div class="col-lg-6 col-md-7 col-sm-9 mx-auto text-center">
      <h2 align="center"><b>Pilih salah satu!</b></h2>

      <div class="row mt-4">
        <div class="col-lg-4 col-md-4 col-sm-4">
          <a onclick="batu()">
            <div class="card text-center" id="card">
              <i class="fa fa-hand-rock" id="pilihan"></i>
              <h6 class="mt-3">Batu</h6>
            </div>
          </a>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4">
          <a onclick="gunting()">
            <div class="card text-center" id="card">
              <i class="fa fa-hand-peace" id="pilihan"></i>
              <h6 class="mt-3">Gunting</h6>
            </div>
          </a>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4">
          <a onclick="kertas()">
            <div class="card text-center" id="card">
              <i class="fa fa-hand-paper" id="pilihan"></i>
              <h6 class="mt-3">Kertas</h6>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  html, body{ height: 100%; width: 100%; background: #C4E4FF; background: radial-gradient(circle, hsl(223, 20%,12%), hsl(223, 20%,22%)); background: radial-gradient(circle, hsl(223, 40%,22%), hsl(223, 40%,12%)); }
  #row{ width: 100%; height: 100%; display: table }
  #col{ display: table-cell; vertical-align: middle }
  #card{ color: lightslategrey; border-radius: 5px; padding: 30px 30px 10px 30px; height: 100%; width: 100% }
  #pilihan{ font-size: 60px }
  h2{ color: lightsteelblue }
  h6{ color: black }
</style>

<script>
  $(document).ready(function(){
    setInterval(() => {
      $.ajax({
        type  : 'ajax',
        url   : "<?= base_url() ?>cek/pemain/<?= $p ?>",
        async : false,
        dataType : 'json',
        success : function(data){
          if(data == 1){
            window.location.href = '<?= base_url() ?>cari-pemain?p=<?= $p ?>';
          }
        }
      });
    }, 1000);
  });

  function batu(){
    Swal.fire({
      title: "Peringatan!",
      text: "Anda yakin ingin memilih batu?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: 'lightslategrey',
      cancelButtonColor: 'grey',
      cancelButtonText: 'Tidak',
      confirmButtonText: 'Yakin'
    }).then((result) =>{
      if(result.value){
        document.location.href = "<?= base_url() ?>main/Batu/<?= $p.'/'.$r ?>";
      }
    });
  }

  function gunting(){
    Swal.fire({
      title: "Peringatan!",
      text: "Anda yakin ingin memilih gunting?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: 'lightslategrey',
      cancelButtonColor: 'grey',
      cancelButtonText: 'Tidak',
      confirmButtonText: 'Yakin'
    }).then((result) =>{
      if(result.value){
        document.location.href = "<?= base_url() ?>main/Gunting/<?= $p.'/'.$r ?>";
      }
    });
  }

  function kertas(){
    Swal.fire({
      title: "Peringatan!",
      text: "Anda yakin ingin memilih kertas?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: 'lightslategrey',
      cancelButtonColor: 'grey',
      cancelButtonText: 'Tidak',
      confirmButtonText: 'Yakin'
    }).then((result) =>{
      if(result.value){
        document.location.href = "<?= base_url() ?>main/Kertas/<?= $p.'/'.$r ?>";
      }
    });
  }
</script>
