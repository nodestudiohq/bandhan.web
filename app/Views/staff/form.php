<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php $editing = isset($staff); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h4 class="fw-semibold mb-0"><?= $editing ? 'Edit Staff' : 'Add Staff' ?></h4>
    <small class="text-muted">
      <?= $editing ? 'Update staff member details' : 'Register a new staff member' ?>
    </small>
  </div>
  <a href="<?= base_url('staff') ?>" class="btn btn-outline-secondary btn-sm">
    <i class="bi bi-arrow-left me-1"></i>Back
  </a>
</div>

<div class="card border-0">
  <div class="card-body">
    <form method="post" action="<?= $editing ? base_url('staff/update/' . $staff['id']) : base_url('staff/store') ?>"
      enctype="multipart/form-data">
      <?= csrf_field() ?>
      <?php if ($editing): ?>
        <input type="hidden" name="_method" value="PUT">
      <?php endif; ?>

      <div class="row g-3">

        <!-- Personal Info -->
        <div class="col-12">
          <h6 class="fw-semibold text-muted text-uppercase mb-3" style="font-size:.75rem;letter-spacing:.05em">Personal
            Information</h6>
        </div>

        <div class="col-md-4">
          <label class="form-label">Full Name <span class="text-danger">*</span></label>
          <input type="text" name="name" class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>"
            value="<?= old('name', $staff['name'] ?? '') ?>" required>
          <div class="invalid-feedback"><?= $errors['name'] ?? '' ?></div>
        </div>

        <div class="col-md-4">
          <label class="form-label">Father's Name</label>
          <input type="text" name="father_name" class="form-control"
            value="<?= old('father_name', $staff['father_name'] ?? '') ?>">
        </div>

        <div class="col-md-4">
          <label class="form-label">Date of Birth</label>
          <input type="date" name="dob" class="form-control" value="<?= old('dob', $staff['dob'] ?? '') ?>">
        </div>

        <div class="col-md-4">
          <label class="form-label">Gender</label>
          <select name="gender" class="form-select">
            <option value="">Select</option>
            <option value="Male" <?= old('gender', $staff['gender'] ?? '') === 'Male' ? 'selected' : '' ?>>Male</option>
            <option value="Female" <?= old('gender', $staff['gender'] ?? '') === 'Female' ? 'selected' : '' ?>>Female
            </option>
            <option value="Other" <?= old('gender', $staff['gender'] ?? '') === 'Other' ? 'selected' : '' ?>>Other</option>
          </select>
        </div>

        <div class="col-md-4">
          <label class="form-label">Blood Group</label>
          <select name="blood_group" class="form-select">
            <option value="">Select</option>
            <?php foreach (['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $bg): ?>
              <option value="<?= $bg ?>" <?= old('blood_group', $staff['blood_group'] ?? '') === $bg ? 'selected' : '' ?>>
                <?= $bg ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="col-md-4">
          <label class="form-label">Photo</label>
          <input type="file" name="photo" class="form-control" accept="image/*">
          <?php if (!empty($staff['photo'])): ?>
            <small class="text-muted">Current: <?= esc($staff['photo']) ?></small>
          <?php endif; ?>
        </div>

        <!-- Contact Info -->
        <div class="col-12 mt-2">
          <h6 class="fw-semibold text-muted text-uppercase mb-3" style="font-size:.75rem;letter-spacing:.05em">Contact
            Information</h6>
        </div>

        <div class="col-md-4">
          <label class="form-label">Phone <span class="text-danger">*</span></label>
          <input type="text" name="phone" class="form-control <?= isset($errors['phone']) ? 'is-invalid' : '' ?>"
            value="<?= old('phone', $staff['phone'] ?? '') ?>" required>
          <div class="invalid-feedback"><?= $errors['phone'] ?? '' ?></div>
        </div>

        <div class="col-md-4">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
            value="<?= old('email', $staff['email'] ?? '') ?>">
          <div class="invalid-feedback"><?= $errors['email'] ?? '' ?></div>
        </div>

        <div class="col-md-4">
          <label class="form-label">Emergency Contact</label>
          <input type="text" name="emergency_contact" class="form-control"
            value="<?= old('emergency_contact', $staff['emergency_contact'] ?? '') ?>">
        </div>

        <div class="col-12">
          <label class="form-label">Address</label>
          <textarea name="address" class="form-control"
            rows="2"><?= old('address', $staff['address'] ?? '') ?></textarea>
        </div>

        <!-- Job Info -->
        <div class="col-12 mt-2">
          <h6 class="fw-semibold text-muted text-uppercase mb-3" style="font-size:.75rem;letter-spacing:.05em">Job
            Information</h6>
        </div>

        <div class="col-md-4">
          <label class="form-label">Designation <span class="text-danger">*</span></label>
          <input type="text" name="designation"
            class="form-control <?= isset($errors['designation']) ? 'is-invalid' : '' ?>"
            value="<?= old('designation', $staff['designation'] ?? '') ?>" placeholder="e.g. Nurse, Doctor, Technician"
            required>
          <div class="invalid-feedback"><?= $errors['designation'] ?? '' ?></div>
        </div>

        <div class="col-md-4">
          <label class="form-label">Department <span class="text-danger">*</span></label>
          <?php $selectedDept = old('department', $staff['department'] ?? ''); ?>
          <select name="department" class="form-select <?= isset($errors['department']) ? 'is-invalid' : '' ?>"
            required>
            <option value="">Select Department</option>
            <?php foreach ($departments as $category => $depts): ?>
              <optgroup label="<?= esc($category) ?>">
                <?php foreach ($depts as $dept): ?>
                  <option value="<?= esc($dept) ?>" <?= $selectedDept === $dept ? 'selected' : '' ?>>
                    <?= esc($dept) ?>
                  </option>
                <?php endforeach; ?>
              </optgroup>
            <?php endforeach; ?>
          </select>
          <div class="invalid-feedback"><?= $errors['department'] ?? '' ?></div>
        </div>

        <div class="col-md-4">
          <label class="form-label">Date of Joining</label>
          <input type="date" name="joining_date" class="form-control"
            value="<?= old('joining_date', $staff['joining_date'] ?? date('Y-m-d')) ?>">
        </div>

        <div class="col-md-4">
          <label class="form-label">Weekly Off Day</label>
          <select name="weekly_off" class="form-select">
            <?php foreach (['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'] as $day): ?>
              <option value="<?= $day ?>" <?= old('weekly_off', $staff['weekly_off'] ?? 'Sunday') === $day ? 'selected' : '' ?>>
                <?= $day ?>
              </option>
            <?php endforeach; ?>
          </select>
          <div class="form-text">Staff's regular weekly off day</div>
        </div>

        <div class="col-md-4">
          <label class="form-label">Status</label>
          <select name="status" class="form-select">
            <option value="active" <?= old('status', $staff['status'] ?? 'active') === 'active' ? 'selected' : '' ?>>Active
            </option>
            <option value="inactive" <?= old('status', $staff['status'] ?? 'active') === 'inactive' ? 'selected' : '' ?>>
              Inactive</option>
          </select>
        </div>

        <div class="col-md-4">
          <label class="form-label">Aadhar / ID Number</label>
          <input type="text" name="id_number" class="form-control"
            value="<?= old('id_number', $staff['id_number'] ?? '') ?>">
        </div>

        <div class="col-12 d-flex gap-2 justify-content-end mt-2 pt-2 border-top">
          <a href="<?= base_url('staff') ?>" class="btn btn-outline-secondary">Cancel</a>
          <button type="submit" class="btn btn-primary">
            <i class="bi bi-check-lg me-1"></i><?= $editing ? 'Update Staff' : 'Save Staff' ?>
          </button>
        </div>

      </div>
    </form>
  </div>
</div>

<?= $this->endSection() ?>