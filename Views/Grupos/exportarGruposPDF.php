<?php
require_once("../../Config/dbconnection.php");
require_once("../../Libraries/dompdf/autoload.inc.php");

use Dompdf\Dompdf;
use Dompdf\Options;

$cn = abrirConexion();

$query = "SELECT id_grupo, codigo, nombre, descripcion, nivel, fecha_inicio, fecha_fin, estado
          FROM tbl_grupos
          ORDER BY id_grupo DESC";

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

<h2>Lista de Grupos</h2>
<table>
<thead>
<tr>
<th>Código</th>
<th>Nombre</th>
<th>Descripción</th>
<th>Nivel</th>
<th>Fecha de Ingreso</th>
<th>Fecha de Salida</th>
<th>Estado</th>
</tr>
</thead>
<tbody>';

if ($resultado && $resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $estado = $row['estado'] ? 'Activo' : 'Inactivo';
        $html .= '<tr>
                    <td>' . htmlspecialchars($row["codigo"]) . '</td>
                    <td>' . htmlspecialchars($row["nombre"]) . '</td>
                    <td>' . htmlspecialchars($row["descripcion"]) . '</td>
                    <td>' . htmlspecialchars($row["nivel"]) . '</td>
                    <td>' . htmlspecialchars($row["fecha_inicio"]) . '</td>
                    <td>' . htmlspecialchars($row["fecha_fin"]) . '</td>
                    <td>' . $estado . '</td>
                 </tr>';
    }
} else {
    $html .= '<tr><td colspan="7" style="text-align:center;">Sin Grupos</td></tr>';
}

$html .= '</tbody></table>';

$options = new Options();
$options->set('defaultFont', 'DejaVu Sans');
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream("Lista_Grupos.pdf", ["Attachment" => true]);
exit;
?>
