</body>

<script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.0/dist/sweetalert2.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.5.7/p5.min.js"></script>

<script>
  const suksesData     = $('.sukses-data').data('sukses');
  const gagalData 	   = $('.gagal-data').data('gagal');
  const peringatanData = $('.peringatan-data').data('peringatan');
  const rondeData      = $('.ronde-data').data('ronde');
  const menangData     = $('.menang-data').data('menang');
  const kalahData      = $('.kalah-data').data('kalah');
  const seriData       = $('.seri-data').data('seri');
  const selesaiData    = $('.selesai-data').data('selesai');

  if(suksesData){
    setTimeout(function(){
      Swal.fire({
        title: 'Berhasil!',
        text: suksesData,
        icon: 'success',
        confirmButtonColor: 'darkseagreen',
        confirmButtonText: 'OK'
      }).then((result) =>{
        if (result.value){
          document.location.href = href;
        }
      })
    }, 1800);
  }
  else if(gagalData){
    Swal.fire({
      title: 'Gagal!',
      text: gagalData,
      icon: 'error',
      confirmButtonColor: 'darkseagreen',
      confirmButtonText: 'OK'
    }).then((result) =>{
      if (result.value){
        document.location.href = href;
      }
    })
  }
  else if(peringatanData){
    setTimeout(function(){
      Swal.fire({
        title: 'Peringatan!',
        text: peringatanData,
        icon: 'warning',
        confirmButtonColor: 'darkseagreen',
        confirmButtonText: 'OK'
      }).then((result) =>{
        if (result.value){
          document.location.href = href;
        }
      })
    }, 1800);
  }
  else if(rondeData){
    setTimeout(function(){
      Swal.fire({
        title: 'Mulai Ronde ' + rondeData,
        icon: 'warning',
        confirmButtonColor: 'darkseagreen',
        confirmButtonText: 'OK'
      }).then((result) =>{
        if (result.value){
          document.location.href = href;
        }
      })
    }, 1800);
  }
  else if(menangData){
    setTimeout(function(){
      Swal.fire({
        title: 'Anda menang ronde ' + menangData + '!',
        icon: 'success',
        confirmButtonColor: 'darkseagreen',
        confirmButtonText: 'OK'
      }).then((result) =>{
        if (result.value){
          document.location.href = href;
        }
      })
    }, 1800);
  }
  else if(kalahData){
    setTimeout(function(){
      Swal.fire({
        title: 'Anda kalah ronde ' + kalahData + '!',
        icon: 'error',
        confirmButtonColor: 'darkseagreen',
        confirmButtonText: 'OK'
      }).then((result) =>{
        if (result.value){
          document.location.href = href;
        }
      })
    }, 1800);
  }
  else if(seriData){
    setTimeout(function(){
      Swal.fire({
        title: 'Anda seri di ronde ' + seriData + '!',
        icon: 'warning',
        confirmButtonColor: 'darkseagreen',
        confirmButtonText: 'OK'
      }).then((result) =>{
        if (result.value){
          document.location.href = href;
        }
      })
    }, 1800);
  }
  else if(selesainData){
    setTimeout(function(){
      Swal.fire({
        title: 'Permainan telah selesai!',
        icon: 'warning',
        confirmButtonColor: 'darkseagreen',
        confirmButtonText: 'OK'
      }).then((result) =>{
        if (result.value){
          document.location.href = href;
        }
      })
    }, 1800);
  }
</script>
