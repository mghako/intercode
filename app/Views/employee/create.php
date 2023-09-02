<?= $this->extend('default') ?>
<?= $this->section('page_title') ?>
    Employee Data
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <a href="/employee" class="btn btn-dark">Back</a>
    <button type="button" id="add-employee" class="btn btn-info">Add Employee</button>
    <span id="employee-container-count">0</span>
    <div class="container mx-auto w-">
      <form method="POST" action="/employee/store">
        <div id="employee-container">
        </div>
          
          
          <button type="submit" class="btn btn-primary">Create Employee</button>
      </form>
    </div>
<?= $this->endSection() ?>

<?= $this->section("scripts")?>
<script src="<?= base_url('/js/createEmployee.js') ?>"></script>
<?= $this->endSection()?>