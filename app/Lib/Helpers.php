<?php

function m($input) {
    return 'Rp ' . number_format($input, 2, '.', ',');
}

function mp($input) {
    return 'Rp <span class="pull-right">' . number_format($input, 2, '.', ',') . '</span>';
}

function d($input) {
    if (!($input instanceof Carbon\Carbon)) {
        $input = new Carbon\Carbon($input);
    }
    return $input->toFormattedDateString();
}
