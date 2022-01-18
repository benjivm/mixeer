# MixEEr
 This addon brings [Laravel Mix's](https://github.com/JeffreyWay/laravel-mix) `mix()` method to [ExpressionEngine's](https://github.com/ExpressionEngine/ExpressionEngine) template system.

## Preamble
- This addon assumes you've already got your `webpack.mix.js` file and build tools set up, it does not include the base Laravel Mix build tools, [read this](https://github.com/JeffreyWay/laravel-mix/blob/master/docs/installation.md#stand-alone-project) if you need help getting started with Laravel Mix.
- Laravel Mix works best when the public path is either a sibling or below its own directory. Therefore, because it's [best practice](https://docs.expressionengine.com/latest/installation/best-practices.html#moving-the-system-directory-above-webroot) to move ExpressionEngine's `system/` directory above the `public/` directory, you should setup Laravel Mix as a sibling of the `system/` directory.

Here's an example directory structure:

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

- You may be unable to compile assets until you specify the `publicPath` in your Mix options:

```js
mix.sass('resources/sass/app.scss', 'public/assets/css')
    .js('resources/js/app.js', 'public/assets/js')
    .options({
        publicPath: 'public',
    });
```

## Installation
- [Download](https://github.com/benjivm/mixeer/archive/master.zip) the MixEEr addon.
- Copy the `mixeer/` directory to the `system/user/addons/` directory.
- In ExpressionEngine's control panel go to *Developer > Addons* and install the plugin.

## Usage
Once the plugin is installed you can use the `{exp:mixeer}` tag in your templates:

```html
<link rel="stylesheet" href="{exp:mixeer file='assets/css/app.css'}">
<script src="{exp:mixeer file='assets/js/app.js'}"></script>
```

If you are overriding the directory of Laravel Mix's generated `mix-manifest.json` file you may also pass the `manifest_dir` parameter:

```html
<link rel="stylesheet" href="{exp:mixeer manifest_dir='assets/manifest' file='assets/css/app.css'}">
```
