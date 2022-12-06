<div id="row">
  <div id="col">
    <div class="col-lg-6 col-md-7 col-sm-9 mx-auto text-center">
      <div class="spinner-border text-light" role="status" id="spinner">
        <span class="visually-hidden"></span>
      </div>

      <h3 class="text-light mt-4"><b>Mencari ulang lawan...</b></h3>
    </div>
  </div>
</div>

<style>
  html, body{ height: 100%; width: 100%; background: black }
  #row{ width: 100%; height: 100%; display: table }
  #col{ display: table-cell; vertical-align: middle }
  #spinner{ height: 120px; width: 120px; font-size: 50px }
</style>

<script>
  $(document).ready(function(){
    setInterval(() => {
      $.ajax({
        type  : 'ajax',
        url   : "<?= base_url() ?>cari/pemain",
        async : false,
        dataType : 'json',
        success : function(data){
          if(data == 1){
            window.location.href = '<?= base_url() ?>cari/ruangan';
          }
          else if(data == 2){
            window.location.href = '<?= base_url() ?>cari/pertandingan';
          }
        }
      });
    }, 1000);
  });
</script>
