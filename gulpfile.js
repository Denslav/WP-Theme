const gulp        = require('gulp');
const gulpif      = require('gulp-if');
const browserSyncConst = require('browser-sync').create();
const sass        = require('gulp-sass')(require('sass'));
const prefixer    = require('gulp-autoprefixer');
const sourcemaps  = require('gulp-sourcemaps');
const webpack     = require('webpack-stream');
const path = require("path");
const glob = require('glob');
const postcss = require('gulp-postcss');
const pxtorem = require('postcss-pxtorem');
const fs = require('fs');

const themeName = 'theme',
      host      = 'http://local.loc';
var   mode      = 'production';

function browserSync(done) {
    browserSyncConst.init({
        proxy: host,
        serveStatic: [
            {
                route: '/wp-content/themes/' + themeName + '/dist/css',
                dir: 'dist/css'
            },
            {
                route: '/wp-content/themes/' + themeName + '/dist/js',
                dir: 'dist/js'
            }
        ],
        files: ['dist/css/*.css', 'dist/js/*.js', 'dist/vendors/**/*.*']
    });
    done();
}

function startWatch(done) {
    gulp.watch(['**/*.php']).on('change', browserSyncConst.reload);

    gulp.watch('src/js/**/*.js', gulp.series(buildScripts, browserSyncConst.reload));

    gulp.watch('theme.json', gulp.series(jsonToScss, buildStyles));
    gulp.watch('src/scss/**/*.scss', buildStyles);

    done();
}

function buildStyles() {
    return gulp.src([
            'src/scss/global.scss',
            'src/scss/fonts.scss',
            'src/scss/header.scss',
            'src/scss/footer.scss',
            'src/scss/admin-styles.scss',
            'src/scss/pages/**/*.scss',
            'src/scss/blocks/**/*.scss',
            '!src/scss/**/_*.scss'
        ], { base: 'src/scss' })
        .pipe(gulpif(mode === 'development', sourcemaps.init()))
        .pipe(sass({
            outputStyle: 'compressed',
            includePaths: ['node_modules']
        }).on('error', sass.logError))
        .pipe(postcss([
            pxtorem({
                rootValue: 16,
                unitPrecision: 5,
                propList: ['*'],
                replace: true,
                mediaQuery: true,
                minPixelValue: 1
            })
        ]))
        .pipe(gulpif(mode === 'production', prefixer('last 4 version')))
        .pipe(gulpif(mode === 'development', sourcemaps.write()))
        .pipe(gulp.dest('dist/css/'))
        .pipe(browserSyncConst.stream());
}

function buildScripts() {
    const entries = {};
    glob.sync('./src/js/**/*.js').forEach(f => {
        const relativePath = path.relative('./src/js', f);
        const entryName = relativePath.replace(/\.js$/, '');
        entries[entryName] = f;
    });

    const webpackConfig = {
        mode: mode,
        entry: entries,
        output: {
            filename: '[name].min.js',
            path: path.resolve(__dirname, 'dist/js'),
        },
        module: {
            rules: [{
                test: /\.js$/,
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader',
                    options: { presets: ['@babel/preset-env'] }
                }
            }]
        }
    };

    return webpack(webpackConfig, require('webpack'))
        .pipe(gulp.dest('dist/js'))
        .pipe(browserSyncConst.stream())
}

function jsonToScss(done) {
    const theme = JSON.parse(fs.readFileSync('theme.json', 'utf8'));
    let scssContent = '';

    //containerts
    scssContent += `$wp--preset--container--content-size: ${theme.settings.layout.contentSize}; // ${theme.settings.layout.contentSize}\n`;
    scssContent += `$wp--preset--container--wide-size: ${theme.settings.layout.wideSize}; // ${theme.settings.layout.wideSize}\n`;

    //colors
    theme.settings.color.palette.forEach((color, index) => {
        scssContent += `$wp--preset--color--${color.slug}: ${color.color}; // ${color.name}\n`;
    });

    //gradients
    theme.settings.color.gradients.forEach((gradient, index) => {
        scssContent += `$wp--preset--gradient--${gradient.slug}: ${gradient.gradient}; // ${gradient.name}\n`;
    });

    //fontSizes
    theme.settings.typography.fontSizes.forEach((fontSize, index) => {
        scssContent += `$wp--preset--font-size--${fontSize.slug}: ${fontSize.size}; // ${fontSize.name}\n`;
    });

    //fontFamilies
    theme.settings.typography.fontFamilies.forEach((fontFamily, index) => {
        scssContent += `$wp--preset--font-family--${fontFamily.slug}: ${fontFamily.fontFamily}; // ${fontFamily.name}\n`;
    });

    fs.writeFileSync('src/scss/_gutenberg-variables.scss', scssContent);
    done();
}


const build = gulp.series(jsonToScss, gulp.parallel(buildScripts, buildStyles));

exports.build_styles = buildStyles;
exports.build_json   = jsonToScss;
exports.build_js     = buildScripts;
exports.build        = build;
exports.default      = gulp.parallel(build, browserSync, startWatch);
