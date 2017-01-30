@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

                <?php

                    if (isset($error)) {
                        ?>

                              <div class="alert alert-danger" data-mensaje="<?php echo $error; ?>">
                              
                                <p><strong>Error!!</strong> <span><?php echo $error; ?></span></p>

                              </div>


                        <?php
                    }

                ?>

            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>
                <div class="panel-body">
                    Your Application's Landing Page.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
