# Project-4

В данном проекте применяются следующие технологии:
* HTML
* CSS
* JavaScript
* jQuery
* LESS
* GULP
* PHP
* SQL
* Materialize

Применена БЭМ-методология. Данный проект был направлен на работу с бэкендом. 
Верстка проводилась без макета и с помощью компонентов CSS фреймворка Materialize.
Веб сайт представляет из себя блокнот для чтения, редактировани и добавления записей. 
Для проведения работ с блокнотом необходима регистрация/авторизация.

Для работы с проектом необходимо:
1. предварительно установить node.js для работы пакетного менеджера npm
2. установить OpenServer для отображения в браузере файлов .php
2. скачать проект с помощью команды <p>git clone https://github.com/SeregaZnam/Project-4.git<p>
либо скачать архив с git репозитория и разархивировать у себя в директории OpenServer
3. в консоли ввести команду npm install для скачивания всех необходимых библиотек
4. запустить OpenServer

### Структура базы данных
```
.
└── Project-5
    ├── cardsContent
    |    ├── id
    |    ├── id_content
    |    ├── title
    |    ├── text
    |    └── datatime
    └── registryPeople
        ├── id
        ├── id_content
        ├── name
        ├── surname
        ├── nickname
        ├── password
        ├── email
        ├── age
        └── male
```
### Карта проекта
```
.
├── app
│   ├── classes
|   │   ├── databaseConnect.php
|   │   └── formBuild.php
│   ├── css
|   │   ├── main.min.css
|   │   └── materialize.min.css
│   ├── img
|   |   └── ...
│   ├── js
|   │   └── main.js
│   ├── libs
|   │   ├── createOptions.js
|   │   ├── jquery-3.2.1.min.js
|   │   └── materialize.min.js
│   ├── templates
|   │   ├── authorization.php
|   │   ├── logout.php
|   │   ├── main-window.php
|   │   └── registration.php
│   ├── .htaccess
│   └── index.php
├── less
|   ├── imports
|   |   ├── authorization.less
|   |   ├── first-list.less
|   |   ├── main-window.less
|   |   ├── registration.less
|   |   └── reset.less
│   └── main.less
├── .bowerrc
├── .gitignore
├── README.md
├── gulpfile.js
└── package.json
```
