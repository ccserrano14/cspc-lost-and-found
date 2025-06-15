<!DOCTYPE html>
<html>
<head>
    <title>Add New Item</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-4">
    <h1>Add New Item</h1>
    <a href="<?= site_url('items') ?>" class="btn btn-secondary mb-3">Back to List</a>

    <?php if (isset($validation)): ?>
        <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
    <?php endif; ?>

    <form action="<?= site_url('items/store') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="<?= set_value('name') ?>" required />
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="3" required><?= set_value('description') ?></textarea>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-select" required>
                <option value="">-- Select Status --</option>
                <option value="pending" <?= set_select('status', 'pending') ?>>Pending</option>
                <option value="claimed" <?= set_select('status', 'claimed') ?>>Claimed</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Condition</label>
            <select name="condition" class="form-select" required>
                <option value="">-- Select Condition --</option>
                <option value="lost" <?= set_select('condition', 'lost') ?>>Lost</option>
                <option value="found" <?= set_select('condition', 'found') ?>>Found</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control" accept="image/*" required />
        </div>

        <button type="submit" class="btn btn-success">Save Item</button>
    </form>
</div>
</body>
</html>
