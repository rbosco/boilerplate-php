'use strict';
var gulp = require('gulp'),
        jshint = require('gulp-jshint'),
        gutil = require('gulp-util'),
        clean = require('gulp-clean'),
        ignore = require('gulp-ignore'),
        copy = require('gulp-copy'),
        imagemin = require('gulp-imagemin'),
        less = require('gulp-less'),
        uglify = require('gulp-uglify'),
        watch = require('gulp-watch'),
        changed = require('gulp-changed'),
        minifyCSS = require('gulp-minify-css'),
        rename = require('gulp-rename'),
        header = require('gulp-header'),
        plumber = require('gulp-plumber'),
        browserSync = require('browser-sync').create(),
        reload = browserSync.reload,
        pkg = require('./package.json'),
        /***** DIRETORIOS ***/
        paths = {
            themes: '_public/themes/default/',
            dev: ['_app/', '_public'],
            prod: 'producao/'
        },
/* BANNER */
banner = ['/**',
    ' * <%= pkg.name %> v<%= pkg.version %>',
    ' * <%= pkg.description %>',
    ' * <%= pkg.author.name %> <<%= pkg.author.email %>>',
    ' */',
    ''].join('\n');

function errorLog(error) {
    console.error.bind(error);
    this.emit('end');
}


/***** TAREFAS DEV***/

/** COMPILA O LESS E RENOMEIA O CSS **/
gulp.task('less', function () {
    gulp.src(paths.themes + 'less/default.less')
            .pipe(plumber())
            .pipe(less())
            .pipe(minifyCSS({keepSpecialComments: 1}))
            .pipe(rename('style.min.css'))
            .pipe(gulp.dest(paths.themes + 'css/'));
});

gulp.task('browserSync', function () {
    browserSync.init(['./*.php', paths.themes + 'js/**/*.js', paths.themes + 'less/*.less', paths.themes + 'templates/**/*.phtml', paths.themes + 'templates/*.phtml', paths.dev[0] + '**/*.php'], {
        proxy: 'http://arquiteturaphp.com.br:9090'
    });
});

gulp.task('watch', ['browserSync'], function () {
    gulp.watch(paths.dev[0] + '**/*.php', reload);
    gulp.watch(paths.themes + 'less/**/**/*.less', ['less']);
    gulp.watch(paths.themes + 'css/*.min.css', reload);
    gulp.watch(paths.themes + 'js/**/*.js', reload);
    gulp.watch(paths.themes + 'templates/**/*.phtml', reload);
});

gulp.task('dev', ['watch']);

/***** TAREFAS PRODUCAO***/

/** LIMPAR A PASTA PRODUCAO **/
gulp.task('clean', function () {
    gulp.src(paths.prod)
            .pipe(clean())
            .on('error', errorLog);
});

/** MINIFICAR O JAVASCRIPT DO PROJETO **/
gulp.task('uglify', function () {
    gulp.src('js/**', {cwd: paths.themes})
            .pipe(plumber())
            .pipe(uglify())
            .pipe(gulp.dest(paths.prod + paths.themes + 'js'));
});

gulp.task('imagemin', function () {
    return gulp.src('images/**', {cwd:paths.themes})
            .pipe(imagemin())
            .pipe(gulp.dest(paths.prod + paths.themes + 'images'));
});


gulp.task('changed', function () {
    return gulp.src([paths.dev[0], paths.themes])
            .pipe(changed(paths.prod))
            .on('error', errorLog)
            .pipe(gulp.dest(paths.prod));
});

gulp.task('copy',['clean', 'uglify', 'imagemin'], function () {
    /**COPIAR A PASTA APP**/
    gulp.src('**/', {cwd: paths.dev[0]})
            .pipe(gulp.dest(paths.prod + paths.dev[0]));

    /**COPIAR PASTAS DO PUBLIC*/
    gulp.src([paths.themes + '/**',
            '!' + paths.themes + 'less{,/**}',
            '!' + paths.themes + 'js{,/**}',
            '!' + paths.themes + 'images{,/**}'])
            .pipe(gulp.dest(paths.prod + paths.themes));
    

    /**COPIAR ARQUIVOS DA RAIZ**/
    gulp.src(['index.php', '.htaccess'])
            .pipe(gulp.dest(paths.prod));
});

gulp.task('prod', ['copy']);

/***** TAREFAS TESTE***/

/**VERIFICA ERROS NO JS**/
gulp.task('jshint', function () {
    gulp.src(paths.themes + 'js/*.js')
            .pipe(jshint())
            .on('error', errorLog)
            .pipe(jshint.reporter('default'));
});

gulp.task('test', ['jshint']);










