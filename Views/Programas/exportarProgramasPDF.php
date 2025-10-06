<?php
require_once("../../Config/dbconnection.php");
require_once("../../Libraries/dompdf/autoload.inc.php");

use Dompdf\Dompdf;
use Dompdf\Options;

$cn = abrirConexion();

$query = "SELECT id_programa, nombre, descripcion, tipo, estado
          FROM tbl_programas
          ORDER BY id_programa DESC";

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

<h2>Lista de Programas</h2>
<table>
<thead>
<tr>
<th>Nombre</th>
<th>Descripción</th>
<th>Tipo</th>
<th>Estado</th>
</tr>
</thead>
<tbody>';

if ($resultado && $resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $estado = $row['estado'] ? 'Activo' : 'Inactivo';
        $html .= '<tr>
                    <td>' . htmlspecialchars($row["nombre"]) . '</td>
                    <td>' . htmlspecialchars($row["descripcion"]) . '</td>
                    <td>' . htmlspecialchars($row["tipo"]) . '</td>
                    <td>' . $estado . '</td>
                 </tr>';
    }
} else {
    $html .= '<tr><td colspan="4" style="text-align:center;">Sin programas</td></tr>';
}

$html .= '</tbody></table>';

$options = new Options();
$options->set('defaultFont', 'DejaVu Sans');
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream("Lista_Programas.pdf", ["Attachment" => true]);
exit;
?>
