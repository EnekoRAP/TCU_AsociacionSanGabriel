<?php
require_once("../../Config/dbconnection.php");
require_once("../../Libraries/dompdf/autoload.inc.php");

use Dompdf\Dompdf;
use Dompdf\Options;

$cn = abrirConexion();

$query = "SELECT b.identificacion, b.nombre, b.apellidos, b.fecha_nacimiento, b.edad, b.alergias, b.medicamentos, b.fecha_ingreso, b.encargado, b.contacto, b.pago, 
          p.nombre AS nombre_programa, g.nombre AS nombre_grupo
          FROM tbl_beneficiarios b
          LEFT JOIN tbl_programas p ON b.id_programa = p.id_programa
          LEFT JOIN tbl_grupos g ON b.id_grupo = g.id_grupo
          ORDER BY b.id_beneficiario DESC";

$resultado = $cn->query($query);
cerrarConexion($cn);

$html = '
<style>
    body { font-family: DejaVu Sans, sans-serif; }
    h2 { text-align: center; margin-bottom: 20px; }
    table { width: 100%; border-collapse: collapse; font-size: 12px; }
    th, td { border: 1px solid #000; padding: 6px; text-align: left; }
    th { background-color: #f2f2f2; }
</style>

<h2>Lista de Beneficiarios</h2>
<table>
<thead>
<tr>
<th>Identificación</th>
<th>Nombre</th>
<th>Apellidos</th>
<th>Fecha Nacimiento</th>
<th>Edad</th>
<th>Alergias</th>
<th>Medicamentos</th>
<th>Fecha Ingreso</th>
<th>Encargado</th>
<th>Contacto</th>
<th>Pago</th>
<th>Programa</th>
<th>Grupo</th>
</tr>
</thead>
<tbody>';

if ($resultado && $resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $html .= '<tr>
                    <td>' . htmlspecialchars($row["identificacion"]) . '</td>
                    <td>' . htmlspecialchars($row["nombre"]) . '</td>
                    <td>' . htmlspecialchars($row["apellidos"]) . '</td>
                    <td>' . htmlspecialchars($row["fecha_nacimiento"]) . '</td>
                    <td>' . htmlspecialchars($row["edad"]) . '</td>
                    <td>' . htmlspecialchars($row["alergias"]) . '</td>
                    <td>' . htmlspecialchars($row["medicamentos"]) . '</td>
                    <td>' . htmlspecialchars($row["fecha_ingreso"]) . '</td>
                    <td>' . htmlspecialchars($row["encargado"]) . '</td>
                    <td>' . htmlspecialchars($row["contacto"]) . '</td>
                    <td>' . '₡' . number_format($row["pago"], 2) . '</td>
                    <td>' . htmlspecialchars($row["nombre_programa"]) . '</td>
                    <td>' . htmlspecialchars($row["nombre_grupo"]) . '</td>
                 </tr>';
    }
} else {
    $html .= '<tr><td colspan="13" style="text-align:center;">No hay beneficiarios registrados</td></tr>';
}

$html .= '</tbody></table>';

$options = new Options();
$options->set('defaultFont', 'DejaVu Sans');

$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();

$dompdf->stream("Lista_Beneficiarios.pdf", ["Attachment" => true]);
exit;
?>
