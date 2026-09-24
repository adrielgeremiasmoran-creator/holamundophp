<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-warning">
                <i class="bi bi-pencil-square"></i> Editar Usuario
            </div>
            <div class="card-body">
                <form action="<?= $base ?>/users/update/<?= (int) $user['id'] ?>" method="post">
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($user['name']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nueva contraseña <small class="text-muted">(dejar en blanco para no cambiar)</small></label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="<?= $base ?>/users" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-save"></i> Actualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>