# MixEEr
[Laravel Mix](https://github.com/JeffreyWay/laravel-mix) for [ExpressionEngine](https://expressionengine.com/). This addon brings the `mix()` method to ExpressionEngine's template system.

### Notes and caveats
- This addon assumes you've already got your `webpack.mix.js` file and build tools set up, it does not include the base Laravel Mix build tools, [read this](https://github.com/JeffreyWay/laravel-mix/blob/master/docs/installation.md) if you need help getting started with Laravel Mix.
- Laravel Mix works best compiling assets either alongside or below (not above) the target directory. You should already be running [ExpressionEngine's control panel outside the public folder](https://docs.expressionengine.com/latest/installation/best_practices.html), so use Laravel Mix from there. Here's an example folder structure:

```
    ├── system/
    │   ├── ee/
    │   └── user/
    │   ├── index.html
    │   ├── index.php
    ├── node_modules/
    ├── public/
    │   ├── assets/
    │   │   ├── css/
    │   │   └── js/
    │   ├── images/
    │   └── themes/
    │   ├── admin.php
    │   ├── favicon.ico
    │   ├── index.php
    │   ├── mix-manifest.json
    ├── resources/
    │   ├── fonts/
    │   ├── js/
    │   └── sass/
    ├── webpack.mix.js
    ├── package.json
```

### Installation
- Copy the `mixeer/` folder to `system/user/addons/`
- Go to *Developer > Addons* and install the plugin.

### Usage
Add the `{exp:mixeer}` tag to your templates, for example:

```
<link rel="stylesheet" href="{exp:mixeer file='assets/css/app.css'}">
<script src="{exp:mixeer file='assets/js/app.js'}"></script>
```

You can also pass the `manifest_dir` parameter if your `mix-manifest.json` file is not in the root of your *public* folder:

```
<link rel="stylesheet" href="{exp:mixeer manifest_dir='assets/manifest' file='assets/css/app.css'}">
```
