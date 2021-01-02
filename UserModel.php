<?php

namespace yassersoliman\phpmvc;
use yassersoliman\phpmvc\db\DbModel;

abstract class UserModel extends DbModel
{
	abstract public function getDisplayName(): string;
}

?>
