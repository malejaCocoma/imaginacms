<?php

return [
  'custom-featured-categories-home' => [
    'name' => 'icustom::custom-featured-categories-home',
    'value' => null,
    'type' => 'treeSelect',
    'columns' => 'col-12 col-md-6',
    'loadOptions' => [
      'apiRoute' => 'apiRoutes.qcommerce.categories',
      'select' => ['label' => 'title', 'id' => 'id'],
    ],
    'props' => [
      'label' => 'icustom::common.custom-featured-categories-home',
      'clearable' => true,
      'multiple' => true,
      'value-consists-of' => 'BRANCH_PRIORITY',
      'sort-value-by' => 'ORDER_SELECTED'
    ],
  ],


];