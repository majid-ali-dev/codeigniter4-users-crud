<!DOCTYPE html>
<html>

<head>
    <title>Users CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">

        <div class="d-flex justify-content-between mb-4">
            <h2>Users Management</h2>
            <a href="/users/create" class="btn btn-primary">Add User</a>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= esc(session()->getFlashdata('success')) ?>
            </div>
        <?php endif; ?>

        <table class="table table-bordered table-striped bg-white table-hover text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th width="180">Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= esc($user['id']) ?></td>
                        <td><?= esc($user['name']) ?></td>
                        <td><?= esc($user['email']) ?></td>
                        <td>
                            <a href="/users/edit/<?= esc($user['id']) ?>"
                                class="btn btn-warning btn-sm">Edit</a>

                            <form action="/users/delete/<?= esc($user['id']) ?>"
                                method="post" class="d-inline">
                                <?= csrf_field() ?>
                                <button type="submit"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Delete this user?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>

                <?php if (empty($users)): ?>
                    <tr>
                        <td colspan="4" class="text-center">No users found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

    </div>
</body>

</html>