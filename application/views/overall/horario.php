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
            <?php foreach($horario as $hora => $dias): ?>
            <tr>
                <td>
                    <?php echo $hora; ?>
                </td>
                <?php foreach ($dias as $dia): ?>
                    <?php if($dia): ?>
                        <td class="seccion-inscrita">
                            <?php echo $dia; ?>
                        </td>
                    <?php else: ?>
                        <td></td>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

