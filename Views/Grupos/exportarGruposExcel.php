<?php
require_once("../../Config/dbconnection.php");
require_once("../../Libraries/vendor/autoload.php");

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$cn = abrirConexion();

$query = "SELECT id_grupo, codigo, nombre, descripcion, nivel, fecha_inicio, fecha_fin, estado
          FROM tbl_grupos
          ORDER BY id_grupo DESC";

$resultado = $cn->query($query);
cerrarConexion($cn);

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle("Grupos");

$headers = ["Código","Nombre","Descripción","Nivel","Fecha de Ingreso","Fecha de Salida","Estado"];
$col = 'A';
foreach ($headers as $h) {
    $sheet->setCellValue($col.'1', $h);
    $sheet->getColumnDimension($col)->setAutoSize(true);
    $col++;
}

$rowNum = 2;
if ($resultado && $resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $col = 'A';
        $sheet->setCellValue($col++.$rowNum, $row["codigo"]);
        $sheet->setCellValue($col++.$rowNum, $row["nombre"]);
        $sheet->setCellValue($col++.$rowNum, $row["descripcion"]);
        $sheet->setCellValue($col++.$rowNum, $row["nivel"]);
        $sheet->setCellValue($col++.$rowNum, $row["fecha_inicio"]);
        $sheet->setCellValue($col++.$rowNum, $row["fecha_fin"]);
        $sheet->setCellValue($col++.$rowNum, $row["estado"] ? 'Activo' : 'Inactivo');
        $rowNum++;
    }
} else {
    $sheet->setCellValue('A2', 'Sin Grupos');
    $sheet->mergeCells('A2:G2');
    $sheet->getStyle('A2')->getAlignment()->setHorizontal('center');
}

$filename = "Lista_Grupos.xlsx";
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=\"$filename\"");
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>
