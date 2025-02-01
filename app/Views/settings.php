<?php $session = \Config\Services::session(); ?>
<?= $this->extend("layouts/header-new") ?>

<?= $this->section("body") ?>
<?php
if (isset($_SESSION['msg'])) {
  echo $_SESSION['msg'];
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content settings">
    <div class="container-fluid">
      <div class="row">

        <div class="col-12 col-lg-3">
          <div class="card mt-2">
            <div class="card-header">
              <h6 class="card-title">Assign Candidates</h6>
            </div>
            <form method="post" action="<?= site_url('update-settings') ?>" autocomplete="off">
              <input type="hidden" name="name" value="auto-assign">
              <div class="card-body ">
                <div class="form-group">
                  <div class="form-group">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="value" id="inlineRadio1" value="1" <?= ($settings['auto-assign'] == 1) ? 'checked' : '' ?>>
                      <label class="form-check-label" for="inlineRadio1">Auto</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="value" id="inlineRadio2" value="2" <?= ($settings['auto-assign'] == 2) ? 'checked' : '' ?>>
                      <label class="form-check-label" for="inlineRadio2">Manual</label>
                    </div>
                  </div>
                  <button type="submit" class="btn update mt-4">Update Settings</button>
                </div>
              </div>
            </form>
          </div>
        </div>

        <div class="col-12 col-lg-3">
          <div class="card mt-2">
            <div class="card-header">
              <h6 class="card-title">Payroll Automation</h6>
            </div>
            <form method="post" action="<?= site_url('update-settings') ?>" autocomplete="off">
              <input type="hidden" name="name" value="payrol-function">
              <div class="card-body ">
                <div class="form-group">
                  <div class="form-group">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="value" id="inlineRadio1" value="1" <?= ($settings['payrol-function'] == 1) ? 'checked' : '' ?>>
                      <label class="form-check-label" for="inlineRadio1">Auto</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="value" id="inlineRadio2" value="2" <?= ($settings['payrol-function'] == 2) ? 'checked' : '' ?>>
                      <label class="form-check-label" for="inlineRadio2">Manual</label>
                    </div>
                  </div>
                  <button type="submit" class="btn update mt-4">Update Settings</button>
                </div>
              </div>
            </form>
          </div>
        </div>

        <div class="col-12 col-lg-3">
          <div class="card mt-2">
            <div class="card-header">
              <h6 class="card-title">Job Experiance Options</h6>
            </div>
            <form method="post" action="<?= site_url('update-settings-options') ?>" autocomplete="off">
              <div class="del-list-option"></div>
              <div class="card-body">
                <div class="options">
                  <?php if (empty($options)) { ?>
                    <div class="d-flex align-items-center mt-2">
                      <input name="options[]" class="form-control" style="margin-right: 10px;" placeholder="1 - 2 years">
                      <button type="button" class="btn add-button">+</button>
                    </div>
                  <?php } ?>
                  <?php foreach ($options as $index => $option) {
                    if ($index == 0) { ?>
                      <div class="d-flex align-items-center mt-2">
                        <input class="form-control" style="margin-right: 10px;" placeholder="1 - 2 years" value="<?= $option['Options'] ?>" readonly>
                        <button type="button" class="btn add-button">+</button>
                      </div>
                    <?php } else { ?>
                      <div class="d-flex align-items-center mt-2">
                        <input class="form-control" style="margin-right: 10px;" placeholder="1 - 2 years" value="<?= $option['Options'] ?>" readonly>
                        <?php if($option['Del']){ ?>
                          <button type="button" class="btn remove-button" data-id="<?= $option['IDPK'] ?>">-</button>
                        <?php }else{ ?>
                          <button type="button" class="btn perremove-button">-</button>
                        <?php } ?>
                      </div>
                  <?php }
                  } ?>
                </div>
                <span class="text-danger" id="option_error" style="display:none;">Some Career still have this experience!</span>
                <button type="submit" class="btn update mt-4">Update Settings</button>
              </div>
            </form>
          </div>
        </div>

        <div class="col-12 col-lg-3">
          <div class="card mt-2">
            <div class="card-header">
              <h6 class="card-title">Tiket Types</h6>
            </div>
            <form method="post" action="<?= site_url('update-settings-tikets') ?>" autocomplete="off">
              <div class="del-list-ticket"></div>
              <div class="card-body">
                <div class="tickets">
                  <?php if (empty($ticket_types)) { ?>
                    <div class="d-flex align-items-center mt-2">
                      <input name="Name[]" class="form-control" style="margin-right: 10px;" placeholder="1 - 2 years">
                      <button type="button" class="btn add-button">+</button>
                    </div>
                  <?php } ?>
                  <?php foreach ($ticket_types as $index => $types) {
                    if ($index == 0) { ?>
                      <div class="d-flex align-items-center mt-2">
                        <input class="form-control" style="margin-right: 10px;" placeholder="1 - 2 years" value="<?= $types['Name'] ?>" readonly>
                        <button type="button" class="btn add-button">+</button>
                      </div>
                    <?php } else { ?>
                      <div class="d-flex align-items-center mt-2">
                        <input class="form-control" style="margin-right: 10px;" placeholder="1 - 2 years" value="<?= $types['Name'] ?>" readonly>
                        <?php if($types['Del']){ ?>
                          <button type="button" class="btn remove-button" data-id="<?= $types['IDPK'] ?>">-</button>
                        <?php }else{ ?>
                          <button type="button" class="btn perremove-button">-</button>
                        <?php } ?>
                      </div>
                  <?php }
                  } ?>
                </div>
                <span class="text-danger" id="type_error" style="display:none;">Some Tickets still have this type!</span>
                <button type="submit" class="btn update mt-4">Update Settings</button>
              </div>
            </form>
          </div>
        </div>


      </div>
    </div>
  </section>
</div>

<script>
  $('.options').on('click', '.add-button', function() {
    const inputHtml = `<div class="d-flex align-items-center mt-2">
                          <input name="options[]" class="form-control" style="margin-right: 10px;" placeholder="1 - 2 years">
                          <button type="button" class="btn bg-orange remove-button" data-id="0">-</button>
                        </div>`;
    $('.options').append(inputHtml);
  });
  $('.options').on('click', '.remove-button', function() {
    var IDPK = $(this).data('id');
    if(IDPK != 0){
      var HTML =`<input type="hidden" name="remove[]" value="`+IDPK+`">`;
      $('.del-list-option').append(HTML);
    }
    $(this).closest('.d-flex').remove();
  });
  $('.options').on('click', '.perremove-button', function() {
    $('#option_error').show();
    setTimeout(function() {
        $('#option_error').hide(); // Hide the error message after 3 seconds
    }, 3000);
  });



  $('.tickets').on('click', '.add-button', function() {
    const inputHtml = `<div class="d-flex align-items-center mt-2">
                          <input name="Name[]" class="form-control" style="margin-right: 10px;" placeholder="1 - 2 years">
                          <button type="button" class="btn bg-orange remove-button" data-id="0">-</button>
                        </div>`;
    $('.tickets').append(inputHtml);
  });
  $('.tickets').on('click', '.remove-button', function() {
    var IDPK = $(this).data('id');
    if(IDPK != 0){
      var HTML =`<input type="hidden" name="remove[]" value="`+IDPK+`">`;
      $('.del-list-ticket').append(HTML);
    }
    $(this).closest('.d-flex').remove();
  });
  $('.tickets').on('click', '.perremove-button', function() {
    $('#type_error').show();
    setTimeout(function() {
        $('#type_error').hide(); // Hide the error message after 3 seconds
    }, 3000);
  });
</script>

<?= $this->endSection() ?>