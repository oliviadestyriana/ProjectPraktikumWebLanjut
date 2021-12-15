<div class="col-md-12 well">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;"><i class="fa fa-briefcase"></i> List Siswa (Ekstrakulikuler: <b><?php echo $ekstrakulikuler->nama; ?></b>)</h3>

  <div class="box box-body">
      <table id="tabel-detail" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Nama</th>
            <th>No Telp</th>
            <th>Asal Kelas</th>
            <th>Jenis Kelamin</th>
          </tr>
        </thead>
        <tbody id="data-siswa">
          <?php
            foreach ($dataEkstrakulikuler as $siswa) {
              ?>
              <tr>
                <td style="min-width:230px;"><?php echo $siswa->siswa; ?></td>
                <td><?php echo $siswa->telp; ?></td>
                <td><?php echo $siswa->kelas; ?></td>
                <td><?php echo $siswa->kelamin; ?></td>
              </tr>
              <?php
            }
          ?>
        </tbody>
      </table>
  </div>

  <div class="text-right">
    <button class="btn btn-danger" data-dismiss="modal"> Close</button>
  </div>
</div>