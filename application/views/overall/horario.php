<table width="100%" >
        <thead>
            <tr>
                <th width="10%">Hora</th>
                <th width="15%">Lunes</th>
                <th width="15%">Martes</th>
                <th width="15%">Miércoles</th>
                <th width="15%">Jueves</th>
                <th width="15%">Viernes</th>
                <th width="15%">Sábado</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($horario as $fila): ?>
            <tr>
                <?php foreach ($fila as $col): ?>
                    <?php if($col): ?>
                        <td class="seccion-inscrita">
                            <?= $col; ?>
                        </td>
                    <?php else: ?>
                        <td></td>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

