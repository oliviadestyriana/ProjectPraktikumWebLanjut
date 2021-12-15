<?php
  $no = 1;
  foreach ($dataEkstrakulikuler as $ekstrakulikuler) {
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $ekstrakulikuler->nama; ?></td>
      <td class="text-center" style="min-width:230px;">
        <button class="btn btn-warning update-dataEkstrakulikuler" data-id="<?php echo $ekstrakulikuler->id; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
        <button class="btn btn-danger konfirmasiHapus-ekstrakulikuler" data-id="<?php echo $ekstrakulikuler->id; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>
        <button class="btn btn-info detail-dataEkstrakulikuler" data-id="<?php echo $ekstrakulikuler->id; ?>"><i class="glyphicon glyphicon-info-sign"></i> Detail</button>
      </td>
    </tr>
    <?php
    $no++;
  }
?>