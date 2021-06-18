<?php 
return [
  'backend' => [
    'access' => [
      'users' => [
        'delete_user_confirm' => 'Вы уверены, что хотите удалить этот пользователь постоянно? В любом месте приложения, которые ссылаются на идентификатор этого пользователя, скорее всего, ошибка. Приступить к своему собственному риску. Это не может быть отменено.',
        'if_confirmed_off' => '(Если подтверждено выключено)',
        'no_deactivated' => 'Нет деактивированных пользователей.',
        'no_deleted' => 'Нет удаленных пользователей.',
        'restore_user_confirm' => 'Восстановите этот пользователь к своему первоначальному состоянию?',
      ],
    ],
    'dashboard' => [
      'title' => 'Приборная панель',
      'welcome' => 'Добро пожаловать',
    ],
    'general' => [
      'all_rights_reserved' => 'Все права защищены.',
      'are_you_sure' => 'Вы уверены, что хотите это сделать?',
      'boilerplate_link' => 'Laravel Starter',
      'continue' => 'Продолжать',
      'member_since' => 'Участник с',
      'minutes' => 'минут',
      'search_placeholder' => 'Поиск...',
      'timeout' => 'Вы были автоматически вынесены в систему по соображениям безопасности, так как у вас нет активности в',
      'see_all' => [
        'messages' => 'Смотрите все сообщения',
        'notifications' => 'Посмотреть все',
        'tasks' => 'Просмотреть все задачи',
      ],
      'status' => [
        'online' => 'В сети',
        'offline' => 'Не в сети',
      ],
      'you_have' => [
        'messages' => '{0} У вас нет сообщений | {1} У вас есть 1 сообщение | [2, inf] У вас есть сообщения :number',
        'notifications' => '{0} У вас нет уведомлений | {1} У вас есть 1 уведомление | [2, INF] У вас есть уведомления :number',
        'tasks' => '{0} У вас нет задач | {1} У вас есть 1 задача | [2, INF] У вас есть задачи :number',
      ],
    ],
    'search' => [
      'empty' => 'Пожалуйста введите критерий поиска.',
      'incomplete' => 'Вы должны написать свою собственную логику поиска для этой системы.',
      'title' => 'результаты поиска',
      'results' => 'Результаты поиска для :query',
    ],
    'welcome' => 'Добро пожаловать на приборную панель',
  ],
  'emails' => [
    'auth' => [
      'account_confirmed' => 'Ваша учетная запись была подтверждена.',
      'error' => 'Упс!',
      'greeting' => 'Привет!',
      'regards' => 'С уважением,',
      'trouble_clicking_button' => 'Если у вас проблемы с нажатием кнопки «: Action_Text», скопируйте и вставьте URL ниже в свой веб-браузер:',
      'thank_you_for_using_app' => 'Спасибо за использование нашего приложения!',
      'password_reset_subject' => 'Сброс пароля',
      'password_cause_of_email' => 'Вы получаете это письмо, потому что получим запрос сброса пароля для вашей учетной записи.',
      'password_if_not_requested' => 'Если вы не запрашиваете сброс пароля, дополнительное действие не требуется.',
      'reset_password' => 'Нажмите здесь, чтобы сбросить пароль',
      'click_to_confirm' => 'Нажмите здесь, чтобы подтвердить свою учетную запись:',
    ],
    'contact' => [
      'email_body_title' => 'У вас есть новая контактная форма запроса: ниже детали:',
      'subject' => 'Новая контактная форма :app_name!',
    ],
  ],
  'frontend' => [
    'test' => 'Контрольная работа',
    'tests' => [
      'based_on' => [
        'permission' => 'На основе разрешений -',
        'role' => 'Роль на основе -',
      ],
      'js_injected_from_controller' => 'JavaScript введен из контроллера',
      'using_blade_extensions' => 'Использование расширений лезвия',
      'using_access_helper' => [
        'array_permissions' => 'Использование Helper Access с массивом имени разрешений или идентификатора, где пользователь должен иметь все.',
        'array_permissions_not' => 'Использование доступа Helper с массивом имени разрешений или идентификатора, где пользователь не должен обладать всем.',
        'array_roles' => 'Использование Helper Access с массивом имени ролей или идентификатора, где пользователь должен обладать всем.',
        'array_roles_not' => 'Использование доступа Helper с массивом имени ролей или идентификатора, где пользователь не должен обладать всем.',
        'permission_id' => 'Использование Helper Access с идентификатором разрешения',
        'permission_name' => 'Использование доступа Helper с именем разрешений',
        'role_id' => 'Использование доступа Helper с идентификатором роли',
        'role_name' => 'Использование доступа Helper с именем роли',
      ],
      'view_console_it_works' => 'Посмотреть консоль, вы должны увидеть «это работает!» который исходит от FrontendController @ index',
      'you_can_see_because' => 'Вы можете увидеть это, потому что у вас есть роль «: роль»!',
      'you_can_see_because_permission' => 'Вы можете увидеть это, потому что у вас есть разрешение «: разрешение»!',
    ],
    'general' => [
      'joined' => 'Присоединился',
    ],
    'user' => [
      'change_email_notice' => 'Если вы измените свой адрес электронной почты, вы войдете в систему, пока не подтвердите новый адрес электронной почты.',
      'email_changed_notice' => 'Вы должны подтвердить свой новый адрес электронной почты, прежде чем вы сможете войти снова.',
      'profile_updated' => 'Профиль успешно обновлен.',
      'password_updated' => 'Пароль успешно обновлен.',
    ],
    'welcome_to' => 'Добро пожаловать в х1',
  ],
  'enabled' => 'Включено',
  'disabled' => 'Отключено',
  'total' => 'Общее',
  'uzbek' => 'Узбек',
  'english' => 'английский',
  'russian' => 'русский',
  'Key' => 'Ключ',
  'Value' => 'Значение',
  'Actions' => 'Действия',
  'Create' => 'Создавать',
  'Are you sure you want to do this?' => 'Вы уверены, что хотите это сделать?',
  'General' => 'Общий',
  'Data' => 'Данные',
  'Image' => 'Изображение',
  'Additional Images' => 'Дополнительные изображения',
  'Social links' => 'Социальные ссылки',
  'Instagram' => 'Instagram.',
  'Facebook' => 'Facebook',
  'YouTube' => 'YouTube',
  'Contacts' => 'Контакты',
  'Phone' => 'Телефон',
  'Address' => 'Адрес',
  'new' => 'Новый',
  'completed' => 'Завершенный',
  'canceled' => 'Отменил',
  'Settings' => 'Настройки',
  "Search" => "Найти",
  "Sign In to your account" => "Sign In to your account",
  "Login" => "Login",
  "Username" => "Username",
  "Password" => "Password",
  "Forgot password" => "Forgot password"
];