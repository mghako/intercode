<?= $this->extend('default') ?>
<?= $this->section('page_title') ?>
    Employee Data
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <a href="/employee" class="btn btn-dark">Back</a>
    <div class="container mx-auto w-">
      <form method="POST" action=<?php echo "/employee/update/"; ?>>
        <input type="hidden" name="id" id="id" value="<?php echo $employee['id']; ?>">
        <div id="employee-container">
          <div class="form-group">
              <label for="name">Name:</label>
              <input type="text" name="name" class="form-control" value=<?php echo $employee['name'] ?> required>
          </div>
          <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" name="email" value=<?php echo $employee['email'] ?> class="form-control" required>
          </div>
        </div>
          <button type="submit" class="btn btn-primary">Update Employee</button>
      </form>
    </div>
<?= $this->endSection() ?>

<?= $this->section("scripts")?>
<!-- <script src="<?= base_url('/js/createEmployee.js') ?>"></script> -->
<?= $this->endSection()?>