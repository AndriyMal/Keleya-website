<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
      crossorigin="anonymous">
<div class="wrap">
  <a href="/wp-admin/admin-ajax.php?action=kp_export_promodes&code=<?= get_the_ID() ?>"
     class="btn btn-primary btn active" role="button" aria-pressed="true">Export to csv</a>

  <br>
  <br>

  <table class="table">
    <caption>Promocodes</caption>
    <tr>
      <th>Codes</th>
      <th>Max count of use</th>
      <th>Used</th>
    </tr>
    <?php
    foreach ($codes as $code) {
      $meta = get_post_meta($code->ID);
      ?>
      <tr>
        <td><?= $code->post_title ?></td>
        <td><?= $meta['max_count_of_use'][0] ?></td>
        <td><?= $meta['current_count_of_use'][0] ?></td>
      </tr>
      <?php
    }
    ?>
  </table>

</div>
