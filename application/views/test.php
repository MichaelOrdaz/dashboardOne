<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
  <link rel="stylesheet" href="">
</head>
<body>
  
  <table>
    
    <thead>
      <tr>
        <th> idBitaGes </th>
        <th> comentarioBitaGes </th>
        <th> telContactBitaGes </th>
        <th> fechaProxContactBitaGes </th>
        <th> fechaBitaGes </th>
        <th> userAsig </th>
        <th> idUser </th>
        <th> folio </th>
        <th> idCliente </th>
        <th> idCR </th>
        <th> idCA </th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($rows as $row): ?>
        
        <tr>
          <td> <?= $row->idBitaGes ?> </td>
          <td> <?= $row->comentarioBitaGes ?> </td>
          <td> <?= $row->telContactBitaGes ?> </td>
          <td> <?= $row->fechaProxContactBitaGes ?> </td>
          <td> <?= $row->fechaBitaGes ?> </td>
          <td> <?= $row->userAsig ?> </td>
          <td> <?= $row->idUser ?> </td>
          <td> <?= $row->folio ?> </td>
          <td> <?= $row->idCliente ?> </td>
          <td> <?= $row->idCA ?> </td>
          <td> <?= $row->idCA ?> </td>
        </tr>

      <?php endforeach; ?>
    </tbody>

  </table>


</body>
</html>