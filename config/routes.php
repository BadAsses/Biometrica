<?php
return array(
  'addUid'=>'main/add',
  'test'=>'main/test',
  '([a-z]+)'=>'main/validate/$1',
  '([0-9]+)'=>'main/validate/$1',
  // '@"\<[a-z0-9_-]*\>'=>'main/validate/$1',
  '' => 'main/index'
);
