<div id="row">
  <div id="col">
    <div class="col-lg-6 col-md-7 col-sm-9 mx-auto text-center">
      <h3 align="center"><b>Pilih satu!</b></h3>

      <div class="row mt-4">
        <div class="col-lg-4 col-md-4 col-sm-4">
          <div class="card text-center" id="card">
            <i class="fa fa-hand-rock" id="pilihan"></i>
            <h6 class="mt-3">Batu</h6>
          </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4">
          <div class="card text-center" id="card">
            <i class="fa fa-hand-peace" id="pilihan"></i>
            <h6 class="mt-3">Gunting</h6>
          </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4">
          <div class="card text-center" id="card">
            <i class="fa fa-hand-paper" id="pilihan"></i>
            <h6 class="mt-3">Kertas</h6>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  html, body{ height: 100%; width: 100%; background: black }
  #row{ width: 100%; height: 100%; display: table }
  #col{ display: table-cell; vertical-align: middle }
  #card{ color: mediumseagreen; border-radius: 5px; padding: 30px 30px 10px 30px; height: 100%; width: 100% }
  #pilihan{ font-size: 30px }
  h3{ color: mediumseagreen }
  h6{ color: black }
</style>

<!-- <script>
  $(document).ready(function(){
    setInterval(() => {
      $.ajax({
        type  : 'ajax',
        url   : "<?= base_url() ?>cari/pemain",
        async : false,
        dataType : 'json',
        success : function(data){
          if(data == 1){
            <?php
              $this->db->where('status_pertandingan', 'Sedang bermain');
              $this->db->where('id_pemain_1', $this->session->userdata('id_pemain'));
              $this->db->or_where('id_pemain_2', $this->session->userdata('id_pemain'));
              $cek = $this->db->get('tabel_pertandingan')->row_array();
            ?>

            document.location.href = '<?= base_url() ?>pertandingan?p=<?= $cek['id_pertandingan'] ?>';
          }
          else if(data == 2){
            window.location.href = '<?= base_url() ?>cari/pertandingan';
          }
        }
      });
    }, 1000);
  });
</script> -->
