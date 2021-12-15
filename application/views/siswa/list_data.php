<?php
  foreach ($dataSiswa as $siswa) {
    ?>
    <tr>
      <td style="min-width:230px;"><?php echo $siswa->siswa; ?></td>
      <td><?php echo $siswa->telp; ?></td>
      <td><?php echo $siswa->kota; ?></td>
      <td><?php echo $siswa->kelamin; ?></td>
      <td><?php echo $siswa->posisi; ?></td>
      <td class="text-center" style="min-width:230px;">
        <button class="btn btn-warning update-dataSiswa" data-id="<?php echo $siswa->id; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
        <button class="btn btn-danger konfirmasiHapus-siswa" data-id="<?php echo $siswa->id; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>
      </td>
    </tr>
    <?php
  }
?>