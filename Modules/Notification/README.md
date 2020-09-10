# Inotification module 4.1.1
Improved version of the Asgard Notification Module - https://github.com/AsgardCms/Notification

##Realease Notes
### Added
- Rules `CreateNotificationRequest`
- Validation message for request rules
- `Labs Mobile` default provider for SMS notifications
- `Provider`, `Rule`, `Template` and `TypeNotification` Asgard Entities Scaffold
- `defaultEmailView` config 
- `provider` and `recipient` columns into `notification__notifications` table
- `notificationTypes` config to be seeded in the notification__notification_types table
- `providers` config to add new providers configurations
- `NotificationTypeTableSeeder` depending on the config
- `EventServiceProvider` to listening dynamically all the events defined in the config `providers`
- `NotificationHandler` to handle all the events listened by the `EventServiceProvider`
- `Rule->conditions` validations
- `ImaginaNotification` improved version of the `AsgardNotification`

>Note
>
>with the new `ImaginaNotification` service, the column `user_id` was replaced by `recipient` in the table `notification__notifications` 


## Installation

### Composer

Execute the following command in your terminal:

``` bash
composer require imagina/asgardcms-inotifications
```

>Note
>
>After installation you'll have to give you the required permissions to get to the blog module pages in the backend.**

#### Run migrations and seeders

``` bash
php artisan module:migrate notification --seed
```

### Providers configuration 
#####[/Config/config.php](/Config/config.php)

