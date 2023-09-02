<?= $this->extend('default') ?>
<?= $this->section('page_title') ?>
    Employee Data
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <div class="d-flex justify-content-between">
        <div>
        <a href="/employee/create" class="btn btn-primary">Add</a>
        </div>
    <div>
        <a href="<?php echo base_url('employee/export'); ?>" class="btn btn-success">Excel Export</a></div>
    <div>
    <form action="<?php echo base_url('employee/import'); ?>" method="post" enctype="multipart/form-data">
        <input type="file" name="excel_file" class="form-control" required>
        <input type="submit" value="Upload & Update" class="form-control bg-success text-white">
    </form>
    </div>
</div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($employee as $emp): ?>
            <tr>
                <td><?= $emp['id'] ?></th>
                <td><?=  $emp['name'] ?></td>
                <td><?=  $emp['email'] ?></td>
                <td>
                    <a href=<?php echo "/employee/edit/".$emp['id'] ?> class="btn btn-warning btn-sm" >Edit</a>
                    <a href=<?php echo "/employee/delete/".$emp['id'] ?> class="btn btn-danger btn-sm" >Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?= $pager->simpleLinks() ?>
<?= $this->endSection() ?>