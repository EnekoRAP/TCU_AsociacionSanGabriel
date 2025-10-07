<?php
require_once("../../Config/dbconnection.php");
require_once("../../Libraries/vendor/autoload.php");

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$cn = abrirConexion();

$query = "SELECT b.identificacion, b.nombre, b.apellidos, b.fecha_nacimiento, b.edad, b.alergias, b.medicamentos, b.fecha_ingreso, b.encargado, b.contacto, b.pago, p.nombre AS nombre_programa, g.nombre AS nombre_grupo
          FROM tbl_beneficiarios b
          LEFT JOIN tbl_programas p ON b.id_programa = p.id_programa
          LEFT JOIN tbl_grupos g ON b.id_grupo = g.id_grupo
          ORDER BY b.id_beneficiario DESC";

$resultado = $cn->query($query);
cerrarConexion($cn);

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle("Beneficiarios");

$encabezados = [
    "Identificación", "Nombre", "Apellidos", "Fecha Nacimiento", "Edad",
    "Alergias", "Medicamentos", "Fecha Ingreso", "Encargado", "Contacto",
    "Pago", "Programa", "Grupo"
];

$col = 'A';
foreach ($encabezados as $header) {
    $sheet->setCellValue($col . '1', $header);
    $sheet->getColumnDimension($col)->setAutoSize(true);
    $col++;
}

$fila = 2;
if ($resultado && $resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $col = 'A';
        $sheet->setCellValue($col++ . $fila, $row["identificacion"]);
        $sheet->setCellValue($col++ . $fila, $row["nombre"]);
        $sheet->setCellValue($col++ . $fila, $row["apellidos"]);
        $sheet->setCellValue($col++ . $fila, $row["fecha_nacimiento"]);
        $sheet->setCellValue($col++ . $fila, $row["edad"]);
        $sheet->setCellValue($col++ . $fila, $row["alergias"]);
        $sheet->setCellValue($col++ . $fila, $row["medicamentos"]);
        $sheet->setCellValue($col++ . $fila, $row["fecha_ingreso"]);
        $sheet->setCellValue($col++ . $fila, $row["encargado"]);
        $sheet->setCellValue($col++ . $fila, $row["contacto"]);
        $sheet->setCellValue($col++ . $fila, '₡' . number_format($row["pago"], 2));
        $sheet->setCellValue($col++ . $fila, $row["nombre_programa"]);
        $sheet->setCellValue($col++ . $fila, $row["nombre_grupo"]);
        $fila++;
    }
}

$filename = "Lista_Beneficiarios.xlsx";
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=\"$filename\"");
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>
