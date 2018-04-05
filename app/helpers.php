<?php

function refs($login)
{
    return \App\User::whereRefLogin($login)->count();
}
