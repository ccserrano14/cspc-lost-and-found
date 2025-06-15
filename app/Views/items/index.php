<!DOCTYPE html>
<html>
<head>
    <title>Items List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-4">
    <h1>Items</h1>

    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <a href="<?= site_url('items/create') ?>" class="btn btn-primary mb-3">Add New Item</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Status</th>
                <th>Condition</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($items)): ?>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?= esc($item['name']) ?></td>
                        <td><?= esc(ucfirst($item['status'])) ?></td>
                        <td><?= esc(ucfirst($item['condition'])) ?></td>
                        <td><?= date('Y-m-d', strtotime($item['created_at'])) ?></td>
                        <td>
                            <a href="<?= site_url('items/'.$item['id']) ?>" class="btn btn-info btn-sm">View</a>
                            <a href="<?= site_url('items/edit/'.$item['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="<?= site_url('items/delete/'.$item['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="5" class="text-center">No items found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
