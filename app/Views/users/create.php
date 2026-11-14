<!DOCTYPE html>
<html>

<head>
    <title>Create User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">

        <div class="card p-4">
            <h3>Add New User</h3>

            <form action="/users/store" method="post">

                <?= csrf_field() ?>

                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name"
                        class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email"
                        class="form-control" required>
                </div>

                <button class="btn btn-primary">Save User</button>
                <a href="/users" class="btn btn-secondary">Back</a>

            </form>
        </div>

    </div>
</body>

</html>