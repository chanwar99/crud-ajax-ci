<?php
ob_start();
$no = $rowNo;
foreach ($dataMahasiswa as $row) : ?>
    <tr>
        <th scope="row"><?= ++$no; ?></th>
        <td><?= $row->npm; ?></td>
        <td><?= $row->nama; ?></td>
        <td><?= $row->nama_jurusan; ?></td>
        <td>
            <button type="button" class="btn btn-primary btn-sm mb-2 btnUpdate"><i class="fas fa-edit"></i></button>
            <button type="button" class="btn btn-primary btn-sm mb-2 btnDelete"><i class="fas fa-trash"></i></button>
        </td>
    </tr>
<?php endforeach;
$html = ob_get_contents();
ob_end_clean();
echo json_encode(array(
    'html' => $html,
    'data' => empty($dataMahasiswa) ? false : true,
    'pagination' => $pagination,
));
?>