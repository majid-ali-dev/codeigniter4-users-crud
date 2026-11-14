<!DOCTYPE html>
<html>

<head>
    <title>Users CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function confirmDelete(event, button) {
        event.preventDefault();

        const form = button.closest('form');

        Swal.fire({
            title: 'Are you sure?',
            text: 'This user will be permanently deleted!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });

        return false;
    }
</script>

<body class="bg-light">

    <div class="container mt-5">

        <div class="d-flex justify-content-between mb-4">
            <h2>Users Management</h2>
            <a href="/users/create" class="btn btn-primary">Add User</a>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: <?= json_encode(session()->getFlashdata('success')) ?>,
                    confirmButtonText: 'OK'
                });
            </script>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: <?= json_encode(session()->getFlashdata('error')) ?>
                });
            </script>
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
                <?php if (!empty($users)): ?>
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
                                        onclick="return confirmDelete(event, this)">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">No users found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="mt-4">
            <?= $pager->links('default', 'bootstrap_custom') ?>
        </div>
    </div>
</body>

</html>