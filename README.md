# MixEEr
 This addon brings [Laravel Mix](https://github.com/JeffreyWay/laravel-mix)'s `mix()` method to [ExpressionEngine](https://github.com/ExpressionEngine/ExpressionEngine)'s template system.

### Preamble
- This addon assumes you've already got your `webpack.mix.js` file and build tools set up, it does not include the base Laravel Mix build tools, [read this](https://github.com/JeffreyWay/laravel-mix/blob/master/docs/installation.md#stand-alone-project) if you need help getting started with Laravel Mix.
- Laravel Mix works best compiling assets either alongside or below the target directory; you should already have [ExpressionEngine's System directory above the public folder](https://docs.expressionengine.com/latest/installation/best-practices.html#moving-the-system-directory-above-webroot), so use Laravel Mix as a sibling of the **System** directory.

Here's a typical folder structure for example:

<pre>
    ├── <b>system/</b>
    │   ├── <b>ee/</b>
    │   └── <b>user/</b>
    │   ├── index.html
    │   ├── index.php
    ├── <b>node_modules/</b>
    ├── <b>public/</b>
    │   ├── <b>assets/</b>
    │   │   ├── <b>css/</b>
    │   │   └── <b>js/</b>
    │   ├── <b>images/</b>
    │   └── <b>themes/</b>
    │   ├── admin.php
    │   ├── favicon.ico
    │   ├── index.php
    │   ├── mix-manifest.json
    ├── <b>resources/</b>
    │   ├── <b>fonts/</b>
    │   ├── <b>js/</b>
    │   └── <b>sass/</b>
    ├── <em>webpack.mix.js</em>
    ├── <em>package.json</em>
</pre>

- You may be unable to compile assets until you specify the `publicPath` in your Mix options, for example:

```
mix.options({
    publicPath: 'public',
});

mix.sass('resources/sass/app.scss', 'public/assets/css')
    .js('resources/js/app.js', 'public/assets/js');
```

### Installation
- [Download](https://github.com/benjivm/mixeer/archive/master.zip) the MixEEr addon
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
