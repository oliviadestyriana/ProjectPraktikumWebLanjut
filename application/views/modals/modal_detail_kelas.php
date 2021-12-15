<div class="col-md-12 well">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;"><i class="fa fa-location-arrow"></i> List Siswa (Dari Kelas: <b><?php echo $kelas->nama; ?></b>)</h3>

  <div class="box box-body">
      <table id="tabel-detail" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Nama</th>
            <th>No Telp</th>
            <th>Jenis Kelamin</th>
            <th>Ekstrakulikuler</th>
          </tr>
        </thead>
        <tbody id="data-siswa">
          <?php
            foreach ($dataKelas as $siswa) {
              ?>
              <tr>
                <td style="min-width:230px;"><?php echo $siswa->siswa; ?></td>
                <td><?php echo $siswa->telp; ?></td>
                <td><?php echo $siswa->kelamin; ?></td>
                <td><?php echo $siswa->ekstrakulikuler; ?></td>
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