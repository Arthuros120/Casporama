<!-- user/home/homeContent -->

<h1>User Page</h1>

<?php

    echo "Sesision :</br></br>";

    if ($this->session->userdata('user')) {

        var_dump($this->session->userdata('user'));

    }

    echo "</br></br>Cookie :</br></br>";

    if ($this->input->cookie('user')) {

        var_dump($this->input->cookie('user'));

    }

?>
<p></p>
<a href="<?php echo base_url('user/logout'); ?>">Logout</a>
<a href="<?= base_url() ?>">Home</a>

<!-- user/home/homeContent -->
