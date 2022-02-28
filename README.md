# Minimal PHP Skeleton MVC

***
> **NB:** *this is for education purpose*

## Installation

You can create new project via composer:

```bash
composer create-project forticas/minimal-php-skeleton-mvc project-name
```

## Project structure

`controller`, `model` and `view` folders are inside `src`

```
project-name
└───core
│   │   Controller.php
│   │   Dao.php
│   │   Model.php
│   │   Router.php
│   
└───public
│   │   index.php
│   │   .htaccess
│   
└───src
│   └───controller
│   └───model
│   └───view
│   │   └───...
│   │   │   layout.php
│   
│   .gitignore
│   .htaccess
│   README.md
│   composer.json
│   config.ini
```

## Usage
### 1. Configuration

change configuration inside `config.ini`

```ini
[database]
host= localhost
dbname = your_db_name
;default MySQL port
port = 3306
username = your_db_username
password = your_db_password

[server]
;your project folder name
base_uri = /project-name
```

### 2. Controller

```php
// project-name/src/controller/DefaultController.php

declare(strict_types=1)

use App\core\Controller;

class DefaultController extends Controller
{
    public function my_first_action(){
        //...
        $message = 'Hello World!';
        $user = 'John Doe'
        $this->renderView('defaut_folder_name/file_name',[
            'message' => $message,
            'userName' => $user
            //...
        ])
    } 
    public function my_second_action(mixed ...$values){
        
    }
}
```
#### Predefined method inside controllers
```php
$this->renderView(string $path, array $args = [], bool $isWithoutLayout = false)
```
```php
$this->redirectTo(string $path)
```
```php
$this->redirectToRoute(string $path)
```
```php
$this->json(array $content)
```

### 3. Routing

define routing inside `index.php`

Examples : 
```php
// project-name/public/index.php

...
$router = new Router();
$router->register('/', '\App\controller\DefaultController::index');
$router->register('/contact', '\App\controller\DefaultController::contact');
$router->register('/posts', '\App\controller\PostController::list');
$router->register('/posts/#id', '\App\controller\PostController::showOne');
$router->register('/posts/#status/orderBy/#date', '\App\controller\PostController::showWithStatusAndOrderBy');
$router->run();
```

### 4. Views
> Don't delete `layout.php` file.

create your views files inside `project-name/src/view/`

Examples :
```
project-name 
└───...
│
└───src
│   └───...
│   └───view
│   │   └───default
│   │   │   │   index.php
│   │   │   │   contact.php
│   │   └───post
│   │   │   │   list.php
│   │   │   │   show_one.php
│   │   │   layout.php
│   
│   ...
```

### 4. Models
Example : 
```php
// project-name/src/model/Post.php

declare(strict_types=1)

use App\core\Model;

class Post extends Model
{
    private int $id;
    private string $title;
    //...
    
    /**
     * @return int
     */
     public  function getId(): int{
        return $this->id;
    }
    /**
     * @return string
     */
     public  function getTitle(): string{
        return $this->title;
    }
    /**
     * @param string $title
     * @return Post
     */
     public  function setTitle(string $title):self {
        $this->title = $title;
        return $this;
    }
}
```

### 5. Database predefined methods:

`Coming soon...`