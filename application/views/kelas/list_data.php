<?php
  $no = 1;
  foreach ($dataKelas as $kelas) {
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $kelas->nama; ?></td>
      <td class="text-center" style="min-width:230px;">
          <button class="btn btn-warning update-dataKelas" data-id="<?php echo $kelas->id; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
          <button class="btn btn-danger konfirmasiHapus-kelas" data-id="<?php echo $kelas->id; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>
          <button class="btn btn-info detail-dataKelas" data-id="<?php echo $kelas->id; ?>"><i class="glyphicon glyphicon-info-sign"></i> Detail</button>
      </td>
    </tr>
    <?php
    $no++;
  }
?>