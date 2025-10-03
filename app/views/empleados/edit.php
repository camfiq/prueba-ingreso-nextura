<?php
require __DIR__ . '/../layout/header.php';
?>
<div class="row justify-content-center align-items-center">
    <div class="col-12 mt-5">
        <div class="container my-5">
            <h2>Modificar empleado</h2>

            <div class="alert alert-info">
                Los campos con asteriscos (*) son obligatorios
            </div>

            <form id="formularioEmpleado" action="/public/empleado.php?action=edit" method="POST">
                <input type="hidden" name="id" value="<?= $empleado['id']  ?>">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre completo *</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre completo del empleado" required value="<?= htmlspecialchars($empleado['nombre']) ?>">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico *</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Correo electrónico" required value="<?= htmlspecialchars($empleado['email']) ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label d-block">Sexo *</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sexo" id="masculino" value="M" required <?= ($empleado['sexo'] == 'M') ? 'checked' : '' ?>>
                        <label class="form-check-label" for="masculino">Masculino</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sexo" id="femenino" value="F" required <?= ($empleado['sexo'] == 'F') ? 'checked' : '' ?>>
                        <label class="form-check-label" for="femenino">Femenino</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="area" class="form-label">Área *</label>
                    <select class="form-select" id="area" name="area_id" required>
                        <option value="">Seleccione un área</option>
                        <?php foreach ($areas as $area) { ?>
                            <option value="<?= $area['id'] ?>" <?= ($empleado['area_id'] == $area['id']) ? 'selected' : '' ?>>
                                <?= $area['nombre'] ?>
                            </option>
                        <?php }; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción *</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Descripción de la experiencia del empleado" required><?= htmlspecialchars($empleado['descripcion']) ?></textarea>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="boletin" name="boletin" value="1" <?= (!empty($empleado['boletin'])) ? 'checked' : '' ?>>
                    <label class="form-check-label" for="boletin">Deseo recibir boletín informativo</label>
                </div>

                <div class="mb-3">
                    <label class="form-label d-block">Roles *</label>
                    <?php foreach ($roles as $rol) { ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="rol<?= $rol['id'] ?>" name="roles[]" value="<?= $rol['id'] ?>"
                                <?php if (!empty($empleado['roles']) && in_array($rol['id'], $empleado['roles'])) echo 'checked'; ?>>
                            <label class="form-check-label" for="rol<?= $rol['id'] ?>"><?= $rol['nombre'] ?></label>
                        </div>
                    <?php } ?>
                </div>

                <!-- Botón Guardar -->
                <button type="submit" id="btnGuardar" class="btn btn-primary">Editar </button>
            </form>
        </div>
    </div>
</div>

<script src="/public/js/modules/empleados/edit.js"></script>
<?php
require __DIR__ . '/../layout/footer.php';
?>