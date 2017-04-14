<?php

function user()
{
    return auth()->user();
}

function now() {
    return \Carbon\Carbon::now();
}