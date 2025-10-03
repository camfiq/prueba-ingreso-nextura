<?php
require __DIR__ . '/../layout/header.php';
?>
<div class="row justify-content-center align-items-center">
    <div class="col-12 mt-5">
        <div class="container mt-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Listado de Empleados</h3>
                <a href="/public/empleado.php?action=create" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i> Crear
                </a>
            </div>

            <table class="table table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th><i class="bi bi-person"></i> Nombre</th>
                        <th><i class="bi bi-at"></i> Email</th>
                        <th><i class="bi bi-gender-ambiguous"></i> Sexo</th>
                        <th><i class="bi bi-briefcase"></i> Área</th>
                        <th><i class="bi bi-envelope"></i> Boletín</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($empleados as $empleado) { ?>
                        <tr id="row-empleado-<?= $empleado['id'] ?>">
                            <td><?= $empleado['nombre'] ?></td>
                            <td><?= $empleado['email'] ?></td>
                            <td><?= $empleado['sexo'] ?></td>
                            <td><?= $empleado['area'] ?></td>
                            <td><?= $empleado['boletin'] ? 'Sí' : 'No' ?></td>
                            <td>
                                <a href="empleado.php?action=edit&id=<?= $empleado['id'] ?>" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                            </td>
                            <td>
                                <a href="#!" data-id="<?= $empleado['id'] ?>" class="btn btn-sm btn-outline-danger btn-eliminar-empleado">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php }; ?>



                </tbody>
            </table>
        </div>


    </div>
</div>
<script src="/public/js/modules/empleados/index.js"></script>
<?php
require __DIR__ . '/../layout/footer.php';
?>