| Option | Description | Required |
| ------------- | ------------- | ------------- |
| name | Name to show in frontend administrator | Yes |
| systemName | Name to use in backend | Yes |
| icon | Icon to use in frontend administrator | No |
| color | Color to use in frontend administrator | No |
| rules | Rules to validate the recipient, see the [available rules](https://laravel.com/docs/5.5/validation#available-validation-rules)  | No |
| fields | Fields necessary to configure the provider, see the [Provider Fields](https://github.com/imagina/asgardcms-inotifications#provider-fields) | Yes |
| settings | the available settings for each rules | No |

### Provider Fields

All the fields necessary to configure the provider: api keys, login, user names, passwords. 

Each field need to be defined with the `dynamic fields` configuration in the [basequasar-app](https://github.com/imagina/basequasar-app). Here a list of the fields required:

| Option | Description | Required |
| ------------- | ------------- | ------------- |
| id | it's necessary to the crud in frontend, only the `value` it's necessary: ```  ["id" => ['value' => null]``` | Yes
| status | a select field with Enable/Disable options ('1' or '0') | Yes
| default | a checkbox field for the default provider by type of notification | Yes
| type | Type of the notification, defined in the config `notificationTypes` and seeded in the `notification__notification_types` | Yes
| saveInDatabase | required field for save in the `notification__notifications` table or not| Yes
    
>Note
>
>Each Provider field can define the route to the public config to replace the keys from ENV file, just add the configRoute value:

  ``` php
  // example: broadcasting pusher config route
  "configRoute" => "broadcasting.connections.pusher.options.encrypted"
```
this setting is only used at the time of sending a notification, the rest of the application will continue to use the settings from the .env file.

### Provider Settings

The settings necessary to customize the fields of the provider for each Rule

Each setting need to be defined with the `dynamic fields` configuration in the [basequasar-app](https://github.com/imagina/basequasar-app). Here a list of the settings required:

| Option | Description | Required |
| ------------- | ------------- | ------------- |
| status | a select field with Enable/Disable options ('1' or '0') | Yes |
| saveInDatabase | required field for save in the `notification__notifications` table or not| Yes |

    
>Note
>    
>the required fields of the Provider have more precedence over the Rule Settings.


### Publish the configuration

``` bash
php artisan module:publish-config notification
```

## Usage

There is two ways for use the sending of notifications:

###1  Quickly send notifications to your frontend application.

Inject the `Modules\Notification\Services\Inotification` interface where you need it and assign it to a class variable.
  
``` php
    // New Service Inotification
    use Modules\Notification\Services\Inotification;
  
    /**
    *  by type, to user->id recipient
    */ 
     $this->notification->type('broadcast')->to($user->id)
    ->push(
      [
        "title" => "test notification",
        "message" => "message notification",
        "icon_class" => "fas fa-test",
        "link" => url(''),
        "setting" => [
          "saveInDatabase" => 1 // now, the notifications with type broadcast need to be save in database to really send the notification
        ]
      ]
    );
    

/**
 *  by mutiple types, to user->id recipient
 */ 
  $this->notification->type(['broadcast', 'push'])->to($user->id)
    ->push(
      [
        "title" => "test notification",
        "message" => "message notification",
        "icon_class" => "fas fa-test",
        "link" => url(''),
        "setting" => [
          "saveInDatabase" => 1 // now, the notifications with type broadcast need to be save in database to really send the notification
        ]
      ]
    );
  

/**
*  by provider, to user->email recipient
*/
$this->notification->provider('email')->to($user->email)
  ->push(
    [
      "title" => "test notification",
      "message" => "message notification",
      "icon_class" => "fas fa-test",
      "link" => url(''),
      "view" => "email.view"
    ]
  );


/**
  *  by mutiple types defined in the to 
  */ 
  $this->notification->to([
    "broadcast" => $user->id,
    "email" => $user->email,
  ])->push(
      [
        "title" => "test notification",
        "message" => "message notification",
        "icon_class" => "fas fa-test",
        "link" => url(''),
        "view" => "email.view",
        "setting" => [
          "saveInDatabase" => 1 // now, the notifications with type broadcast need to be save in database to really send the notification
        ]
      ]
  );
            
```
   
   
### 2 Using Events and defining the Notifiable config in each module to administrate from the database by the Rules

#### Notifiable Configuration

First in each module you need to define the Notifiable config, the Notification module will be detect the configuration and will sending to the frontend for the creation of the Rules, each Rule need to be saved in the database for having effect. 

 | Option | Description | Required |
   | ------------- | ------------- | ------------- |
   | title | Name of the entity to show in frontend administrator | Yes
   | entityName | Class Path Name for an unique name for the notifiable, example: `Modules\\ModuleName\\Entities\\EntityName` | Yes
   | events | Array of arrays for all the events notifiable to the entity, only needs the `title` (for the frontend) and `path` (class path name) | Yes
   | conditions | Conditions to validate the Rule, if is empty the Rule will be executed without restrictions, see the [Notifiable conditions configuration](https://github.com/imagina/asgardcms-inotifications#notifiable-conditions-configuration) | No
   | settings | array to add options to the provider settings | No
     

#### Notifiable conditions configuration

The conditions are configured like the dynamic fields  of the basequasar-app.
 however, there are only 3 types of conditions available:  

1 recursive
``` php
"EMail" => [
  "name" => "EMail",
  'value' => [
    "comparator" => "",
    "value" => ""
  ],
  'type' => 'recursive',
  "fields" => [
    "operator" => [
      "name" => "operator",
      'value' => 'any',
      'type' => 'select',
      'props' => [
        'label' => 'Email',
        'options' => [
          ['label' => 'Any', 'value' => 'any'],
          ['label' => 'Contains', 'value' => 'contains'],
          ['label' => 'Exact Match', 'value' => 'exactMatch']
        ]
      ],
    ],
    "value" => [
      "name" => "value",
      'value' => '',
      'type' => 'text',
      'props' => [
        'label' => ''
      ],
    ],
    "type" => [
      "name" => "type",
      'value' => 'comparatorSimple',
      'type' => 'hidden',
      'props' => [
        'label' => ''
      ],
    ]
  ]

],
```

2 select with static options
``` php

"NinetyMin" => [
  "name" => "NinetyMin",
  'value' => 'any',
  'type' => 'select',
  'props' => [
    'label' => 'Ninety Min',
    'options' => [
      ['label' => 'Any', 'value' => 'any'],
      ['label' => 'Yes', 'value' => 'Y'],
      ['label' => 'No', 'value' => 'N']
    ]
  ],
],
```

3 select with dynamic options
``` php
"idSource" => [
  "name" => "idSource",
  'value' => 'any',
  'type' => 'select',
  'loadOptions' => [
    'apiRoute' => 'apiRoutes.setup.sources',
    'select' => ['label' => 'title', 'id' => 'id']
  ],
  'options' => [
    ['label' => 'Any', 'value' => 'any'],
  ],
  'props' => [
    'label' => 'Source'
  ],
],
```       
       
>Note
>    
> All conditions require the `any` default value, the handle detects it and validates it
 
## 
##Event Example

``` php

namespace Modules\Iteam\Events;


class UserWasJoined
{
    public $user;
    public $team;
    
    // this attribute it's required
    public $entity;

    /**
     * Create a new event instance.
     *
     * @param $entity
     * @param array $data
     */
    public function __construct($user,$team)
    {
        $this->user = $user;
        $this->entity = $team;
        $this->team = $team;
    }
  
  // this method it's required
  
  public function notification(){
    
    return [
      "title" =>  "¡Buenas Noticias!, te han aceptado en el equipo: ".$this->team->title,
      "message" =>   "Has sido aceptado en el equipo: ".$this->team->title,
      "icon_class" => "fas fa-glass-cheers",
      "link" => "link",
      "view" => "iteam::emails.userJoined.userJoined",
      "recipients" => [
        "email" => [$this->user->email],
        "broadcast" => [$this->user->id],
        "push" => [$this->user->id],
      ],
      
      // here you can send all objects and params necessary to the view template
      "user" => $this->user,
      "team" => $this->team
    ];
  }

}
```

## Notifiable Config Example

``` php
  'notifiable' => [
    
    [
      "title" => "Lead Opportunity",
      "entityName" => "Modules\\Ilead\\Entities\\LeadOpportunity",
      "events" => [
        [
          "title" => "New Lead Opportunity was created",
          "path" => "Modules\\Ilead\\Events\\LeadOpportunityWasCreated"
        ]
      ],
      
      "conditions" => [
        "EMail" => [
          "name" => "EMail",
          'value' => [
            "comparator" => "",
            "value" => ""
          ],
          'type' => 'recursive',
          "fields" => [
            "operator" => [
              "name" => "operator",
              'value' => 'any',
              'type' => 'select',
              'props' => [
                'label' => 'Email',
                'options' => [
                  ['label' => 'Any', 'value' => 'any'],
                  ['label' => 'Contains', 'value' => 'contains'],
                  ['label' => 'Exact Match', 'value' => 'exactMatch']
                ]
              ],
            ],
            "value" => [
              "name" => "value",
              'value' => '',
              'type' => 'text',
              'props' => [
                'label' => ''
              ],
            ],
            "type" => [
              "name" => "type",
              'value' => 'comparatorSimple',
              'type' => 'hidden',
              'props' => [
                'label' => ''
              ],
            ]
          ]
        
        ],
        "NinetyMin" => [
          "name" => "NinetyMin",
          'value' => 'any',
          'type' => 'select',
          'props' => [
            'label' => 'Ninety Min',
            'options' => [
              ['label' => 'Any', 'value' => 'any'],
              ['label' => 'Yes', 'value' => 'Y'],
              ['label' => 'No', 'value' => 'N']
            ]
          ],
        ],
        "idSource" => [
          "name" => "idSource",
          'value' => 'any',
          'type' => 'select',
          'loadOptions' => [
            'apiRoute' => 'apiRoutes.setup.sources',
            'select' => ['label' => 'title', 'id' => 'id']
          ],
          'options' => [
            ['label' => 'Any', 'value' => 'any'],
          ],
          'props' => [
            'label' => 'Source'
          ],
        ],
        "idStore" => [
          "name" => "idStore",
          'value' => 'any',
          'type' => 'select',
          'loadOptions' => [
            'apiRoute' => 'apiRoutes.setup.stores',
            'select' => ['label' => 'title', 'id' => 'id']
          ],
          'options' => [
            ['label' => 'Any', 'value' => 'any'],
          ],
          'props' => [
            'label' => 'Store'
          ],
        ],
      
      ],
      
      "settings" => [
        
        "email" => [
          
          "recipients" => [
            ['label' => 'Customer Email', 'value' => 'EMail']
          ]
        ],
        
        "sms" => [
          "recipients" => [
            ['label' => 'Day Phone', 'value' => 'DayPhone'],
            ['label' => 'Evening Phone', 'value' => 'EvePhone'],
            ['label' => 'Cell Phone', 'value' => 'CellPhone']
          ]
        ],
        
        "pusher" => [
          "recipients" => [
            ['label' => 'Rep 1', 'value' => 'repId'],
            ['label' => 'Rep 2', 'value' => 'repId2']
          ]
        ],
        
        "firebase" => [
          "recipients" => [
            ['label' => 'Rep 1', 'value' => 'repId'],
            ['label' => 'Rep 2', 'value' => 'repId2']
          ]
        ],
      ],
    ],
  ]
```

## Provider Config Example [providers](Config/config.php)

``` php
 "pusher" => [// PUSHER PROVIDER
      "name" => "Pusher",
      "systemName" => "pusher",
      "icon" => "far fa-bell",
      "color" => "#c223ce",
      "rules" => [
        "numeric",
        "min:1",
      ],
      "fields" => [
        "id" => [
          'value' => null,
        ],
        "pusherAppEncrypted" => [
          "name" => "pusherAppEncrypted",
          'value' => true,
          'type' => 'toggle',
          "isFakeField" => 'fields',
          'props' => [
            'label' => 'Pusher App Encrypted',
            'falseValue' => false,
            'trueValue' => true
          ],
          "configRoute" => "broadcasting.connections.pusher.options.encrypted"
        ],
        
        "pusherAppId" => [
          "name" => "pusherAppId",
          'value' => '',
          'type' => 'input',
          "isFakeField" => 'fields',
          'required' => true,
          'props' => [
            'label' => 'Pusher App Id *'
          ],
          "configRoute" => "broadcasting.connections.pusher.app_id"
        ],
        
        "pusherAppKey" => [
          "name" => "pusherAppKey",
          'value' => '',
          'type' => 'input',
          "isFakeField" => 'fields',
          'required' => true,
          'props' => [
            'label' => 'Pusher App Key *'
          ],
          "configRoute" => "broadcasting.connections.pusher.key"
        ],
        
        "pusherAppSecret" => [
          "name" => "pusherAppSecret",
          'value' => '',
          'type' => 'input',
          "isFakeField" => 'fields',
          'required' => true,
          'props' => [
            'label' => 'Pusher App Secret *'
          ],
          "configRoute" => "broadcasting.connections.pusher.secret"
        ],
        
        "pusherAppCluster" => [
          "name" => "pusherAppCluster",
          'value' => '',
          'type' => 'input',
          "isFakeField" => 'fields',
          'required' => true,
          'props' => [
            'label' => 'Pusher App Cluster *'
          ],
          "configRoute" => "broadcasting.connections.pusher.options.cluster"
        ],
        "status" => [
          "name" => "status",
          'value' => '0',
          'type' => 'select',
          'required' => true,
          'props' => [
            'label' => 'Status',
            'options' => [
              ["label" => 'enabled', "value" => '1'],
              ["label" => 'disabled', "value" => '0'],
            ],
          ],
        ],
        "default" => [
          "name" => "default",
          'value' => false,
          'type' => 'checkbox',
          'props' => [
            'label' => 'Default',
          ]
        ],
        "saveInDatabase" => [
          "name" => "saveInDatabase",
          'value' => '1',
          'type' => 'select',
          'required' => true,
          'props' => [
            'label' => 'Save in database',
            'options' => [
              ["label" => 'enabled', "value" => '1'],
              ["label" => 'disabled', "value" => '0'],
            ],
          ],
        ],
        "type" => ['value' => 'broadcast'],
      ],
      "settings" => [
        "recipients" => [
          "name" => "recipients",
          'value' => '',
          'type' => 'input',
          "isFakeField" => 'settings',
          'props' => [
            'label' => 'Recipients',
            "hint" => "Enter recipient ID - separate entries with commas"
          ],
        ],
        "status" => [
          "name" => "status",
          'value' => '0',
          'type' => 'select',
          'required' => true,
          'props' => [
            'label' => 'Enable',
            'options' => [
              ["label" => 'enabled', "value" => '1'],
              ["label" => 'disabled', "value" => '0'],
            ],
          ],
        ],
        "saveInDatabase" => [
          "name" => "saveInDatabase",
          'value' => '1',
          'type' => 'select',
          'required' => true,
          'props' => [
            'label' => 'Save in database',
            'options' => [
              ["label" => 'enabled', "value" => '1'],
              ["label" => 'disabled', "value" => '0'],
            ],
          ],
        ],
      ]
    ],
```
## Flow Chart
![Flow Chart](https://raw.githubusercontent.com/imagina/asgardcms-inotifications/dev-4.0/Assets/img/flow-chart.jpeg)